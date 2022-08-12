<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'nimona' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'root' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', 'root' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '(j7XCfxwx$%!W) ciW76RHOzSHi{>+3<#]Fz)c$Vvv.aG:|OQlQT0Q<Kr>ELEW9}' );
define( 'SECURE_AUTH_KEY',  'B4R68^=FrFHJR88.f2F&L38TpR1Ky~3EmgLdED_UiZ#bj9iPo9<^y.f]:/y7KL}b' );
define( 'LOGGED_IN_KEY',    'P#Z_^3| @)2S0Qdm+e*;M?{fW^vV]6BDQYtw`:M4?2/0MW*jhuzrsE,9{gxhzNM;' );
define( 'NONCE_KEY',        'ROAH_5|quu`[~JIgN@ QqC{TEH*b*DCMEU&mu`zxy4W0wVE 2S)`;D~1LV|$P =%' );
define( 'AUTH_SALT',        'Iza[E3jeFxM%qhYw$K (;Ip&-h[`,81zr|7Cv^M6GSR?~Yf(nD=U{O2tNTvZ!:g@' );
define( 'SECURE_AUTH_SALT', '/X1-r<&B@C@.Qb=EI<_L~qy+|Sz{m|A}s;.$@n`/R)sTU`f<7-F&c`it.nX]75R<' );
define( 'LOGGED_IN_SALT',   '4b?B??6$5nK1IDgT:r($8S=*8bCZ}B9:nRB;p5EDv?)B8wj%m9hz$+/!J!5lH/JN' );
define( 'NONCE_SALT',       '{]6=uP^^/-A13Q#?QJ#5,tD,`&*M>`+qs9Pe<O{-Up4_ePn,Q@Fi4M7Jvuac8~kr' );

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
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
