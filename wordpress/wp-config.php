<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_db' );

/** Database username */
define( 'DB_USER', 'local' );

/** Database password */
define( 'DB_PASSWORD', '123' );

/** Database hostname */
define( 'DB_HOST', 'db' );

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
define( 'AUTH_KEY',         '>~z $)q0(uq*G9p3%;K=)lZG09})/~gqz<0ACWHfZ=KZGcdJ,/$]![^Ob89pr;Xe' );
define( 'SECURE_AUTH_KEY',  'yJi*n-p GW-Y]L`c;p-sywWX18~ W-eS!Rfh7)l^*tjwm&!z@%-)=aX];>y-aEuZ' );
define( 'LOGGED_IN_KEY',    '59fEbP7bt/B{%QMq+7jM;m;/Ks1.z-8X^L,hMXc/^|A^@]{^D ;]QV` md<q<f*Q' );
define( 'NONCE_KEY',        'K6Y<6Cp=%$!yqzGEjJ[]wW`)5{)#XUxEF+cEFd:sR+A|B=|UTj_wE^EU85&kF|Jo' );
define( 'AUTH_SALT',        '>Veq%ShSKpx{0J0/TS-3_YM 25k`o${f_iC6Y9kB$T;Lq&)-Dy{SokLTB-,h4I?<' );
define( 'SECURE_AUTH_SALT', 'O!*M*!MW,@62W*z*nJ<,NN6k,Kh:rbTdOqcw>B@hjA8zmYnwDAuLFJTs;49!+&#b' );
define( 'LOGGED_IN_SALT',   'oiy*`Tcsa1NaMx+,NUOAvbmBBn9F$XXFrW+0*OdJswWr_5n99MrkcTRpp(KTdhA ' );
define( 'NONCE_SALT',       '>C9039MN)gc%V+f&+Q.}P/QI7M;]Z?<QcqwKNcL{>4l({7<!BIjKc`htY]>@H=~I' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
