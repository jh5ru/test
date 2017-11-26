<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'wordpress');

/** Имя пользователя MySQL */
define('DB_USER', 'wordpress');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'wordpress145236');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'WUl4pmp@`e__TdiYtc?Sr6<#7n}6yeI,B+fvK!RvTw@F|/RL(^qa9ta+!Ntwv]:z');
define('SECURE_AUTH_KEY', 'QRKmKiq8&jHVsMA|Ot,#qm_Cn@<UH()M@cQuQ(/&={YrS-b$mug@e9yd{;U4K@-e');
define('LOGGED_IN_KEY', 'Kl8`7k:!$SIA0X p@BO*^#_r_,r;madA)HK4V-J ,HXix?n25zw~a)G8Db&!<&;7');
define('NONCE_KEY', 'LFX^7#dacZv410@VrxZ~s(F{5EA|4&>6V=Us}k~HoOwUS``z e;[$PcSZ,?M`)sK');
define('AUTH_SALT', 'jl:hyyk>^BQXsbVb9PwWt2)AGebfNW;1@ kb5NB-+tAnZxBy;E{C]<?5Ix*70{wF');
define('SECURE_AUTH_SALT', '<&8p%9$iLr%Cp&^usWK{ Po2llMYiLo r-iT<3*xzF}/b]Sy_J<7JH~q3uhGGG(a');
define('LOGGED_IN_SALT', '~Ucb*}wxF.XzqX+`J#R<B4![Rnp.%5o>G=8I]uV?vn=__mAKs?K2GPK@:(#*h!{M');
define('NONCE_SALT', ':999`d0um|Rgkyiap`^<s|MU}GW-I9so,&7@OogM}qRZ9M?#wwSKj;z^hydN`bL/');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */

define('WP_DEBUG', true);

define('WP_DEBUG_LOG', true);

define('WP_DEBUG_DISPLAY', true);

define('SCRIPT_DEBUG', true);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if (!defined('ABSPATH'))
    define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
