<?php
define('DB_NAME', 'wordpress');
define('DB_USER', 'wordpress');
define('DB_PASSWORD', '8bb3fe74b0471256703e2d1c08f12802');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

define('AUTH_KEY', '13cf63152bc11606d304abe41bfe93ba1a1acdb1fe60101615075027564f8a8e');
define('AUTH_SALT', '180002fd5e6987639000805b77b9de9a29748147a105b3399b22d04510dbadac');
define('AUTH_KEY', '13cf63152bc11606d304abe41bfe93ba1a1acdb1fe60101615075027564f8a8e');
define('AUTH_SALT', '180002fd5e6987639000805b77b9de9a29748147a105b3399b22d04510dbadac');
define('LOGGED_IN_KEY', 'a966a0d95dc38750faea1364be533a63d47d943235159253a81c4ebbb9f3bb68');
define('LOGGED_IN_SALT', 'e27e8be63165ffe5c7df64d419061c1fa54577faf6e969c0c58588c00f82751c');
define('NONCE_KEY', '38740bde49f4575939ae2f3daceabb8a897caa1181e9b656ef0ef64e99f28bfa');
define('NONCE_SALT', 'a49a0b2798255bf321b5abb14bfe51e63fc2918eec8bfa603423466929c0115d');

$table_prefix  = 'wp_';

// WordPress Localized Language, defaults to English.
define ('WPLANG', '');

// WordPress debugging mode (for developers).
define('WP_DEBUG', false);

// WordPress update method
define('FS_METHOD', 'direct');

// WordPress update policy
define('AUTOMATIC_UPDATER_DISABLED', false);
define('WP_AUTO_UPDATE_CORE', 'minor');

// Single-Site (serves any hostname)
// For Multi-Site, see: https://www.turnkeylinux.org/docs/wordpress/multisite
define('WP_SITEURL', 'http://'.$_SERVER['HTTP_HOST']);
define('WP_HOME', 'http://'.$_SERVER['HTTP_HOST']);

/* That's all, stop editing! Happy blogging. */

if ( !defined('ABSPATH') )
        define('ABSPATH', dirname(__FILE__) . '/');

require_once(ABSPATH . 'wp-settings.php');
