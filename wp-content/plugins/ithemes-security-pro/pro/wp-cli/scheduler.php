<?php

/**
 * View events scheduled by iThemes Security.
 */
class ITSEC_Scheduler_Command extends WP_CLI_Command {

	/**
	 * List the scheduled events.
	 *
	 * ## OPTIONS
	 *
	 * [--single]
	 * : Only list one-time events.
	 *
	 * [--recurring]
	 * : Only list recurring events.
	 *
	 * @subcommand list
	 *
	 * @param array $args
	 * @param array $assoc_args
	 */
	public function list_( $args, $assoc_args ) {

		$assoc_args = wp_parse_args( $assoc_args, array( 'format' => 'table' ) );
		$scheduler  = ITSEC_Core::get_scheduler();

		$single_only = false;

		if ( ! empty( $assoc_args['single'] ) ) {
			$events      = $scheduler->get_single_events();
			$single_only = true;
		} elseif ( ! empty( $assoc_args['recurring'] ) ) {
			$events = $scheduler->get_recurring_events();
		} else {
			$events = array_merge( $scheduler->get_single_events(), $scheduler->get_recurring_events() );
		}

		$formatted = array();

		foreach ( $events as $event ) {
			$pretty = array(
				'id'          => $event['id'],
				'data'        => $event['data'],
				'fire_at'     => date( 'Y-m-d H:i:s', $event['fire_at'] + ITSEC_Core::get_time_offset() ),
				'fire_at_gmt' => date( 'Y-m-d H:i:s', $event['fire_at'] ),
			);

			if ( ! empty( $event['schedule'] ) ) {
				$pretty['schedule'] = $event['schedule'];
			} elseif ( ! $single_only ) {
				$pretty['schedule'] = '-';
			}

			$formatted[] = $pretty;
		}

		usort( $formatted, function ( $a, $b ) {
			$cmp = strcmp( $a['id'], $b['id'] ) ;

			if ( $cmp === 0 ) {
				return strtotime( $a['fire_at_gmt'] ) - strtotime( $b['fire_at_gmt'] );
			}

			return $cmp;
		} );

		$columns = array( 'id', 'data', 'fire_at', 'fire_at_gmt' );

		if ( ! $single_only ) {
			$columns[] = 'schedule';
		}

		\WP_CLI\Utils\format_items( $assoc_args['format'], $formatted, $columns );
	}

	/**
	 * Get the type of scheduler being used.
	 *
	 * @return string
	 */
	public function type() {
		WP_CLI::line( get_class( ITSEC_Core::get_scheduler() ) );
	}

	/**
	 * Reset the scheduled events.
	 *
	 * This will unregister all events and then re-register them.
	 */
	public function reset() {

		ITSEC_Core::get_scheduler()->uninstall();
		ITSEC_Core::get_scheduler()->register_events();

		WP_CLI::success( 'Scheduler reset.' );
	}
}

WP_CLI::add_command( 'itsec events', 'ITSEC_Scheduler_Command' );
