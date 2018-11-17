require('slick-carousel');
require('jquery-visible');

jQuery(document).ready(() => {
  // Wrap embedded objects and force them into 16:9
  $('#container iframe, #container embed, #container video').not('.ignore-ratio').wrap('<div class="video-container" />');

  // HEADER: Responsive Nav Toggle
  $('#responsive-nav-toggle').click(e => {
    e.preventDefault();
    const $this = $(e.currentTarget);
    $('#menu-header-menu').toggleClass('is-active');
    $this.toggleClass('is-active');
  });

  // MODULE: Under Construction Slideshow
  $('#header-slides').slick({
    arrows: false,
    fade: true,
    autoplay: true,
  });

  // MODULE: Equipment Gallery
  $('#gallery').slick({
    asNavFor: '#gallery-control',
    fade: true,
    adaptiveHeight: true,
  });
  $('#gallery-control').slick({
    arrows: false,
    asNavFor: '#gallery',
    slidesToShow: 4,
    focusOnSelect: true,
  });

  // MODULES: Parallax
  $(window).on('load resize scroll', () => {
    const d_scroll = $(window).scrollTop();
    const w_height = $(window).height();
    $('.animate-parallax').each((i,e) => {
      const $this = $(e);
      const $thisBg = $this.find('.stars-bg');
      const p_position = $this.offset().top;
      const e_height = $this.outerHeight();
      const ebg_height = $this.find('.stars-bg').outerHeight();
      const bg_diff = ebg_height - e_height;
      const dhit_in = p_position - w_height;
      const dhit_out = p_position + e_height;
      const dhit_read = p_position - w_height - d_scroll;
      // Boolean hit Check
      if (dhit_read <= 0 && d_scroll <= dhit_out) {
        const per_scrolled = (d_scroll - dhit_in) / (dhit_out - dhit_in);
        const offset = (bg_diff * per_scrolled) ;
        $thisBg.css('transform', `translateY(-${offset}px)`);
      }
    });
  });

  // MODULES: Animate onScreen
  $(window).on('load resize scroll', () => {
    $('.animate-on-enter').each((i, el) => {
      const $this = $(el);
      if($this.visible(true)) {
        $this.addClass('is-visible');
      }
    });
    $('.animate-on-leave').each((i, el) => {
      const $this = $(el);
      if(!$this.visible(true)) {
        $this.removeClass('is-visible');
      }
    });
  });

  // COMPANY: Product Nav
  $('#products-nav li:first-of-type').addClass('is-active');
  $(window).load(() => { $('#product-1').slideDown(); })
  $('#products-nav li').click((e) => {
    const $this = $(e.currentTarget);
    const target = $this.data('product');
    $('#products-nav li').removeClass('is-active');
    $this.addClass('is-active');
    $('.products-data li').slideUp();
    $(`#${target}`).slideDown();
  });

  // COMPANY: Submit Requests Into Preview Area
  $('.product-form').submit((e) => {
    e.preventDefault();
    const $this = $(e.currentTarget);
    const name = $this.data('product');
    const $values = [`<li><span class="product-review-fieldname">Product:</span><span class="product-review-value">${name}</span></li>`];
    const $post = [`${name}\n\n`];
    $this.find('input').each((i,e) => {
      const $field = $(e);
      const fieldName = $field.data('name');
      const fieldVal = $field.val();
      $values.push(`<li><span class="product-review-fieldname">${fieldName}:</span><span class="product-review-value">${fieldVal}</span></li>`);
      $post.push(`${fieldName}: ${fieldVal}\n`);
    });
    $('#product-preview-data').html($values);
    $('#comment').val($post.join(''));
    $('#product-preview').slideDown();
    $('html, body').animate({
      scrollTop: $('#product-preview').offset().top,
    }, 1000);
  });
  // COMPANY: Submit Request as Comment Post
  $('#product-preview').submit((e) => {
    e.preventDefault();
    let qty = $('#product-quantity').val();
    if(qty == 0) { qty = 'Not Specified';}
    let date = $('#product-date').val();
    if(date == 0) { date = 'Not Specified'; }
    let notes = $('#product-notes').val();
    if(notes != 0) { notes = `\nNotes: ${notes}`}
    const order = $('#comment').val();
    $('#comment').val(`${order}\nQuantity: ${qty}\nDelivery Date: ${date}${notes}`);
    $('#submit')[0].click();
    $('#product-preview').slideUp();
  });
  // COMPANY: Make Changes
  $('#product-cancel').click((e) => {
    e.preventDefault();
    $('#product-preview').slideUp();
    $('#comment').val('');
    $('html, body').animate({
      scrollTop: $('#products-nav').offset().top,
    }, 1000);
  });


  // COMMENTS: AJAX Protocol
	$( '#commentform' ).submit(function(){
		const button = $('#submit');
    const respond = $('#respond');
    const commentlist = $('.comment-list');
    const cancelreplylink = $('#cancel-comment-reply-link');
		if(!button.hasClass('loadingform')) {
      /* eslint-disable */
			$.ajax({
				type: 'POST',
				url: galaxy_press_comment_params.ajaxurl,
				data: $(this).serialize() + '&action=ajaxcomments',
				beforeSend: function(xhr){
					button.addClass('loadingform').val('Loading...');
				},
				error: function (request, status, error) {
					if( status == 500 ){
						alert( 'Error while adding comment' );
					} else if( status == 'timeout' ){
						alert('Error: Server doesn\'t respond.');
					} else {
						var wpErrorHtml = request.responseText.split("<p>"),
							wpErrorStr = wpErrorHtml[1].split("</p>");
						alert( wpErrorStr[0] );
					}
				},
				success: function (addedCommentHTML) {
					if( commentlist.length > 0 ){
						if( respond.parent().hasClass('comment')){
							if( respond.parent().children('.children' ).length){
								respond.parent().children('.children' ).prepend(addedCommentHTML);
							} else {
								addedCommentHTML = '<ol class="children">' + addedCommentHTML + '</ol>';
								respond.parent().prepend( addedCommentHTML);
							}
							cancelreplylink.trigger('click');
						} else {
							commentlist.prepend(addedCommentHTML);
						}
					} else {
						addedCommentHTML = '<ol class="comment-list">' + addedCommentHTML + '</ol>';
						respond.before( $(addedCommentHTML));
					}
					$('#comment').val('');
				},
				complete: function(){
					button.removeClass('loadingform').val('Post Comment');
          $('.comment-list li:first-of-type').addClass('is-new');
          $('#company-order-success').fadeIn();
          if($('#comments-title').text() == 'No orders have been placed yet.' || $('#comments-title').text() == 'Showing One Order') {
            $('#comments-title').slideUp();
          } else {
            $('#comments-title span').text($('.comment-list li').length);
          }
				},
			});
      /* eslint-enable */
		}
		return false;
	});

  // COMPANY: Close Success Modal Close
  $('#company-order-success-close').click((e) => {
    e.preventDefault();
    $('#company-order-success').fadeOut();
  });

  // COMMENTS: Expand Details
  $('.comment-list li').on('click', (e) => {
    const $this = $(e.currentTarget);
    $this.find('.comment-close, .comment-open, .comment-content').slideToggle();
  });
});
