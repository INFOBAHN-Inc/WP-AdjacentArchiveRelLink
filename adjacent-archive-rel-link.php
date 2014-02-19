<?php
/*
Plugin Name:Adjacent Archive Rel Link
Version: 1.0.0
Author: shigeru.ashikawa
Copyright: Copyright (c) 2014, infobahn inc.
Description: 既存の link[rel=next|prev] を削除し、アーカイブページに設定
*/

remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);

function adjacent_archive_rel_link_wp_head() {
    global $paged, $wp_query;

    $max_page = $wp_query->max_num_pages;

    if (!$paged) {
        $paged = 1;            
    }

    $nextpage = intval($paged) + 1;

    if (is_singular())  {
        return;
    }

    if ($nextpage <= $max_page) { 
        $next_posts = next_posts($max_page, false);
        echo "<link rel=\"next\" href=\"{$next_posts}\">" . PHP_EOL;
    }

    if ($paged > 1) {
        $prev_posts = previous_posts(false);
        echo "<link rel=\"prev\" href=\"{$prev_posts}\">"  . PHP_EOL;
    }
}

add_action('wp_head', 'adjacent_archive_rel_link_wp_head', 10, 0);
