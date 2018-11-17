<?php
/* ==============
	 SEARCH RESULTS
	 ============== */
$hit_count = $wp_query->found_posts;
get_header(); ?>
			<div id="content" class="wrap">
				<main id="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
          <?php if(have_posts()): ?>
          <h1>Search Results</h1>
          <p class="search-results"><?php printf( __('Search results for: %s' ), '<strong>' . get_search_query() . '</strong> <span>(' . $hit_count . ' results found.)</span>'); ?></p>
					<?php while (have_posts()): the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('entry-content'); ?> role="article" itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
							<header class="article-header">
								<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								<p class="entry-meta"><?php vp_post_meta(); ?></p>
							</header>
							<section itemprop="text">
								<?php the_excerpt(); ?>
							</section>
							<footer class="article-footer">
								<p class="entry-meta">
									<?php vp_comment_count(); ?><br />
									<?php vp_categories(); ?><br />
									<?php vp_tags(); ?>
								</p>
							</footer>
						</article>
					<?php endwhile; ?>
						<?php vp_page_navi(); ?>
					<?php else: ?>
						<?php get_template_part('templates/blog', '404'); ?>
					<?php endif; ?>
				</main>
				<?php get_sidebar(); ?>
			</div>
<?php get_footer(); ?>
