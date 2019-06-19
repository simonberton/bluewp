<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Airi
 */

$layout 		= airi_blog_layout();
$read_more 		= get_theme_mod( 'read_more_text', __( 'Read more', 'airi' ) );
$hide_thumb 	= get_theme_mod( 'index_hide_thumb' );
$hide_date 		= get_theme_mod( 'index_hide_date' );
$hide_cats 		= get_theme_mod( 'index_hide_cats' );
$hide_author 	= get_theme_mod( 'index_hide_author' );
$hide_comments 	= get_theme_mod( 'index_hide_comments' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="post-inner">
        <div class="flex">

            <?php if ( $hide_thumb == '' ) : ?>
                <div class="<?php echo esc_attr( $layout['item_inner_cols'] ); ?>">
                    <?php airi_post_thumbnail(); ?>
                </div>
            <?php endif; ?>

            <div class="post-info <?php echo esc_attr( $layout['item_inner_cols'] ); ?>">
                <header class="entry-header">
                    <?php
                    if ( $hide_date == '' ) {
                        airi_posted_on();
                    }
                    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                    the_content();
                    ?>
                </header><!-- .entry-header -->

                <?php if ( $layout['type'] != 'layout-grid' && $layout['type'] != 'layout-masonry' ) : ?>
                    <div class="entry-content">
                        <?php echo sprintf('AUTHOR: %s', get_the_excerpt()); ?>
                    </div><!-- .entry-content -->
                <?php endif; ?>

            </div>
        </div>
    </div>

</article><!-- #post-<?php the_ID(); ?> -->
