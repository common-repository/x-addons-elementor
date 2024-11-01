<?php

/**
 * Personal Widget Class.
 *
 * @since 1.0.0
*/

class xaddons_hero_personal_Widget extends \Elementor\Widget_Base {
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
		return 'xa-hero-personal-widget';
	}

	public function get_title() {
		return __( 'XA: Hero Widget (Personal)', 'x-addons-elementor' );
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
				'label' => __( 'Hero Content', 'x-addons-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'xaddons_hero_thumb',
			[
				'label' => __( 'Hero Thumbnail', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
			]
		);		

		$this->add_control(
			'xaddons_anim_label',
			[
				'label' => __( 'Animate Label', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Professional',
				'label_block' => true,
				'separator' => 'before',   
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'xaddons_anim_text',
			[
				'label' => esc_html__( 'Animate Text', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'xaddons_anim_lists',
			[
				'label' => __( 'All Animate List', 'x-addons-elementor' ),
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

		$this->add_control(
			'xaddons_hero_title',
			[
				'label' => __( 'Hero Title', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Hello! It\'s <span>Danniel</span> Walker Sprote',
				'label_block' => true,
				'separator' => 'before',   
			]
		);

		$this->add_control(
			'xaddons_hero_desc',
			[
				'label' => __( 'Hero Content', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Aenean ligula quam, aliquet eget ullamcorper quis',
			]
		);

		$this->add_control(
			'xaddons_video_btn_text',
			[
				'label' => __( 'Video Button Text', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'My Overview',
				'label_block' => true,
				'separator' => 'before',   
			]
		);

		$this->add_control(
			'xaddons_video_btn_url',
			[
				'label' => __( 'Youtube Video ID', 'x-addons-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Y7cpCDlRfV0',
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		// Tab #2
		$this->start_controls_section(
			'xaddons_tab_two',
			[
				'label' => __( 'Hero Shape', 'x-addons-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'xaddons_shape_1',
			[
				'label' => __( 'Hero Shape 1', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'xaddons_shape_2',
			[
				'label' => __( 'Hero Shape 2', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'xaddons_shape_3',
			[
				'label' => __( 'Hero Shape 3', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
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
		<section class="xa-hero-personal  xa-wrapper">
			<div class="xa-hero-layer">
				<div class="xa-hero-layer__single xa-mp-1" style="background-image:url('.esc_url($settings['xaddons_shape_1']['url']).')"></div>
				<div class="xa-hero-layer__single xa-mp-2" style="background-image:url('.esc_url($settings['xaddons_shape_2']['url']).')"></div>
				<div class="xa-hero-layer__single xa-mp-3" style="background-image:url('.esc_url($settings['xaddons_shape_3']['url']).')"></div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-12">
						<div class="xa-hero-personal__content">
							<span class="xa-hero-personal__label">'.esc_html($settings['xaddons_anim_label']).' <span id="typed"></span></span>
							<div id="typed-strings">';
								foreach($settings['xaddons_anim_lists'] as $alist){
									echo'<p>'.esc_html($alist['xaddons_anim_text']).'</p>';
								}echo'
							</div>
							<h1 class="xa-hero-personal__title">'.wp_kses_post($settings['xaddons_hero_title']).'</h1>
							<p class="xa-hero-personal__text">'.esc_html($settings['xaddons_hero_desc']).'</p>
							<div class="xa-hero-personal__btn">
								<a class="theme-btn xa-youtube-btn video"  data-video-id="'.esc_attr($settings['xaddons_video_btn_url']).'"><i class="fa fa-play"></i>'.esc_html($settings['xaddons_video_btn_text']).'</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-12">
						<div class="xa-hero-personal__img">
							<img src="'.esc_url($settings['xaddons_hero_thumb']['url']).'" alt="'.esc_attr('thumbnail', 'x-addons-elementor').'">
						</div>
					</div>
				</div>
			</div>
		</section>';

	}

}