<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
class PageAnchorBraine extends \ElementorPro\Modules\DynamicTags\Tags\Base\Data_Tag {
    public function get_name() {
        return 'page-anchor-braine';
    }

    public function get_title() {
        return "Âncora da Página";
    }

    public function get_group() {
        return 'braine';
    }

    public function get_categories() {
        return [\Elementor\Modules\DynamicTags\Module::URL_CATEGORY ];
    }

    public function is_settings_required() {
        return true;
    }

    public function get_value(array $options = []) {
        $settings = $this->get_settings();

		$type = $settings['type'];
		$anchor = $settings['anchor'];
		$url = '';

		if ( 'post' === $type && ! empty( $settings['post_id'] ) ) {
			$url = get_permalink( (int) $settings['post_id'] );
		} elseif ( 'taxonomy' === $type && ! empty( $settings['taxonomy_id'] ) ) {
			$url = get_term_link( (int) $settings['taxonomy_id'] );
		} elseif ( 'attachment' === $type && ! empty( $settings['attachment_id'] ) ) {
			$url = get_attachment_link( (int) $settings['attachment_id'] );
		} elseif ( 'author' === $type && ! empty( $settings['author_id'] ) ) {
			$url = get_author_posts_url( (int) $settings['author_id'] );
		}

		if ( ! is_wp_error( $url ) ) {
			return $url . $anchor;
		}

		return '';
    }

    protected function register_controls() {
		$this->add_control( 'type', [
			'label' => esc_html__( 'Type', 'elementor-pro' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'options' => [
				'post' => esc_html__( 'Content', 'elementor-pro' ),
				'taxonomy' => esc_html__( 'Taxonomy', 'elementor-pro' ),
				'attachment' => esc_html__( 'Media', 'elementor-pro' ),
				'author' => esc_html__( 'Author', 'elementor-pro' ),
			],
		] );

		$this->add_control( 'post_id', [
			'label' => esc_html__( 'Search & Select', 'elementor-pro' ),
			'type' => \ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
			'options' => [],
			'label_block' => true,
			'autocomplete' => [
				'object' => \ElementorPro\Modules\QueryControl\Module::QUERY_OBJECT_POST,
				'display' => 'detailed',
				'query' => [
					'post_type' => 'any',
				],
			],
			'condition' => [
				'type' => 'post',
			],
		] );

		$this->add_control( 'taxonomy_id', [
			'label' => esc_html__( 'Search & Select', 'elementor-pro' ),
			'type' => \ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
			'options' => [],
			'label_block' => true,
			'autocomplete' => [
				'object' => \ElementorPro\Modules\QueryControl\Module::QUERY_OBJECT_TAX,
				'display' => 'detailed',
			],
			'condition' => [
				'type' => 'taxonomy',
			],
		] );

		$this->add_control( 'attachment_id', [
			'label' => esc_html__( 'Search & Select', 'elementor-pro' ),
			'type' => \ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
			'options' => [],
			'label_block' => true,
			'autocomplete' => [
				'object' => \ElementorPro\Modules\QueryControl\Module::QUERY_OBJECT_ATTACHMENT,
				'display' => 'detailed',
			],
			'condition' => [
				'type' => 'attachment',
			],
		] );

		$this->add_control( 'author_id', [
			'label' => esc_html__( 'Search & Select', 'elementor-pro' ),
			'type' => \ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
			'options' => [],
			'label_block' => true,
			'autocomplete' => [
				'object' => \ElementorPro\Modules\QueryControl\Module::QUERY_OBJECT_AUTHOR,
				'display' => 'detailed',
			],
			'condition' => [
				'type' => 'author',
			],
		] );

        $this->add_control(
			'anchor',
			[
				'label' => "Âncora",
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '#exemplo',
				'placeholder' => "Digite a âncora com a #",
			]
		);
	}

    public function get_panel_template_setting_key() {
        return 'key';
    }
}