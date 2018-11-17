<li class="staff-module-single">
  <div class="staff-inner">
    <?php $photo = get_field('photos'); ?>
    <div class="staff-info-image modal-trigger" style="background-image: url(<?php echo $photo['head_shot']['sizes']['medium']; ?>);"  data-modal="modal-staff-<?php the_ID(); ?>"><span>Image for <?php the_title(); ?></span></div>
    <div class="staff-info-name modal-trigger" data-modal="modal-staff-<?php the_ID(); ?>">
      <strong><?php the_title(); ?></strong><br />
      <span><?php the_field('position'); ?></span>
    </div>
    <div class="staff-info-contact">
      <?php exStaff_contactMethods('icons'); ?>
      <?php if(get_field('quote')): ?>
        <p><?php the_field('quote'); ?></p>
      <?php endif; ?>
    </div>
    <div class="staff-info-bio">
    </div>
  </div>
</li>
<div id="modal-staff-<?php the_ID(); ?>" class="modal-container">
  <div class="modal-wrap">
    <div class="modal-inner">
      <div class="modal-close">Close</div>
      <div class="modal-staff-left">
        <img src="<?php echo $photo['head_shot']['sizes']['thumbnail-medium']; ?>" />
        <?php exStaff_contactMethods('text'); ?>
      </div>
      <div class="modal-staff-right">
        <h2><?php the_title(); ?></h2>
        <h3><?php the_field('position'); ?></h3>
        <?php the_field('bio'); ?>
      </div>
    </div>
  </div>
</div>
