<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<h1>Index of /<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>/<?php echo index_of_blog_page_link(); ?>/<?php the_category( ' ', true); ?>/<?php the_title(); ?></h1>

<table width="100%">
	<tr>
		<th width="30%">&nbsp;</th>
		<th width="70%">Posted</th>
	</tr>
	<tr>
		<td>
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/back.gif" alt="Back" />
			<a href="<?php echo get_category_link( index_of_get_primary_category_id( get_the_id() ) );?>">Parent Directory</a>
		</td>
		<td><?php the_time( 'Y-m-d H:i' ); ?></td>
	</tr>
</table>

<hr /><?php the_content(); ?>

<?php comments_template(); ?>

<?php endwhile; else: ?>
	<?php include( get_template_directory() . '/errortext.php' ); ?>
<?php endif;

get_footer();
