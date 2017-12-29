<?php get_header(); ?>

<h1>Index of /<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>/<?php echo index_of_blog_page_link(); ?>/<?php single_cat_title('', true); ?></h1>

<?php if ( have_posts() ) : ?>

<table class="sortable" id="anyid" width="100%">
	<tr>
		<th width="35%">Name</th>
		<th width="17%">Last modified</th>
		<th width="8%">Comments</th>
		<th width="40%">Description</th>
	</tr>
	<tr class="sorttop">
		<td><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/back.gif" alt="Back" />
		<a href="<?php echo esc_url( home_url( 'blog' ) ); ?>">Parent Directory</a></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php while ( have_posts() ) : the_post(); ?>
	<tr>
		<td><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/text.gif" alt="Permalink to <?php the_title(); ?>" /> <a href="<?php echo esc_url( get_the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></td>
		<td><?php the_time( 'Y-m-d H:i' ); ?></td>
		<td><?php comments_popup_link( '0', '1', '%' ); ?></td>
		<td><?php the_excerpt(); ?></td>
	</tr>
	<?php endwhile; ?>
</table>
<hr />
<?php else : ?>
	<?php include( get_template_directory() . '/errortext.php' ); ?>
<?php endif;

get_footer();
