<?php

add_action('init', function(){
  add_theme_support('post-thumbnails'); 
});

add_action('wp_enqueue_scripts', function(){
  wp_enqueue_style('main', get_stylesheet_uri());
  wp_enqueue_script('main', get_stylesheet_directory_uri() . '/sorting.js', '', '', true);
});
