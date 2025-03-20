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