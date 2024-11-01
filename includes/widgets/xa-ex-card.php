<?php

/**
 * Experiences Widget Class.
 *
 * @since 1.0.0
*/

class xaddons_ex_card_Widget extends \Elementor\Widget_Base {
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
		return 'xa-ex-card-widget';
	}

	public function get_title() {
		return __( 'XA: Experience Card', 'x-addons-elementor' );
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
				'label' => __( 'Image Content', 'x-addons-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		

		$this->add_control(
			'xaddons_label',
			[
				'label' => __( 'Experiences Year', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '2002-2006',
				'label_block' => true,
			]
		);

        $this->add_control(
			'xaddons_title',
			[
				'label' => __( 'Experiences Title', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Web Design',
				'label_block' => true,
				'separator' => 'before',   
			]
		);

        $this->add_control(
			'xaddons_info',
			[
				'label' => __( 'Experiences Info', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Springlean Graphic University',
				'label_block' => true,
				'separator' => 'before',   
			]
		);

		$this->add_control(
			'xaddons_desc',
			[
				'label' => __( 'Experiences Text', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Aenean ligula quam, aliquet eget ullamcorper quis',
			]
		);

		$this->end_controls_section();

		// Tab #2
		$this->start_controls_section(
			'xaddons_tab_two',
			[
				'label' => __( 'Text & Alignment Position', 'x-addons-elementor' ),
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
				'default' => 'text-left',
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
		<div class="xa-ex-card xa-wrapper xa-alignment">
			<div class="xa-ex-card__single '.esc_attr($settings['xaddons_text_position']).'">
				<div class="xa-ex-card__label">
					<span>'.esc_html($settings['xaddons_label']).'</span>
				</div>
				<div class="xa-ex-card__content">
					<div class="xa-ex-card__heading">
						<h2 class="xa-ex-card__title">'.esc_html($settings['xaddons_title']).'</h2>
						<span class="xa-ex-card__info">'.esc_html($settings['xaddons_info']).'</span>
					</div>
					<p class="xa-ex-card__text">'.esc_html($settings['xaddons_desc']).'</p>
				</div>
			</div>
		</div>
        ';

	}

}