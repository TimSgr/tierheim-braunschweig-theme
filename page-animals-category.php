<?php
/**
 * Template Name: Animals Category
 */
$context = Timber::context();
$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$query = parse_url($url, PHP_URL_QUERY);

$context['post'] = Timber::get_post();
$args = [
    'post_type' => 'tier',
    'category_name' => $query,
];

$categories = ["Hunde", "Katzen", "Kleintiere"];
$context['categories'] = $categories;

$context['posts'] = Timber::get_posts($args);
error_log(print_r($context['posts'], true));
Timber::render('page-animals-category.twig', $context);

