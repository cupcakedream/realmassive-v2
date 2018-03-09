<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if( ! class_exists( 'El_Blog_Module' ) ){
    
    class El_Blog_Module extends ET_Builder_Module {
    
        function init() {
            $this->name       = esc_html__( 'Divi Blog Extras', 'et_builder' );
            $this->slug       = 'et_pb_blog_extras';
            $this->fb_support = false;
            $this->main_css_element = '%%order_class%% .et_pb_post.et_pb_post_extra';
            
            $this->whitelisted_fields = array(
                'blog_layout',
                'posts_number',
                'include_categories',
                'meta_date',
                'show_thumbnail',
                'image_position',
                'show_content',
                'show_more',
                'excerpt_length',
                'read_more_text',
                'show_author',
                'show_date',
                'show_categories',
                'category_meta_colors',
                'category_color',
                'category_background_color',
                'category_hover_color',
                'category_hover_background_color',
                'show_comments',
                'cutom_ajax_pagination',
                'show_load_more',
                'load_more_text',
                'show_less_text',
                'offset_number',
                'post_order',
                'show_social_icons',
                'admin_label',
                'module_id',
                'module_class',
                'use_overlay',
                'hover_overlay_color',
                'hover_icon',
                'overlay_icon_color',
                'content_color',
                'animation',
            );
    
            $this->fields_defaults = array(
                'blog_layout'       => array( 'grid_extended' ),
                'posts_number'      => array( 10, 'add_default_setting' ),
                'meta_date'         => array( 'M j, Y', 'add_default_setting' ),
                'show_thumbnail'    => array( 'on' ),
                'show_content'      => array( 'off' ),
                'show_more'         => array( 'on' ),
                'show_author'       => array( 'on' ),
                'show_date'         => array( 'on' ),
                'show_categories'   => array( 'on' ),
                'show_comments'     => array( 'on' ),
                'show_load_more'    => array( 'off' ),
                'post_order'        => array( 'DESC' ),
                'offset_number'     => array( 0, 'only_default_setting' ),
                'show_social_icons' => array( 'off' ),
                'use_overlay'       => array( 'off' ),
                'animation'         => array( 'bottom' ),
            );
            
            $this->options_toggles = array(
    			'general'   => array(
    				    'toggles' => array(
    					    'main_content'  => esc_html__( 'Content', 'et_builder' ),
    					    'elements'      => esc_html__( 'Elements', 'et_builder' ),
    					    'pagination'    => esc_html__( 'Pagination', 'et_builder'),
    				    ),
    			),
    			'advanced' => array(
    				    'toggles' => array(
    					    'layout_toggle'         => esc_html__( 'Layout', 'et_builder' ),
    					    'block_extended_toggle' => esc_html__( 'Block Extended', 'et_builder' ),
    					    'category_toggle'       => esc_html__( 'Category', 'et_builder' ),
        					'overlay'               => esc_html__( 'Overlay', 'et_builder' ),
    					    'text'                  => array(
    						        'title'    => esc_html__( 'Text', 'et_builder' ),
    						        'priority' => 49,
    					        ),
                        ),
    			),
    			'custom_css' => array()
    		);

    		$this->advanced_options = array(
    			'fonts' => array(
    				'header' => array(
    					'label'    => esc_html__( 'Header', 'et_builder' ),
    					'css'      => array(
    						    'main'          => "{$this->main_css_element} .entry-title",
    						    'color'         => "{$this->main_css_element} .entry-title a",
    						    'plugin_main'   => "{$this->main_css_element} .entry-title, {$this->main_css_element} .entry-title a",
    						    'important'     => 'all',
    					),
    				),
    				'body'  => array(
    					'label'    => esc_html__( 'Body', 'et_builder' ),
    					'css'      => array(
    						    'main'        => "{$this->main_css_element}, %%order_class%%.et_pb_bg_layout_light .et_pb_post .post-content p, %%order_class%%.et_pb_bg_layout_dark .et_pb_post .post-content p",
    						    'color'       => "{$this->main_css_element}, {$this->main_css_element} .post-content *",
    						    'line_height' => "{$this->main_css_element} .post-content p:not(.post-meta)",
    						    'plugin_main' => "{$this->main_css_element}, %%order_class%%.et_pb_bg_layout_light .et_pb_post .post-content p, %%order_class%%.et_pb_bg_layout_dark .et_pb_post .post-content p, %%order_class%%.et_pb_bg_layout_light .et_pb_post a.more-link, %%order_class%%.et_pb_bg_layout_dark .et_pb_post a.more-link",
    					),
    				),
    				'meta' => array(
    					'label'    => esc_html__( 'Meta', 'et_builder' ),
    					'css'      => array(
    						    'main'        => "{$this->main_css_element} .post-meta",
    						    'plugin_main' => "{$this->main_css_element} .post-meta",
    					),
    				),
    			),
    			'border'        => array(),
    			'background'    => array(
    				    'css' => array(
    					    'main' => "{$this->main_css_element}:not(.el_dbe_box_extended), {$this->main_css_element}:not(.image-background) .post-content, {$this->main_css_element}.el_dbe_block_extended:not(.image-background) .post-meta",
    				    )
    			),
    			'button'        => array(
					    'ajax_pagination' => array(
						    'label' => esc_html__('Ajax Pagination Button', 'et_builder'),
						    'css' => array(
						        'main' => '%%order_class%% .el-dbe-blog-extra .et_pb_button',
							    'plugin_main' => '%%order_class%% .el-dbe-blog-extra .et_pb_button.el-button'
						    ),
						    'tab_slug' => 'general',
						    'toggle_slug' => 'pagination'
					    )
				),
    			'custom_margin_padding' => array(
    				    'css'   => array(
    					    'main' => $this->main_css_element,
    				    ),
    			),
    			'max_width' => array(),
    			'text'      => array(),
        	);
		
    		$this->custom_css_options = array(
    			'title' => array(
    				'label'    => esc_html__( 'Title', 'et_builder' ),
    				'selector' => '.et_pb_post.et_pb_post_extra .entry-title',
    			),
    			'post_meta' => array(
    				'label'    => esc_html__( 'Post Meta', 'et_builder' ),
    				'selector' => '.et_pb_post.et_pb_post_extra .post-meta',
    			),
    			'featured_image' => array(
    				'label'    => esc_html__( 'Featured Image', 'et_builder' ),
    				'selector' => '.et_pb_image_container',
    			),
    			'read_more' => array(
    				'label'    => esc_html__( 'Read More Button', 'et_builder' ),
    				'selector' => '.et_pb_post.et_pb_post_extra .more-link',
    			),
    		);
	
        }
    
        function get_fields() {
            
            $fields = array(
                'blog_layout' => array(
                    'label'             => esc_html__( 'Blog Layout', 'et_builder' ),
                    'type'              => 'select',
                    'option_category'   => 'layout',
                    'options'           => array(
                        'grid_extended'         => esc_html__( 'Grid Extended', 'et_builder' ),
                        'box_extended'          => esc_html__( 'Box Extended', 'et_builder' ),
                        'full_width'            => esc_html__( 'Full Width', 'et_builder' ),
                        'block_extended'        => esc_html__( 'Block Extended', 'et_builder' ),
                        'full_width_background' => esc_html__( 'Full Width Background', 'et_builder' ),
                        'classic'               => esc_html__( 'Classic', 'et_builder' ),
                    ),
                    'affects'           => array(
                        'image_position',
                        'show_social_icons',
                    ),
                    'tab_slug'          => 'advanced',
				    'toggle_slug'       => 'layout_toggle',
                    'description'       => esc_html__( 'Here you can choose the design that you want for the blog.', 'et_builder' ),
                ),
                'posts_number' => array(
                    'label'             => esc_html__( 'Posts Number', 'et_builder' ),
                    'type'              => 'text',
                    'option_category'   => 'configuration',
                    'tab_slug'          => 'general',
                    'toggle_slug'       => 'main_content',
                    'description'       => esc_html__( 'Choose how much posts you would like to display per page.', 'et_builder' ),
                ),
                'offset_number' => array(
                    'label'             => esc_html__( 'Offset Number', 'et_builder' ),
                    'type'              => 'text',
                    'option_category'   => 'configuration',
                    'tab_slug'          => 'general',
                    'toggle_slug'       => 'main_content',
                ),
                'post_order'    => array(
                    'label'             => esc_html__( 'Order', 'et_builder' ),
                    'type'              => 'select',
                    'option_category'   => 'configuration',
                    'options'           => array(
                        'DESC' => esc_html__( 'DESC', 'et_builder' ),
                        'ASC'  => esc_html__( 'ASC', 'et_builder' ),
                    ),
                    'tab_slug'          => 'general',
                    'toggle_slug'       => 'main_content',
                ),
                'include_categories' => array(
                    'label'            => esc_html__( 'Include Categories', 'et_builder' ),
                    'renderer'         => 'et_builder_include_categories_option',
                    'option_category'  => 'basic_option',
                    'renderer_options' => array(
                        'use_terms' => false,
                    ),
                    'tab_slug'          => 'general',
                    'toggle_slug'       => 'main_content',
                    'description'      => esc_html__( 'Choose which categories you would like to include in the feed.', 'et_builder' ),
                ),
                'meta_date' => array(
                    'label'             => esc_html__( 'Meta Date Format', 'et_builder' ),
                    'type'              => 'text',
                    'option_category'   => 'configuration',
                    'tab_slug'          => 'general',
                    'toggle_slug'       => 'main_content',
                    'description'       => esc_html__( 'If you would like to adjust the date format, input the appropriate PHP date format here.', 'et_builder' ),
                ),
                'show_thumbnail' => array(
                    'label'             => esc_html__( 'Show Featured Image', 'et_builder' ),
                    'type'              => 'yes_no_button',
                    'option_category'   => 'configuration',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'et_builder' ),
                        'off' => esc_html__( 'No', 'et_builder' ),
                    ),
                    'affects'           => array(
                        'image_position',
                        'use_overlay',
                    ),
                    'tab_slug'          => 'general',
                    'toggle_slug'       => 'elements',
                    'description'        => esc_html__( 'This will turn thumbnails on and off.', 'et_builder' ),
                ),
                'image_position' => array(
                    'label'             => esc_html__( 'Featured Image Position', 'et_builder' ),
                    'type'              => 'select',
                    'option_category'   => 'configuration',
                    'options'           => array(
                        'top'        => esc_html__( 'Top', 'et_builder' ),
                        'background' => esc_html__( 'Background', 'et_builder' ),
                        'alternate'  => esc_html__( 'Alternate', 'et_builder' ),
                    ),
                    'depends_show_if'   => 'block_extended',
                    'tab_slug'          => 'advanced',
				    'toggle_slug'       => 'block_extended_toggle',
                    'description'        => esc_html__( 'This will set the thumbnails position.', 'et_builder' ),
                ),
                'show_content' => array(
                    'label'             => esc_html__( 'Content', 'et_builder' ),
                    'type'              => 'select',
                    'option_category'   => 'configuration',
                    'options'           => array(
                        'off' => esc_html__( 'Show Excerpt', 'et_builder' ),
                        'on'  => esc_html__( 'Show Content', 'et_builder' ),
                    ),
                    'affects'           => array(
                        'show_more',
                        'excerpt_length',
                    ),
                    'tab_slug'          => 'general',
                    'toggle_slug'       => 'main_content',
                    'description'        => esc_html__( 'Showing the full content will not truncate your posts on the index page. Showing the excerpt will only display your excerpt text.', 'et_builder' ),
                ),
                'excerpt_length' => array(
                    'label'             => esc_html__( 'Excerpt Length', 'et_builder' ),
                    'type'              => 'text',
                    'option_category'   => 'configuration',
                    'depends_show_if'   => 'off',
                    'tab_slug'          => 'general',
                    'toggle_slug'       => 'main_content',
                    'description'       => esc_html__( 'Here you can define excerpt length in characters, if 0 no excerpt will be shown.', 'et_builder' ),
                ),
                'show_more' => array(
                    'label'             => esc_html__( 'Read More Button', 'et_builder' ),
                    'type'              => 'yes_no_button',
                    'option_category'   => 'configuration',
                    'options'           => array(
                        'off' => esc_html__( 'Off', 'et_builder' ),
                        'on'  => esc_html__( 'On', 'et_builder' ),
                    ),
                    'affects'           => array(
                        'read_more_text',
                    ),
                    'depends_show_if'   => 'off',
                    'tab_slug'          => 'general',
                    'toggle_slug'       => 'elements',
                    'description'       => esc_html__( 'Here you can define whether to show "read more" link after the excerpts or not.', 'et_builder' ),
                ),
                'read_more_text' => array(
                    'label'             => esc_html__( 'Read More Button Text', 'et_builder' ),
                    'type'              => 'text',
                    'option_category'   => 'configuration',
                    'depends_show_if'   => 'on',
                    'tab_slug'          => 'general',
                    'toggle_slug'       => 'elements',
                ),
                'show_author' => array(
                    'label'             => esc_html__( 'Show Author', 'et_builder' ),
                    'type'              => 'yes_no_button',
                    'option_category'   => 'configuration',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'et_builder' ),
                        'off' => esc_html__( 'No', 'et_builder' ),
                    ),
                    'tab_slug'          => 'general',
                    'toggle_slug'       => 'elements',
                    'description'        => esc_html__( 'Turn on or off the author link.', 'et_builder' ),
                ),
                'show_date' => array(
                    'label'             => esc_html__( 'Show Date', 'et_builder' ),
                    'type'              => 'yes_no_button',
                    'option_category'   => 'configuration',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'et_builder' ),
                        'off' => esc_html__( 'No', 'et_builder' ),
                    ),
                    'tab_slug'          => 'general',
                    'toggle_slug'       => 'elements',
                    'description'        => esc_html__( 'Turn the date on or off.', 'et_builder' ),
                ),
                'show_categories' => array(
                    'label'             => esc_html__( 'Show Categories', 'et_builder' ),
                    'type'              => 'yes_no_button',
                    'option_category'   => 'configuration',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'et_builder' ),
                        'off' => esc_html__( 'No', 'et_builder' ),
                    ),
                    'affects'           => array(
                        'category_meta_colors',
                        'category_color',
                        'category_background_color',
                        'category_hover_color',
                        'category_hover_background_color',
                    ),
                    'tab_slug'          => 'general',
                    'toggle_slug'       => 'elements',
                    'description'        => esc_html__( 'Turn the category links on or off.', 'et_builder' ),
                ),
                'category_meta_colors' => array(
                    'label'             => esc_html__( 'Pick Colors From Categories', 'et_builder' ),
                    'type'              => 'yes_no_button',
                    'option_category'   => 'configuration',
                    'options'           => array(
                        'off' => esc_html__( 'No', 'et_builder' ),
                        'on'  => esc_html__( 'Yes', 'et_builder' ),
                    ),
                    'depends_show_if' => 'on',
                    'tab_slug'          => 'advanced',
                    'toggle_slug'       => 'category_toggle',
                    'description'        => esc_html__( 'Use category tag background color from custom field. If defined, it will take precendence over below category colors.', 'et_builder' ),
                ),
                'category_color' => array(
    				'label'           => esc_html__( 'Category Color', 'et_builder' ),
    				'type'            => 'color',
    				'depends_show_if' => 'on',
    				'tab_slug'          => 'advanced',
				    'toggle_slug'       => 'category_toggle',
    				'description'     => esc_html__( 'Here you can define a custom color for the category text.', 'et_builder' ),
    			),
    			'category_background_color' => array(
    				'label'           => esc_html__( 'Category Background', 'et_builder' ),
    				'type'            => 'color-alpha',
    				'depends_show_if' => 'on',
    				'tab_slug'          => 'advanced',
				    'toggle_slug'       => 'category_toggle',
    				'description'     => esc_html__( 'Here you can define a custom color for the category background.', 'et_builder' ),
    			),
    			'category_hover_color' => array(
    				'label'           => esc_html__( 'Category Hover Color', 'et_builder' ),
    				'type'            => 'color',
    				'depends_show_if' => 'on',
    				'tab_slug'          => 'advanced',
				    'toggle_slug'       => 'category_toggle',
    				'description'     => esc_html__( 'Here you can define a custom color for the category text on hover.', 'et_builder' ),
    			),
    			'category_hover_background_color' => array(
    				'label'           => esc_html__( 'Category Hover Background', 'et_builder' ),
    				'type'            => 'color-alpha',
    				'depends_show_if' => 'on',
    				'tab_slug'          => 'advanced',
				    'toggle_slug'       => 'category_toggle',
    				'description'     => esc_html__( 'Here you can define a custom color for the category background on hover.', 'et_builder' ),
    			),
                'show_comments' => array(
                    'label'             => esc_html__( 'Show Comment Count', 'et_builder' ),
                    'type'              => 'yes_no_button',
                    'option_category'   => 'configuration',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'et_builder' ),
                        'off' => esc_html__( 'No', 'et_builder' ),
                    ),
                    'tab_slug'          => 'general',
                    'toggle_slug'       => 'elements',
                    'description'        => esc_html__( 'Turn comment count on and off.', 'et_builder' ),
                ),
                'show_load_more' => array(
                    'label'             => esc_html__( 'Show Load More', 'et_builder' ),
                    'type'              => 'yes_no_button',
                    'option_category'   => 'configuration',
                    'options'           => array(
                        'off' => esc_html__( 'No', 'et_builder' ),
                        'on'  => esc_html__( 'Yes', 'et_builder' ),
                    ),
                    'affects'           => array(
                        'load_more_text',
                        'show_less_text',
                        'custom_ajax_pagination',
                    ),
                    'tab_slug'          => 'general',
                    'toggle_slug'       => 'pagination',
                    'description'        => esc_html__( 'Show Load More button or not.', 'et_builder' ),
                ),
                'load_more_text' => array(
                    'label'             => esc_html__( 'Load More Button Text', 'et_builder' ),
                    'type'              => 'text',
                    'option_category'   => 'configuration',
                    'depends_show_if'   => 'on',
                    'tab_slug'          => 'general',
                    'toggle_slug'       => 'pagination',
                ),
                'show_less_text' => array(
                    'label'             => esc_html__( 'Show Less Button Text', 'et_builder' ),
                    'type'              => 'text',
                    'option_category'   => 'configuration',
                    'depends_show_if'   => 'on',
                    'tab_slug'          => 'general',
                    'toggle_slug'       => 'pagination',
                ),
                'show_social_icons' => array(
                    'label'             => esc_html__( 'Show Social Icons', 'et_builder' ),
                    'type'              => 'yes_no_button',
                    'option_category'   => 'configuration',
                    'options'           => array(
                        'off' => esc_html__( 'No', 'et_builder' ),
                        'on'  => esc_html__( 'Yes', 'et_builder' ),
                    ),
                    'depends_show_if'   => 'classic',
                    'tab_slug'          => 'advanced',
                    'toggle_slug'       => 'layout_toggle',
                    'description'        => esc_html__( 'Turn social sharing icons on or off.', 'et_builder' ),
                ),
                'use_overlay' => array(
                    'label'             => esc_html__( 'Featured Image Overlay', 'et_builder' ),
                    'type'              => 'yes_no_button',
                    'option_category'   => 'layout',
                    'options'           => array(
                        'off' => esc_html__( 'Off', 'et_builder' ),
                        'on'  => esc_html__( 'On', 'et_builder' ),
                    ),
                    'affects'           => array(
                        'overlay_icon_color',
                        'hover_overlay_color',
                        'hover_icon',
                    ),
                    'depends_show_if'   => 'on',
                    'tab_slug'          => 'advanced',
                    'toggle_slug'       => 'overlay',
                    'description'       => esc_html__( 'If enabled, an overlay color and icon will be displayed when a visitors hovers over the featured image of a post.', 'et_builder' ),
                ),
                'overlay_icon_color' => array(
                    'label'             => esc_html__( 'Overlay Icon Color', 'et_builder' ),
                    'type'              => 'color',
                    'custom_color'      => true,
                    'depends_show_if'   => 'on',
                    'tab_slug'          => 'advanced',
                    'toggle_slug'       => 'overlay',
                    'description'       => esc_html__( 'Here you can define a custom color for the overlay icon', 'et_builder' ),
                ),
                'hover_overlay_color' => array(
                    'label'             => esc_html__( 'Hover Overlay Color', 'et_builder' ),
                    'type'              => 'color-alpha',
                    'custom_color'      => true,
                    'depends_show_if'   => 'on',
                    'tab_slug'          => 'advanced',
                    'toggle_slug'       => 'overlay',
                    'description'       => esc_html__( 'Here you can define a custom color for the overlay', 'et_builder' ),
                ),
                'hover_icon' => array(
                    'label'               => esc_html__( 'Hover Icon Picker', 'et_builder' ),
                    'type'                => 'text',
                    'option_category'     => 'configuration',
                    'class'               => array( 'et-pb-font-icon' ),
                    'renderer'            => 'et_pb_get_font_icon_list',
                    'renderer_with_field' => true,
                    'depends_show_if'     => 'on',
                    'tab_slug'          => 'advanced',
                    'toggle_slug'       => 'overlay',
                    'description'         => esc_html__( 'Here you can define a custom icon for the overlay', 'et_builder' ),
                ),
                'content_color' => array(
                    'label'             => esc_html__( 'Text Color', 'et_builder' ),
                    'type'              => 'color',
                    'custom_color'      => true,
                    'tab_slug'          => 'advanced',
                    'toggle_slug'       => 'text',
                ),
                'disabled_on' => array(
                    'label'           => esc_html__( 'Disable on', 'et_builder' ),
                    'type'            => 'multiple_checkboxes',
                    'options'         => array(
                        'phone'   => esc_html__( 'Phone', 'et_builder' ),
                        'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
                        'desktop' => esc_html__( 'Desktop', 'et_builder' ),
                    ),
                    'additional_att'  => 'disable_on',
                    'option_category' => 'configuration',
                    'tab_slug'        => 'custom_css',
				    'toggle_slug'     => 'visibility',
                    'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
                ),
                'admin_label' => array(
                    'label'       => esc_html__( 'Admin Label', 'et_builder' ),
                    'type'        => 'text',
                    'toggle_slug'     => 'admin_label',
                    'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
                ),
                'module_id' => array(
                    'label'           => esc_html__( 'CSS ID', 'et_builder' ),
                    'type'            => 'text',
                    'option_category' => 'configuration',
                    'tab_slug'        => 'custom_css',
				    'toggle_slug'     => 'classes',
                    'option_class'    => 'et_pb_custom_css_regular',
                ),
                'module_class' => array(
                    'label'           => esc_html__( 'CSS Class', 'et_builder' ),
                    'type'            => 'text',
                    'option_category' => 'configuration',
                    'tab_slug'        => 'custom_css',
				    'toggle_slug'     => 'classes',
                    'option_class'    => 'et_pb_custom_css_regular',
                ),
                'animation' => array(
					'label' => esc_html__('Single Post Animation', 'et_builder'),
					'type' => 'select',
					'option_category' => 'configuration',
					'options' => array(
						'top' => esc_html__('Top To Bottom', 'et_builder'),
						'left' => esc_html__('Left To Right', 'et_builder'),
						'right' => esc_html__('Right To Left', 'et_builder'),
						'bottom' => esc_html__('Bottom To Top', 'et_builder'),
						'off' => esc_html__('No Animation', 'et_builder')
					),
					'tab_slug' => 'advanced',
					'toggle_slug' => 'animation',
					'description' => esc_html__('This controls the direction of the lazy-loading animation.', 'et_builder')
				),
                
            );
            
            return $fields;
        }
        
    
        function shortcode_callback( $atts, $content = null, $function_name ) {
            /**
             * Cached $wp_filter so it can be restored at the end of the callback.
             * This is needed because this callback uses the_content filter / calls a function
             * which uses the_content filter. WordPress doesn't support nested filter
             */
    
            global $wp_filter;
            $wp_filter_cache = $wp_filter;
    
            $module_id                          = $this->shortcode_atts['module_id'];
            $module_class                       = $this->shortcode_atts['module_class'];
            $layout                             = $this->shortcode_atts['blog_layout'];
            $posts_number                       = $this->shortcode_atts['posts_number'];
            $include_categories                 = $this->shortcode_atts['include_categories'];
            $meta_date                          = $this->shortcode_atts['meta_date'];
            $show_thumbnail                     = $this->shortcode_atts['show_thumbnail'];
            $image_position                     = $this->shortcode_atts['image_position'];
            $show_content                       = $this->shortcode_atts['show_content'];
            $show_more                          = $this->shortcode_atts['show_more'];
            $excerpt_length                     = $this->shortcode_atts['excerpt_length'];
            $read_more_text                     = $this->shortcode_atts['read_more_text'];
            $show_author                        = $this->shortcode_atts['show_author'];
            $show_date                          = $this->shortcode_atts['show_date'];
            $show_categories                    = $this->shortcode_atts['show_categories'];
            $category_meta_colors               = $this->shortcode_atts['category_meta_colors'];
            $category_color                     = $this->shortcode_atts['category_color'];
            $category_background                = $this->shortcode_atts['category_background_color'];
            $category_hover_color               = $this->shortcode_atts['category_hover_color'];
            $category_hover_background          = $this->shortcode_atts['category_hover_background_color'];
            $show_comments                      = $this->shortcode_atts['show_comments'];
            $show_load_more                     = $this->shortcode_atts['show_load_more'];
            $load_more_text                     = $this->shortcode_atts['load_more_text'];
            $show_less_text                     = $this->shortcode_atts['show_less_text'];
            $custom_ajax_pagination             = $this->shortcode_atts['custom_ajax_pagination'];
			$ajax_pagination_icon               = $this->shortcode_atts['ajax_pagination_icon'];
			$ajax_pagination_use_icon           = $this->shortcode_atts['ajax_pagination_use_icon'];
            $offset_number                      = $this->shortcode_atts['offset_number'];
            $post_order                         = $this->shortcode_atts['post_order'];
            $show_social_icons                  = $this->shortcode_atts['show_social_icons'];
            $overlay_icon_color                 = $this->shortcode_atts['overlay_icon_color'];
            $hover_overlay_color                = $this->shortcode_atts['hover_overlay_color'];
            $hover_icon                         = $this->shortcode_atts['hover_icon'];
            $use_overlay                        = $this->shortcode_atts['use_overlay'];
            $content_color                      = $this->shortcode_atts['content_color'];
            $animation                          = $this->shortcode_atts['animation'];
    
    
            $module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );
    
            $container_is_closed = false;
            
            // include easyPieChart which is required for loading Blog module content via ajax correctly
		    wp_enqueue_script( 'easypiechart' );
		    
		    // include ET Shortcode scripts
		    wp_enqueue_script( 'et-shortcodes-js' );
    
            // remove all filters from WP audio shortcode to make sure current theme doesn't add any elements into audio module
            remove_all_filters( 'wp_audio_shortcode_library' );
            remove_all_filters( 'wp_audio_shortcode' );
            remove_all_filters( 'wp_audio_shortcode_class');
            
            $layout_class_inline = '.el_dbe_'.$layout;
            
            if ( 'on' === $use_overlay ) {
                $data_icon = '' !== $hover_icon
                    ? sprintf(
                        ' data-icon="%1$s"',
                        esc_attr( et_pb_process_font_icon( $hover_icon ) )
                    )
                    : '';
    
                $overlay_output = sprintf(
                    '<span class="et_overlay%1$s"%2$s></span>',
                    ( '' !== $hover_icon ? ' et_pb_inline_icon' : '' ),
                    $data_icon
                );
            }
        
            if ( '' !== $overlay_icon_color ) {
                ET_Builder_Element::set_style( $function_name, array(
                    'selector'    => '%%order_class%% .et_overlay:before',
                    'declaration' => sprintf(
                        'color: %1$s !important;',
                        esc_html( $overlay_icon_color )
                    ),
                ) );
            }
    
            if ( '' !== $hover_overlay_color ) {
                ET_Builder_Element::set_style( $function_name, array(
                    'selector'    => '%%order_class%% .et_overlay',
                    'declaration' => sprintf(
                        'background-color: %1$s;',
                        esc_html( $hover_overlay_color )
                    ),
                ) );
            }
            
            if ( '' !== $content_color ) {
                ET_Builder_Element::set_style( $function_name, array(
                    'selector'    => '%%order_class%% .post-content p:not(.post-meta)',
                    'declaration' => sprintf(
                        'color: %1$s !important;',
                        esc_html( $content_color )
                    ),
                ) );
            }
            
            if ( 'on' !== $show_content ) {
                if( $layout == 'classic' ){
                    $excerpt_length = ( '' === $excerpt_length ) ? 600 : esc_attr( $excerpt_length );
                }else{
                    $excerpt_length = ( '' === $excerpt_length ) ? 270 : esc_attr( $excerpt_length );
                }
            }
            
            if ( 'on' == $show_more ) {
                $read_more_text = ( '' === $read_more_text ) ? 'Read More' : esc_attr( $read_more_text );
            }
            
            if ( 'on' == $show_load_more ) {
                $load_more_text = ( '' === $load_more_text ) ? 'Load More' : esc_attr( $load_more_text );
                $show_less_text = ( '' === $show_less_text ) ? 'Show Less' : esc_attr( $show_less_text );
            }
    
            $overlay_class = 'on' === $use_overlay ? ' et_pb_has_overlay' : '';
    
            
            $args = array( 'post_type' => 'post' );
            
        
            $args['post_status'] = 'publish';
    
            if ( '' !== $include_categories ) {
                $args['cat'] = $include_categories;
            }
            
            if ( '' !== $offset_number && ! empty( $offset_number ) ) {
    			$args['offset'] = intval( $offset_number );
    		}else{
    		    $args['offset'] = 0;
    		}
    		
    		$args['posts_per_page'] = intval($posts_number);
    		
    		if( $args['offset'] != '' && $args['posts_per_page'] == -1 ){
    		    $count_posts = wp_count_posts();
                $published_posts = $count_posts->publish;
                $args['posts_per_page'] = $published_posts;
    		}
    		
    		if ( '' !== $post_order ) {
    			$args['order'] = $post_order;
    		}
    
            if ( is_single() && ! isset( $args['post__not_in'] ) ) {
                $args['post__not_in'] = array( get_the_ID() );
            }
    
            ob_start();
    
            $Query = new WP_Query($args);
        
            if ( $Query->have_posts() ) {
                
                $total = ceil( ($Query->found_posts - $args['offset'])/$args['posts_per_page'] );
                
                $counter = 1;
                
                echo '<div class="el-dbe-blog-extra '.$layout.'">';
            
                while ( $Query->have_posts() ) {
                    $Query->the_post();
                    
                    global $post;
                    $pid        = $post->ID;
    
                    $thumb      = '';
    				$classtext  = 'et_pb_post_main_image';
    				$titletext  = get_the_title();
    				$thumbnail  = get_thumbnail( '', '', $classtext, $titletext, $titletext, false, 'Blogimage' );
    				$thumb      = $thumbnail["thumb"];
                        
                    $no_thumb_class = ( '' === $thumb || 'off' === $show_thumbnail ) ? ' et_pb_no_thumb' : '';
                    
                    if ( '' !== $thumb && 'on' === $show_thumbnail ) {
                        if( $layout == 'block_extended' ){
                            
                            if( $image_position != 'alternate' ){
                                $image_class = ' image-'.$image_position;
                            } else {
                                if( $counter%2 != 0 ){
                                    $image_class = ' image-background';
                                }else{
                                    $image_class = ' image-top';
                                }
                            }
                            
                        }else{
                            $image_class = '';
                        }
                    }else{
                        $image_class = '';
                    }
    
                    $layout_class   = ' el_dbe_'.$layout;
                    
                    $animation_class = ' et-waypoint et_pb_animation_'.$animation;
                    
                    ?>
    
                    <article id="post-<?php echo $pid; ?>" <?php post_class( 'et_pb_post et_pb_post_extra et_pb_text_align_left' . $animation_class. $layout_class . $no_thumb_class . $overlay_class . $image_class  ); ?>>
    
                        <?php 
                            if( file_exists( get_stylesheet_directory_uri() . '/divi-blog-extras/layouts/'.$layout.'.php' ) ) {
                                include get_stylesheet_directory_uri() . '/divi-blog-extras/layouts/'.$layout.'.php';
                            }else if( file_exists(ELICUS_BLOG_DIR_PATH .'src/layouts/'.$layout.'.php') ) {
                                include ( ELICUS_BLOG_DIR_PATH .'src/layouts/'.$layout.'.php' );
                            }
                        ?>
                            
                    </article> <!-- .et_pb_post_extra -->
                    
                    <?php
                    
                    
                    $counter++;
                    
                } // endwhile
    
                if ( 'on' === $show_load_more && ! is_search() ) {
    
                    //$container_is_closed = true;
                    
                    if( $total > 1 ){
                        $ajax_pagination_data_icon            = ( 'on' == $ajax_pagination_use_icon && '' !== $ajax_pagination_icon && 'on' === $custom_ajax_pagination) ? sprintf(' data-icon="%1$s"', esc_attr(et_pb_process_font_icon($ajax_pagination_icon))) : '';
	                    $ajax_pagination_custom_icon_class    = ( 'on' == $ajax_pagination_use_icon && '' !== $ajax_pagination_icon && 'on' === $custom_ajax_pagination) ? ' et_pb_custom_button_icon' : '';
    		            echo  '<div class="ajax-pagination"><a'.$ajax_pagination_data_icon.' class="et_pb_button el-button el-load-more et-waypoint et_pb_animation_bottom et-animated'.$ajax_pagination_custom_icon_class.'" data-load="1" data-total="'.$total.'">'.$load_more_text.'</a></div>';
            		}
                    
            		echo '</div>';
            		
            		?>
            		<div class="el-blog-params">
                		<input type="hidden"
                		    function_name="<?php echo $function_name; ?>"
                            layout="<?php echo $layout ?>"
                            posts_number="<?php echo $posts_number ?>"
                            include_categories="<?php echo $include_categories; ?>"
                            meta_date="<?php echo $meta_date; ?>"
                            show_thumbnail="<?php echo $show_thumbnail; ?>"
                            image_position="<?php echo $image_position; ?>"
                            show_content="<?php echo $show_content; ?>"
                            show_more="<?php echo $show_more; ?>"
                            excerpt_length="<?php echo $excerpt_length; ?>"
                            read_more_text="<?php echo $read_more_text; ?>"
                            show_author="<?php echo $show_author; ?>"
                            show_date="<?php echo $show_date; ?>"
                            show_categories="<?php echo $show_categories; ?>"
                            category_meta_colors="<?php echo $category_meta_colors ?>"
                            show_comments="<?php echo $show_comments; ?>"
                            show_load_more="<?php echo $show_load_more; ?>"
                            load_more_text="<?php echo $load_more_text; ?>"
                            show_less_text="<?php echo $show_less_text; ?>"
                            offset_number="<?php echo $offset_number; ?>"
                            post_order="<?php echo $post_order; ?>"
                            show_social_icons="<?php echo $show_social_icons; ?>"
                            overlay_icon_color="<?php echo $overlay_icon_color; ?>"
                            hover_overlay_color="<?php echo $hover_overlay_color; ?>"
                            hover_icon="<?php echo esc_attr( et_pb_process_font_icon( $hover_icon ) ); ?>"
                            use_overlay="<?php echo $use_overlay; ?>"
                            content_color="<?php echo $content_color; ?>"
                            animation="<?php echo $animation; ?>"
                            ajax_pagination_use_icon="<?php echo $ajax_pagination_use_icon; ?>"
                            ajax_pagination_icon="<?php echo $ajax_pagination_icon; ?>"
                            custom_ajax_pagination="<?php echo $custom_ajax_pagination; ?>"
                            />
                    </div>
            		<?php
                }else{
                    
                    echo '</div>';
            			
                }
    
                wp_reset_query();
            } else {
                if ( et_is_builder_plugin_active() ) {
                    include( ET_BUILDER_PLUGIN_DIR . 'includes/no-results.php' );
                } else {
                    get_template_part( 'includes/no-results', 'index' );
                }
            }
    
            $posts = ob_get_contents();
    
            ob_end_clean();
    
            $class = " et_pb_module et_pb_bg_layout_light";
    
            $output = sprintf(
                '<div%5$s class="%1$s%3$s%6$s"%7$s>
    				%2$s
    			%4$s',
                'et_pb_posts',
                $posts,
                esc_attr( $class ),
                ( ! $container_is_closed ? '</div> <!-- .et_pb_posts -->' : '' ),
                ( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
                ( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
                ( '' )
            );
    
    
            // Restore $wp_filter
            $wp_filter = $wp_filter_cache;
            unset($wp_filter_cache);
    
            return $output;
    
        }
    
    }
    new El_Blog_Module;
    
}
