<?php 
	if(isset($_GET['import-demo']) && $_GET['import-demo'] == true){
		// ------- Create Nav Menu --------
		$real_estate_property_menuname ='Primary Menu';
	    $real_estate_property_bpmenulocation = 'primary_menu';
	    $real_estate_property_menu_exists = wp_get_nav_menu_object( $real_estate_property_menuname );
	    if( !$real_estate_property_menu_exists){
	        $real_estate_property_menu_id = wp_create_nav_menu($real_estate_property_menuname);
	        $real_estate_property_home_parent = wp_update_nav_menu_item($real_estate_property_menu_id, 0, array(
				'menu-item-title' =>  __('Home','real-estate-property'),
				'menu-item-classes' => 'home',
				'menu-item-url' =>home_url( '/' ),
				'menu-item-status' => 'publish')
			);

			wp_update_nav_menu_item($real_estate_property_menu_id, 0, array(
	            'menu-item-title' =>  __('About Us','real-estate-property'),
	            'menu-item-classes' => 'about',
	            'menu-item-url' => home_url( '//features/' ), 
	            'menu-item-status' => 'publish'));

	        wp_update_nav_menu_item($real_estate_property_menu_id, 0, array(
	            'menu-item-title' =>  __('Properties','real-estate-property'),
	            'menu-item-classes' => 'properties',
	            'menu-item-url' => home_url( '//products/' ), 
	            'menu-item-status' => 'publish'));

			wp_update_nav_menu_item($real_estate_property_menu_id, 0, array(
	            'menu-item-title' =>  __('Blog','real-estate-property'),
	            'menu-item-classes' => 'blog',
	            'menu-item-url' => home_url( '//support/' ), 
	            'menu-item-status' => 'publish'));

			wp_update_nav_menu_item($real_estate_property_menu_id, 0, array(
	            'menu-item-title' =>  __('Contact Us','real-estate-property'),
	            'menu-item-classes' => 'contact',
	            'menu-item-url' => home_url( '//contact/' ), 
	            'menu-item-status' => 'publish'));
	        
			if( !has_nav_menu( $real_estate_property_bpmenulocation ) ){
	            $locations = get_theme_mod('nav_menu_locations');
	            $locations[$real_estate_property_bpmenulocation] = $real_estate_property_menu_id;
	            set_theme_mod( 'nav_menu_locations', $locations );
	        }
	    }
	    $real_estate_property_home_id='';
		$real_estate_property_home_content = '';
		$real_estate_property_home_title = 'Home';
		$real_estate_property_home = array(
			'post_type' => 'page',
			'post_title' => $real_estate_property_home_title,
			'post_content' => $real_estate_property_home_content,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'home'
		);
		$real_estate_property_home_id = wp_insert_post($real_estate_property_home);
	    
		add_post_meta( $real_estate_property_home_id, '_wp_page_template', 'templates/template-homepage.php' );

		update_option( 'page_on_front', $real_estate_property_home_id );
		update_option( 'show_on_front', 'page' );

		//---Header--//

		set_theme_mod('real_estate_property_top_twitter_link', '#');
		set_theme_mod('real_estate_property_top_linkdin_link', '#');
		set_theme_mod('real_estate_property_top_youtube_link', '#');
		set_theme_mod('real_estate_property_top_facebook_link', '#');
		set_theme_mod('real_estate_property_top_instagram_link', '#');

		set_theme_mod('real_estate_property_header_register_link', '#');
		set_theme_mod('real_estate_property_header_register_text', 'Add Property');

		set_theme_mod('real_estate_property_header_phone_number', 'Call: +1234567890');
		set_theme_mod('real_estate_property_header_email_address', 'info@example.com');

		//-----Slider-----//

		set_theme_mod( 'real_estate_property_slide_on_off', 'on' );

		set_theme_mod('real_estate_property_slide_count','3');

		$real_estate_property_slider_title=array('Your Gateway to a Richer Life', 'Unlock the Door to a More Abundant Life', 'Your Key to a Life of Greater Fulfillment');

		for ($i=1; $i <= 3; $i++) {
			set_theme_mod( 'real_estate_property_slider_image'.$i, get_template_directory_uri().'/images/demo-import-images/slides/slide_'.$i.'.png' );
			
			set_theme_mod('real_estate_property_slider_heading'.$i, $real_estate_property_slider_title[$i - 1]);
			set_theme_mod('real_estate_property_slider_heading_link'.$i,'#');
			set_theme_mod('real_estate_property_slider_content'.$i,'Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.');
			set_theme_mod('real_estate_property_slider_button_link'.$i, '#');
			set_theme_mod('real_estate_property_slider_button_text'.$i, 'Buy Now');
		}

		//-----Projects-----//

		set_theme_mod( 'real_estate_property_project_on_off', 'on' );

		set_theme_mod('real_estate_property_project_main_heading','Our Recent Projects');

		set_theme_mod('real_estate_property_project_count','3');

		$real_estate_property_features_title=array('The best place to buy property for investing', 'How to achieve financial independence through real...', 'Dream house plus best rates, How to calculate?');

		$real_estate_property_features_date=array('05 December 2021', '15 January 2021', '21 December 2021');

		$real_estate_property_features_category=array('Investment', 'Finance', 'Property');

		for ($i=1; $i <= 3; $i++) {
			set_theme_mod( 'real_estate_property_project_image'.$i, get_template_directory_uri().'/images/demo-import-images/project/project_'.$i.'.jpg' );
			set_theme_mod('real_estate_property_project_heading'.$i, $real_estate_property_features_title[$i - 1]);
			set_theme_mod('real_estate_property_project_date'.$i, $real_estate_property_features_date[$i - 1]);
			set_theme_mod('real_estate_property_project_category'.$i, $real_estate_property_features_category[$i - 1]);
			set_theme_mod('real_estate_property_project_content'.$i,'Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.');
		}

	}
?>