<?php
/**
 * The template for displaying the portfolio meta.
 * Note that we are using the $portfolio_layout to generate two separate styles within this file.
 * 
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */

get_header();

wp_reset_query();

//VIEW COUNTER
bean_setPostViews(get_the_ID());

//SETTING UP META
$portfolio_content_display = get_post_meta($post->ID, '_bean_portfolio_content_display', true); 
$portfolio_date = get_post_meta($post->ID, '_bean_portfolio_date', true); 
$portfolio_url = get_post_meta($post->ID, '_bean_portfolio_url', true); 
$portfolio_views = get_post_meta($post->ID, '_bean_portfolio_views', true);
$portfolio_client = get_post_meta($post->ID, '_bean_portfolio_client', true); 
$portfolio_cats = get_post_meta($post->ID, '_bean_portfolio_cats', true); 
$portfolio_tags = get_post_meta($post->ID, '_bean_portfolio_tags', true);
$portfolio_custom_meta = get_post_meta($post->ID, '_bean_portfolio_custom_meta', true);

//LAYOUT
//WE ARE USING THE GLOBAL THEME CUSTOMIZER VALUE AS PRIORITY HERE, BUT IF THE PORTFOLIO LAYOUT 
//FROM THE PORTFOLIO POST META IS NOT "DEFAULT", THEN WE PULL THAT.
$portfolio_layout = get_post_meta($post->ID, '_bean_portfolio_layout', true);
if ($portfolio_layout == 'default') {
	if 	  ( get_theme_mod( 'theme_version') == 'theme_version_fullscreen') { $portfolio_layout = 'fullscreen'; } 
	elseif ( get_theme_mod( 'theme_version') == 'theme_version_fullwidth') { $portfolio_layout = 'fullwidth'; }
	elseif ( get_theme_mod( 'theme_version') == 'theme_version_edge') { $portfolio_layout = 'edge'; }
	elseif ( get_theme_mod( 'theme_version') == 'theme_version_carousel') { $portfolio_layout = 'carousel'; }
	elseif ( get_theme_mod( 'theme_version') == 'theme_version_grid') { $portfolio_layout = 'grid'; }
	elseif ( get_theme_mod( 'theme_version') == 'theme_version_masonry') { $portfolio_layout = 'grid'; }
	elseif ( get_theme_mod( 'theme_version') == 'theme_version_masonry_full') { $portfolio_layout = 'grid'; }
	else   { $portfolio_layout = 'std'; }

	if ($portfolio_layout == 'std') {
		$portfolio_layout = "fullwidth";
	}
}
?>

<?php if ($portfolio_content_display == 'on') { ?> 

	<div class="portfolio-wrap <?php if ($portfolio_layout == 'grid' OR $portfolio_layout == 'masonry') { echo 'gallery-grid'; } ?>">

		<?php if ($portfolio_layout == 'fullwidth' OR $portfolio_layout == 'edge' OR $portfolio_layout == 'fullscreen' OR $portfolio_layout == 'grid' OR $portfolio_layout == 'masonry') { echo '<div class="twelve columns sidebar-right">'; } ?>

			<?php if ($portfolio_layout == 'std') { ?>
				<?php if( get_theme_mod( 'portfolio_likes' ) == true) { ?>
					<?php Bean_PrintLikes($post->ID); ?>
				<?php } //END if get_theme_mod( 'portfolio_likes' ) ?>
			<?php } //END $portfolio_layout == 'std' ?>
			
			<h1><?php the_title(); ?></h1>

			<div class="entry-content">

				<?php the_content(); ?>

				<?php if ($portfolio_layout == 'fullwidth' OR $portfolio_layout == 'edge' OR $portfolio_layout == 'fullscreen' OR $portfolio_layout == 'grid' OR $portfolio_layout == 'masonry') { // DISPLAY SOCIAL ?>
					<?php if ( get_theme_mod( 'show_portfolio_sharing' ) == true ) { ?>
						<?php get_template_part( 'content', 'portfolio-social' ); ?>
					<?php } ?>
				<?php } ?>

			</div><!-- END .entry-content-->

		<?php if ($portfolio_layout != 'std') { echo '</div>'; } ?>

		<?php if ($portfolio_layout == 'fullwidth' OR $portfolio_layout == 'edge' OR $portfolio_layout == 'fullscreen' OR $portfolio_layout == 'grid' OR $portfolio_layout == 'masonry') { echo '<div class="twelve columns portfolio-full-meta">'; } ?>

			<ul class="entry-meta clearfix subtext">
						
				<?php if ($portfolio_client) { // DISPLAY CLIENT ?>
					<li><span><?php _e( 'For ', 'bean' ); ?></span>
					<?php if ($portfolio_url) { // DISPLAY PORTFOLIO URL ?>
						<a href="<?php echo $portfolio_url; ?>" target="blank"><?php echo $portfolio_client;  ?></a>
					<?php } else { echo $portfolio_client; } // IF NO URL ?>
					</li> 
				<?php } ?>
				
				<?php if ($portfolio_date == 'on') { ?> 
					<li><span><?php _e( 'On ', 'bean' ); ?></span><?php the_time(get_option('date_format')); ?></li>
				<?php } ?>
				
				<?php if ($portfolio_cats == 'on') { // DISPLAY TAGS ?>	
					<?php $terms = get_the_terms( $post->ID, 'portfolio_category' ); ?>
					<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
						<li class="tax"><span><?php _e( 'In ', 'bean' ); ?></span><?php the_terms($post->ID, 'portfolio_category', '', ', ', ''); ?></li>
					<?php endif;?>
				<?php } ?>
				
				<?php if ($portfolio_views == 'on') { // DISPLAY VIEWS ?>	
					<li><span><?php _e( 'Views ', 'bean' ); ?></span><?php echo bean_getPostViews(get_the_ID()); ?><?php _e( ' & Counting', 'bean' ); ?></li>
				<?php } ?>
				
				<?php if ($portfolio_tags == 'on') { // DISPLAY CATEGORY ?>	
					<li class="tax"><span><?php _e( 'Tags ', 'bean' ); ?></span><?php the_terms($post->ID, 'portfolio_tag', '#', ' #', ''); ?></li>
				<?php } ?>

				<?php if ($portfolio_custom_meta == 'on') { // DISPLAY CATEGORY ?>	
					<?php the_meta(); ?>
				<?php } ?>
				
			</ul><!-- END .entry-meta-->	

		<?php if ($portfolio_layout != 'std' ) { echo '</div>'; } ?>

	</div><!-- END .portfolio-wrap -->

<?php } ?> 