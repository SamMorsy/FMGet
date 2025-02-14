<?php
/**
 * Front to the FMGet application. This file doesn't do anything, but loads
 * fmg-load.php which loads the default app / form or start the setup script.
 *
 * If no default app is selected and the conditions for setup are not true
 * then show a welcome page as place holder.
 * 
 * @package FMGet
 */

require_once __DIR__ . '/fmg-load.php';

//call fmg-load
//call fmg-apps
