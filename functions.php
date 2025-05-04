<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 */

// Load Composer dependencies.
require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/src/StarterSite.php';

Timber\Timber::init();

// Sets the directories (inside your theme) to find .twig files.
Timber::$dirname = [ 'templates', 'views' ];



new StarterSite();

add_action('wp_enqueue_scripts', 'enqueue_styles');
function enqueue_styles(){
    wp_enqueue_style('pico', get_template_directory_uri() . '/assets/css/pico.min.css');
    wp_enqueue_style('default', get_template_directory_uri() . '/assets/css/style.css');
}

/*
add_action('wp_enqueue_scripts', 'enqueue_scripts');
function enqueue_scripts(){
    wp_enqueue_script( 
        'changing_words', 
        get_template_directory_uri() . '/assets/js/changing_words.js', 
        array('jquery'), // Abhängigkeiten als Array
        '1.0.0', 
        true // Lädt das Script im Footer
    );
}
*/

// In deiner functions.php oder eigenem Mini-Plugin
add_action('admin_bar_menu', 'add_purge_button_to_admin_bar', 100);

function add_purge_button_to_admin_bar($wp_admin_bar) {
    if (!current_user_can('manage_options')) return;

    $wp_admin_bar->add_node([
        'id'    => 'purge_varnish_cache',
        'title' => '🔄 Varnish Cache leeren',
        'href'  => wp_nonce_url(admin_url('?purge_varnish=1'), 'purge-varnish'),
    ]);
}

add_action('init', function () {
    if (is_admin() && current_user_can('manage_options') && isset($_GET['purge_varnish'])) {
        if (!check_admin_referer('purge-varnish')) return;

        $url = home_url('/');

        $response = wp_remote_request($url, [
            'method' => 'PURGE',
            'headers' => ['Host' => $_SERVER['HTTP_HOST']],
        ]);

        if (!is_wp_error($response)) {
            wp_safe_redirect(admin_url('?purge_success=1'));
            exit;
        }
    }
});
