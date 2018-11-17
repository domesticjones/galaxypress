<?php
  /* ==============
     DEFAULT FOOTER
     ============== */
?>
    <footer id="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
      <section class="footer-contact">
        <h1>We don't just Print... We Care!</h1>
        <img class="footer-affiliate" src="<?php echo asset_path('images/contracosta.png'); ?>" alt="Member of Contra Consta" />
        <?php
          ex_contact('phone');
          ex_contact('address');
        ?>
      </section>
      <p class="copyright">&copy;<?php echo date('Y') . ' '; ex_brand('legal'); ?> &mdash; All Rights Reserved</p>
    </footer>
  </div>
  <?php wp_footer(); ?>
</body>
</html>
