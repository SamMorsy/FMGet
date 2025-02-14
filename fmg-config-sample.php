<?php
/**
 * The base configuration for FMGet
 * 
 * This file contains the following configurations:
 *
 * * FileMaker server and database settings
 * * Secret keys
 * * ABSPATH
 * 
 * Any changes in this file can break the connection between the website and the FileMaker server.
 * 
 */

 // ** FileMaker settings ** //
/**
 * The name of the FileMaker database - Url encoded
 * and can include .fmp12 or can be without it.
 * 
 */
define( 'DB_NAME', 'database_name_here' );

/** Database username for an account with full access */
define( 'DB_USER', 'username_here' );

/** Database password */
define( 'DB_PASSWORD', 'password_here' );

/**
 * FileMaker server address 
 * It should not include the https:// part. Do not put a slash “/” at the end.
 * 
 * Don't include the database name in this constant.
 * 
 */
define( 'DB_HOST', 'fms.example.com' );

/**
 * The value defined is the address where your FMGet core files reside.
 * It should include the https:// part. Do not put a slash “/” at the end.
 *
 */
define( 'FMG_SITEURL', 'https://example.com/fmget' );

/** Selected Language for FMGet */
define( 'FMGLANG', 'en-us' );

/**
 * Holds the name of the app / form that is marked as default.
 *
 * This app / form will be loaded if the user navigates to the root of FMGet.
 *
 */
define( 'FMG_MAIN_APP',         'put the name of the app directory' );

/**
 * Authentication unique keys and salts.
 *
 * You can generate these using the setup script
 *
 */
define( 'AUTH_KEY1',         'put your unique phrase here' );
define( 'AUTH_KEY2',         'put your unique phrase here' );
define( 'AUTH_KEY3',         'put your unique phrase here' );
define( 'LOGGED_IN_KEY',     'put your unique phrase here' );

/** Absolute path to the FMGet directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

