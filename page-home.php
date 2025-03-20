<?php
/**
 * Template Name: Home
 */
$context = Timber::context();
$context['post'] = Timber::get_post();
Timber::render('page-home.twig', $context);

