<?php

function ajax_submit_comment(){
	$comment = wp_handle_comment_submission( wp_unslash($_POST));
	if(is_wp_error($comment)){
		$error_data = intval($comment->get_error_data());
		if(! empty( $error_data)){
			wp_die('<p>' . $comment->get_error_message() . '</p>', __('Comment Submission Failure'), array('response' => $error_data, 'back_link' => true));
		} else {
			wp_die('Unknown error');
		}
	}
	$user = wp_get_current_user();
	do_action('set_comment_cookies', $comment, $user);
	$comment_depth = 1;
	$comment_parent = $comment->comment_parent;
	while( $comment_parent ){
		$comment_depth++;
		$parent_comment = get_comment( $comment_parent );
		$comment_parent = $parent_comment->comment_parent;
	}
	$GLOBALS['comment'] = $comment;
	$GLOBALS['comment_depth'] = $comment_depth;

	//Comment Display
	get_template_part('templates/company', 'order');
	die();
}
add_action('wp_ajax_ajaxcomments', 'ajax_submit_comment');
add_action('wp_ajax_nopriv_ajaxcomments', 'ajax_submit_comment');

// Custom Comment Layout in Theme
function company_orders_layout( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  get_template_part('templates/company', 'order');
}

// Editor Manage Users
function editor_manage_users() {
  if (get_option('add_cap_editor_once' ) != 'done') {
    $edit_editor = get_role('editor');
    $edit_editor->add_cap('edit_users');
    $edit_editor->add_cap('list_users');
    $edit_editor->add_cap('promote_users');
    $edit_editor->add_cap('create_users');
    $edit_editor->add_cap('add_users');
    $edit_editor->add_cap('delete_users');
    update_option('add_cap_editor_once', 'done');
  }
}
add_action('init', 'editor_manage_users');

// Editor Limit access and protect from Admins
class editor_user_caps {
  function __construct() {
    add_filter( 'editable_roles', array(&$this, 'editable_roles'));
    add_filter( 'map_meta_cap', array(&$this, 'map_meta_cap'),10,4);
  }
  function editable_roles($roles) {
    if(isset($roles['administrator']) && !current_user_can('administrator')) {
      unset($roles['administrator']);
    }
    return $roles;
  }
  function map_meta_cap($caps, $cap, $user_id, $args){
    switch($cap) {
      case 'edit_user':
      case 'remove_user':
      case 'promote_user':
        if(isset($args[0]) && $args[0] == $user_id)
          break;
        elseif(!isset($args[0]))
          $caps[] = 'do_not_allow';
          $other = new WP_User(absint($args[0]));
        if($other->has_cap( 'administrator')) {
          if(!current_user_can('administrator')) {
            $caps[] = 'do_not_allow';
          }
        }
        break;
        case 'delete_user':
        case 'delete_users':
          if(!isset($args[0]))
            break;
          $other = new WP_User(absint($args[0]));
          if($other->has_cap('administrator')) {
            if(!current_user_can('administrator')) {
              $caps[] = 'do_not_allow';
            }
          }
        break;
        default:
      break;
    }
    return $caps;
  }
}
$editor_user_caps = new editor_user_caps();

// Editor Hide Admin Users
add_action('pre_user_query','isa_pre_user_query');
function isa_pre_user_query($user_search) {
  $user = wp_get_current_user();
  if(!current_user_can('manage_options')) {
    global $wpdb;
    $user_search->query_where =
      str_replace('WHERE 1=1',
      "WHERE 1=1 AND {$wpdb->users}.ID IN (
        SELECT {$wpdb->usermeta}.user_id FROM $wpdb->usermeta
        WHERE {$wpdb->usermeta}.meta_key = '{$wpdb->prefix}capabilities'
        AND {$wpdb->usermeta}.meta_value NOT LIKE '%administrator%')",
      $user_search->query_where
    );
  }
}
