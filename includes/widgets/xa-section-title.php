<?php

/**
 * Section TItle Widget Class.
 *
 * @since 1.0.0
*/

class xaddons_section_title_Widget extends \Elementor\Widget_Base {
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
		return 'xa-section-title-widget';
	}

	public function get_title() {
		return __( 'XA: Section Title', 'x-addons-elementor' );
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
				'label' => __( 'Section Content', 'x-addons-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'xaddons_label',
			[
				'label' => __( 'Heading Label', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'We Area Creative',
				'label_block' => true,
				'separator' => 'before',   
			]
		);

		$this->add_control(
			'xaddons_title',
			[
				'label' => __( 'Heading Title', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Best Web Solutions',
				'label_block' => true,
				'separator' => 'before',   
			]
		);

		$this->add_control(
			'xaddons_desc',
			[
				'label' => __( 'Heading Content', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Continually network virtual strategic theme areas',
			]
		);

		$this->end_controls_section();

		// Tab #2
		$this->start_controls_section(
			'xaddons_tab_two',
			[
				'label' => __( 'Heading Styles', 'x-addons-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'xaddons_align',
			[
				'label' => __('Alignment', 'x-addons-elementor'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => __('Left', 'x-addons-elementor'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'x-addons-elementor'),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => __('Right', 'x-addons-elementor'),
						'icon' => 'eicon-text-align-right',
					],

				],
				'default' => 'flex-start',
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}} .xa-alignment' => 'justify-content: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'xaddons_text_position',
			[
				'label' => esc_html__( 'Text Position', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'text-center',
				'options' => [
					'text-left' => [
                        'title' => __('Left', 'x-addons-elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => __('Center', 'x-addons-elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-end' => [
                        'title' => __('Right', 'x-addons-elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
				],
                'toggle' => false,
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
		<div class="xa-buttons xa-wrapper xa-alignment">
			<div class="xa-section-title '.esc_attr($settings['xaddons_text_position']).'">
				<span class="xa-section-title__label">'.esc_html($settings['xaddons_label']).'</span>
				<h2 class="xa-section-title__heading">'.esc_html($settings['xaddons_title']).'</h2>
				<p class="xa-section-title__content">'.esc_html($settings['xaddons_desc']).'</p>
			</div>
		</div>';

	}

}