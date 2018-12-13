<?php
/** CONFIGURATION SETUP START **/
ini_set('display_errors',1);
ini_set('default_charset', 'UTF-8');

session_start();

// Google OAuth Setup
$OAUTH2_CLIENT_ID = 'OAUTH2 CLIENT ID';
$OAUTH2_CLIENT_SECRET = 'OAUTH2 CLIENT SECRET';

// Database Setup
// Change the following to setup for database
$db = mysqli_connect('DB SERVER','DB ACCOUNT','DB PASSWORD','DB NAME');
if (!$db) {
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    die("Error: Unable to connect to MySQL.");
}

// Menus
$MENUS = array(
	'JUDGE_DEFAULT' => array(
		'Contests' => '/',
		'Create Contest' => '/editContest',
		'Logout' => '/auth' 
	),
	'JUDGE_CONTEST' => array(
		'ScoreBoard' => '/',
		'Submissions' => '/submissions',
		'Questions' => '/questions',
		'Edit' => '/editContest',
		'Exit' => '/?contest=exit',
		'Logout' => '/auth'
	),
	'PARTICIPANT' => array(
		'ScoreBoard' => '/',
		'Questions' => '/questions',
		'Submissions' => '/submissions',
		'Logout' => '/auth'
	)
);

/** CONFIGURATION SETUP END **/

// Remove extension and set index if not set
$REQUEST_CODE = ( empty($_GET['page']) ? "index" : str_replace('/','',explode(".",$_GET['page'])[0]) );

// Direct access to login or logout
if($REQUEST_CODE == 'auth') $PAGE_PATH = 'pages/auth.php';
else $PAGE_PATH = 'pages/' . $_SESSION['ROLE'] . '/' . $REQUEST_CODE . '.php';

// open requested page if exists
if(file_exists($PAGE_PATH)) require($PAGE_PATH);
else http_response_code(410);

function show_header($title,$menu_select=NULL){
	global $MENUS;
?>
<!DOCTYPE html>
<html>
<head>
	<title><?= htmlentities($title) ?> - IQAC</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Content-Language" content="en-US">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/assets/pure-min.css">
	<link rel="stylesheet" href="/assets/grids-responsive-min.css">
	<link rel="stylesheet" href="/assets/style.css">
	<link rel="stylesheet" href="/assets/pell.min.css">
</head>
<body>
	<div class="menu-wrapper pure-menu pure-menu-horizontal">
		<a href="/" class="pure-menu-heading pure-menu-link"><?= htmlentities($title) ?></a>
		<ul class="pure-menu-list">
<?php
if(isset($_SESSION['MENU'])){
	foreach($MENUS[$_SESSION['MENU']] as $text => $url){
		echo '<li class="pure-menu-item '.($menu_select == $text ? 'pure pure-menu-selected' : '' ).'"><a href="'.$url.'" class="pure-menu-link">'.$text.'</a></li>';
	}
}
?>
		</ul>
	</div>
<?
}

function show_footer(){
?>
<script src="/assets/ui.js"></script>
</body>
</html>
<?php
}
?>