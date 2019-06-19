<?php /* Template Name: Testimonials */

get_header();
require_once('form.php');

$formSubmittedOk = false;
if ( ! empty( $_POST ) ) {
    //Lets verify that our submited data is not empty
    if (verifyForm()) {
        saveForm();
        $formSubmittedOk = true;
    }
}
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
            <h1 class="testimonial">Testimonials List</h1>
            <?php
            $args = ['post_status' => 'publish', 'post_type' => 'testimonial', 'posts_per_page' => 300];
            $loop = new WP_Query($args);
                // Load posts loop.
                while ( $loop->have_posts() ) {
                    $loop->the_post();
                    echo '<div class="testimonial-box">';
                    get_template_part( 'template-parts/content', get_post_format() );
                    echo '</div>';
                }
            ?>
    </main><!-- #main -->
</div><!-- #primary -->
<div class="form-container">
    <p><? echo $formSubmittedOk ? 'Your testimonial has been submited': ''?></p>
    <p>In case you want your testimonial, please fill the following form</p>
    <form name="testimonialForm" method="post" action="">
        <label for="title">Title*:</label>
        <input type="text" name="title" required>
        <label for="text">Text*:</label>
        <input type="text" name="text" required>
        <label for="author">Author*:</label>
        <input type="text" name="author" required>
        <button type="submit">Submit Testimonial</button>
    </form>
</div>

<?php
    get_footer();
