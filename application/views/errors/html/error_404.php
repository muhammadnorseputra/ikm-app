<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function url(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'] . '/ikm-app';
}
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>
<link rel="stylesheet" href="<?= url() ?>/assets/plugins/bootstrap-4/css/bootstrap.min.css">
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }
#main {
	height: 100vh;
}
</style>
</head>
<body>
	<div class="d-flex justify-content-center align-items-center flex-column" id="main">
	    <h1 class="align-top inline-block align-content-center"><?php echo $heading; ?></h1>
	    <div class="inline-block mt-3">
	    	<h2 class="font-weight-normal lead" id="desc"><?php echo $message; ?></h2>
	    </div>
	</div>
<script src="assets/plugins/bootstrap-4/js/bootstrap.bundle.min.js"></script>
</body>
</html>