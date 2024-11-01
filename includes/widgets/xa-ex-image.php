<?php

/**
 * Personal Widget Class.
 *
 * @since 1.0.0
*/

class xaddons_ex_image_Widget extends \Elementor\Widget_Base {
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
		return 'xa-ex-image-widget';
	}

	public function get_title() {
		return __( 'XA: Experiences Image', 'x-addons-elementor' );
	}

	public function get_icon() {
		return 'eicon-featured-image';
	}

	public function get_categories() {
		return [ 'x-addons' ];
	}

	protected function register_controls() {

		// Tab #1
		$this->start_controls_section(
			'xaddons_tab_one',
			[
				'label' => __( 'XA Experiences Image & Hover', 'x-addons-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'xaddons_thumbnail',
			[
				'label' => __( 'Image Thumbnail', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
			]
		);		

		$this->add_control(
			'xaddons_number',
			[
				'label' => __( 'Experiences Year', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '7',
				'label_block' => true,
				'separator' => 'before',   
			]
		);

		$this->add_control(
			'xaddons_desc',
			[
				'label' => __( 'Experiences Text', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Years <br> Experience <br> Working',
			]
		);

		$this->end_controls_section();

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

		
        echo '
        <div class="xa-ex-image  xa-wrapper">
            <img src="'. esc_url($settings['xaddons_thumbnail']['url']) . '" alt="'.esc_attr('thumbnail', 'x-addons-elementor').'">
            <div class="xa-ex-image__hover">
                <div class="xa-ex-image__content">
                    <span class="xa-ex-image__number">'.esc_html($settings['xaddons_number']).'</span>
                    <p class="xa-ex-image__text">'.esc_html($settings['xaddons_desc']).'</p>
                </div>
            </div>
        </div>';

	}

}