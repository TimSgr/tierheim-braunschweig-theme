<?php
/**
 * Template Name: Animals
 */
$context = Timber::context();

$categories = ["Hunde", "Katzen", "Kleintiere"];
$context['categories'] = $categories;
Timber::render('page-animals.twig', $context);