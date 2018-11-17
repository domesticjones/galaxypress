<?php date_default_timezone_set('America/Los_Angeles'); ?>
<article class="company-products">
  <h1 class="header-blue"><?php the_title(); ?></h1>
  <div class="wrap">
    <?php if(have_rows('products')): $productId = 0; $productData = 0; ?>
      <ul id="products-nav">
        <span>Select a Product:</span>
        <?php
          while(have_rows('products')):
            the_row();
            $product = get_sub_field('product');
            $productId++
          ?>
          <li data-product="product-<?php echo $productId; ?>"><?php echo $product['name']; ?></li>
        <?php endwhile; ?>
      </ul>
      <ul class="products-data">
        <?php
          while(have_rows('products')):
            the_row();
            $product = get_sub_field('product');
            $productData++;
          ?>
          <li id="product-<?php echo $productData; ?>">
            <div class="product-image"><?php echo wp_get_attachment_image($product['image'], 'medium'); ?></div>
            <div class="product-fields">
              <?php if(have_rows('fields')): $productMeta = 0; ?>
                <form id="form-product-<?php echo $productData; ?>" class="product-form" data-product="<?php echo $product['name']; ?>">
                  <?php
                    while(have_rows('fields')):
                      the_row();
                      $productMeta++;
                      $fieldName = get_sub_field('name');
                      $fieldType = get_sub_field('type');
                      $fieldId = 'product-' . $productData . '-meta-' . $productMeta;
                    ?>
                    <div class="product-field-wrap">
                      <label for="<?php echo $fieldId; ?>"><?php echo $fieldName; ?></label>
                      <input id="<?php echo $fieldId; ?>" class="field-entry" type="<?php echo $fieldType; ?>" data-name="<?php echo $fieldName; ?>">
                    </div>
                  <?php endwhile; ?>
                  <div class="product-field-wrap">
                    <input class="field-entry" type="hidden" data-name="Requested" value="<?php echo date('F j, Y - g:i a'); ?>">
                  </div>
                  <button type="submit">Submit Request</button>
                </form>
              <?php endif; ?>
            </div>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php endif; ?>
    <form id="product-preview">
      <h2>Review Request</h2>
      <p>Please review your details below and ensure spelling and accuracy.</p>
      <ul id="product-preview-data"></ul>
      <div class="product-review-fields">
        <div class="product-review-field-wrap">
          <label for="product-quantity">Quantity (optional)</label>
          <input id="product-quantity" type="number">
        </div>
        <div class="product-review-field-wrap">
          <label for="product-date">Delivery Date (optional)</label>
          <input id="product-date" type="date">
        </div>
        <div class="product-review-field-wrap product-review-field-full">
          <label for="product-notes">Notes (optional)</label>
          <textarea id="product-notes" type="date"></textarea>
        </div>
      </div>
      <div class="product-review-buttons">
        <button id="product-cancel" type="button">Make Changes</button>
        <button id="product-submit" type="submit">Place Order</button>
      </div>
    </form>
  </div>
  <footer class="company-orders animate-parallax animate-z-normal">
    <div class="stars-bg"></div>
    <div class="wrap">
      <h2>Order Request History</h2>
      <?php comments_template(); ?>
    </div>
  </footer>
</article>
<footer id="company-order-success">
  <div class="company-order-success-inner">
    <div class="wrap">
      <h1>Order Request Successful</h1>
      <p>
        Your order request was placed successfully.
        <br />
        A representative from <?php ex_brand(); ?> will be in touch with you shortly to complete your order request.
      </p>
      <p>
        Please contact <?php ex_brand(); ?> with any questions:
      </p>
      <div class="company-order-success-contact">
        <?php ex_contact('phone'); ?>
        <?php ex_contact('email'); ?>
      </div>
      <button id="company-order-success-close" type="button">Return to Website</button>
    </div>
  </div>
</footer>
