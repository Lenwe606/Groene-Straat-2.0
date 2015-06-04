<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'groenestraat');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'usbw');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'cv_s$-B+C?:=G14FtiT-&|+8LE~-Sv`X9.C*JdGDV^]*KCQ7FB|*Xy<uKl.p+lQ%');
define('SECURE_AUTH_KEY',  '6~ErW[}^?f_N1dZrRo?t]b:rB^-V%xxj5:laA 5Gb!>@gI`?!5Q|84B3=;lb6*O*');
define('LOGGED_IN_KEY',    ']FHE.;f,)+y*B[_ KmP`f4gRe.qEB|pXw=q&XF{tWd-TZ|d:JQt6M{ePh*dom+Q3');
define('NONCE_KEY',        'snqqr*wAMbX5sm~zLl*m-[|<9<(1; wHm*TrV][4Ri+a-6%WEwDmk)fB3$_&gvcc');
define('AUTH_SALT',        'f`Lt7W|K`#:jjY[mMtI3z46^V[X6|%v}|PsBk=>,Da]c$6!5_P$ao4B0gZusRos2');
define('SECURE_AUTH_SALT', 'lt7Ab_AN2,]pv[CTms JvqS,^$+*SWT$|-!:q2%YK{ R97dwZLxY;I S/Q0 5Ftp');
define('LOGGED_IN_SALT',   '`qh<-oE%2R/=6%yVnJ8xl,%ugs}3RQRG~nfxX]cF]8u %Li-N4Bg:1dLI]3NV{ys');
define('NONCE_SALT',       '-^s0u7QG1Qg@m>XA8zC`w1,$!_jThJt[H>Mzf`%TW(,$L|-Q+}9wl~R^09]/0(<5');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
