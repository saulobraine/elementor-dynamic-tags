<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class ACFGroupURL extends \ElementorPro\Modules\DynamicTags\Tags\Base\Data_Tag {

	public function get_name() {
		return 'acf-group-url-braine';
	}

	public function get_title() {
		return "ACF Group URL";
	}

	public function get_group() {
		return 'braine';
	}

	public function get_categories() {
		return [ \Elementor\Modules\DynamicTags\Module::URL_CATEGORY ];
	}

	public function is_settings_required() {
		return true;
	}

	protected function _register_controls() {

    // Seleciona se o segundo ano é o ano atual
	
		$this->add_control(
			'group',
			array(
				'label'   => 'Grupo',
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'gummy_kit_',
			)
		);

		$this->add_control(
			'internal_group',
			array(
				'label'   => 'Grupo Interno',
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '',
			)
		);
    
		$this->add_control(
			'field_url',
			array(
				'label'   => 'Campo do link',
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'link_do_produto',
			)
		);
	}

	public function get_panel_template_setting_key() {
		return 'key';
	}

	public function get_value( array $options = [] ) {

    $settings = $this->get_settings();

		$group = get_field("{$settings['group']}_{$settings['internal_group']}", 'option');

		return $group[$settings['field_url']];

	}

	public function get_supported_fields() {
		return [
			'text',
			'email',
			'image',
			'file',
			'page_link',
			'post_object',
			'relationship',
			'taxonomy',
			'url',
		];
	}

}