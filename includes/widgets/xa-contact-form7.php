<?php
/**
 * Elementor Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0

 */
class xaddons_contact_form7_widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve widget name.
	 *

	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.

	 */

	public function get_name() {
		return 'xa-contact-form';
	}


	public function get_title() {
		return __( 'XA: Contact Form 7', 'x-addons-elementor' );
	}

	public function get_icon() {
		return 'eicon-featured-image';
	}

	public function get_categories() {
		return [ 'x-addons-elementor' ];
	}


	protected function register_controls() {

		// Tab One
		$this->start_controls_section(
			'xaddons_tab_one',
			[
				'label' => __( 'Contact Form', 'x-addons-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'xaddons_form_class',
			[
				'label' => esc_html__( 'Form Class', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'xaddons_label',
			[
				'label' => esc_html__( 'Contact Label', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Get in touch',
				'label_block' => true,
			]
		);

		$this->add_control(
			'xaddons_title',
			[
				'label' => esc_html__( 'Contact Title', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Write us a message',
				'label_block' => true,
			]
		);

        
        // Add a dropdown control for the Contact Form 7 form
        $cf7_form_options = $this->get_cf7_form_options();
        $this->add_control(
            'form_id',
            [
                'label' => __( 'Contact Form 7 Form', 'x-addons-elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $cf7_form_options,
				'label_block' => true,
                'default' => '',
            ]
        );

		$this->end_controls_section();

    }

    /**
     * Retrieve the list of Contact Form 7 forms.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array List of Contact Form 7 forms.
     */

    public function get_cf7_form_options() {
        $cf7_forms = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
        $cf7_form_options = [ '' => 'Select a Contact Form 7 form' ];

        foreach ( $cf7_forms as $cf7_form ) {
            $cf7_form_options[ $cf7_form->ID ] = $cf7_form->post_title;
        }
        return $cf7_form_options;

    }

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

	 protected function render() {
		$settings = $this->get_settings_for_display();
		$form_id = $settings['form_id'];
	
		echo '
		<div class="xa-wrapper xa-contact-form ' . esc_attr( $settings['xaddons_form_class'] ) . '">
			<div class="xa-contact-form__head">
				<p class="xa-contact-form__label">' . esc_html( $settings['xaddons_label'] ) . '</p>
				<h4 class="xa-contact-form__title">' . esc_html( $settings['xaddons_title'] ) . '</h4>
			</div>
			<div class="xa-contact-form__body">';
		
			if ( $form_id ) {
				echo do_shortcode( '[contact-form-7 id="' . esc_attr( $form_id ) . '"]' );
			} else {
				echo '<p>' . esc_html__( 'Please select a contact form from field', 'x-addons-elementor' ) . '</p>';
			}
		echo '
			</div>
		</div>';
	}

}

