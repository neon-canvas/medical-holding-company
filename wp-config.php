<?php
# Database Configuration
define( 'DB_NAME', 'wp_mholding2020' );
define( 'DB_USER', 'mholding2020' );
define( 'DB_PASSWORD', '8keo8JkoMjlOxJO13AQ5' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         '/6)ANGT;3ux1,k&u]_AYO`FF]Awj3zAE=6qi0*kxMh=Oj^YS=4o]F-M?0A1-JAHb');
define('SECURE_AUTH_KEY',  '$zN>_GVJ&1+_,s|-nVe+WKj f=F7<}rk$u>G1MW5xbm),&W!++kT77Nlkfy8fGqw');
define('LOGGED_IN_KEY',    'QuF]XACg{>g0>(]BzRi,4]enc>MB|koL|RM({_{U+;;v _,0@&hP|h[)+jVx4^Nr');
define('NONCE_KEY',        '$Rg|-njUw^tigGSP=`=wy*898(5C|aNBPzffMB=3(cTUXGSlECTJR EI>idlA>Nv');
define('AUTH_SALT',        'r_dJM--~C.oxeZR6WbW]-nGP:bHP zgS@dU+jBP~^Z+m&@-=P$}t*ZEKUG5uC4K!');
define('SECURE_AUTH_SALT', '9=xamT-j~5t2Ph)GmNDM 1~)9Iee+f_]1s;9-f8YzqhoWjO$<HE&<rZ`-1h+!UPa');
define('LOGGED_IN_SALT',   'YKst-?2tSMIcC3q2?VEPwR-T!j82I8r)$RZT[ KCnBxQra|}26a+!2CCd%e-|F)u');
define('NONCE_SALT',       ',rk2g;U+paqCD}e=Jnsf7~Sil<49_4A]&Z$.O3G9n#e9ylmS+#}g^_M&[k&Mmh1~');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'mholding2020' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'WPE_APIKEY', 'a05b3daae2d661647f40a5237bfb9af39d17f990' );

define( 'WPE_CLUSTER_ID', '154875' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', true );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'mholding2020.wpengine.com', );

$wpe_varnish_servers=array ( 0 => 'pod-154875', );

$wpe_special_ips=array ( 0 => '34.73.202.166', );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( 'default' =>  array ( 0 => 'unix:///tmp/memcached.sock', ), );
define('WPLANG', '');

# WP Engine ID


# WP Engine Settings







# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', __DIR__ . '/');
require_once(ABSPATH . 'wp-settings.php');
