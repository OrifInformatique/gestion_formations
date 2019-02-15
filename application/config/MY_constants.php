<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| CUSTOM CONSTANTS
|--------------------------------------------------------------------------
|
| These are constants defined specially for this application.
|
| Add line "include'MY_constants.php';" in constants.php to load these
*/
/*
|--------------------------------------------------------------------------
| My application constants
|--------------------------------------------------------------------------
*/
defined('PASSWORD_MIN_LENGTH') OR define('PASSWORD_MIN_LENGTH', 6);
defined('USERNAME_MIN_LENGTH') OR define('USERNAME_MIN_LENGTH', 2);
/*
|--------------------------------------------------------------------------
| Access levels
|--------------------------------------------------------------------------
*/
define('ACCESS_LVL_GUEST', 1);
define('ACCESS_LVL_REGISTERED', 2);
define('ACCESS_LVL_ADMIN', 4);