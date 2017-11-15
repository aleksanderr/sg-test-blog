<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'h99459d9_sg');

/** MySQL database username */
define('DB_USER', 'h99459d9_sg');

/** MySQL database password */
define('DB_PASSWORD', '7Q**1RGn');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] .'/blog/wp-content/');
define('WP_CONTENT_URL', 'http://'. $_SERVER['HTTP_HOST'] .'/blog/wp-content/');
define( 'WP_PLUGIN_DIR', $_SERVER['DOCUMENT_ROOT'] . '/blog/wp-content/plugins' );
define( 'WP_PLUGIN_URL', 'http://'. $_SERVER['HTTP_HOST'] .'/blog/wp-content/plugins');
define('DISALLOW_FILE_EDIT',true);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '&Dl-Ywq:Vz`fnl09%h8+bMV<Q.}x/R%IFd?p37r*Dj%fdd%>4J0P#9jMx&>m[Elv');
define('SECURE_AUTH_KEY',  '|$)4eY7<Xe3znZ^=pKw;]km9a+>*c.I8gaBm5Zl+q&9DWE6`AQPoOo89I|7Tn(B*');
define('LOGGED_IN_KEY',    'B,zx{g{YM0HH&AsoXTxP2psj]ADBg_=LAhw5%4!D<m5Fgs&^2)F+eU0v)!IP,AP/');
define('NONCE_KEY',        'x^i5u||~Y*N<DcP+t7@,,U{Z @]$~@rs,!$k.),iCVE)w0jf(5|e)f&uS&jqSMn.');
define('AUTH_SALT',        '[B=C7|48LA]-?-W_>|csa5-UXIj};`E-VfX2+;yX+qJ]RIxi{~ozXtzQ7HdY|[vC');
define('SECURE_AUTH_SALT', 'YiDi1/Hn(4xuGDMS n&ajCIpXBmOa YIp(@`p4-|OMe{)75]!c~h_j4LDozU/N][');
define('LOGGED_IN_SALT',   '8x-g|lRU$@~x$n_#-e;|zO-Hx+_v66xqzDpM|X(Am&r4?kg[+Z8!S^p/9Idvq9-M');
define('NONCE_SALT',       'K+U+14-:^sI`Z}Tk,Iu@OE.L^#]@YMFJAt{xH<*P[ar_$gIVNBW!T>+L@]>?6,d5');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'sg_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
