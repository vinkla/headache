<?php

/**
 * Copyright (c) Vincent Klaiber
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/headache
 */

/*
 * Plugin Name: Headache
 * Description: An easy-to-swallow painkiller plugin for WordPress.
 * Author: Vincent Klaiber
 * Author URI: https://github.com/vinkla
 * Version: 3.3.1
 * Plugin URI: https://github.com/vinkla/headache
 * GitHub Plugin URI: vinkla/headache
 */

declare(strict_types=1);

namespace Headache;

use Ramsey\Uuid\Uuid;

// Redirects all feeds to home page.
function disable_feeds(): void
{
    wp_redirect(home_url());
    exit;
}

// Disable feeds.
add_action('do_feed', __NAMESPACE__ . '\\disable_feeds', 1);
add_action('do_feed_rdf', __NAMESPACE__ . '\\disable_feeds', 1);
add_action('do_feed_rss', __NAMESPACE__ . '\\disable_feeds', 1);
add_action('do_feed_rss2', __NAMESPACE__ . '\\disable_feeds', 1);
add_action('do_feed_atom', __NAMESPACE__ . '\\disable_feeds', 1);

// Disable comments feeds.
add_action('do_feed_rss2_comments', __NAMESPACE__ . '\\disable_feeds', 1);
add_action('do_feed_atom_comments', __NAMESPACE__ . '\\disable_feeds', 1);

// Disable comments.
add_filter('comments_open', '__return_false');

// Remove language dropdown on login screen.
add_filter('login_display_language_dropdown', '__return_false');

// Disable XML RPC for security.
add_filter('xmlrpc_enabled', '__return_false');
add_filter('xmlrpc_methods', '__return_false');

// Remove WordPress version.
remove_action('wp_head', 'wp_generator');

// Remove generated icons.
remove_action('wp_head', 'wp_site_icon', 99);

// Remove shortlink tag from <head>.
remove_action('wp_head', 'wp_shortlink_wp_head', 10);

// Remove shortlink tag from HTML headers.
remove_action('template_redirect', 'wp_shortlink_header', 11);

// Remove Really Simple Discovery link.
remove_action('wp_head', 'rsd_link');

// Remove RSS feed links.
remove_action('wp_head', 'feed_links', 2);

// Remove all extra RSS feed links.
remove_action('wp_head', 'feed_links_extra', 3);

// Remove wlwmanifest.xml.
remove_action('wp_head', 'wlwmanifest_link');

// Remove meta rel=dns-prefetch href=//s.w.org
remove_action('wp_head', 'wp_resource_hints', 2);

// Remove relational links for the posts.
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);

// Remove REST API link tag from <head>.
remove_action('wp_head', 'rest_output_link_wp_head', 10);

// Remove REST API link tag from HTML headers.
remove_action('template_redirect', 'rest_output_link_header', 11);

// Remove emojis.
// WordPress 6.4 deprecated the use of print_emoji_styles() function, but it has
// been retained for backward compatibility purposes.
// https://make.wordpress.org/core/2023/10/17/replacing-hard-coded-style-tags-with-wp_add_inline_style/
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

// Remove oEmbeds.
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('wp_head', 'wp_oembed_add_host_js');

// Disable default users API endpoints for security.
// https://www.wp-tweaks.com/hackers-can-find-your-wordpress-username/
function disable_rest_endpoints(array $endpoints): array
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

add_filter('rest_endpoints', __NAMESPACE__ . '\\disable_rest_endpoints');

// Remove JPEG compression.
function remove_jpeg_compression(): int
{
    return 100;
}

add_filter('jpeg_quality', __NAMESPACE__ . '\\remove_jpeg_compression', 10, 2);

// Update login page image link URL.
function login_url(): string
{
    return home_url();
}

add_filter('login_headerurl', __NAMESPACE__ . '\\login_url');

// Update login page link title.
function login_title(): string
{
    return get_bloginfo('name');
}

add_filter('login_headertext', __NAMESPACE__ . '\\login_title');

// Update permalink structure to /%postname%/.
function permalink_structure()
{
    if (get_option('permalink_structure') !== '/%postname%/') {
        update_option('permalink_structure', '/%postname%/');
        flush_rewrite_rules();
    }
}

add_action('after_setup_theme', __NAMESPACE__ . '\\permalink_structure');

// Remove Gutenberg's front-end block styles.
function remove_block_styles(): void
{
    wp_deregister_style('wp-block-library');
    wp_deregister_style('wp-block-library-theme');
}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\remove_block_styles');

// Remove core block styles.
// https://github.com/WordPress/gutenberg/issues/56065
function remove_core_block_styles(): void
{
    wp_dequeue_style('core-block-supports');
}

add_action('wp_footer', __NAMESPACE__ . '\\remove_core_block_styles');

// Remove Gutenberg's global styles.
// https://github.com/WordPress/gutenberg/pull/34334#issuecomment-911531705
function remove_global_styles(): void
{
    wp_dequeue_style('global-styles');
}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\remove_global_styles');

// Remove classic theme styles.
// https://github.com/WordPress/WordPress/commit/143fd4c1f71fe7d5f6bd7b64c491d9644d861355
function remove_classic_theme_styles(): void
{
    wp_dequeue_style('classic-theme-styles');
}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\remove_classic_theme_styles');

// Remove the SVG Filters that are mostly if not only used in Full Site Editing/Gutenberg
// Detailed discussion at: https://github.com/WordPress/gutenberg/issues/36834
function remove_svg_filters(): void
{
    remove_action('wp_body_open', 'gutenberg_global_styles_render_svg_filters');
    remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
}

add_action('init', __NAMESPACE__ . '\\remove_svg_filters');

// Remove ?ver= query from styles and scripts.
function remove_script_version(string $url): string
{
    if (is_admin()) {
        return $url;
    }

    if ($url) {
        return esc_url(remove_query_arg('ver', $url));
    }

    return $url;
}

add_filter('script_loader_src', __NAMESPACE__ . '\\remove_script_version', 15, 1);
add_filter('style_loader_src', __NAMESPACE__ . '\\remove_script_version', 15, 1);

// Remove contributor, subscriber and author roles.
function remove_roles(): void
{
    remove_role('author');
    remove_role('contributor');
    remove_role('subscriber');
}

add_action('init', __NAMESPACE__ . '\\remove_roles');

// Disable attachment template loading and redirect to 404.
// WordPress 6.4 introduced an update to disable attachment pages, but this
// implementation is not as robust as the current one.
// https://github.com/joppuyo/disable-media-pages/issues/41
// https://make.wordpress.org/core/2023/10/16/changes-to-attachment-pages/
function attachment_redirect_not_found(): void
{
    if (is_attachment()) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
    }
}

add_filter('template_redirect', __NAMESPACE__ . '\\attachment_redirect_not_found');

// Disable attachment canonical redirect links.
function disable_attachment_canonical_redirect_url(string $url): string
{
    attachment_redirect_not_found();

    return $url;
}

add_filter('redirect_canonical', __NAMESPACE__ . '\\disable_attachment_canonical_redirect_url', 0, 1);

// Disable attachment links.
function disable_attachment_link(string $url, int $id): string
{
    if ($attachment_url = wp_get_attachment_url($id)) {
        return $attachment_url;
    }

    return $url;
}

add_filter('attachment_link', __NAMESPACE__ . '\\disable_attachment_link', 10, 2);

// Randomize attachment slugs using UUIDs to avoid slug reservation.
function disable_attachment_slug_reservation(string $slug, string $id, string $status, string $type): string
{
    if ($type !== 'attachment') {
        return $slug;
    }

    if (preg_match('/^[\da-f]{8}-[\da-f]{4}-[\da-f]{4}-[\da-f]{4}-[\da-f]{12}$/iD', $slug) > 0) {
        return $slug;
    }

    return (string) Uuid::uuid4();
}

add_filter('wp_unique_post_slug', __NAMESPACE__ . '\\disable_attachment_slug_reservation', 10, 4);

// Discourage search engines from indexing in non-production environments.
function disable_indexing()
{
    return wp_get_environment_type() === 'production' ? 1 : 0;
}

add_action('pre_option_blog_public', __NAMESPACE__ . '\\disable_indexing');
