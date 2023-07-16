<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class ACFGroupNumberDivider extends \Elementor\Core\DynamicTags\Tag {
    public function get_name() {
        return 'acf-group-number-divider-braine';
    }

    public function get_title() {
        return "ACF Group Number Divider";
    }

    public function get_group() {
        return 'braine';
    }

    public function get_categories() {
        return [\Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY,
            \Elementor\Modules\DynamicTags\Module::NUMBER_CATEGORY];
    }

    public function is_settings_required() {
        return true;
    }

    protected function _register_controls() {
        // Seleciona se o segundo ano é o ano atual

        $this->add_control(
            'group',
            [
                'label' => 'Grupo',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->add_control(
            'internal_group',
            [
                'label' => 'Grupo Interno',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->add_control(
            'field_number',
            [
                'label' => 'Campo do número',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->add_control(
            'field_divider_number',
            [
                'label' => 'Número de vezes a dividir',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 12,
            ]
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

        $newNumber = floatval($group[$settings['field_number']]) / 12;

        if($settings['is_currency']):
            echo "R$" . number_format($newNumber, 2, ',', '.');
        else:
            echo $newNumber;
        endif;
    }
}
