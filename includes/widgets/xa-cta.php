<?php
/**
 * CTA Widget Class.
 *
 * @since 1.0.0
*/

class xaddons_cta_Widget extends \Elementor\Widget_Base {

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
		return 'xa-cta-widget';
	}


	public function get_title() {
		return __( 'XA: CTA Widget', 'x-addons-elementor' );
	}


	public function get_icon() {
		return 'eicon-featured-image';
	}


	public function get_categories() {
		return [ 'xoft' ];
	}


	protected function register_controls() {

	

		$this->start_controls_section(
			'xaddons_tab_content',
			[
				'label' => __( 'XA Content', 'x-addons-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'xaddons_title',
			[
				'label' => __( 'CTA Title', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Have any project in your mind? <span>Let\'s talk now.</span>',
				'label_block' => true,

			]
		);

		$this->add_control(
			'xaddons_desc',
			[
				'label' => __( 'CTA Description', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'It is a long established fact that a reader will be distracted by the readable content',
				'label_block' => true,

			]
		);

		$this->add_control(
			'xaddons_btn_text',
			[

				'label' => __( 'CTA Button Text', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Contact Me',
				'label_block' => true,
			]

		);

		$this->add_control(
			'xaddons_btn_link',
			[
				'label' => __( 'CTA Button URL', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => __('https://example-site.com', 'x-addons-elementor'),
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
		<div class="xa-wrapper xa-cta-area">
			<div class="xa-cta-area__content">
				<h2 class="xa-cta-area__title">'.wp_kses_post($settings['xaddons_title']).' </h2>
				<p class="xa-cta-area__text">'.esc_html($settings['xaddons_desc']).' </p>
			</div>
			<div class="xa-cta-area__button">
				<a  class="xa-buttons__btn" href="'.esc_url($settings['xaddons_btn_link']['url']).'"><i class="far fa-arrow-alt-circle-right"></i>'.esc_html($settings['xaddons_btn_text']).'</a>
			</div>
		</div>';
	}


}