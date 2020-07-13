<?php

/**
 * Manage iThemes Security Pro functionality
 *
 * Provides command line access via WP-CLI: http://wp-cli.org/
 */
class ITSEC_WP_CLI_Command_ITSEC extends WP_CLI_Command {

	/**
	 * Run the upgrade routine.
	 *
	 * ## OPTIONS
	 *
	 * [--build=<build>]
	 * : Manually specify the build number to upgrade from. Otherwise, will pull from current version.
	 *
	 * @param array $args
	 * @param array $assoc_args
	 */
	public function upgrade( $args, $assoc_args ) {

		$build = ! empty( $assoc_args['build'] ) ? $assoc_args['build'] : false;

		ITSEC_Core::get_instance()->handle_upgrade( $build );

		WP_CLI::success( __( 'Upgrade routine completed.', 'it-l10n-ithemes-security-pro' ) );
	}

	/**
	 * Performs a file change scan
	 *
	 * @since 1.12
	 *
	 * @return void
	 */
	public function filescan() {

		if ( ! class_exists( 'ITSEC_File_Change' ) ) {
			WP_CLI::error( __( 'File change scanning is not enabled. You must enable the module first.', 'it-l10n-ithemes-security-pro' ) );
		}

		ITSEC_Modules::load_module_file( 'scanner.php', 'file-change' );
		$response = ITSEC_File_Change_Scanner::run_scan( false, true );

		if ( false === $response ) {
			WP_CLI::success( __( 'File scan completed. No changes were detected.', 'it-l10n-ithemes-security-pro' ) );
			return;
		}

		if ( -1 === $response ) {
			WP_CLI::error( __( 'A scan is currently running. Please wait a few minutes before attempting a new file scan.', 'it-l10n-ithemes-security-pro' ) );
			return;
		}

		if ( ! is_array( $response ) ) {
			WP_CLI::error( __( 'There was an error in the scan operation. Please check the site logs or contact support.', 'it-l10n-ithemes-security-pro' ) );
			return;
		}

		if ( empty( $response['added'] ) && empty( $response['removed'] ) && empty( $response['changed'] ) ) {
			WP_CLI::success( __( 'File scan completed. No changes were detected.', 'it-l10n-ithemes-security-pro' ) );
			return;
		}


		$added    = array();
		$removed  = array();
		$modified = array();

		//process added files if we have them
		if ( isset( $response['added'] ) && sizeof( $response['added'] ) > 0 ) {

			foreach ( $response['added'] as $index => $data ) {

				$added[] = $this->format_filescan( __( 'added', 'it-l10n-ithemes-security-pro' ), $index, $data['h'], $data['d'] );

			}

		}

		//process removed files if we have them
		if ( isset( $response['removed'] ) && sizeof( $response['removed'] ) > 0 ) {

			foreach ( $response['removed'] as $index => $data ) {

				$removed[] = $this->format_filescan( __( 'removed', 'it-l10n-ithemes-security-pro' ), $index, $data['h'], $data['d'] );

			}

		}

		//process modified files if we have them
		if ( isset( $response['changed'] ) && sizeof( $response['changed'] ) > 0 ) {

			foreach ( $response['changed'] as $index => $data ) {

				$modified[] = $this->format_filescan( __( 'modified', 'it-l10n-ithemes-security-pro' ), $index, $data['h'], $data['d'] );

			}

		}

		$file_changes = array_merge( $added, $removed, $modified );

		$obj_type   = 'itsec_file_changes';
		$obj_fields = array(
			'type',
			'file',
			'hash',
			'date',
		);

		$defaults = array(
			'format' => 'table',
			'fields' => array( 'type', 'file', 'hash', 'date', ),
		);

		$formatter = $this->get_formatter( $defaults, $obj_fields, $obj_type );
		$formatter->display_items( $file_changes );

	}

	/**
	 * Standardize and sanitize output of file changes detected
	 *
	 * @since 1.12
	 *
	 * @param string $type the type of change
	 * @param string $file the file that changed
	 * @param string $hash the md5 hash of the file
	 * @param int    $date the timestamp detected on the file
	 *
	 * @return array presentable array of file information
	 */
	private function format_filescan( $type, $file, $hash, $date ) {

		$file_info = array();

		$file = sanitize_text_field( $file );

		$file_info['type'] = sanitize_text_field( $type );
		$file_info['file']  = $file;
		$file_info['hash']  = substr( sanitize_text_field( $hash ), 0, 8 );
		$file_info['date']  = human_time_diff( ITSEC_Core::get_current_time_gmt(), intval( $date ) ) . ' ago';

		return $file_info;

	}

	/**
	 * Returns an instance of the wp-cli formatter for better information dissplay
	 *
	 * @since 1.12
	 *
	 * @param array  $assoc_args array of formatter options
	 * @param array  $obj_fields array of field titles for display
	 * @param string $obj_type   type of object being displayed
	 *
	 * @return \WP_CLI\Formatter
	 */
	private function get_formatter( $assoc_args, $obj_fields, $obj_type ) {

		return new \WP_CLI\Formatter( $assoc_args, $obj_fields, $obj_type );

	}

	/**
	 * Retrieve active lockouts
	 *
	 * @since 1.12
	 *
	 * @return void
	 */
	public function getlockouts() {

		/** @var ITSEC_Lockout $itsec_lockout */
		global $itsec_lockout;

		$host_locks = $itsec_lockout->get_lockouts( 'host' );
		$user_locks = $itsec_lockout->get_lockouts( 'user' );

		if ( empty( $host_locks ) && empty( $user_locks ) ) {

			WP_CLI::success( __( 'There are no current lockouts', 'it-l10n-ithemes-security-pro' ) );

		} else {

			if ( ! empty( $host_locks ) ) {

				foreach ( $host_locks as $index => $lock ) {

					$host_locks[ $index ]['type']           = __( 'host', 'it-l10n-ithemes-security-pro' );
					$host_locks[ $index ]['lockout_expire'] = isset( $lock['lockout_expire'] ) ? human_time_diff( ITSEC_Core::get_current_time(), strtotime( $lock['lockout_expire'] ) ) : __( 'N/A', 'it-l10n-ithemes-security-pro' );

				}

			}

			if ( ! empty( $user_locks ) ) {

				foreach ( $user_locks as $index => $lock ) {

					$user_locks[ $index ]['type']           = __( 'user', 'it-l10n-ithemes-security-pro' );
					$user_locks[ $index ]['lockout_expire'] = isset( $lock['lockout_expire'] ) ? human_time_diff( ITSEC_Core::get_current_time(), strtotime( $lock['lockout_expire'] ) ) : __( 'N/A', 'it-l10n-ithemes-security-pro' );

				}

			}

			$lockouts = array_merge( $host_locks, $user_locks );

			WP_CLI\Utils\format_items( 'table', $lockouts, array( 'lockout_id', 'type', 'lockout_host', 'lockout_username', 'lockout_expire' ) );

		}

	}

	/**
	 * Release a lockout using one or more ID's provided by getlockouts.
	 *
	 * ## OPTIONS
	 *
	 * [<id>...]
	 * : One or more active lockout ID's.
	 *
	 * [--id=<id>]
	 * : An active lockout ID.
	 *
	 * ## EXAMPLES
	 *
	 *     wp itsec releaselockout 14 21
	 *     wp itsec releaselockout --id=83
	 *
	 * @since 1.12
	 *
	 * @param array $args
	 * @param array $assoc_args
	 *
	 * @return void
	 */
	public function releaselockout( $args, $assoc_args ) {

		/** @var ITSEC_Lockout $itsec_lockout */
		global $itsec_lockout;

		$ids = array();

		//make sure they provided a valid ID
		if ( isset( $assoc_args['id'] ) ) {
			$ids[] = $assoc_args['id'];
		} else {
			$ids = $args;
		}

		if ( empty( $ids ) ) {
			WP_CLI::error( __( 'You must supply one or more lockout ID\'s to release.', 'it-l10n-ithemes-security-pro' ) );
		}

		foreach ( $ids as $id ) {
			if ( '' === $id ) {
				WP_CLI::error( __( 'Skipping empty ID.', 'it-l10n-ithemes-security-pro' ) );
			} else if ( (string) intval( $id ) !== (string) $id ) {
				WP_CLI::error( sprintf( __( 'Skipping invalid ID "%s". Please supply a valid ID.', 'it-l10n-ithemes-security-pro' ), $id ) );
			} else if ( ! $itsec_lockout->release_lockout( $id ) ) {
				WP_CLI::error( sprintf( __( 'Unable to remove lockout "%s".', 'it-l10n-ithemes-security-pro' ), $id ) );
			} else {
				WP_CLI::success( sprintf( __( 'Successfully removed lockout "%d".', 'it-l10n-ithemes-security-pro' ), $id ) );
			}
		}
	}

	/**
	 * List the most recent log items
	 *
	 * ## OPTIONS
	 *
	 * [<count>]
	 * : The number of log items to display.
	 * ---
	 * default: 10
	 * ---
	 *
	 * [--count=<count>]
	 * : The number of log items to display.
	 * ---
	 * default: 10
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *     wp itsec getrecent 20
	 *     wp itsec getrecent --count=50
	 *
	 * @since 1.12
	 *
	 * @param array $args
	 * @param array $assoc_args
	 *
	 * @return void
	 */
	public function getrecent( $args, $assoc_args ) {
		if ( isset( $assoc_args['count'] ) && 10 != $assoc_args['count'] ) {
			$count = intval( $assoc_args['count'] );
		} else if ( isset( $args[0] ) && 10 != $args[0] ) {
			$count = intval( $args[0] );
		} else {
			$count = 10;
		}

		$entries = ITSEC_Log::get_entries( array(), $count );

		if ( ! is_array( $entries ) || empty( $entries ) ) {

			WP_CLI::success( __( 'The Security logs are empty.', 'it-l10n-ithemes-security-pro' ) );

		} else {

			foreach ( $entries as $index => $entry ) {
				if ( '' === $entry['user_id'] ) {
					$username = '';
				} else {
					$user = get_user_by( 'id', $entry['user_id'] );

					if ( false === $user ) {
						$username = '';
					} else {
						$username = $user->user_login;
					}
				}

				$entries[$index] = array(
					'Time'     => sprintf( esc_html__( '%s ago', 'it-l10n-ithemes-security-pro' ), human_time_diff( ITSEC_Core::get_current_time_gmt(), strtotime( $entry['timestamp'] ) ) ),
					'Code'     => $entry['code'],
					'Type'     => $entry['type'],
					'IP'       => $entry['remote_ip'],
					'Username' => $username,
					'URL'      => $entry['url'],
				);

			}

			WP_CLI\Utils\format_items( 'table', $entries, array( 'Time', 'Code', 'Type', 'IP', 'Username', 'URL' ) );

		}

	}

}

