<?php
/**
 * Basic example Beaver Builder module
 *
 * This is an example module with only the basic
 * setup necessary to get it working.
 *
 * @package    Mule_Plugin
 * @subpackage Includes\Beaver
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Basic example Beaver Builder module
 *
 * @since  1.0.0
 * @access public
 */
class MULE_Basic_Example_Module extends FLBuilderModule {

    /**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
    public function __construct() {

        parent::__construct( [
            'name'          => __( 'Basic Example', 'mule-plugin' ),
            'description'   => __( 'An basic example for coding new modules.', 'mule-plugin' ),
            'category'      => __( 'Example Modules', 'mule-plugin' ),
            'dir'           => MULE_PATH . 'includes/beaver/modules/basic-example/',
            'url'           => MULE_URL . 'includes/beaver/modules/basic-example/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ] );

    }
}

/**
 * Register the module and its form settings.
 *
 * @since  1.0.0
 * @access public
 * @return array Returns the array of module fields.
 */
FLBuilder::register_module( 'MULE_Basic_Example_Module', [
    'general' => [ // Tab
        'title'    => __( 'General', 'mule-plugin' ), // Tab title
        'sections' => [ // Tab Sections
            'general' => [ // Section
                'title' => __( 'Section Title', 'mule-plugin' ), // Section Title
                'fields' => [ // Section Fields
                    'text_field' => [
                        'type'        => 'text',
                        'label'       => __( 'Text Field', 'mule-plugin' ),
                        'default'     => '',
                        'maxlength'   => '2',
                        'size'        => '3',
                        'placeholder' => '10',
                        'class'       => 'my-css-class',
                        'description' => 'px',
                        'help'        => __( 'Put your help inf here.', 'mule-plugin' ),
                        'preview'     => [
                            'type'     => 'css',
                            'selector' => '.fl-example-text',
                            'property' => 'font-size',
                            'unit'     => 'px'
                        ]
                    ],
                    'textarea_field' => [
                        'type'        => 'textarea',
                        'label'       => __( 'Textarea Field', 'mule-plugin' ),
                        'default'     => '',
                        'placeholder' => __( 'Placeholder Text', 'mule-plugin' ),
                        'rows'        => '6',
                        'preview'     => [
                            'type'     => 'text',
                            'selector' => '.fl-example-text'
                        ]
                    ],
                    'color_field' => [
                        'type'          => 'color',
                        'label'         => __( 'Color Picker', 'mule-plugin' ),
                        'default'       => '333333',
                        'show_reset'    => true,
                        'preview'       => [
                            'type'     => 'css',
                            'selector' => '.fl-example-text',
                            'property' => 'color'
                        ]
                    ],
                    'custom_field_example' => [
                        'type'    => 'mule-custom-beaver-field',
                        'label'   => __( 'Custom Field Example', 'mule-plugin' ),
                        'default' => ''
                    ],
                ]
            ]
        ]
    ]
] );