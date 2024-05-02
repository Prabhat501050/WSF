<?php

$blockFields = get_fields();
$customBlock = PXUtils::parse_custom_block($block, $blockFields);

if (is_array($blockFields)) {
	extract($blockFields);
} else {
	extract($block['data']);
}

// Inital Query Logic
$all_upcoming_event_args = array(  
	'post_type' => 'event',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	// Order by start date
	'orderby' => 'meta_value',
	'meta_key' => 'start_date',
	'order' => 'ASC',
	// Filter by start_date
	'meta_query' => array(
		array(
			'key' => 'start_date',
			'value' => date('Ymd'),
			'compare' => '>=',
			'type' => 'DATE'
		)	
	)
);
// If we have an event category filter, add it to the query
if ( !empty($blockFields['event_category']) ) {
	$all_upcoming_event_args['tax_query'][] = array(
		array(
			'taxonomy' => 'event-category',
			'field' => 'id',
			'terms' => $blockFields['event_category'],
		)
	);
}

// Get an array of all upcoming posts for the various functions that need it
$all_upcoming_events = get_posts($all_upcoming_event_args);

// Duplicate args and add the posts per page
$args = $all_upcoming_event_args;
$args['posts_per_page'] = 12;

// Check if we have a page number
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
// If we have a page number, add it to the query
if ( !empty($paged) ) {
	$args['paged'] = $paged;
}



// Get any active filters from the query string and sanitize them with REGEX
$state = !empty($_GET['state']) ? preg_replace('/[^a-zA-Z]/', '', $_GET['state']) : '';
$month = !empty($_GET['month']) ? preg_replace('/[^a-zA-Z]/', '', $_GET['month']) : '';
$school_type = !empty($_GET['school-type']) ? preg_replace('/[^a-zA-Z0-9-_]/', '', $_GET['school-type']) : '';
$event_type = !empty($_GET['event-type']) ? preg_replace('/[^a-zA-Z0-9-_]/', '', $_GET['event-type']) : '';
$event_search = !empty($_GET['event-search']) ? sanitize_text_field( $_GET['event-search'] ) : '';


// Check if we have an event search query
if ( !empty($event_search) ) {
	$args['s'] = $event_search;
	$args['relevanssi'] = 'true';
}

// Check the query string for a state filter, and add it to the query if it exists
if ( !empty($state) ) {
	// Add the state query to the meta query array
	$args['meta_query'][] = array(
		'key' => 'event_state',
		'value' => $state,
		'compare' => '=',
	);
}

// Check the query string for a tag filter, and add it to the query if it exists
if ( !empty($event_type) ) {
	// Add the tag query to the tex query array
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'event-type',
			'field' => 'slug',
			'terms' => $event_type,
		)
	);
}

// Check the query string for a school type filter, and add it to the query if it exists
if ( !empty($school_type) ) {
	// Add the school type query to the tex query array
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'school-type',
			'field' => 'slug',
			'terms' => $school_type,
		)
	);
}

// Check the query string for a month filter, and add it to the query if it exists
if ( !empty($_GET['month']) ) {
	// Use regex to ensure the month is a valid slug
	$month = preg_replace('/[^a-zA-Z]/', '', $_GET['month']);
	// Add the month query to the meta query array
	$args['meta_query'][] = array(
		'key' => 'start_date',
		'value' => date('Ym', strtotime($month)),
		'compare' => 'LIKE',
	);
}

// Run the query
$loop = new WP_Query( $args );
$event_posts = $loop->get_posts();


// Build Block Class Array
$blockClasses = [];
if ( !empty($customBlock->classesString) ) $blockClasses[] = $customBlock->classesString;
if ( !empty($customBlock->bgColor) ) $blockClasses[] = $customBlock->bgColor;
if ( !empty($customBlock->bgClass) ) $blockClasses[] = $customBlock->bgClass;
if ( !empty($customBlock->paddingStyle) ) $blockClasses[] = $customBlock->paddingStyle;

?>

<div id="<?= $customBlock->id ?>" data-anchor="<?= $customBlock->id ?>" data-anchor-label="<?= $customBlock->anchorLabel ?>" class="<?= implode(' ', $blockClasses) ?>">
	<?= $is_preview ? '<span class="block-preview-label">' . $customBlock->title . '</span>' : '' ?>

	<div class="search-form-filter container my-2 mb-4">
		<form role="search" method="get" class="search-form w-[400px] py-5 px-10 rounded-full bg-white">
			<label class="search-label" for="event-search">
				<input id="event-search" name="event-search" type="search" placeholder="Search Events" class="w-1/2 p-2 mr-2" value="<?php echo $event_search; ?>">
			</label>
			<input type="submit" value="Search" class="w-[50px] h-[50px] rounded-full p-0" />
		</form>
	</div>

	<div class="filters container hidden my-2" aria-hidden="true">
	<?php
		echo '<div class="filter-label">Filter By:</div>';
		
		// Build the filter bar
		echo '<div class="filter-bar flex flex-wrap gap-4 my-2">';
			// Get all the event-types and render them if they exist
			$event_types = WSFUtils::getTermsForPosts('event-type', $all_upcoming_events);
			if ( !empty($event_types) ) get_template_part('template-parts/dropdown-filter', null, ['options' => $event_types, 'label' => 'Event Type', 'label_slug' => 'event-type']);

			// Get all the school type tags and render them if they exist
			$school_types = WSFUtils::getTermsForPosts('school-type', $all_upcoming_events);
			if ( !empty($school_types) ) get_template_part('template-parts/dropdown-filter', null, ['options' => $school_types, 'label' => 'School Type', 'label_slug' => 'school-type']);

			// Get all the states for upcoming events
			$all_upcoming_event_states = WSFUtils::getEventStates($all_upcoming_events);
			// If we have states render them
			if ( !empty($all_upcoming_event_states) ) get_template_part('template-parts/dropdown-filter', null, ['options' => $all_upcoming_event_states, 'label' => 'State', 'label_slug' => 'state']);

			// Get the upcoming months and render them
			$months = WSFUtils::getUpcomingMonths();
			get_template_part('template-parts/dropdown-filter', null, ['options' => $months, 'label' => 'Month', 'label_slug' => 'month']);

		echo '</div>';		

		// If we have active filters, render them
		if ( !empty($state) || !empty($school_type) || !empty($month) || !empty($event_type) || !empty($event_search) ) {
			// Get the current query string
			$query_string = $_SERVER['QUERY_STRING'];

			// Render the active filters
			echo '<div class="active-filters flex items-center flex-wrap my-2">';
				// Current filters label
				echo '<span class="active-filters-label mr-2">Current Filters:</span>';
				// If we have a state filter, render it
				if ( !empty($state) ) {
					// Generate a query string to remove the filter
					$new_query_string = WSFUtils::removeQueryParameter($query_string, 'state');
					// Render the active filter
					echo '<a href="?'. $new_query_string .'" class="active-filter bg-dark-beige rounded-md text-charcoal uppercase text-sm transition-expo hover:scale-105 hover:bg-tan hover:cursor-pointer"><span>'. $state . '</span></a>';
				}
				// If we have a month filter, render it
				if ( !empty($month) ) {
					// Generate a query string to remove the filter
					$new_query_string = WSFUtils::removeQueryParameter($query_string, 'month');
					// Render the active filter
					echo '<a href="?'. $new_query_string .'" class="active-filter bg-dark-beige rounded-md text-charcoal uppercase text-sm transition-expo hover:scale-105 hover:bg-tan hover:cursor-pointer"><span>'. $month . '</span></a>';
				}
				// If we have an event_type filter, render it
				if ( !empty($event_type) ) {
					// Generate a query string to remove the filter
					$new_query_string = WSFUtils::removeQueryParameter($query_string, 'event-type');
					// Render the active filter
					echo '<a href="?'. $new_query_string .'" class="active-filter bg-dark-beige rounded-md text-charcoal uppercase text-sm transition-expo hover:scale-105 hover:bg-tan hover:cursor-pointer"><span>'. $event_type . '</span></a>';
				}
				// If we have a school type filter, render it
				if ( !empty($school_type) ) {
					// Generate a query string to remove the filter
					$new_query_string = WSFUtils::removeQueryParameter($query_string, 'school-type');
					// Render the active filter
					echo '<a href="?'. $new_query_string .'" class="active-filter bg-dark-beige rounded-md text-charcoal uppercase text-sm transition-expo hover:scale-105 hover:bg-tan hover:cursor-pointer"><span>'. $school_type . '</span></a>';
				}
				// If we have an event search filter, render it
				if ( !empty($event_search) ) {
					// Generate a query string to remove the filter
					$new_query_string = WSFUtils::removeQueryParameter($query_string, 'event-search');
					// Render the active filter
					echo '<a href="?'. $new_query_string .'" class="active-filter bg-dark-beige rounded-md text-charcoal uppercase text-sm transition-expo hover:scale-105 hover:bg-tan hover:cursor-pointer"><span>'. $event_search . '</span></a>';
				}
			echo '</div>';
		}
	?>
	</div>
	<div class="results container mt-2 mb-8">
		<?php
			// Display "results x-y of z" if we have results
			if ( $event_posts ) {
				// Get the current page number
				$current_page = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
				// Get the total number of pages
				$total_pages = $loop->max_num_pages;
				// Get the total number of posts
				$total_posts = $loop->found_posts;
				// Get the current page's first post number
				$current_page_first_post = (($current_page - 1) * $args['posts_per_page']) + 1;
				// Get the current page's last post number
				$current_page_last_post = $current_page_first_post + $args['posts_per_page'] - 1;
				// If the last post number is greater than the total number of posts, set it to the total number of posts
				if ( $current_page_last_post > $total_posts ) $current_page_last_post = $total_posts;
				// Render the results
				echo 'Results ' . $current_page_first_post . '-' . $current_page_last_post . ' of ' . $total_posts;
			}
		?>
	</div>

	<div class="container space-y-5 md:grid-cols-2 md:space-y-0 md:grid md:gap-8 lg:grid-cols-3 lg:gap-y-16 lg:gap-x-8">
		<?php
		if ( $event_posts ) {
			// Loop through the events
			foreach ( $event_posts as $key => $event ) {
				$eventID = $event->ID;

				// Get the event link
				$event_link = get_field('event_link', $eventID);
				

				echo '<div class="event group">';
					// Build the image HTML
					$event_image = get_field('event_image', $eventID);
					
					// Render the event image
					echo '<div class="event-image rounded-md aspect-video bg-red-accent/50 relative overflow-hidden mb-3 relative">';
						if ( $event_image ) echo '<img src="'. $event_image['sizes']['large'] .'" alt="'. $event_image['alt'] .'" class="transition-expo w-full h-full object-center object-cover group-hover:scale-105" />';
					echo '</div>';

					// Render the event info
					echo '<div class="event-info flex text-charcoal">';


						// Render the date
						$start_date = get_field('start_date', $eventID);
						// Month string
						$event_month = date('M', strtotime($start_date));
						// Date string
						$event_date = date('j', strtotime($start_date));
						// Render the date HTML
						echo '<div class="event-date self-start bg-white rounded-md flex flex-shrink-0 justify-center items-center flex-col overflow-hidden w-[75px] mr-4 border-2 border-dark-beige text-center tracking-wider text-xl font-heading">';
							echo '<div class="event-date-month w-full bg-red-accent px-4 py-1 text-white font-black uppercase">'. $event_month .'</div>';
							echo '<div class="event-date-day p-2">'. $event_date .'</div>';
						echo '</div>';


						// Render the rest of the details
						echo '<div class="relative w-full">';
							// Render the event name
							$event_name = get_field('event_name', $eventID);
							echo '<div class="event-detail font-heading text-3xl tracking-wide font-bold uppercase">' . $event_name . '</div>';

							// Render the event description if it exists
							$event_description = get_field('event_description', $eventID);
							if ( !empty($event_description) ) {
								echo '<div class="event-description">' . $event_description . '</div>';
							}

							// If we have a time window, render it
							$event_time_window = '';
							$start_time = get_field('start_time', $eventID);
							$end_time = get_field('end_time', $eventID);
							if ( !empty($start_time) ) $event_time_window = $start_time;
							if ( !empty($end_time) ) $event_time_window .= ' - '. $end_time;
							if ( !empty($event_time_window) ) echo '<div class="event-time italic">' . $event_time_window . '</div>';
							
							// If we have a venue name, render it
							$event_venue = get_field('event_venue_name', $eventID);
							if ( !empty($event_venue) ) {
								echo '<div class="event-venue-name font-bold">' . $event_venue . '</div>';
							}

							// If we have a city and/or state name, render them
							$event_city = get_field('event_city', $eventID);
							$event_state = get_field('event_state', $eventID);
							if ( !empty($event_city) || !empty($event_state) ) {
								echo '<div class="event-location text-sm">';
									if ( !empty($event_city) ) {
										echo '<span class="event-city">';
											echo $event_city;
											if ( !empty($event_state) ) echo ', ';
										echo '</span>';
									}
									if ( !empty($event_state) ) {
										echo '<span class="event-state">' . $event_state . '</span>';
									}
								echo '</div>';
							}

							// Check if we should display the event type
							if ( !empty($blockFields['display_event_type_labels']) ) {
								// Get the event types taxonomies and render
								$event_taxonomies = wp_get_post_terms($eventID, 'event-type');
								$event_type = '';
								// List the taxonomies for event_type
								if ( !empty($event_taxonomies) ) {
									$tax_array = array();
									foreach ($event_taxonomies as $key => $event_taxonomy) {
										$tax_array[] = $event_taxonomy->name;
									}
									$event_type = implode(', ', $tax_array);
								}
								if ( !empty($event_type) ) {
									// Render the event type
									echo '<div class="event-type my-1"><span class="inline-block bg-dark-beige px-5 py-1 rounded-md italic text-sm">' . $event_type . '</span></div>';
								}
							}

							// Check if we should display the event tags
							if ( !empty($blockFields['display_event_tag_labels']) ) {
								// Get the event tags taxonomies and render
								$event_taxonomies = wp_get_post_terms($eventID, 'event-tag');
								$event_tags = '';
								// List the taxonomies for event_tag
								if ( !empty($event_taxonomies) ) {
									$tax_array = array();
									foreach ($event_taxonomies as $key => $event_taxonomy) {
										$tax_array[] = $event_taxonomy->name;
									}
									$event_tags = implode(', ', $tax_array);
								}
								if ( !empty($event_tags) ) {
									// Render the event tags
									echo '<div class="event-tags my-1"><span class="inline-block bg-dark-beige px-5 py-1 rounded-md italic text-sm">' . $event_tags . '</span></div>';
								}
							}

							if ( !empty($create_ics_invites) ) {
								// Build the ICS URL
								$ics_base_url = get_template_directory_uri() . '/utilities/ics/';
								// Build the query string
								$ics_query_array = array();
								// Add the date
								$ics_query_array['date'] = date('Ymd', strtotime($start_date));
								// Add the start time if we have it
								if ( !empty($start_time) ) $ics_query_array['starttime'] = $start_time;
								// Add the end time if we have it
								if ( !empty($end_time) ) $ics_query_array['endtime'] = $end_time;
								// Get the timezone and add it, if it is empty set it to eastern
								$timezone = get_field('timezone', $eventID);
								if ( empty($timezone) ) $timezone = 'eastern';
								$ics_query_array['timezone'] = $timezone;
								// Add an event name
								$ics_query_array['name'] = "Wayne-Sanderson Farms Hiring Event";
								// Add the event location
								$ics_query_array['location'] = $event_name;

								// Render an ICS link
								echo '<div class="ics-link">';
									echo '<a href="'. $ics_base_url .'?'. http_build_query($ics_query_array) .'"><img src="'. get_template_directory_uri() .'/assets/icons/calendar-charcoal.svg" alt="Add Event to Your Calendar"></a>';
								echo '</div>';
							}
						echo '</div>';


					echo '</div>';

					// Render event button if we have a link, otherwise render a link to the contact page
					if ( !empty($event_link) ) {
						// If we have an event link, wrap the event in an anchor tag
						echo '<a href="'. $event_link['url'] .'" target="'. $event_link['url'] .'">';
							echo '<div class="btn btn-primary event-link block text-center border-2 bg-red text-white">'. $event_link['title'] .'</div>';
						echo '</a>';
					} else if ( !empty($link_to_contact_if_no_link_is_provided) ) {
						// Check for copy for the link
						$contact_link_copy = 'Request More Information';
						if ( !empty($default_contact_link_text) ) $contact_link_copy = $default_contact_link_text;
						// Check for a subject value to prepopulate the contact form
						$contact_subject = '';
						if ( !empty($subject_value_for_default_contact_link) ) $contact_subject = $subject_value_for_default_contact_link;
						// Build the contact href
						$contact_href = '/contact';
						// Add the event name to the message via the query string
						$contact_href .= '?message='. urlencode('I am interested in more information about the event: '. $event_name .' starting '. $start_date) .'%0A';
						// If we have a subject add it to the href after sanitizing for URL
						if ( !empty($contact_subject) ) $contact_href .= '&subject=' . urlencode($contact_subject);
						// Render the link to the contact page
						echo '<a href="'. $contact_href .'" class="btn btn-primary event-link block text-center border-2 bg-red text-white">'. $contact_link_copy .'</a>';
					}

				echo '</div>';
			}
		} else {
			echo "<div class='no-events col-span-3'>";
			// If no upcoming events
			if ( count($all_upcoming_events) == 0 ) {
				echo "<p>Please check back soon for upcoming events.</p>";
			} else {
				echo "<p>Sorry, no upcoming events match your filters.</p>";
			}
			echo "</div>";
		}
		?>
	</div>
	<?php
		// Pagination
		if ( true ) {
			echo '<div class="container flex justify-center">';
				echo '<div class="pagination-bar">';
					echo PXUtils::pagination_bar($loop);
				echo '</div>';
			echo '</div>';
		}
	?>
</div>