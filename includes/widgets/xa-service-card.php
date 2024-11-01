<?php

/**
 * Service Widget Class.
 *
 * @since 1.0.0
*/

class xaddons_service_card_Widget extends \Elementor\Widget_Base {
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
		return 'xa-service-card';
	}

	public function get_title() {
		return __( 'XA: Service Card', 'x-addons-elementor' );
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
			'xaddons_icon',
			[
				'label' => esc_html__( 'Button Icon', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,      
				'default' => [
					'value' => 'fas fa-paint-brush',
					'library' => 'solid',
				],
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
			'xaddons_button_link',
			[
				'label' => __( 'Button Link', 'x-addons-elementor' ),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [ 'url' => '#',],
			]
		);

		$this->add_control(
			'xaddons_desc',
			[
				'label' => __( 'Heading Content', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Continually network virtual strategic theme areas vis-a-vis ubiquitous potentialities. Holisticly negotiate focused e-tailers without premiu',
				'rows' => 5,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'xaddons_active',
			[
				'label' => esc_html__( 'Service Active', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'no-active',
				'options' => [
					'xa-active'  => esc_html__( 'Yes', 'x-addons-elementor' ),
					'no-active'  => esc_html__( 'No', 'x-addons-elementor' ),
				],
				'label_block' => true,
			]
		);
		

		$this->end_controls_section();

		// Tab #2
		$this->start_controls_section(
			'xaddons_tab_two',
			[
				'label' => __( 'Service Styles', 'x-addons-elementor' ),
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

		if($settings['xaddons_button_link']['is_external'] == true) {
			$xaddons_target= '_blank';
		} else {
			$xaddons_target= '_self';
		}
		
        echo '
		<div class="xa-services xa-wrapper xa-alignment">
			<div class="xa-service-card '.esc_attr($settings['xaddons_text_position']).' '.esc_attr($settings['xaddons_active']).'">';
				if(!empty ($settings['xaddons_icon']['value']) ){
					echo'<div class="xa-service-card__icon"><i class="'.esc_attr($settings['xaddons_icon']['value']).'"></i></div>';
				}echo'
				<div class="xa-service-card__content">
					<h3 class="xa-service-card__title"><a href="'.esc_url($settings['xaddons_button_link']['url']).'" target="'.esc_attr($xaddons_target).'">'.esc_html($settings['xaddons_title']).'</a></h3>
					<p class="xa-service-card__desc">'.esc_html($settings['xaddons_desc']).'</p>
				</div>
			</div>
		</div>';

	}

}