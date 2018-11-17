<?php
	/* ===================
		 PLUGIN SANITY CHECK
		 =================== */

  // Custom post format permalinks
  function post_format_permalink(){
    if(function_exists('ex_post_format_permalink')) {
      return ex_post_format_permalink();
    } else {
      return '<a href="' . get_the_permalink() . '" title="Read more about ' . get_the_title() . '">Read More &raquo;</a>';
    }
  }

  // Post format content in post head
  function post_format_header(){
    if(function_exists('ex_post_format_header')) {
      return ex_post_format_header();
    }
  }

  // Post format content in post footer
  function post_format_footer(){
    if(function_exists('ex_post_format_header')) {
      return ex_post_format_header();
    }
  }
