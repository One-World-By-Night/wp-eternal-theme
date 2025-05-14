<?php
/**

 * Recommended way to include parent theme styles.

 * (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)

 *

 */  

add_action( 'wp_enqueue_scripts', 'chronicle_hello_elementor_child_style' );
				function chronicle_hello_elementor_child_style() {
					wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
					wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
				}
/**

  Your code goes below. /

// Enqueue scripts.
add_action('wp_enqueue_scripts', 'enqueue_child_theme_scripts', 99);
function enqueue_child_theme_scripts() {
    // Enqueue your custom JavaScript file
    wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/chronicles-custom.js', array('jquery'), null, true);
}
function your_function($content, $atts) {
    $url = home_url($_SERVER['REQUEST_URI']);
    $parsed_url = parse_url($url, PHP_URL_PATH);
    $path_segments = explode('/', rtrim($parsed_url, '/'));
    $last_segment = end($path_segments);
    $user = get_user_by('login', $last_segment);
// 	echo"<pre>";
// 	print_r($user);
// 	echo"</pre>";
   if (isset($user->ID)) {
    $chronicle_Info = get_field('chronicle_Info', 'user_' . $user->ID);
    $game_sessions = get_field('game_sessions', 'user_' . $user->ID);
    $game_site_information = get_field('game_site_information', 'user_' . $user->ID);
    $resource_links = get_field('resource_links', 'user_' . $user->ID);
    $house_rule = get_field('house_rule', 'user_' . $user->ID);
    $house_title_text = 'House Rule : ';
	   

    // Initialize variables to store HTML for each section
    $chronicle_Info_val = '';
    $game_sessions_val = '';
    $game_site_information_val = '';
    $resource_links_val = '';
    $house_rule_val = '';

    // Conditionally add content if the field is not empty
    if (!empty($chronicle_Info)) {
        $chronicle_Info_val = '<div class="chron-info"><h2>Chronicle Information</h2>' . $chronicle_Info . '</div>';
    }

    if (!empty($game_sessions)) {
        $game_sessions_val = '<div class="game_session"><h2>Game Sessions</h2>' . $game_sessions . '</div>';
    }

    if (!empty($game_site_information)) {
        $game_site_information_val = '<div class="game_siteInfo"><h2>Game Site Information</h2>' . $game_site_information . '</div>';
    }
    if (!empty($house_rule)) {
        $house_rule_val = '<h2 class="resourcetitle">Resource Links</h2><div class="house_rule_block">
            <p>' . esc_html($house_title_text) . '</p>
            <a href="' . esc_attr($house_rule) . '" class="house_rule_link">Link</a>
        </div>';
    }
    if (!empty($resource_links && $house_rule)) {
        $resource_links_val = '<div class="resource_link">' . $resource_links . '</div>';
    }


    // Wrap the $chronicle_Info_val in a div with class "left_ChronicleInfo"
    $left_content = '<div class="left_ChronicleInfo">' . $chronicle_Info_val . '</div>';

    // Wrap the remaining content in a div with class "right_ChronicleInfo"
    $right_content = '<div class="right_ChronicleInfo">';
    $right_content .= $game_sessions_val;
    $right_content .= $game_site_information_val;
	$right_content .= $house_rule_val;
    $right_content .= $resource_links_val;
    $right_content .= '</div>';

    // Wrap both left_ChronicleInfo and right_ChronicleInfo in a div with class "User_chronicleInfo"
    $wrapped_content = '<div class="User_chronicleInfo">';
    $wrapped_content .= $left_content;
    $wrapped_content .= $right_content;
    $wrapped_content .= '</div>';

    $content .= $wrapped_content;
}

return $content;
}
add_filter('arm_change_content_after_display_profile_and_directory', 'your_function', 10, 2);



function custom_event_listing_type_rewrite_rule() {
    // Change 'chronicles' to your desired URL slug
    $rewrite_slug = 'annual-events';

    // Change 'event_listing_type' to your custom post type name
    global $wp_rewrite;
    $wp_rewrite->extra_permastructs['event_listing_type']['struct'] = "/$rewrite_slug/%event_listing_type%";

    // Flush rewrite rules to apply changes
    flush_rewrite_rules();
}
add_action('init', 'custom_event_listing_type_rewrite_rule');


// Add shortcode to fetch current website URL with "chronicles" and event creator's name
function get_website_url_with_chronicles_and_author() {
    global $post;

    // Get current post's author ID
    $author_id = $post->post_author;

    // Get author's display name
    $author_name = get_the_author_meta('user_login', $author_id);

    // Get website URL
    $website_url = home_url();

    // Append "chronicles" and author's name to the website URL
    $url_with_chronicles_and_author = $website_url.'/chronicles/'.$author_name;
	$event_chronicles = '<a href="'.$url_with_chronicles_and_author.'">View Details</a>';
    return $event_chronicles;
}
add_shortcode('website_url_with_chronicles_and_author', 'get_website_url_with_chronicles_and_author');


// table press
function restrict_tablepress_edit_access($edit_access, $table_id) {
    // Get the current user ID
    $current_user_id = get_current_user_id();
    
    // Get table information to check who created it
    $table = TablePress::$model_table->load($table_id);
    
    // Check if the current user is the owner or an admin
    if ($table['author'] != $current_user_id && !current_user_can('administrator')) {
        $edit_access = false;  // Block access to editing
    }

    return $edit_access;
}
add_filter('tablepress_user_can_edit_table', 'restrict_tablepress_edit_access', 1000, 200);

function restrict_tablepress_delete_access($delete_access, $table_id) {
    // Get the current user ID
    $current_user_id = get_current_user_id();
    
    // Get table information to check who created it
    $table = TablePress::$model_table->load($table_id);
    
    // Check if the current user is the owner or an admin
    if ($table['author'] != $current_user_id && !current_user_can('administrator')) {
        $delete_access = false;  // Block access to deleting
    }

    return $delete_access;
}
add_filter('tablepress_user_can_delete_table', 'restrict_tablepress_delete_access', 1000, 200); 
// function hide_tools_menu() {
//     if (is_admin()) {
//         // Check if the user has the desired role (optional condition)
//         if (!current_user_can('administrator')) {
//             remove_menu_page('tools.php');  // Removes the "Tools" menu
//             remove_menu_page('edit.php?post_type=elementor_library'); 
//             remove_menu_page('tablepress'); 
//         }
//     }
// }
// add_action('admin_menu', 'hide_tools_menu', 999);









/********** BatterDocs start **********/


function rudr_add_term_fields( $taxonomy ) {
    $current_user_id = get_current_user_id();
	echo '<div class="form-field">';
	echo'<input type="hidden" name="user_id_text" id="user_id_text" value="'.$current_user_id.'" />';
	echo'</div>';
}
add_action( 'doc_category_add_form_fields', 'rudr_add_term_fields' );



function rudr_save_term_fields( $term_id ) {
	update_term_meta(
		$term_id,
		'user_id_text',
		sanitize_text_field( $_POST[ 'user_id_text' ] )
	);
}
add_action( 'created_doc_category', 'rudr_save_term_fields' );


function filter_tex($query) {
    if (is_admin() && isset($_GET['taxonomy']) && $_GET['taxonomy'] === 'doc_category') {
        $current_user = wp_get_current_user();
        if (in_array('author', $current_user->roles)) {
            $user_id = $current_user->ID;
            $meta_query = array(
                array(
                    'key' => 'user_id_text',
                    'value' => $user_id,
                    'compare' => '='
                )
            );
            $query->query_vars['meta_query'] = $meta_query;
        }
    }
}

add_action('pre_get_terms', 'filter_tex');



function my_custom_meta_box() {
    add_meta_box(
        'post_created_by_user_id',
        'User Id',
        'set_user_id_in_post_callback',
        'docs',
        'normal', 
        'default'
    );
}
add_action('add_meta_boxes', 'my_custom_meta_box');

function set_user_id_in_post_callback($post) {
    $value = get_post_meta($post->ID, 'post_created_by_user_id', true);
    echo '<label for="my_custom_meta_field">User Id:</label>';
    if($value){
        echo '<input type="text" readonly id="my_custom_meta_field" name="post_created_by_user_id" value="' . esc_attr($value) . '" style="width:100%;" />';
    }
   
}


function my_custom_meta_save($post_id) {
    if (isset($_POST['post_created_by_user_id'])) {
        update_post_meta($post_id, 'post_created_by_user_id', sanitize_text_field($_POST['post_created_by_user_id']));
    }
}
add_action('save_post', 'my_custom_meta_save');




function modify_posts_list_table_query($query) {
    if (is_admin() && $query->is_main_query() && isset($_GET['post_type']) && $_GET['post_type'] === 'docs') {
        $current_user = wp_get_current_user();
        if (in_array('author', $current_user->roles)) {
            $current_user_id = get_current_user_id();
            $meta_query = array(
                array(
                    'key'     => 'post_created_by_user_id',
                    'value'   => $current_user_id,
                    'compare' => '==',
                ),
            );
            $query->set('meta_query', $meta_query);
        }
        
    }
}
add_action('pre_get_posts', 'modify_posts_list_table_query');


/********** BatterDocs End **********/


/*********** Table Press *********/


function admin_script_with_user_name() {
    wp_enqueue_script(
        'custom-admin-script',
        get_stylesheet_directory_uri() . '/admin-js/custom-admin.js',
        array('jquery'),
        '1.0.0',
        true
    );
    $current_user = wp_get_current_user();
    $role_data = in_array('author', $current_user->roles);
    $localized_data = array(
        'display_name' =>$current_user->display_name,
        'user_role' =>$role_data
    );
    wp_localize_script(
        'custom-admin-script',
        'customAdminData',
        $localized_data
    );

}
add_action('admin_enqueue_scripts', 'admin_script_with_user_name');




/*********** Table Press *********/

function hide_tools_menu() {
    if (is_admin()) {
        // Check if the user has the desired role (optional condition)
        if (!current_user_can('administrator')) {
            remove_menu_page('tools.php');  // Removes the "Tools" menu
            remove_menu_page('templates.php'); 
            remove_menu_page('arm_manage_members'); 
        }
    }
}
add_action('admin_menu', 'hide_tools_menu', 999);
