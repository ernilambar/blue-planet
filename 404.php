<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Blue_Planet
 */

get_header(); ?>

	<div id="tertiary" class="col-md-2">&nbsp;</div>

	<div id="primary" class="content-area col-md-8 col-sm-12 col-xs-12 pull-left">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'blue-planet' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'blue-planet' ); ?></p>

					<?php get_search_form(); ?>



				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<div id="tertiary1" class="col-md-2">&nbsp;</div>
<?php get_footer(); ?>
