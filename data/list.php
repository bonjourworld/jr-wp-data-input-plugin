<?php

header('Content-Type: application/json');


// Get access to WordPress
define( 'SHORTINIT', true );
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

//simulate a "taxonomy__in" query for 3.0
$post_status = "'publish'";
$post_type = "('geopin')" ;

$query = "SELECT $wpdb->posts.ID as id, $wpdb->posts.post_title as geopin_title, $wpdb->posts.post_date as date,   pm1.meta_value as country, pm2.meta_value as latitude, pm3.meta_value as longitude, pm4.meta_value as zoom, pm5.meta_value as title, pm6.meta_value as name, pm7.meta_value as direction, pm8.meta_value as image, pm9.guid as url

FROM $wpdb->posts 
LEFT JOIN $wpdb->postmeta AS pm1 ON ($wpdb->posts.ID = pm1.post_id  AND pm1.meta_key='pin_country') 
LEFT JOIN $wpdb->postmeta AS pm2 ON ($wpdb->posts.ID = pm2.post_id 	AND pm2.meta_key='pin_latitude')
LEFT JOIN $wpdb->postmeta AS pm3 ON ($wpdb->posts.ID = pm3.post_id  AND pm3.meta_key='pin_longitude') 
LEFT JOIN $wpdb->postmeta AS pm4 ON ($wpdb->posts.ID = pm4.post_id  AND pm4.meta_key='pin_zoom_level') 
LEFT JOIN $wpdb->postmeta AS pm5 ON ($wpdb->posts.ID = pm5.post_id  AND pm5.meta_key='pin_title') 
LEFT JOIN $wpdb->postmeta AS pm6 ON ($wpdb->posts.ID = pm6.post_id  AND pm6.meta_key='pin_name')
LEFT JOIN $wpdb->postmeta AS pm7 ON ($wpdb->posts.ID = pm7.post_id  AND pm7.meta_key='pin_direction') 
LEFT JOIN $wpdb->postmeta AS pm8 ON ($wpdb->posts.ID = pm8.post_id  AND pm8.meta_key='_thumbnail_id')
LEFT JOIN $wpdb->posts pm9 ON (pm9.ID= pm8.meta_value  AND pm9.post_type='attachment')

WHERE $wpdb->posts.post_type = 'geopin' 
AND $wpdb->posts.post_status = 'publish' 
AND ((pm1.meta_key = 'pin_country') OR (pm2.meta_key = 'pin_latitude') OR (pm3.meta_key = 'pin_longitude') OR (pm4.meta_key = 'pin_zoom_level') OR (pm5.meta_key = 'pin_title') OR (pm6.meta_key = 'pin_name') OR (pm7.meta_key = 'pin_direction') OR (pm8.meta_key = '_thumbnail_id') ) 
GROUP BY $wpdb->posts.ID ORDER BY $wpdb->posts.ID ASC";

$my_posts=$wpdb->get_results($query);

// var_dump($my_posts);

echo wp_json_encode ( $my_posts );









