<?php
/**
 * The template for displaying the portfolio loop.
 *
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */

// GENERATE TERMS FOR FILTER PORTFOLIO TEMPLATE
$terms =  get_the_terms( $post->ID, 'portfolio_category' ); 
$term_list = null;
if( is_array($terms) ) { foreach( $terms as $term ) { $term_list .= $term->term_id; $term_list .= ' '; } }
?>

<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>

	<li id="post-<?php the_ID(); ?>" <?php post_class("$term_list masonry-item filtered"); ?>>
		
		<div class="wrap">
			
			<a class="masonry-link nji-frontpage_link" title="<?php printf(__('Permanent Link to %s', 'bean'), get_the_title()); ?>" href="<?php the_permalink(); ?>">

			<div class="post-thumb">

				<?php the_post_thumbnail('post-feat'); ?>
				
				<span class="overlay-arrow"></span>
			
			</div><!-- END .post-thumb -->

			</a>

		</div><!-- END .wrap -->

	</li>

<?php } //END if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) ?> 