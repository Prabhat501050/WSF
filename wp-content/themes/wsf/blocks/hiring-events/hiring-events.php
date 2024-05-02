<?php

$blockFields = get_fields();
$customBlock = PXUtils::parse_custom_block($block, $blockFields);

if (is_array($blockFields)) {
	extract($blockFields);
} else {
	extract($block['data']);
}

// Inital Query Logic
$args = array(  
	'post_type' => 'hiring-events',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	// Order by start date
	'orderby' => 'meta_value',
	'meta_key' => 'start_date',
	'order' => 'ASC',
	// Filter by end_date if it exists, otherwise filter by start_date
	'meta_query' => array(
		'relation' => 'OR',
		array(
			'key' => 'end_date',
			'value' => date('Ymd'),
			'compare' => '>=',
			'type' => 'DATE'
		),
		array(
			'key' => 'start_date',
			'value' => date('Ymd'),
			'compare' => '>=',
			'type' => 'DATE'
		)
	)
);
$loop = new WP_Query( $args );
$event_posts = $loop->get_posts();
?>
<div id="<?= $customBlock->id ?>" data-anchor="<?= $customBlock->id ?>" data-anchor-label="<?= $customBlock->anchorLabel ?>" class=" <?= $customBlock->classesString ?> <?= $customBlock->paddingStyle; ?>">
	<?= $is_preview ? '<span class="block-preview-label">' . $customBlock->title . '</span>' : '' ?>
	<div class="container">
		<div class="events grid gap-10 lg:grid-cols-2">
			<?php
			if($event_posts){
				foreach ($event_posts as $key => $event) {
					$eventID = $event->ID;
					echo '<div class="event">';
						echo '<a href="' . get_the_permalink($eventID) . '">';

							// Build the image HTML
							$event_image = get_field('event_image', $eventID);
							$event_image_html = '';
							if($event_image){
								$event_image_html = $event_image['html'];
							}
							
							// Render the event image
							echo '<div class="event-image aspect-video overflow-hidden mb-3">';
								echo $event_image_html;
							echo '</div>';

							// Render the city and date
							echo '<div class="event-info text-center">';
								$event_name = get_field('event_name', $eventID);
								$start_date = get_field('start_date', $eventID);
								$end_date = get_field('end_date', $eventID);
								$event_type = get_field('event_type', $eventID);
								$event_link_text = $event_name;
								// Add start date to the text
								$event_link_text .= ' - '. date('M j', strtotime($start_date));
								// Add end date to the text
								if ( !empty($end_date) ) {
									// If the month is different, add the month
									if ( date('F', strtotime($start_date)) != date('F', strtotime($end_date)) ) {
										$event_link_text .= ' - ' . date('M j', strtotime($end_date));
									} else {
										$event_link_text .= ' - ' . date('j', strtotime($end_date));
									}
								}
								// Render the text
								echo '<h2 class="event-detail">' . $event_link_text . '</h2>';

								// Build the event type string
								if ( empty($event_type) ) {
									$event_type = 'Entry-Level Hiring Event';
								} else {
									$event_type = ucfirst($event_type) . ' Hiring Event';
								}
								// Render the event type
								echo '<p class="event-type">' . $event_type . '</p>';
							echo '</div>';

							// Render event button
							echo '<div class="btn btn-primary event-link block text-center border-2 bg-red text-white p-2">View Event</div>';
						
						echo '</a>';
					echo '</div>';
				}
			} else {
 				echo "<div class='no-events'><p>No upcoming events found.</p></div>";				
			}
			?>
		</div>
	</div>
</div>