<?php
/**
 * Last line of defense for the database.
 *
 * If this file can be excuted by a public call to the data directory
 * means that the server is not configured correctly.
 * 
 * @to-do Add a log fuction to alert the admin about this critical issue.
 *
 * @package FMGet
 */

http_response_code(403);
exit;