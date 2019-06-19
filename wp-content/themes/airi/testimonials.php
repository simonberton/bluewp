<?php /* Template Name: Testimonials */

get_header();

?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
            <h1>Testimonials List</h1>
            <?php
            $args = ['post_status' => 'publish', 'post_type' => 'testimonial', 'posts_per_page' => 300];
            $loop = new WP_Query($args);
                // Load posts loop.
                while ( $loop->have_posts() ) {
                    $loop->the_post();

                    get_template_part( 'template-parts/content', get_post_format() );
                    //
                }
                // Previous/next page navigation.
                //twentynineteen_the_posts_navigation();


            ?>
    </main><!-- #main -->
</div><!-- #primary -->



<div class="form-container">
    <p>In case you want your testimonial, please fill the following form</p>
    <form name="testimonialForm" method="post" action="#">
        <label for="title">Title*:</label>
        <input type="text" name="title">
        <label for="text">Text*:</label>
        <input type="text" name="text">
        <label for="author">Author*:</label>
        <input type="text" name="author">
        <button type="submit">Submit Testimonial</button>
    </form>
</div>

<?php
    get_footer();
