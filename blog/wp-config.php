<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
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
define('DB_NAME', 'ideasy5p_dw_blog');

/** MySQL database username */
//define('DB_USER', 'ideasy5p_dwblog');
define('DB_USER', 'root');

/** MySQL database password */
//define('DB_PASSWORD', 'IDEAS2it@');
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'nhCB-b-JKLmq?g1rLCdjb+gVlD++^fHG;86$(,=7exAI11lu8M%S4/ak.O,$-I-^');
define('SECURE_AUTH_KEY',  '%lW!#M1Rkl72iIk]nX pvj{IQ-UlcQ=z#H^eOr?.||L--y2[B[m|`4r|T_2Q;Ds6');
define('LOGGED_IN_KEY',    'Rp+[.#,;m:,^Z3AR19OuSrk$dRb_=x5%|]; E<-;/G2-^x{K7jd]L>JGh7Z;@]Bh');
define('NONCE_KEY',        'oK4*@pJ/SJI+]~hYZ*e=l  j`14[faVTgnm=fGJzf.#|xT>J{c=f^6+X2$|,,_.k');
define('AUTH_SALT',        'g+|[-C q>)vHS|K`Re=5W@5YV}~~?yQbF]N|.aJ31d[S!c.6yVPcRvUK0G*e9p1y');
define('SECURE_AUTH_SALT', '@/`WT$HLEE|%b;10v<p@U6CLI|[|Ncy$}ghPlf2^OQ|t0t=8@`P?>bM|cTX9ZtG+');
define('LOGGED_IN_SALT',   'uH-p+rO!=:dmg5S3DQVV+OFS*6OV/Tr!`w<53|oPyra?XqVm]<7;+!g sMdIIJP_');
define('NONCE_SALT',       '`~t#kZ0Y.?D Fa=7^dJe$Z49KZUTO(g$l||V^,AO$luk-o3z 6_hn+N9$d+wNK(/');

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
define('FS_METHOD','direct');
define('WP_DEBUG', false);
#define('WP_HOME','http://www.ideas2it.com/blog/');
#define('WP_SITEURL','http://www.ideas2it.com/blog/');
// define('WP_HOME','http://localhost/blog/');
// define('WP_SITEURL','http://localhost/blog/');
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
