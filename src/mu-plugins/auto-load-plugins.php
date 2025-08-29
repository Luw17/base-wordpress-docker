<?php
$plugins_dir = WP_CONTENT_DIR . '/plugins';

foreach (glob($plugins_dir . '/*', GLOB_ONLYDIR) as $plugin_folder) {
    $main_file = $plugin_folder . '/' . basename($plugin_folder) . '.php';
    if (file_exists($main_file)) {
        include_once $main_file;
    } else {
        foreach (glob($plugin_folder . '/*.php') as $file) {
            include_once $file;
        }
    }
}
