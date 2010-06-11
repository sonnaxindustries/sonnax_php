<?php get_header(); ?>
		<div id="main">
		<div id="main-content">
				<?php if (have_posts()) : ?>
		
		<?php while (have_posts()) : the_post(); ?>
				
			<div class="post" id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<div class="post-content">
					<?php the_content('Read all &raquo;'); ?>
				</div>
		</div>
		<?php endwhile; ?>
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; previous') ?></div>
			<div class="alignright"><?php previous_posts_link('next &raquo;') ?></div>
		</div>
	<?php else : ?>
		<h2 class="center">Not found</h2>
		<p class="center">Sorry but you are looking for something that isn't here</p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>
	<?php endif; ?>
		</div>
			<div class="sidebar-wrapper">
				<div id="abonnements">
					<?php include (TEMPLATEPATH . '/searchform.php'); ?>
					<a href="<?php bloginfo('rss2_url') ?>"><img id="rssfeed" src="<?php bloginfo('template_url'); ?>/rss.gif" alt="rss" title="subscribe to this blog" /></a>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
		<?php get_footer(); ?>