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
define( 'FMG_DB_HOST', 'shamansoftwareapps.com' );

 /**
 * The name of the FileMaker database - Url encoded
 * and can include .fmp12 or can be without it.
 * 
 */
define( 'FMG_DB_NAME', 'ProShieldSolutions' );

/** Database username for an account with full access */
define( 'FMG_DB_USER', 'SamM' );

/** Database password */
define( 'FMG_DB_PASSWORD', '1\'\'\'""\\\\\\\'::23"5\\\'lo\\"kk:BR ' );





/**
 * The value defined is the address where your FMGet core files reside.
 * It should include the https:// part. Do not put a slash “/” at the end.
 *
 */
define( 'FMG_SITEURL', 'https://fmget.test' );

/**
 * The value defined is the name of this FMGet application.
 * It will show up in different locations around the system
 */
define( 'FMG_SITENAME', 'Test Site FMGet' );

/** Selected Language for FMGet */
define( 'FMG_LANG', 'en-us' );

/** Selected time zone for FMGet */
define( 'FMG_TIMEZONE', 'America/Sao_Paulo' );

/** Selected date format for FMGet */
define( 'FMG_DATEFORMAT', 'info@fmget.com' );

/**
 * Holds the id of the page / form that is marked as the homepage.
 *
 * This page / form will be loaded if the user navigates to the root of FMGet.
 *
 */
define( 'FMG_HOMEPAGE',         'put the id of the page' );




/**
 * Authentication details for the admin panel.
 *
 */
define( 'FMG_USER', 'sam\\\'kool' );
define( 'FMG_PASSWORD', '$2y$10$Fcl5dJOejL8Dufr8RVzNkOhT4n3p17Hxis1HncMqwDLbuUzcCoxpK' );
define( 'FMG_EMAIL', 'info@fmget.com' );




/**
 * Authentication unique keys and salts.
 *
 * You can generate these using the setup script
 *
 */
define( 'FMG_AUTH_KEY1', 'PFpb)QkUIU7wtR))107qYd2F0S71NkpAN52EER-S' );
define( 'FMG_AUTH_KEY2', '0NFIgzF58W7oQDBbYK6kIi(sfks3RzPBvPQgWojN' );
define( 'FMG_AUTH_KEY3', 'QOz)lvwYugh7nPd8F)m+hEUAoMiJN0CQ*aCvFbCl' );
define( 'FMG_AUTH_SALT', 'm+XY7Ts0iiMVxmC-U97jhlPO14(vHnJBB5o70AOd' );




/** Absolute path to the FMGet directory. */
if ( ! defined( 'FMGROOT' ) ) {
	define( 'FMGROOT', __DIR__ . '/' );
}

