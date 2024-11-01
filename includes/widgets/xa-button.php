<?php
/**
 * Button Widget Class.
 *
 * @since 1.0.0
*/

class xaddons_button_Widget extends \Elementor\Widget_Base {

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
		return 'xa-button';
	}

	
	public function get_title() {
		return __( 'XA: Button Default', 'x-addons-elementor' );
	}

	public function get_icon() {
		return 'eicon-featured-image';
	}
	
	public function get_categories() {
		return [ 'x-addons' ];
	}

	/* Register Control*/
	protected function register_controls() {
		
		
		// Tab #1
		$this->start_controls_section(
			'xaddons_tab_one',
			[
				'label' => __( 'Button Content', 'x-addons-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'xaddons_button_text',
			[
				'label' => __( 'Button Text', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Our Services',
				'placeholder' => __('Our Services', 'x-addons-elementor'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'xaddons_button_link',
			[
				'label' => __( 'Button Link', 'x-addons-elementor' ),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [ 'url' => '#',],
				'placeholder' => __('https://example-site.com', 'x-addons-elementor'),
			]
		);

		$this->add_control(
			'xaddons_button_icon',
			[
				'label' => esc_html__( 'Button Icon', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,      
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
				'separator' => 'before',     
			]
		);

		$this->add_control(
			'xaddons_button_dir',
			[
				'label' => esc_html__( 'Icon Position', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-2',
				'options' => [
					'style-1'  => esc_html__( 'Before Text', 'x-addons-elementor' ),
					'style-2'  => esc_html__( 'After Text', 'x-addons-elementor' ),
				],     
			]
		);

		$this->end_controls_section();

		// Tab #2
		$this->start_controls_section(
			'xaddons_tab_two',
			[
				'label' => __( 'Button Styles', 'x-addons-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_responsive_control(
            'xaddons_align',
            [
                'label' => __('Button Alignment', 'x-addons-elementor'),
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
	 * Render  widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	 
	 
	 protected function render() {
		$settings = $this->get_settings_for_display();
	
		// Determine target for link
		$xaddons_target = ( $settings['xaddons_button_link']['is_external'] == true ) ? '_blank' : '_self';
	
		echo '
		<div class="xa-wrapper xa-alignment">
			<div class="xa-buttons ' . esc_attr( $settings['xaddons_text_position'] ) . '">
				<a class="xa-buttons__btn" href="' . esc_url( $settings['xaddons_button_link']['url'] ) . '" target="' . esc_attr( $xaddons_target ) . '">
					<div class="xa-buttons__inside">';
	
					if ( $settings['xaddons_button_dir'] == 'style-1' ) {
						echo '<span><i class="' . esc_attr( $settings['xaddons_button_icon']['value'] ) . '"></i></span>';
					}
				
					echo '<span>' . esc_html( $settings['xaddons_button_text'] ) . '</span>';
				
					if ( $settings['xaddons_button_dir'] == 'style-2' ) {
						echo '<span><i class="' . esc_attr( $settings['xaddons_button_icon']['value'] ) . '"></i></span>';
					}
				
					echo '
					</div>
				</a>
			</div>
		</div>';
	}
	
	 
}