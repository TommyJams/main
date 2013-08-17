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
define('DB_NAME', 'tommyjam_wrd1');

/** MySQL database username */
define('DB_USER', 'tommyjams');

/** MySQL database password */
define('DB_PASSWORD', '1tommyblah');

/** MySQL hostname */
define('DB_HOST', 'tommyjamsmain.cloudapp.net');

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
define('AUTH_KEY',         'x8It9V1qZBR87YevkGw8Y5zn3dwK9AQXrIlpd7khoGPkt1gryzSLeKVOqxCE5RlW');
define('SECURE_AUTH_KEY',  'UgM7farhUWVM1jUtApIh5zcDRuy9nGK0CSkREuiD9XXZNTkad7xUjPdTja9qMYK2');
define('LOGGED_IN_KEY',    'xzpERppt3XLsUIw6r3wjvh8sS6tObXszzC6iXeLFb4IRvcCKCp1jaG78Zh75EI94');
define('NONCE_KEY',        '1OlVqYcNH0tMG2nee7fTvaN7BeDZgKzuCqh9Oruv039pmMUT293YitSBKuH8jBy0');
define('AUTH_SALT',        'YBJAu6fQri31dKTWPl8JYyPi0QeozqWxGU3cRFSyjDvbmVDqZ8kvB4c7QG1CdR7x');
define('SECURE_AUTH_SALT', 'gR4ZXXLs6f8Np6zkMzIVZ7wXsiTCxgdiPpb0xHlgqyf4mb4VLm4GRQF07Mo8bmPA');
define('LOGGED_IN_SALT',   'Edfc7XKFyfS57TfhmIUZZPLytOT6tSYkIHDUejNlg8ljZa6Hpijikcd8RV9sHFWN');
define('NONCE_SALT',       'ccnlgo8fFVAiZ3iutWuOuKMzBMau0ocalCMKmh4mBH7dGdSuzULvdKn8x8zX5sda');

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
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
