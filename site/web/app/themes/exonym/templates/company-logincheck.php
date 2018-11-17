<h1 class="header-blue">Client Portal</h1>
<article class="company-wrap">
  <div class="wrap">
    <?php
      if(is_user_logged_in()):
        get_template_part('templates/company', 'list');
      else:
        get_template_part('templates/company', 'loginfail');
      endif;
    ?>
  </div>
</article>
