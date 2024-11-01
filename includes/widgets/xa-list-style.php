<?php

/**
 * Personal Widget Class.
 *
 * @since 1.0.0
*/

class xaddons_list_style_Widget extends \Elementor\Widget_Base {
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
		return 'xa-list-style-widget';
	}

	public function get_title() {
		return __( 'XA: List Style', 'x-addons-elementor' );
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
				'label' => __( 'List Style', 'x-addons-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'xaddons_list_label',
			[
				'label' => esc_html__( 'List Label', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Phone:',
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

        $repeater->add_control(
			'xaddons_list_info',
			[
				'label' => esc_html__( 'List Info', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => '+123-4567-8901',
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'xaddons_use_link',
			[
				'label' => esc_html__( 'Use Link?', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '2',
				'options' => [
					'1'  => esc_html__( 'Yes', 'x-addons-elementor' ),
					'2'  => esc_html__( 'No', 'x-addons-elementor' ),
				],
			]
		);

		$repeater->add_control(
			'xaddons_link_field',
			[
				'label' => __( 'URL Link', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'default' => [ 'url' => '#',],
				'condition' => ['xaddons_use_link' => '1',],
			]
		);

		$this->add_control(
			'xaddons_lists',
			[
				'label' => __( 'All List', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'Title #1', 'x-addons-elementor' ),
						'list_content' => __( 'List Info', 'x-addons-elementor' ),
					],
				],
			]
		);

		$this->end_controls_section();

		// Tab #2
		$this->start_controls_section(
			'xaddons_tab_two',
			[
				'label' => __( 'List Styles', 'x-addons-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_responsive_control(
            'xaddons_align',
            [
                'label' => __('List Alignment', 'x-addons-elementor'),
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
        <div class="xa-wrapper xa-alignment xa-list-styles">
            <ul class="xa-list-styles__list '.esc_attr($settings['xaddons_text_position']).'">';
            foreach($settings['xaddons_lists'] as $list){
                echo'<li><b>'.esc_html($list['xaddons_list_label']).'</b>';
				if($list['xaddons_use_link'] == '2'){
					echo''.esc_html($list['xaddons_list_info']).'';
				}else{
					echo'<a href="'.esc_url($list['xaddons_link_field']['url']).'">'.esc_html($list['xaddons_list_info']).'</a>';
				}echo'
				</li>';
            }echo'
            </ul>
        </div>';

	}

}