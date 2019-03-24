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
define('DB_NAME', 'rbahadoo_woltech');

/** MySQL database username */
define('DB_USER', 'rbahadoo_woltech');

/** MySQL database password */
define('DB_PASSWORD', 'O}bu00XT@@ui');

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
define('AUTH_KEY',         '<?^[ IiQIu1p~Js_AnSW>Pl=ZJVV$Y.wn_^DqBoP]otnv#<`UP7qfsW$EE*.=7w.');
define('SECURE_AUTH_KEY',  'vPO,r^E7&Av(QcJ<?!n%|67bAIouFz13[[vWjTTpU:u>TTUD/ecO!RYg_)nqgF1H');
define('LOGGED_IN_KEY',    'X;z=.Ef)yf5!] ,5JZUl>@kCo(!ie?o$N@1E|:A @bXK`1?U LP5Whvkq!h1M]!j');
define('NONCE_KEY',        'X=Bsl&=6~R}35$QUDb=z|nl6@Tvdq}Qln0:wUYmq}q/-i}Tkhq*:f`b6<|{geIyL');
define('AUTH_SALT',        'fOVriiZ@.Zj1C{<]^Nc7Mp0y HJ)M,yRqnIgD%c$f_.&FVW|W@2Cy0,e(vf_CXZ<');
define('SECURE_AUTH_SALT', '%G(f$0&LEP5K$:wKL4V}b$d% 8dya{b8EBchVvt?X9),CRd5uB)$74$Rf0+gS:?B');
define('LOGGED_IN_SALT',   '%z{b:t9Gxnh524+ 5Oo9&m.<6!H7EcTBIX()q$/j?r(/>~,4alu{Pn?RIBu[KgIH');
define('NONCE_SALT',       'l$[rE(BucTjk)XQFm631HkknB~X,Bw&g: ~lZV_HD&#0Dz<5,rMsSry*<(Tl<SBo');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
