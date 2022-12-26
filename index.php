<?php get_header( ); ?>

<?php 


$args = array( 'taxonomy' => 'category' );

$q_post = new WP_Term_Query( $args );

foreach ( $q_post ->terms as $term ) {
    // echo '<pre>';
    // // print_r($term);
    // echo '</pre>';

    // $args_p =[
    //     'post_type' => 'post',
    //     'tax_query' => [
    //         'taxonomy' => 'category',
    //         'field'    => 'slug',
    //         'terms'    => 'mall'
    //     ]
    // ];
 
    $args_p = array (
        'post_type' => 'post',
        's'         => 'Incidunt',
        'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => $term->term_id,
             )
    )
    );

    $the_query = new WP_Query($args_p);
    $counter = 1;

    if ( $the_query->have_posts() ) :
        echo 'Post for' . $term->name . ' All(' .  $term->count . ')';
        echo'</br>';
        while ( $the_query->have_posts() ) : $the_query->the_post();
echo $counter++ . ' ';
            the_title( );
            echo '<br>';
        endwhile;
        wp_reset_postdata();
    endif;

    echo'</br>';
}

global $wpdb;



echo '<pre>';
// print_r($wpdb->prefix);



$res = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE $wpdb->posts.post_type = 'post' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_title LIKE 'H%'", OBJECT);


foreach( $res as $key => $post ){
    echo $key . ' ';
    echo $post->post_title;
    echo'</br>';

}

// print_r($sql);
echo '</pre>';



$querystr = "
SELECT $wpdb->posts.* 
FROM $wpdb->posts, $wpdb->postmeta
WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 
AND $wpdb->postmeta.meta_key = 'tag' 
AND $wpdb->postmeta.meta_value = 'email' 
AND $wpdb->posts.post_status = 'publish' 
AND $wpdb->posts.post_type = 'post'
AND $wpdb->posts.post_date < NOW()
ORDER BY $wpdb->posts.post_date DESC
";

// print_r($wpdb->get_results($querystr, OBJECT));

?>


<?php get_footer(); ?>

