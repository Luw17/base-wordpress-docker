<?php
/**
 * WordPress configuration for development in Docker
 */

if (!function_exists('getenv_docker')) {
    function getenv_docker($env, $default = '') {
        if ($fileEnv = getenv($env . '_FILE')) {
            return rtrim(file_get_contents($fileEnv), "\r\n");
        } else if (($val = getenv($env)) !== false) {
            return $val;
        } else {
            return $default;
        }
    }
}

// ** Database settings **
define('DB_NAME',     getenv_docker('WORDPRESS_DB_NAME', 'wordpress'));
define('DB_USER',     getenv_docker('WORDPRESS_DB_USER', 'wordpress'));
define('DB_PASSWORD', getenv_docker('WORDPRESS_DB_PASSWORD', 'wordpress'));
define('DB_HOST',     getenv_docker('WORDPRESS_DB_HOST', 'db:3306'));
define('DB_CHARSET',  'utf8');
define('DB_COLLATE',  '');

// ** Authentication Unique Keys and Salts **
define('AUTH_KEY',         getenv_docker('WORDPRESS_AUTH_KEY', 'put-your-unique-phrase-here'));
define('SECURE_AUTH_KEY',  getenv_docker('WORDPRESS_SECURE_AUTH_KEY', 'put-your-unique-phrase-here'));
define('LOGGED_IN_KEY',    getenv_docker('WORDPRESS_LOGGED_IN_KEY', 'put-your-unique-phrase-here'));
define('NONCE_KEY',        getenv_docker('WORDPRESS_NONCE_KEY', 'put-your-unique-phrase-here'));
define('AUTH_SALT',        getenv_docker('WORDPRESS_AUTH_SALT', 'put-your-unique-phrase-here'));
define('SECURE_AUTH_SALT', getenv_docker('WORDPRESS_SECURE_AUTH_SALT', 'put-your-unique-phrase-here'));
define('LOGGED_IN_SALT',   getenv_docker('WORDPRESS_LOGGED_IN_SALT', 'put-your-unique-phrase-here'));
define('NONCE_SALT',       getenv_docker('WORDPRESS_NONCE_SALT', 'put-your-unique-phrase-here'));

// ** Table prefix **
$table_prefix = getenv_docker('WORDPRESS_TABLE_PREFIX', 'wp_');

// ** Debug settings for development **
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);
define('SCRIPT_DEBUG', true);
define('SAVEQUERIES', true);
define('WP_CACHE', false);

// If behind a proxy server
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) {
    $_SERVER['HTTPS'] = 'on';
}

// Absolute path to the WordPress directory
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

// Setup WordPress vars and included files
require_once ABSPATH . 'wp-settings.php';
