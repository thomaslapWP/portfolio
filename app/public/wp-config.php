<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '8~4: c-.m4TU(aX6M-fC}{f#%#X1z4NJs.BIGPaHmP,LG*n8hyIE(..pmvpmlm8}' );
define( 'SECURE_AUTH_KEY',   'QQ8uxMfsiJwK<?aEz@EH#F_n?p+NHYO_WqXLDF%]@O1WGM@0LNUp8W}*_~YlKCa8' );
define( 'LOGGED_IN_KEY',     'y{{=);}op>3w3b0Lji5LZH3=C5egT{hICT?#:1D-rn%52H1c*K|1 %0ckoNCM0I%' );
define( 'NONCE_KEY',         'z]|J|{}SsF6W^?]Rd|k=xN&BM3_aE_bX#_^Rd!^|P0ZGp{LeR)vj>^0(TWW*&F<G' );
define( 'AUTH_SALT',         'tt}+Os*Rz>ZL!)t?vp0aO%~G>qbOzCQ(XI}vi(E ImF/FY7IY}csahhJPf.HiS 7' );
define( 'SECURE_AUTH_SALT',  'fsI(9<$ro}PL*yPn)7|J)jcO^i.~lJhmC`7q`1FU*]5%8_pd(<_jjtjY[E-#X--&' );
define( 'LOGGED_IN_SALT',    '(F7W;PBn,jSpx`,/co7r%$]3(l!8|V*$j6QlX_g?rJ/-fJa%_CrBDroF?<$G#e< ' );
define( 'NONCE_SALT',        '2ZR4~K*hp,?&^=4+an~L9dzSsChE M[%+OP&Mr`1@7O6]X011<4W]aT;*KrZr73:' );
define( 'WP_CACHE_KEY_SALT', 'sn)/:.pa@mBcTNbH#NO@!xY@&aG~oD_J)G%UFZfoH4K@K $HsE+yi,UgqNJ-n=1I' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
