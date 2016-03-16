<?php
/**
 * The template for displaying the footer
 *
 *
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */

	//DONT SHOW THE FOOTER ON 404, COMING SOON AND UNDER CONSTRUCTION
	if ( !is_404() && !is_page_template('template-comingsoon.php') && !is_page_template('template-underconstruction.php')) 
	{ 

		//LAYOUT
		//WE ARE USING THE GLOBAL THEME CUSTOMIZER VALUE AS PRIORITY HERE, BUT IF THE PORTFOLIO LAYOUT 
		//FROM THE PORTFOLIO POST META IS NOT "DEFAULT", THEN WE PULL THAT.
		$theme_version = get_theme_mod( 'theme_version');
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
		}

		//HEADER LAYOUT
		$header_style = get_theme_mod( 'header_style');
		if ($header_style == 'header_style_2') { $header_style = 'layout-centered'; } 
		else { $header_style = ''; }
		?>

		<div class="row <?php if ($theme_version == 'theme_version_fullscreen') { echo 'fullscreen footer'; } if ( $portfolio_layout != 'fullscreen' && is_singular('portfolio') ) { echo' single'; } ?>">

			<footer id="footer" class="<?php echo $header_style; ?>">

				<?php if (false): ?>
				<p>&copy; <?php echo date("Y") ?> <a href="<?php echo home_url(); ?>" title="<?php echo bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( $name ); ?></a><br/>
				
				<?php 
				if ( get_theme_mod( 'footer_copyright') ) {  
					echo get_theme_mod( 'footer_copyright'); 
				} else { 
					echo '';
				} ?>
				
				</p>

				<?php endif; ?>

				<nav class="secondary subtext">
					<?php
						/*wp_nav_menu( array(
							'theme_location' => 'secondary-menu',
							'container' => '',
							'depth' => '1',
							'menu_id' => 'secondary-menu',
							'menu_class' => 'sf-menu main-menu',
						) );*/
					?>
					<div id="secondary-menu" class="sf-menu main-menu">
						<ul class="nj_bottommenu">
							<?php if ( is_singular('post') OR is_singular('portfolio') OR is_singular('product') && !is_singular('page') ): ?>
							<li class="page_item previous">
								<?php
									$link = get_previous_post_link(__('%link', 'bean'), __('', 'bean'));
									$xml = simplexml_load_string($link);
									$list = $xml->xpath("//@href");

									$preparedUrls = array();
									foreach($list as $item) {
										$item = parse_url($item);
										$preparedUrls[] = $item['scheme'] . '://' .  $item['host'] . $item["path"];
									}

									echo "<a href='".$preparedUrls[0]."' target='_top'>Previous</a>";
								?>
							</li>
							<?php endif; ?>
							<li class="page_item page-item-105">
								<a href="http://nilsjohnnyingmar.se/">Home</a>
							</li>
							<?php if ( is_singular('post') OR is_singular('portfolio') OR is_singular('product') && !is_singular('page') ): ?>
							<li class="page_item next">
								<?php
								$link = get_next_post_link(__('%link', 'bean'), __('', 'bean'));
								$xml = simplexml_load_string($link);
								$list = $xml->xpath("//@href");

								$preparedUrls = array();
								foreach($list as $item) {
									$item = parse_url($item);
									$preparedUrls[] = $item['scheme'] . '://' .  $item['host'] . $item["path"];
								}

								echo "<a href='".$preparedUrls[0]."' target='_top'>Next</a>";
								?>
							</li>
							<?php endif; ?>
						</ul>
					</div>
				</nav>

				<p>&copy; <?php echo date("Y") ?> <a href="<?php echo home_url(); ?>" title="<?php echo bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( $name ); ?></a><br/>
					<?php
					if ( get_theme_mod( 'footer_copyright') ) {
						echo get_theme_mod( 'footer_copyright');
					} else {
						echo '';
					} ?>
				</p>

			</footer><!-- END #footer-->

		</div><!-- END .row -->

		</div><!-- END #theme-wrapper -->

		<?php if( get_theme_mod( 'hidden_sidebar' ) == true) { 
			get_template_part( 'content', 'hidden-sidebar' ); //GET CONTENT-HIDDEN-SIDEBAR.PHP 
		} ?>
	
	<?php //END if ( !is_404()...
	} ?>

<?php bean_body_end(); //PULLS DEBUG INFO ?>  

<?php wp_footer(); ?>

</body>
</html>