<?php
//------- important -------
// touch .gitignore
// cat .gitignore app/db.php
// add this file to your .gitignore
//
// so we do NOT upload/publish our DB config to the cloud repository!
// I can this file in my cloud repo
//----------------------------
// constants for our DB configuration

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'login');
