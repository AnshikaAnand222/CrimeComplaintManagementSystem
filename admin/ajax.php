<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}
if($action == 'update_account'){
	$save = $crud->update_account();
	if($save)
		echo $save;
}
if($action == "save_settings"){
	$save = $crud->save_settings();
	if($save)
		echo $save;
}
if($action == "save_page_img"){
	$save = $crud->save_page_img();
	if($save)
		echo $save;
}

if($action == "save_station"){
	$save = $crud->save_station();
	if($save)
		echo $save;
}
if($action == "delete_station"){
	$save = $crud->delete_station();
	if($save)
		echo $save;
}

if($action == "save_class"){
	$save = $crud->save_class();
	if($save)
		echo $save;
}
if($action == "delete_class"){
	$save = $crud->delete_class();
	if($save)
		echo $save;
}
if($action == "save_responder"){
	$save = $crud->save_responder();
	if($save)
		echo $save;
}
if($action == "delete_responder"){
	$save = $crud->delete_responder();
	if($save)
		echo $save;
}

if($action == "save_student"){
	$save = $crud->save_student();
	if($save)
		echo $save;
}
if($action == "delete_student"){
	$save = $crud->delete_student();
	if($save)
		echo $save;
}
if($action == "save_log"){
	$save = $crud->save_log();
	if($save)
		echo $save;
}
if($action == "verify"){
	$save = $crud->verify();
	if($save)
		echo $save;
}
if($action == "manage_complaint"){
	$save = $crud->manage_complaint();
	if($save)
		echo $save;
}
if($action == "complaint"){
	$save = $crud->complaint();
	if($save)
		echo $save;
}
ob_end_flush();
?>
