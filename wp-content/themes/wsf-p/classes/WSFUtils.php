<?php

class WSFUtils {
    /**
     * Get the event states for the dropdown filter
     * @param $posts array
     *      An array of posts from get_posts
     *      https://developer.wordpress.org/reference/functions/get_posts/
     * @return array
     *      An array of objects with 'name' and 'slug' properties
     */
	public static function getEventStates($posts) {
        // Loop through all the events and get the states
        $event_states = array();
        foreach ($posts as $event) {
            $event_state = get_field('event_state', $event->ID);
            // If the state is not empty, see if it exists in the array
            if (!empty($event_state) ) {
                $event_state_slug = strtolower(sanitize_title($event_state));

                // If the state is not in the array, add it as an object with a name and slug
                if ( !array_key_exists($event_state_slug, $event_states) ) {
                    $event_states[$event_state_slug] = (object) array(
                        'name' => $event_state,
                        'slug' => $event_state_slug
                    );
                }
            }
        }
        // Sort the states by name
        ksort($event_states);
        // Return the states
        return $event_states;
	}

    /**
     * Get the upcoming months for the dropdown filter
     * @return array
     *      An array of objects with 'name' and 'slug' properties
     */
    public static function getUpcomingMonths() {
        // Build a array of month objects and render them
        $months = array();
        // Loop through the next 12 months and add them to the array, this gets us a list starting with the current month
        for ($i=0; $i < 12; $i++) {
            $month = date('F', strtotime('+' . $i . ' month'));
            $month_slug = strtolower(sanitize_title($month));
            $months[$month_slug] = (object) array(
                'name' => $month,
                'slug' => $month_slug
            );
        }
        // Return the months
        return $months;
    }

    /**
     * Remove a query parameter from the URL
     * @param $query_string string
     *      The query string to remove the query parameter from
     * @param $param string
     *      The query parameter to remove
     * @return string
     *      The URL with the query parameter removed
     */
    public static function removeQueryParameter($query_string, $param) {
        // Parse the query string into an array
        parse_str($query_string, $query_array);
        // Remove the query parameter from the array
        unset($query_array[$param]);
        // Return the query string with the query parameter removed
        return http_build_query($query_array);
    }

    /**
     * Get all the terms for a taxonomy for only the posts that match the query
     * @param $taxonomy string
     *      The taxonomy to get the terms for
     * @param $posts array
     *      An array of posts from get_posts
     *      https://developer.wordpress.org/reference/functions/get_posts/
     * @return array
     *      An array of objects with 'name' and 'slug' properties
     */
    public static function getTermsForPosts($taxonomy, $posts) {
        // Loop through all the posts and get the terms
        $terms = array();
        foreach ($posts as $post) {
            $post_terms = get_the_terms($post->ID, $taxonomy);
            // If the terms are not empty, loop through them and add them to the array
            if (!empty($post_terms) ) {
                foreach ($post_terms as $term) {
                    $term_slug = $term->slug;
                    // If the term is not in the array, add it as an object with a name and slug
                    if ( !array_key_exists($term_slug, $terms) ) {
                        $terms[$term_slug] = (object) array(
                            'name' => $term->name,
                            'slug' => $term_slug
                        );
                    }
                }
            }
        }
        // Sort the terms by slug
        ksort($terms);
        // Return the terms
        return $terms;
    }
}
