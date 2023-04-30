<?php


function my_prefix_custom_activity_triggers( $triggers ) {
    // The array key will be the group label
    $triggers['My Custom Events'] = array(
        // Every event of this group is formed with:
        // 'event_that_will_be_triggered' => 'Event Label'
        'my_prefix_custom_event' => __( 'Sales last Year', 'gamipress' ),
        // Also, you can add as many events as you want
        // 'my_prefix_another_custom_event' => __( 'Another custom event label', 'gamipress' ),
        // 'my_prefix_super_custom_event' => __( 'Super custom event label', 'gamipress' ),
    );
    return $triggers;
}
add_filter( 'gamipress_activity_triggers', 'my_prefix_custom_activity_triggers' );



function my_prefix_custom_listener( $args ) {
    // Call to the gamipress_trigger_event() function to let know GamiPress this event was happened
    // GamiPress will check if there is something to award automatically
    gamipress_trigger_event( array(
        // Mandatory data, the event triggered and the user ID to be awarded
        'event' => 'my_prefix_custom_event',
        'user_id' => get_current_user_id()
        // Also, you can add any extra parameters you want
        // They will be passed too on any hook inside the GamiPress awards engine
        // 'date' => date( 'Y-m-d H:i:s' ),
        // 'custom_param' => 'custom_value',
    ) );
}
// The listener should be hooked to the desired action through the WordPress function add_action()
add_action( 'action_we_want_to_hook', 'my_prefix_custom_listener' );