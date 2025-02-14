<?php
/**
 * The interface for managing the FMGet application.
 *
 * Protected by 3 auth keys saved in the fmg-config.php,
 * If the fmg-config.php go to the setup step 2 
 *
 * @package FMGet
 */


 //Dev
 //Showing the given parameters from the code.

echo 'Loading....';
$con_user = isset($_POST['con_user']) ? $_POST['con_user'] : '';
$con_file = isset($_POST['con_file']) ? $_POST['con_file'] : '';
$con_srv = isset($_POST['con_srv']) ? $_POST['con_srv'] : '';
$con_authKey1 = isset($_POST['authKey1']) ? $_POST['authKey1'] : '';
$con_authKey2 = isset($_POST['authKey2']) ? $_POST['authKey2'] : '';
$con_authKey3 = isset($_POST['authKey3']) ? $_POST['authKey3'] : '';

echo '<br>';
echo $con_user;
echo '<br>';
echo $con_file;
echo '<br>';
echo $con_srv;
echo '<br>';
echo $con_authKey1;
echo '<br>';
echo $con_authKey2;
echo '<br>';
echo $con_authKey3;