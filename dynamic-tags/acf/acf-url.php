<?php

use ElementorPro\Modules\DynamicTags\ACF\Module;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class ACFURL extends \ElementorPro\Modules\DynamicTags\Acf\Tags\ACF_URL {
    public function get_name() {
        return 'acf-url-braine';
    }

    public function get_title() {
        return "ACF URL";
    }

    public function get_group() {
        return 'braine';
    }

    public function get_categories() {
        return [\Elementor\Modules\DynamicTags\Module::URL_CATEGORY, \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY];
    }

    protected function register_controls() {
        Module::add_key_control($this);

        $this->add_control(
            'before',
            [
                'label' => esc_html__('Antes', 'elementor-pro'),
            ]
        );

        $this->add_control(
            'fallback',
            [
                'label' => esc_html__('Fallback', 'elementor-pro'),
            ]
        );
    }

    public function get_value(array $options = []) {
        list($field, $meta_key) = Module::get_tag_value_field($this);

        if ($field) {
            $value = $field['value'];

            if (is_array($value) && isset($value[0])) {
                $value = $value[0];
            }

            if ($value) {
                if (!isset($field['return_format'])) {
                    $field['return_format'] = isset($field['save_format']) ? $field['save_format'] : '';
                }

                switch ($field['type']) {
                    case 'email':
                        if ($value) {
                            $value = 'mailto:' . $value;
                        }
                        break;
                    case 'image':
                    case 'file':
                        switch ($field['return_format']) {
                            case 'array':
                            case 'object':
                                $value = $value['url'];
                                break;
                            case 'id':
                                if ('image' === $field['type']) {
                                    $src = wp_get_attachment_image_src($value, 'full');
                                    $value = $src[0];
                                } else {
                                    $value = wp_get_attachment_url($value);
                                }
                                break;
                        }
                        break;
                    case 'post_object':
                    case 'relationship':
                        $value = get_permalink($value);
                        break;
                    case 'taxonomy':
                        $value = get_term_link($value, $field['taxonomy']);
                        break;
                } // End switch().
            }
        } else {
            // Field settings has been deleted or not available.
            $value = get_field($meta_key);
        } // End if().

        if (empty($value) && $this->get_settings('fallback')) {
            $value = $this->get_settings('fallback');
            return wp_kses_post($value);
        }

        return $this->get_settings('before') . wp_kses_post($value);
    }
}
