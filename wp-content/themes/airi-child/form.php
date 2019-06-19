<?php

function verifyForm() {
    return notEmpty($_POST['title']) && notEmpty($_POST['text']) && notEmpty($_POST['author']);
}

function saveForm() {
    wp_insert_post(
        array(
            'comment_status'	=>	'closed',
            'ping_status'		=>	'closed',
            'post_author'		=>	null,
            'post_name'		    =>	$_POST['title'],
            'post_title'		=>	$_POST['title'],
            'post_content'		=>	$_POST['text'],
            'post_excerpt'		=>	$_POST['author'],
            'post_status'		=>	'draft',
            'post_type'		    =>	'testimonial'
        )
    );
}

function notEmpty($value)
{
    return $value != "";
}

?>
