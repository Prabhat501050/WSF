<?php

class WSF_Admin {
    public static function init() {
        self::custom_columns();
        self::custom_filters();
    }

    private static function custom_columns() {
        // Register the columns for sorting
        function add_event_columns( $columns ) {
            return array_merge ( $columns, array ( 
                'start_date' => __ ( 'Event Date' ),
            ) );
        }
        add_filter( 'manage_event_posts_columns', 'add_event_columns' );

        // Populate the columns
        function event_custom_column ( $column, $post_id ) {
            switch ( $column ) {
                case 'start_date':
                    echo date('Y-m-d', strtotime(get_post_meta ( $post_id, 'start_date', true )));
                    break;
            }
        }
        add_action( 'manage_event_posts_custom_column', 'event_custom_column', 10, 2 );

        // Register the column as sortable
        function event_register_sortable_columns( $columns ) {
            $columns['start_date'] = ['start_date', 'asc'];
            return $columns;
        }
        add_filter( 'manage_edit-event_sortable_columns', 'event_register_sortable_columns' );

        // Tell WordPress how to sort the date columns
        function event_column_orderby( $query ) {
            if ( ! is_admin() ) return;
            global $pagenow;
            $post_type = $query->get( 'post_type' );
            $orderby = $query->get( 'orderby' );
            // If on the edit page and the post type is an event.
            if ( 'edit.php' == $pagenow && $post_type == 'event' ) {
                if ( $orderby == 'start_date' ) {
                    $query->set( 'meta_key', 'start_date' );
                    $query->set( 'orderby', 'meta_value' );
                }
                // TODO - This is not working
                if ( !isset( $_GET['orderby'] ) && !isset( $_GET['post_type'] ) ) {
                    $query->set( 'meta_key', 'start_date' );
                    $query->set( 'orderby', 'meta_value' );
                    $query->set( 'order', 'ASC' );
                }
            }
        }
        add_action( 'pre_get_posts', 'event_column_orderby' );
    }

    private static function custom_filters() {

        function event_taxonomy_filter( $post_type ) {
            // Do nothing it it is not a post type we need
            if ( $post_type !== 'event') {
                return;
            }
            
            $taxonomies = ['event-type'];

            // For every taxonomy we are going to do the same
            foreach( $taxonomies as $taxonomy ){
                    
                $taxonomy_object = get_taxonomy( $taxonomy );
                $selected = isset( $_GET[ $taxonomy ] ) ? $_GET[ $taxonomy ] : '';
                
                wp_dropdown_categories( 
                    array(
                        'show_option_all' =>  $taxonomy_object->labels->all_items,
                        'taxonomy'        =>  $taxonomy,
                        'name'            =>  $taxonomy,
                        'orderby'         =>  'name', // slug / count / term_order etc
                        'value_field'     =>  'slug',
                        'selected'        =>  $selected,
                        'hierarchical'    =>  true,
                    )
                );
            }
        }
        add_action( 'restrict_manage_posts', 'event_taxonomy_filter' );

    }
}