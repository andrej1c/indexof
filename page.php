<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<h1>Index of /<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>/<?php
$page_links = index_of_page_structure_links( get_the_id() );
echo ! empty( $page_links ) ? implode( '/', $page_links ) . '/' : '';
the_title(); ?></h1>
<hr />

<?php
$content = get_the_content();
if ( ! empty( $content ) ) {
	the_content();
	echo '<hr />';
}
?>

<table width="100%">
	<tr>
		<td>
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/back.gif" alt="Back" />
			<a href="<?php echo esc_url( index_of_page_parent( get_the_id() ) );?>">Parent Directory</a>
		</td>

		<?php
		$sub_pages = get_pages( [ 'parent' => get_the_id(), 'sort_column' => 'menu_order' ] );
		if ( ! empty( $sub_pages ) ) {
		?>
		<td>
			<strong>Description</strong>
		</td>
		</tr>
		<?php
		foreach ( $sub_pages as $sub_page ) {
			?>
			<tr>
				<td>
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/text.gif" alt="[DIR]" /> <a href="<?php echo esc_url( get_permalink( $sub_page->ID ) ); ?>" title="Permalink to <?php echo $sub_page->post_title; ?>" rel="bookmark"><?php echo $sub_page->post_title; ?></a>
				</td>
				<td>
					<?php echo esc_html( $sub_page->post_excerpt ); ?>
				</td>
			</tr>
			<?php
		} ?>
		<tr>
		<?php
	} else {
		?>
		</tr>
		<?php
	}
	?>
</table>

<?php endwhile; else: ?>
	<?php include( get_template_directory() . '/errortext.php' ); ?>
<?php endif;

get_footer();
