<?php

/**
 * Circle Progress Widget Class.
 *
 * @since 1.0.0
*/

class xaddons_circle_progress_Widget extends \Elementor\Widget_Base {
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
		return 'xa-circle-progress-widget';
	}

	public function get_title() {
		return __( 'XA: Circle Progress Widget', 'x-addons-elementor' );
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
				'label' => __( 'Circle Style', 'x-addons-elementor' ),
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
			'xaddons_list_percent_end',
			[
				'label' => esc_html__( 'List Percent End', 'x-addons-elementor' ),
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
				'label' => __( 'Alignment & Position Styles', 'x-addons-elementor' ),
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
		<script>
			jQuery(document).ready(function(){

				jQuery(".circle__one").circleProgress({
					lineCap: "round",
					fill: {       // the fill color and border radius of the progress bar
						color: "#FC6761",
						borderRadius: "50px"
					},
					border: {     // the border color, width, and border radius of the progress bar
						color: "#000",
						width: 50,
						borderRadius: "50px"
					},
					emptyFill: "#EEEEEE"  // the background color of the progress bar
				})
			});
		</script>';

        echo '
		<div class="xa-circle-progress xa-wrapper xa-alignment">
			<div class="xa-circle-progress__box ' . esc_attr( $settings['xaddons_text_position'] ) . '">
				<h4 class="xa-progress__heading">' . esc_html( $settings['xaddons_title'] ) . '</h4>
					<div class="xa-circle-progress__inner">';
					foreach($settings['xaddons_lists'] as $list){
					echo'
					<div class="xa-circle-progress__inside">
						<div class="xa-circle-progress__single circle__one" data-value="0.'.esc_attr( $list['xaddons_list_percent'] ).'">
							<b class="xa-circle-progress__percent crancy-color1">'.esc_html($list['xaddons_list_percent']).''.esc_html($list['xaddons_list_percent_end']).'</b>
						</div>
						<h4 class="xa-circle-progress__title">'.esc_html($list['xaddons_list_label']).'</h4>
					</div>';
					}echo'
				</div>
			</div>
		</div>';

	}

}