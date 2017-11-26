<?php

final class Products_Product
{

    private $post_type = 'product';

    function __construct($post_type = "")
    {

        if ($post_type)
            $this->post_type = $post_type;

        add_action('init', array($this, 'products_cpt_product'));

        add_action('generate_rewrite_rules', array($this, 'fix_products_category_pagination'));

        add_filter('post_type_link', array($this, 'products_permalink_structure'), 10, 2);

        add_filter('wp_handle_upload', array($this, 'watermark'));

        return false;

    }


    public function products_cpt_product()
    {

        register_taxonomy(
            'products_product_type', 'products_product', array(
                'label' => 'Types',
                'hierarchical' => true,
                'query_var' => true,
                'rewrite' => array('slug' => $this->post_type),
            )
        );

        $labels = array(
            'name' => 'Products',
            'singular_name' => 'Products',
            'add_new' => 'Add Product',
            'add_new_item' => 'Add Product',

        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'rewrite' => array(
                'slug' => $this->post_type . '/%products_product_type%',
                'with_front' => false,
            ),
            'has_archive' => $this->post_type,
        );

        register_post_type('products_product', $args);


        if (current_user_can('manage_options'))
            flush_rewrite_rules();
    }

    public function products_permalink_structure($post_link, $post)
    {
        if (FALSE !== strpos($post_link, '%products_product_type%')) {
            $product_type_term = get_the_terms($post->ID, 'products_product_type');
            if (!empty($product_type_term))
                $post_link = str_replace('%products_product_type%', $product_type_term[0]->slug, $post_link);
        }
        return $post_link;
    }

    public function fix_products_category_pagination($wp_rewrite)
    {
        unset($wp_rewrite->rules[$this->post_type . '/([^/]+)/page/?([0-9]{1,})/?$']);
        $wp_rewrite->rules = array(
                $this->post_type . '/?$' => $wp_rewrite->index . '?post_type=products_product',
                $this->post_type . '/page/?([0-9]{1,})/?$' => $wp_rewrite->index . '?post_type=products_product&paged=' . $wp_rewrite->preg_index(1),
                $this->post_type . '/([^/]+)/page/?([0-9]{1,})/?$' => $wp_rewrite->index . '?products_product_type=' . $wp_rewrite->preg_index(1) . '&paged=' . $wp_rewrite->preg_index(2),
            ) + $wp_rewrite->rules;
    }


    public function watermark($data)
    {

        $id = $_REQUEST['post_id'];

        if (get_post_type($id) == 'products_product') {

            $image = wp_get_image_editor($data['file']);
            if (!is_wp_error($image)) {
                $image->set_quality(90);
                $datas = $image->save($data['file'], $data['type']);

                $img = new \Imagick();
                $img->readImage($datas['path']);
                $im_d = $img->getImageGeometry();
                $im_w = $im_d['width'];
                $im_h = $im_d['height'];

                $watermark = new \Imagick();
                $watermark->readImage($_SERVER['DOCUMENT_ROOT'] . "/wordpress/watermark.png");
                $watermark->rotateImage(new \ImagickPixel('transparent'), -13.55);
                $watermark->evaluateImage(\Imagick::EVALUATE_MULTIPLY, 0.8, Imagick::CHANNEL_ALPHA);
                $watermark_d = $watermark->getImageGeometry();
                $watermark_w = $watermark_d['width'];
                $watermark_h = $watermark_d['height'];

                $margin = 3;
                $x_loc = $im_w - $watermark_w - $margin;
                $y_loc = $im_h - $watermark_h - $margin;
                $img->compositeImage($watermark, \Imagick::COMPOSITE_OVER, $x_loc, $y_loc);
                $img->writeImage($datas['path']);

            }
            return $data;
        } else {
            $image = wp_get_image_editor($data['file']);
            if (!is_wp_error($image)) {
                $image->set_quality(90);
                $image->save($data['file'], $data['type']);
            }
            return $data;
        }

    }

}


new Products_Product('product');