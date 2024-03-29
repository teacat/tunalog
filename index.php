<?php get_header(); ?>

<?php if ( is_search() ) { ?>
<form class="global-search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" class="search__field" name="s" placeholder="<?php _e( 'Search anything...', 'tunalog' ); ?>" value="<?php the_search_query(); ?>">
    <input class="search__button" type="submit" value="<?php _e( 'Search', 'tunalog' ); ?>">
</form>
<?php } ?>

<!-- .global-articles -->
<div class="global-articles">
    <?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
    <div class="articles__article">
        <?php if ( get_theme_mod( 'featured_picture_visibility', 'disabled' ) == 'enabled_background' && has_post_thumbnail() ) { ?>
        <div class="article__featured">
            <?php the_post_thumbnail();?>
        </div>
        <?php } ?>
        <div class="article__section">
            <a href="<?php the_permalink();?>" class="article__title">
                <?php the_title(); ?>
            </a>
            <?php if ( get_theme_mod( 'featured_picture_visibility', 'disabled' ) == 'enabled' && has_post_thumbnail() ) { ?>
            <div class="article__featured">
                <?php the_post_thumbnail('tunalog-fullsize');?>
            </div>
            <?php } ?>
            <div class="article__content">
                <?php if( !post_password_required() ) { ?>
                    <?php echo wp_trim_words( has_excerpt() ? get_the_excerpt() : get_the_content(), 180 ); ?>
                <?php } ?>
            </div>
            <div class="article__meta">
                <a href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'));  ?>" class="meta__date"><?php echo get_the_date(); ?></a>
                <?php if ( get_theme_mod( 'display_author', 'enabled' ) == 'enabled' ) { ?>
                <?php if ( get_the_author_meta( 'user_url' ) != "" ) { ?>
                    ．<a href="<?php the_author_meta( 'user_url' ); ?>" class="meta__author"><?php the_author_meta( 'display_name' ); ?></a>
                <?php } else { ?>
                    ．<div class="meta__author"><?php the_author_meta( 'display_name' ); ?></div>
                <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } } ?>
</div>
<!-- / .global-articles -->

<?php
    global $wp_query;
    $total_pages = $wp_query->max_num_pages;
    $paged       = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>
<?php if ( $total_pages > 1 ) { ?>
<!-- .global-pagination -->
<div class="global-pagination">
    <div class="pagination__previous">
        <?php if ($paged != 1) { ?>
        <?php echo previous_posts_link( __( '← Newer Posts', 'tunalog' ) ); ?>
        <?php } ?>
    </div>
    <div class="pagination__info">
        <?php printf( __('Page %s of %s', 'tunalog'), $paged, $total_pages ); ?>
    </div>
    <div class="pagination__next">
        <?php if ($paged != $total_pages) { ?>
        <?php echo next_posts_link( __( 'Older Posts →', 'tunalog' ) ); ?>
        <?php } ?>
    </div>
</div>
<!-- / .global-pagination -->
<?php } ?>

<?php if ( is_search() && $total_pages == 0 ) { ?>
<!-- .global-nothing -->
<div class="global-nothing">
    <div class="nothing__header"><?php _e( 'No posts found', 'tunalog'); ?></div>
    <div class="nothing__description"><?php _e( 'Try another keyword', 'tunalog'); ?></div>
</div>
<!-- / .global-nothing -->
<?php } ?>

<?php get_footer(); ?>