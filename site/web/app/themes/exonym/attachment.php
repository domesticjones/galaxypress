<?php
  /* ===============
     ATTACHMENT PAGE
     ---------------
     Instead of using the attachment page,
     redirect to the parent post.
     =============== */

wp_redirect(get_permalink($post->post_parent)); ?>
