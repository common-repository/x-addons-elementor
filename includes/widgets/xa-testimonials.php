<?php
/**
 * Portfolio SLider Widget Class.
 *
 * @since 1.0.0
*/
class xaddons_testimonials_widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Slider widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'xa-testimonials-slider';
	}

	
	public function get_title() {
		return __( 'XA: Testimonials Slider', 'x-addons-elementor' );
	}

	public function get_icon() {
		return 'eicon-featured-image';
	}
	
	public function get_categories() {
		return [ 'x-addons' ];
	}

	protected function register_controls() {
		
		
		// Tab One
		$this->start_controls_section(
			'xaddons_tab_one',
			[
				'label' => __( 'Testimonials Slider', 'x-addons-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'xaddons_image_thumb', [
				'label' => __( 'Thumbnail logo', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
			]
		);

        $repeater->add_control(
			'xaddons_review_title', [
				'label' => __( 'Review Title', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
                'default' => 'Incredible Support',
			]
		);

        $repeater->add_control(
			'xaddons_review_desc', [
				'label' => __( 'Author Review', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.',
			]
		);

        $repeater->add_control(
			'xaddons_author_name', [
				'label' => __( 'Author Name', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
                'default' => 'Thomas Smith',
			]
		);

        $repeater->add_control(
			'xaddons_author_position', [
				'label' => __( 'Author Position', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
                'default' => 'Thomas Smith',
			]
		);


		$this->add_control(
			'xaddons_lists',
			[
				'label' => __( 'All Portfolio List', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'Title #1', 'x-addons-elementor' ),
						'list_content' => __( 'Portfolio Information', 'x-addons-elementor' ),
					],
				],
			]
		);
		
		$this->end_controls_section();
		
		// Settings Section
		$this->start_controls_section(
			'xaddons_tab_two',
			[
				'label' => __( 'Slider Settings', 'x-addons-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'xaddons_slider_large_device',
			[
				'label' => __( 'Slide Column Large', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'return_value' => 'yes',
				'default' => '5',
			]
		);
		
		$this->add_control(
			'xaddons_slider_laptop',
			[
				'label' => __( 'Slide Column Laptop', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'return_value' => 'yes',
				'default' => '4',
			]
		);
		
		$this->add_control(
			'xaddons_slider_tab',
			[
				'label' => __( 'Slide Column Tab', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'return_value' => 'yes',
				'default' => '2',
			]
		);
		
		$this->add_control(
			'xaddons_slider_mobile',
			[
				'label' => __( 'Slide Column Mobile', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'return_value' => 'yes',
				'default' => '1',
			]
		);
		
		$this->add_control(
			'xaddons_slider_autoplay',
			[
				'label' => __( 'Slide Autoplay?', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'x-addons-elementor' ),
				'label_off' => __( 'Hide', 'x-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'xaddons_slider_autoplay_times',
			[
				'label' => __( 'Autoplay Timeout', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '5000',
				'condition' => [
					'xaddons_slider_autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'xaddons_slider_loop',
			[
				'label' => __( 'Slide Loop?', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'x-addons-elementor' ),
				'label_off' => __( 'Hide', 'x-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'xaddons_slider_mode',
			[
				'label' => __( 'Center Mode?', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'x-addons-elementor' ),
				'label_off' => __( 'Hide', 'x-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		

		
		$this->add_control(
			'xaddons_slider_speed',
			[
				'label' => __( 'Slide Speed while changes', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '600',
			]
		);	

		$this->add_control(
			'xaddons_slider_nav',
			[
				'label' => __( 'Slide Nav', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'x-addons-elementor' ),
				'label_off' => __( 'Hide', 'x-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		
		$this->add_control(
			'xaddons_slider_dots',
			[
				'label' => __( 'Slide Dots', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'x-addons-elementor' ),
				'label_off' => __( 'Hide', 'x-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
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


		if($settings['xaddons_slider_autoplay'] == 'yes'){
			$xaddons_slider_autoplay = 'true';
		} else{
			$xaddons_slider_autoplay = 'false';
		}

		if($settings['xaddons_slider_loop'] == 'yes'){
			$xaddons_slider_loop = 'true';
		} else{
			$xaddons_slider_loop = 'false';
		}

		if($settings['xaddons_slider_mode'] == 'yes'){
			$xaddons_slider_mode = 'true';
		} else{
			$xaddons_slider_mode = 'false';
		}


		if($settings['xaddons_slider_nav'] == 'yes'){
			$xaddons_slider_nav = 'true';
		} else{
			$xaddons_slider_nav = 'false';
		}

		if($settings['xaddons_slider_dots'] == 'yes'){
			$xaddons_slider_dots = 'true';
		} else{
			$xaddons_slider_dots = 'false';
		}

		$xaddons_dynamic_number = wp_rand(239329329, 393293293);

		echo '<script>
			jQuery(document).ready(function(){
				setInterval(function(){ 
					jQuery(".xa-testimonial-slider--' . esc_attr($xaddons_dynamic_number) . '").slick({
						slidesToShow: ' . esc_js($settings['xaddons_slider_laptop']) . ',
						slidesToScroll: 1,
						autoplay: ' . esc_js($xaddons_slider_autoplay) . ',
						loop: ' . esc_js($xaddons_slider_loop) . ',
						centerMode: ' . esc_js($xaddons_slider_mode) . ',
						speed: ' . esc_js($settings['xaddons_slider_speed']) . ',
						autoplayHoverPause: true,
						arrows: ' . esc_js($xaddons_slider_nav) . ',';
						if ($settings['xaddons_slider_nav'] == 'yes') {
							echo '
							prevArrow: ".xa-slider-nav__prev-' . esc_attr($xaddons_dynamic_number) . '",
							nextArrow: ".xa-slider-nav__next-' . esc_attr($xaddons_dynamic_number) . '",';
						}
						echo '
						dots: ' . esc_js($xaddons_slider_dots) . ',';
						if ($xaddons_slider_autoplay == 'true') {
							echo 'autoplaySpeed: ' . esc_js($settings['xaddons_slider_autoplay_times']) . ', ';
						}
						echo '
						responsive:[
							{
								breakpoint: 767,
								settings: {
									slidesToShow: ' . esc_js($settings['xaddons_slider_mobile']) . ',
								}
							},
							{
								breakpoint: 1025,
								settings: {
									slidesToShow: ' . esc_js($settings['xaddons_slider_tab']) . ',
								}
							},
							{
								breakpoint: 1500,
								settings: {
									slidesToShow: ' . esc_js($settings['xaddons_slider_laptop']) . ',
								}
							},
							{
								breakpoint: 3000,
								settings: {
									slidesToShow: ' . esc_js($settings['xaddons_slider_large_device']) . ',
								}
							},
						]
					}); 
				}, 10);
			});
		</script>';



		echo '	
		<div class="xa-testimonial-slider-section  xa-wrapper">
			<div class="xa-testimonial-slider xa-testimonial-slider--'.esc_attr($xaddons_dynamic_number).'">';
				foreach($settings['xaddons_lists'] as $list){
					echo '
                    <div class="xa-single-testimonial">
                        <div class="xa-single-testimonial__head">
                            <img src="'.esc_url($list['xaddons_image_thumb']['url']).'" alt="'.esc_attr($list['xaddons_author_name']).'">
                        </div>
                        <div class="xa-single-testimonial__content">
                            <h3 class="xa-single-testimonial__title">'.esc_html($list['xaddons_review_title']).'</h3>
                            <p class="xa-single-testimonial__desc">'. esc_html($list['xaddons_review_desc']) . '</p>
                        </div>
                        <div class="xa-single-testimonial__bottom">
                            <h4 class="xa-single-testimonial__author">'.esc_html($list['xaddons_author_name']).'</h4>
                            <span class="xa-single-testimonial__label">'.esc_html($list['xaddons_author_position']).'</span>
                        </div>
                    </div>';
				}echo'
			</div>';
			if($settings['xaddons_slider_nav'] == 'yes'){
			echo'
			<div class="xa-slider-nav">
				<div class="xa-slider-nav__prev-'.esc_attr($xaddons_dynamic_number).'">
					<i class="fas fa-chevron-left"></i>
				</div>
				<div class="xa-slider-nav__next-'.esc_attr($xaddons_dynamic_number).'">
					<i class="fas fa-chevron-right"></i>
				</div>
			</div>';
			}echo'
		</div>';
	}
}