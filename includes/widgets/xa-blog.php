<?php
/**
 * Blog Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
function xaddons_post_categories() {
	$categories = get_terms('category');
	$cat_options = [];
	foreach ($categories as $cat) {
		$cat_options[$cat->term_id] = $cat->name;
	}
	return $cat_options;
}

class xaddons_blog_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve  widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'xa-blog-widget';
	}

	
	public function get_title() {
		return __( 'XA: Blog Post', 'x-addons-elementor' );
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
				'label' => __( 'Blog Styles', 'x-addons-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

	
		$this->add_control(
            'xaddons_post_show_all_categories',
            [
                'label' => __('Show All Categories', 'x-addons-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'x-addons-elementor'),
                'label_off' => __('No', 'x-addons-elementor'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'xaddons_selected_categories',
            [
                'label' => __('Select Categories', 'x-addons-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
				'options' => xaddons_post_categories(),
                'condition' => [
                    'xaddons_post_show_all_categories' => '',
                ],
            ]
        );
		
		$this->add_control(
			'xaddons_post_item',
			[
				'label' => esc_html__( 'Post Item', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '8',
			]
		);
		
		
		$this->add_control(
			'xaddons_post_content_text',
			[
				'label' => esc_html__( 'Show post content?', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes'  => esc_html__( 'Yes', 'x-addons-elementor' ),
					'no'  => esc_html__( 'No', 'x-addons-elementor' ),
				],
			]
		);
		
		$this->add_control(
			'xaddons_show_word',
			[
				'label' => __( 'Post Content Limit in number', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => '24',
				'condition' => [
					'xaddons_post_content_text' => 'yes',
				],
			]
		);
		
		$this->end_controls_section();
		
		
		// Tab Two
		$this->start_controls_section(
			'xaddons_tab_two',
			[
				'label' => __( 'Blog Settings', 'x-addons-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'xaddons_blog_column',
			[
				'label' => esc_html__( 'Blog Column', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'12'  => esc_html__( '1 Column', 'x-addons-elementor' ),
					'6'  => esc_html__( '2 Column', 'x-addons-elementor' ),
					'4'  => esc_html__( '3 Column', 'x-addons-elementor' ),
					'3'  => esc_html__( '4 Column', 'x-addons-elementor' ),
				],
			]
		);
		
		$this->add_control(
			'xaddons_blog_column_medium',
			[
				'label' => esc_html__( 'Blog Column Medium', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '6',
				'options' => [
					'12'  => esc_html__( '1 Column', 'x-addons-elementor' ),
					'6'  => esc_html__( '2 Column', 'x-addons-elementor' ),
					'4'  => esc_html__( '3 Column', 'x-addons-elementor' ),
				],
			]
		);
		
		$this->add_control(
			'xaddons_blog_column_tab',
			[
				'label' => esc_html__( 'Blog Column Tab', 'x-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '6',
				'options' => [
					'12'  => esc_html__( '1 Column', 'x-addons-elementor' ),
					'6'  => esc_html__( '2 Column', 'x-addons-elementor' ),
					'4'  => esc_html__( '3 Column', 'x-addons-elementor' ),
				],
			]
		);
		
		$this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	 
	 
	 
	 protected function render() {
        $settings = $this->get_settings_for_display();

        $xaddons_post_show_all_categories = isset($settings['xaddons_post_show_all_categories']) && $settings['xaddons_post_show_all_categories'] === 'yes';

        $xaddons_selected_categories = isset($settings['xaddons_selected_categories']) ? $settings['xaddons_selected_categories'] : array();
        $category_filter = array();
        if (!$xaddons_post_show_all_categories && !empty($xaddons_selected_categories)) {
            $category_filter = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'id',
                        'terms'    => $xaddons_selected_categories,
                    ),
                ),
            );
        }

        $q = new WP_Query(
            array(
                'posts_per_page' => $settings['xaddons_post_item'],
                'post_type' => 'post',
                'tax_query' => $category_filter,
            )
        );

        echo '<div class="row xa-wrapper">';

        while ($q->have_posts()) : $q->the_post();
            $post_content = get_the_content();
            $category_class = '';
            $categories = get_the_category();
            foreach ($categories as $category) {
                $category_class .= $category->slug . ' ';
            }
            ?>
            <div class="col-xl-<?php echo esc_attr($settings['xaddons_blog_column']); ?> col-lg-<?php echo esc_attr($settings['xaddons_blog_column_medium']); ?> col-md-<?php echo esc_attr($settings['xaddons_blog_column_tab']); ?> col-12 xa-wrapper">
                <div class="blog__item sticky">
                    <div class="xa-blog-single">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="xa-blog-single__thumb">
                                <a href="<?php echo esc_url(get_permalink()); ?>">
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="xa-blog-single__body">
                            <span class="xa-blog-single__date"><?php echo esc_html(get_the_date()); ?></span>
                            <h4 class="xa-blog-single__title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h4>
                            <p class="xa-blog-single__text"><?php echo wp_kses_post(wp_trim_words($post_content, $settings['xaddons_show_word'], '')); ?></p>
                            <div class="xa-blog-single__btn">
                                <a href="<?php echo esc_url(get_permalink()); ?>"><i class="icofont-arrow-right"></i><?php esc_html_e('Read More', 'x-addons-elementor'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile;

        echo '</div>';
        wp_reset_query();
    }
}
