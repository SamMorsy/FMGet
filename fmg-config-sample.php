<?php
/**
 * The base configuration for FMGet
 * 
 * This file contains the following configurations:
 *
 * * FileMaker server and database settings
 * * Secret keys
 * * FMGROOT
 * 
 * Any changes in this file can break the connection between the website and the FileMaker server.
 * 
 */

 // ** FileMaker settings ** //

/**
 * FileMaker server address 
 * It should not include the https:// part. Do not put a slash “/” at the end.
 * 
 * Don't include the database name in this constant.
 * 
 */
define( 'FMG_DB_HOST', 'fms.example.com' );

 /**
 * The name of the FileMaker database - Url encoded
 * and can include .fmp12 or can be without it.
 * 
 */
define( 'FMG_DB_NAME', 'database_name_here' );

/** Database username for an account with full access */
define( 'FMG_DB_USER', 'username_here' );

/** Database password */
define( 'FMG_DB_PASSWORD', 'password_here' );





/**
 * The value defined is the address where your FMGet core files reside.
 * It should include the https:// part. Do not put a slash “/” at the end.
 *
 */
define( 'FMG_SITEURL', 'https://example.com/fmget' );

/**
 * The value defined is the name of this FMGet application.
 * It will show up in different locations around the system
 */
define( 'FMG_SITENAME', 'Company name' );

/** Selected Language for FMGet */
define( 'FMG_LANG', 'en-us' );

/** Selected time zone for FMGet */
define( 'FMG_TIMEZONE', 'UTC' );

/** Selected date format for FMGet */
define( 'FMG_DATEFORMAT', 'MM/DD/YYYY' );

/**
 * Holds the name of the SQLite database.
 *
 * This name is generated randomly when using the setup script.
 * This is done to add an extra layer of security.
 *
 */
define( 'FMG_SQLITE_NAME',         'put the name of the sqlite database here' );


/**
 * Authentication details for the admin panel.
 *
 */
define( 'FMG_USER',         'username_here' );
define( 'FMG_PASSWORD',         'password_here' );
define( 'FMG_EMAIL',         'put your admin email here' );




/**
 * Authentication unique keys and salts.
 *
 * You can generate these using the setup script
 *
 */
define( 'FMG_AUTH_KEY1',         'put your unique phrase here' );
define( 'FMG_AUTH_KEY2',         'put your unique phrase here' );
define( 'FMG_AUTH_KEY3',         'put your unique phrase here' );
define( 'FMG_AUTH_SALT',     'put your unique phrase here' );




/** Absolute path to the FMGet directory. */
if ( ! defined( 'FMGROOT' ) ) {
	define( 'FMGROOT', __DIR__ . '/' );
}

