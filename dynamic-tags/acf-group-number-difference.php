<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class ACFGroupNumberDifference extends \Elementor\Core\DynamicTags\Tag {

	public function get_name() {
		return 'acf-group-number-difference-braine';
	}

	public function get_title() {
		return "ACF Group Number Difference";
	}

	public function get_group() {
		return 'braine';
	}

	public function get_categories() {
		return [ \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY,
		\Elementor\Modules\DynamicTags\Module::NUMBER_CATEGORY ];
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
			'field_number',
			array(
				'label'   => 'Campo do número',
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'valor_antigo',
			)
		);

		$this->add_control(
			'field_number_2',
			array(
				'label'   => 'Campo do número 2',
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'valor',
			)
		);

		$this->add_control(
			'is_currency',
			[
				'label' => 'É monetário?',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => 'Sim',
				'label_off' => 'Não',
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
	}

	public function render() {

    $settings = $this->get_settings();

		$group = get_field("{$settings['group']}_{$settings['internal_group']}", 'option');

		$newNumber = floatval($group[$settings['field_number']]) - floatval($group[$settings['field_number_2']]);


		if($settings['is_currency']):
			echo "R$" . number_format($newNumber, 2, ',', '.');
		else:
			echo $newNumber;
		endif;

	}

}