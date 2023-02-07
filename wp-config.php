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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'PPch44vhW[z{cD< n9(@=3;)d<Y|bPMyPWel+jD,{Z$=Ng?gw_KJCrL[&;ucl}L7' );
define( 'SECURE_AUTH_KEY',  'C1]Y&eHZ9b}3(~FcP`^IZE)X~ef:[;*Vp>d(A1qIG],,qHSi2lQLUAMo`I/~HcnG' );
define( 'LOGGED_IN_KEY',    'UswcySS4x ceQ?gfDbCOvv?a fLf(qpCM86.VVa^Rt_;i%{6%tLKgg:A4S4dD`?9' );
define( 'NONCE_KEY',        '[}s)bAoon:3KJ+32/s_rX<*QJ#*8Jauu?4{s]1%w25}pb@M9O7skV+{v&z3|bJ5K' );
define( 'AUTH_SALT',        'KwlV#%8iO0f!36eg~._~cKTjtq2s6.H5S9_:rXiMfB=ogF}EW8(s52`_jga|qhxb' );
define( 'SECURE_AUTH_SALT', '5wVt<hGXmaKt]~;F5z@Q=x28*}[bacP[}Z9!Lax<=sSGv3-p-]55T1CMrfEi]596' );
define( 'LOGGED_IN_SALT',   'z!@Z.[@}AFGa<8sQSi<-X%qpvT;NDZ^W9M&3t+qROZG$<)`4zb%^w(99g`SY17v+' );
define( 'NONCE_SALT',       'Q,rx98w8#k~~PeDWUW|KKpv0k=_ L|qmoDMQ,e<cLdc9J;ditp6C?np,.}}6p~a:' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
