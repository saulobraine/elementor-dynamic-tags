<?php

/**
 * Tags
 *
 * @package       Tags Dinâmicas
 * @author        Braine.dev
 *
 * @wordpress-plugin
 * Plugin Name:   Tag Dinâmicas
 * Description:   Adiciona Tags ao site
 * Version:       1.0.0
 * Author:        Braine.dev
 * Author URI:    https://braine.dev
 */

if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly.
endif;

/**
 * Register New Dynamic Tag Group.
 *
 * Register new site group for site-related tags.
 *
 * @since 1.0.0
 * @param \Elementor\Core\DynamicTags\Manager $dynamic_tags_manager Elementor dynamic tags manager.
 * @return void
 */
function register_site_dynamic_tag_group($dynamic_tags_manager) {
    $dynamic_tags_manager->register_group(
        'braine',
        [
            'title' => 'Braine'
        ]
    );
}
add_action('elementor/dynamic_tags/register', 'register_site_dynamic_tag_group');

/**
 *
 * Include dynamic tag file and register tag class.
 *
 * @since 1.0.0
 * @param \Elementor\Core\DynamicTags\Manager $dynamic_tags_manager Elementor dynamic tags manager.
 * @return void
 */
function register_acf_group_image($dynamic_tags_manager) {
    require_once __DIR__ . '/dynamic-tags/acf-group-image.php';
    require_once __DIR__ . '/dynamic-tags/acf-group-text.php';
    require_once __DIR__ . '/dynamic-tags/acf-group-url.php';
    require_once __DIR__ . '/dynamic-tags/acf-group-number-divider.php';
    require_once __DIR__ . '/dynamic-tags/acf-group-number-difference.php';

    $dynamic_tags_manager->register(new \ACFGroupImage());
    $dynamic_tags_manager->register(new \ACFGroupText());
    $dynamic_tags_manager->register(new \ACFGroupURL());
    $dynamic_tags_manager->register(new \ACFGroupNumberDivider());
    $dynamic_tags_manager->register(new \ACFGroupNumberDifference());
}
add_action('elementor/dynamic_tags/register', 'register_acf_group_image');
