<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'baumcycles');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '*>9s<Gg6rstH#euguRBJ$<(SgE4f3vh/6/7u49:=4(c&E5_&FcTF,G;i4G4jj?Rb');
define('SECURE_AUTH_KEY',  'oJn(!(oUQ7lw_1[F58<INYO>!vrFK6BE2}#~O0No7&ta0g0,}(!8];gG`qAe$+n1');
define('LOGGED_IN_KEY',    '>=15kagp{hFqh+i21eRcAoI7S[Hj6_M?//.MPyHFvMYv|E5(p06%R*5id=4LmC<A');
define('NONCE_KEY',        'Q71+T>~,%eAIkv@KofP:8cG2RruQ=IhtO(#RSvr7^-??9LoHcKMJ<2v5#dYeq93>');
define('AUTH_SALT',        '%}:pQIe%:j!knFXZox{ECB/  /0Im+h_f#2zc3.ylv~;[%acleX2u]-LZhgrp6$`');
define('SECURE_AUTH_SALT', 'w!i:7,Qe.GCBpN%UtY)TSJ;h.*}1SWjPFS@# e*{^r>+U|guNvW[9?/V%WLUUmap');
define('LOGGED_IN_SALT',   '4Y8GQ@dUnDcB}wu3%/hautMHurM5@8-tO{==_[%0Pfy^2{.+Ag RP}N{#MX0w}PQ');
define('NONCE_SALT',       '%}:2vp{ce@D5A]kAYE:77yf3>ShkA2A)X`7K>cy*=[z6o9AuU%kPNh2*a1z7k#RQ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', '');

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
