<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
  <article id="comment-<?php comment_ID(); ?>" class="comment">
    <section class="comment-meta">
      <span>Order Request #<?php comment_ID(); ?></span>
      <span class="comment-author">by <strong><?php comment_author(); ?></strong><br />on <em><?php comment_date() . comment_time(); ?></em></span>
      <i class="comment-open">Click to View Details</i>
    <div class="comment-content"><?php comment_text(); ?></div>
    <i class="comment-close">Click to Collapse</i>
  </article>
</li>
