<ul id="sidebar">
<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>
			<li><h2>Pages</h2>
				<ul>
					<?php wp_list_pages('sort_column=menu_order&title_li='); ?>
				</ul>
			</li>
			<li><h2>Categories</h2>
				<ul>
					<?php wp_list_cats(); ?>
				</ul>
			</li>
			<li><h2>Archives</h2>
				<ul>
					<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>
<?php endif; ?>
</ul>