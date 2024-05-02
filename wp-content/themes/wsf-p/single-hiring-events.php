<?php
/**
 * The template for displaying hiring event single posts
 */

 // Pull in the ACF fields
$event_image = get_field('event_image');
$event_name = get_field('event_name');
$event_type = get_field('event_type');
$start_date = get_field('start_date');
$end_date = get_field('end_date');
$time_window = get_field('time_window');
$event_location = get_field('event_location_name');
$event_address = get_field('event_address');
$event_address_link = get_field('event_address_link');
$rsvp_link = get_field('hiring_event_rsvp_link');
$event_description = get_field('hiring_event_details');
$positions = get_field('positions');


if($event_image){
	$event_image_html = $event_image['html'];
}

// Populate the defaults if blank
if ( empty($event_name) ) $event_name = get_the_title();


// Generate the Event Title
if ( !empty($event_type) ) {
	$event_title = $event_name . ' ' . $event_type . ' Hiring Event';
} else {
	$event_title = $event_name . ' Hiring Event';
}


get_header();

// Base element
echo '<section class="single-hiring-event">';

	echo '<div class="full-width-container intro-photo h-[500px] lg:h-auto lg:aspect-video relative flex flex-column flex items-center justify-center">';
		echo '<div class="container relative z-20">';
			echo '<h1 class="text-5xl lg:text-8xl text-white text-center">' . $event_name . '</h1>';
		echo "</div>";
		if ( !empty($event_image_html) ) echo $event_image_html;
	echo "</div>";

	// Display the main event details
	echo '<div class="container pt-[50px] pb-[50px] lg:pt-[100px]lg:pb-[100px]">';
		echo '<div class="details wysiwyg">';
			echo '<h1>' . $event_title . '</h1>';
			echo '<div class="event-details">';
				echo '<span class="event-start-date">' . date('l, F j, Y', strtotime($start_date))  . '</span>';
				if ( !empty($end_date) ) echo ' - <span class="event-end-date">' . date('l, F j, Y', strtotime($end_date)) . '</span>';
				if ( !empty($time_window) ) echo ', <span class="event-time-window"> ' . $time_window . '</span>';
			echo '</div>';
			// Display the event description
			if ( !empty($event_description) ) {
				echo '<h3>Hiring Event Details</h3>';
				echo '<div class="event-description">';
					echo $event_description;
				echo '</div>';
			}
		echo '</div>';
	echo '</div>';

	// Display the positions
	if ( !empty($positions) ) {
		foreach ( $positions as $position ) {
			echo '<div class="container pb-[50px] lg:pb-[100px] lg:flex lg:flex-row">';

				echo '<div class="details wysiwyg mb-9">';
					echo '<h2>' . $position['position_title'] . '</h2>';
					echo '<p>Job Description:</p>';
					echo $position['position_description'];
				echo '</div>';

				echo '<div class="sidebar flex-shrink-0 w-[375px] max-w-full lg:ml-[50px]">';
					echo '<div class="sidebar-wrapper bg-beige p-5">';
						$sidebar_title = '';
						$sidebar_title = date('F j, Y', strtotime($start_date));

						if ( !empty($end_date) ) {
							if ( date('F', strtotime($start_date)) != date('F', strtotime($end_date)) ) {
								$sidebar_title .= ' - ' . date('F j, Y', strtotime($end_date));
							} else {
								$sidebar_title .= ' - ' . date('j', strtotime($end_date));
							}
						}
						
						echo '<h2>'. $sidebar_title .'</h2>';
						
						if ( !empty($time_window) ) echo '<p>' . $time_window . "</p>";
						
						echo '<div class="event-location">';
							echo '<span>' . $event_location . '</span>';
							echo '<span>';
								if ( !empty($event_address_link) ) {
									echo '<a href="' . $event_address_link . '" target="_blank">'.$event_address.'</a>';
								} else {
									echo $event_address;
								} 
							echo '</span>';
						echo '</div>';
					
						if ( !empty($rsvp_link) ) echo '<a href="' . $rsvp_link . '" class="btn btn-primary w-full event-button mb-1" target="_blank">RSVP for Hiring Event</a>';
						if ( !empty($position['position_application_link']) ) echo '<a href="' . $position['position_application_link'] . '" class="event-button w-full btn btn-primary mb-1" target="_blank">Apply for Position</a>';
					
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
	}

echo '</section>';

get_footer();
