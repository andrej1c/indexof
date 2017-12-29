<?php
/*
Template Name: Home Page Template
*/
get_header(); ?>

<h1>Index of /<?php bloginfo( 'name' ); ?></h1>

<table class="sortable" id="anyid" width="100%">
	<tr class="header">
		<th width="30%">Name</th>
		<th width="70%">Description</th>
	</tr>
	<tr>
		<td>
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/folder.gif" alt="[DIR]" />
				<a href="<?php echo esc_url( home_url( 'blog' ) ); ?>" title="Blog" rel="bookmark">Blog</a>
		</td>
		<td>
			<?php
			$latest_post_args = [
				'posts_per_page' => 1,
			];
			$latest_post_query = new WP_Query( $latest_post_args );
			if ( $latest_post_query->have_posts() ) {
				print 'Blog, with latest post: <br />';
				while ( $latest_post_query->have_posts() ) {
					$latest_post_query->the_post();
					printf ( '<a href="%s">%s</a> (%s)', esc_url( get_the_permalink() ), get_the_title(), get_the_time( 'F j, Y' ) );
					break;
				}
				wp_reset_postdata();
			}
			?>
		</td>
	</tr>
	<?php
	if ( is_active_sidebar( 'home-page' ) ) {
		dynamic_sidebar( 'home-page' );
	}
	?>
</table>
<hr />

<?php get_footer(); ?>
