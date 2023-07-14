<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class ACFGroupImage extends \ElementorPro\Modules\DynamicTags\Tags\Base\Data_Tag {

	public function get_name() {
		return 'acf-group-image-braine';
	}

	public function get_title() {
		return "ACF Group Image";
	}

	public function get_group() {
		return 'braine';
	}

	public function get_categories() {
		return [ \Elementor\Modules\DynamicTags\Module::IMAGE_CATEGORY, \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY ];
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
			'field_image',
			array(
				'label'   => 'Campo da imagem',
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'imagem_normal',
			)
		);

    $this->add_control(
			'fallback',
			[
				'label' => esc_html__( 'Fallback', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
	}

	public function get_value(array $options = []) {

    $settings = $this->get_settings();

    $image_data = [
			'id' => null,
			'url' => '',
		];

    $group = get_field("{$settings['group']}_{$settings['internal_group']}", 'option');

    $image_data['id'] = $group[$settings['field_image']]['ID'];
    $image_data['url'] = $group[$settings['field_image']]['url'];

    if ( empty( $image_data ) && $this->get_settings( 'fallback' ) ) {
			$value = $this->get_settings( 'fallback' );
		}

		if ( ! empty( $value ) && is_array( $value ) ) {
			$image_data['id'] = $value['id'];
			$image_data['url'] = $value['url'];
		}

    return $image_data;
	}

	public function get_supported_fields() {
		return [
			'image',
		];
	}

	public function get_panel_template_setting_key() {
		return 'key';
	}

}