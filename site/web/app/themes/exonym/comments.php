<?php
  /* =================
     COMMENTS TEMPLATE
     ================= */

  // Don't load it if you can't comment
  if(post_password_required()) {
    return;
  }

  if(have_comments()): ?>
    <h3 id="comments-title">Showing <?php comments_number( __( '<span>No</span> Orders', 'exonym' ), __( '<span>One</span> Order', 'exonym' ), __( '<span>%</span> Orders', 'exonym' ) );?></h3>
    <ol class="comment-list">
      <?php
        wp_list_comments(array(
          'style'             => 'ol',
          'short_ping'        => true,
          'avatar_size'       => 40,
          'callback'          => 'company_orders_layout',
          'type'              => 'all',
          'reply_text'        => __('Reply', 'exonym'),
          'page'              => '',
          'per_page'          => '',
          'reverse_top_level' => null,
          'reverse_children'  => ''
        ));
      ?>
    </ol>
    <?php if(get_comment_pages_count() > 1 && get_option('page_comments')): ?>
      <nav class="navigation comment-navigation" role="navigation">
        <div class="comment-nav-prev"><?php previous_comments_link( __( '&larr; Previous Comments', 'exonym' ) ); ?></div>
        <div class="comment-nav-next"><?php next_comments_link( __( 'More Comments &rarr;', 'exonym' ) ); ?></div>
      </nav>
    <?php endif; ?>
    <?php if(!comments_open()) : ?>
      <p class="no-comments"><?php _e('Comments are closed.' , 'exonym'); ?></p>
    <?php endif; ?>
  <?php else: ?>
    <h3 id="comments-title">No orders have been placed yet.</h3>
  <?php endif; ?>
  <?php comment_form(); ?>
