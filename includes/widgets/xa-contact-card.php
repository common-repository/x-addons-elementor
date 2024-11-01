<?php
/**
 * Elementor Features Widget.
 *
 * Elementor that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class xaddons_contact_card_Widget extends \Elementor\Widget_Base {

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
		return 'xa-contact-card';
	}

	
	public function get_title() {
		return __( 'XA: Contact Card', 'x-addons-elementor' );
	}

	public function get_icon() {
		return 'eicon-featured-image';
	}
	
	public function get_categories() {
		return [ 'x-addons' ];
	}

	protected function register_controls() {
		
        //Contact Tab
		$this->start_controls_section(
			'xaddons_tab_one',
			[
				'label' => __( 'Xa Contact Card', 'x-addons-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'xaddons_title', [
				'label' => __( 'Contact Title', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
                'default' => 'Contact Info',
			]
		);

		$this->add_control(
			'xaddons_desc', [
				'label' => __( 'Contact Description', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
                'default' => 'Lorem ipsum dolor a sit ameti, consectetur adipisicing elit, sed do eiusmod ',
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'xaddons_icon',
			[
				'label' => esc_html__( 'Contact Icon', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-phone-alt',
					'library' => 'solid',
				],
			]
		);
		
		$repeater->add_control(
			'xaddons_label', [
				'label' => __( 'Contact Label', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
                'default' => 'Email:',
			]
		);

		$repeater->add_control(
			'xaddons_info', [
				'label' => __( 'Contact Info', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
                'default' => 'dannielwalker@gmail.com',
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
				'label' => __( 'Sinlge Page URL', 'x-addons-elementor' ),
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
						'list_content' => __( 'Information', 'x-addons-elementor' ),
					],
				],
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

		echo'
		<div class="xa-contacts xa-wrapper">
			<div class="xa-contacts__heading">
				<h5 class="xa-contacts__title">'.esc_html($settings['xaddons_title']).'</h5>
				<p class="xa-contacts__text">'.esc_html($settings['xaddons_desc']).'</p>
			</div>';
			foreach($settings['xaddons_lists'] as $list){
				if($list['xaddons_use_link'] == '2'){
					echo'<div class="xa-contact-single">';
				}else{
					echo'<a class="xa-contact-single" href="'.esc_url($list['xaddons_link_field']['url']).'">';
				}
				echo'
				<div class="xa-contact-single__icon">
					<i class="'.esc_attr($list['xaddons_icon']['value']).'"></i>
				</div>
				<div class="xa-contact-single__desc">
					<span class="xa-contact-single__label">'.esc_html($list['xaddons_label']).'</span>
					<p class="xa-contact-single__info">'.esc_html($list['xaddons_info']).'</p>
				</div>';
				if($list['xaddons_use_link'] == '2'){
					echo'</div>';
				}else{
					echo'</a>';
				}
			}echo'
		</div>';

	}
	 
}