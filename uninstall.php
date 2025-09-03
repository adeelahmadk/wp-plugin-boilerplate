<?php

/**
 * Trigger this file on Plugin uninstall
 *
 * @package  ResilientBitsPlugin
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

// Clear Database stored data
$books = get_posts(['post_type' => 'book', 'numberposts' => -1]);

foreach ($books as $book) {
    // Permanent deletion includes comments, post meta fields, and terms associated with the post.
    // true: delete all posts whether in draft, trash, or published.
    wp_delete_post($book->ID, true);
}

// Delete posts, meta, terms from the database via SQL
/*
global $wpdb;
$books = $wpdb->get_col(array(
	'post_type'      => 'book',
	'posts_per_page' => -1,    // Get all posts
	'fields'         => 'ids', // Only get post IDs for better performance
	'post_status'    => 'any', // Include drafts, private, etc.
));
$ids_string = implode(', ', array_map('absint', $post_ids));
$wpdb->query("DELETE FROM wp_posts WHERE post_type = 'book'");
$wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)");
$wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)");
*/