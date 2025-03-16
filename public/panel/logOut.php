<?php
include_once '../../vendor/autoload.php';

use App\Admin\Auth;

Auth::logOut();

header('Location: /panel/login.php');
