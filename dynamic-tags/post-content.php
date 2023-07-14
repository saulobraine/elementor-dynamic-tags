<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class PostContentBraine extends \ElementorPro\Modules\DynamicTags\Tags\Base\Data_Tag {
    public function get_name() {
        return 'post-content-braine';
    }

    public function get_title() {
        return "Conteúdo do Post";
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

    public function get_value(array $options = []) {
        $settings = $this->get_settings();

        return get_the_content();
    }

    public function get_panel_template_setting_key() {
        return 'key';
    }
}