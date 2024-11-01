<?php

/**
 * Personal Widget Class.
 *
 * @since 1.0.0
*/

class xaddons_progress_list_Widget extends \Elementor\Widget_Base {
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
		return 'xa-progress-list-widget';
	}

	public function get_title() {
		return __( 'XA: Progress List', 'x-addons-elementor' );
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

		$this->add_control(
			'xaddons_title',
			[
				'label' => esc_html__( 'Heading Title', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Coding Skill',
				'label_block' => true,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'xaddons_list_label',
			[
				'label' => esc_html__( 'List Label', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Web Design',
				'label_block' => true,
			]
		);

        $repeater->add_control(
			'xaddons_list_percent',
			[
				'label' => esc_html__( 'List Percent', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '90',
				'label_block' => true,
			]
		);

		
        $repeater->add_control(
			'xaddons_list_percent_after',
			[
				'label' => esc_html__( 'List Percent', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '%',
				'label_block' => true,
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
		<div class="xa-progress xa-wrapper xa-alignment">
			<div class="xa-progress__box '.esc_attr($settings['xaddons_text_position']).'">
				<h4 class="xa-progress__heading">'.esc_html($settings['xaddons_title']).'</h4>';
				foreach($settings['xaddons_lists'] as $list){
				echo'
				<div class="xa-progress__single">
					<h3 class="progress-title">'.esc_html($list['xaddons_list_label']).'</h3>
					<div class="progress">
						<div class="progress-bar" style="width:'.esc_attr($list['xaddons_list_percent']).'%;">
							<div class="progress-value">'.esc_html($list['xaddons_list_percent']).''.esc_html($list['xaddons_list_percent_after']).'</div>
						</div>
					</div>
				</div>';
				}echo'
			</div>
		</div>';

	}

}