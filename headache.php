<?php

/**
 * Copyright (c) Vincent Klaiber.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
 * Plugin Name: Headache
 * Description: An easy-to-swallow painkiller plugin for WordPress.
 * Author: WordPlate
 * Author URI: https://github.com/wordplate/wordplate
 * Version: 1.4.0
 * Plugin URI: https://github.com/wordplate/headache
 * GitHub Plugin URI: wordplate/headache
 */

// Redirects all feeds to home page.
function headache_disable_feeds(): void
{
    wp_redirect(site_url());
}

// Disables feeds.
add_action('do_feed', 'headache_disable_feeds', 1);
add_action('do_feed_rdf',  'headache_disable_feeds', 1);
add_action('do_feed_rss',  'headache_disable_feeds', 1);
add_action('do_feed_rss2', 'headache_disable_feeds', 1);
add_action('do_feed_atom', 'headache_disable_feeds', 1);

// Disables comments feeds.
add_action('do_feed_rss2_comments', 'headache_disable_feeds', 1);
add_action('do_feed_atom_comments', 'hHeadache_disable_feeds', 1);

// Disable XML RPC for security.
add_filter('xmlrpc_enabled', '__return_false');

// Removes WordPress version.
remove_action('wp_head', 'wp_generator');

// Removes generated icons.
remove_action('wp_head', 'wp_site_icon', 99);

// Removes shortlink.
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Removes Really Simple Discovery link.
remove_action('wp_head', 'rsd_link');

// Removes RSS feed links.
remove_action('wp_head', 'feed_links', 2);

// Removes all extra RSS feed links.
remove_action('wp_head', 'feed_links_extra', 3);

// Removes wlwmanifest.xml.
remove_action('wp_head', 'wlwmanifest_link');

// Removes meta rel=dns-prefetch href=//s.w.org
remove_action('wp_head', 'wp_resource_hints', 2);

// Removes relational links for the posts.
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// Removes REST API link tag from header.
remove_action('wp_head', 'rest_output_link_wp_head', 10);

// Removes emojis.
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

// Removes oEmbeds.
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('wp_head', 'wp_oembed_add_host_js');

// Disable default users API endpoints for security.
// https://www.wp-tweaks.com/hackers-can-find-your-wordpress-username/
function headache_disable_rest_endpoints($endpoints): array
{
    if (!is_user_logged_in()) {
        if (isset($endpoints['/wp/v2/users'])) {
            unset($endpoints['/wp/v2/users']);
        }

        if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
            unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
        }
    }

    return $endpoints;
}

add_filter('rest_endpoints', 'headache_disable_rest_endpoints');

// Removes JPEG compression.
function headache_remove_jpeg_compression(): int
{
    return 100;
}

add_filter('jpeg_quality', 'headache_remove_jpeg_compression', 10, 2);

// Update login page image link URL.
function headache_login_url(): string
{
    return home_url();
}

add_filter('login_headerurl', 'headache_login_url');

// Update login page link title.
function headache_login_title(): string
{
    return get_bloginfo('name');
}

add_filter('login_headertext', 'headache_login_title');

// Remove Gutenberg's front-end block styles.
function headache_remove_block_styles(): void
{
    wp_deregister_style('wp-block-library');
}

add_action('wp_enqueue_scripts', 'headache_remove_block_styles');

// Remove Gutenberg's global styles.
// https://github.com/WordPress/gutenberg/pull/34334#issuecomment-911531705
function headache_remove_global_styles()
{
    wp_dequeue_style('global-styles');
}

add_action('wp_enqueue_scripts', 'headache_remove_global_styles');

// Removes ?ver= query from styles and scripts.
function headache_remove_script_version(string $src): string
{
    return $src ? esc_url(remove_query_arg('ver', $src)) : $src;
}

add_filter('script_loader_src', 'headache_remove_script_version', 15, 1);
add_filter('style_loader_src', 'headache_remove_script_version', 15, 1);

// Remove contributor, subscriber and author roles.
function headache_remove_roles(): void
{
    remove_role('author');
    remove_role('contributor');
    remove_role('subscriber');
}

add_action('init', 'headache_remove_roles');
