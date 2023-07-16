<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class ACFGroupText extends \Elementor\Core\DynamicTags\Tag {
    public function get_name() {
        return 'acf-group-text-braine';
    }

    public function get_title() {
        return "ACF Group Text";
    }

    public function get_group() {
        return 'braine';
    }

    public function get_categories() {
        return [\Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY];
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
            'field_text',
            [
                'label' => 'Campo do texto',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
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

        if($settings['is_currency']):
            echo "R$" . number_format($group[$settings['field_text']], 2, ',', '.');
        else:
            echo $group[$settings['field_text']];
        endif;
    }
}
