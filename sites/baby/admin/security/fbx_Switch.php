<?PHP
session_start();
switch($Fusebox["fuseaction"]) {

	case 'home':
		print "<h1>Login</h1>";
		$XFA['validatelogin'] = "login.login";
		include ('dsp_home.php');
	break;

	case 'adduser':
		ValidateUser();
		print "<h1>Add New User</h1>";
		$XFA['insertuser'] = "login.insertuser";
		include ('dsp_addnewuser.php');
	break;

	case 'login':
		CreateLoginSession($sqlDbConnection, $attributes['Username'], $attributes['Password']);
		print ("<script language='javascript'>window.location='index.php?fuseaction=baby.home';</script>");
	break;

	case 'logout':
		Logoff();
		print ("<script language='javascript'>window.location='index.php?fuseaction=login.home';</script>");
	break;

	case 'insertuser':
		ValidateUser();
		AddUser($sqlDbConnection, $attributes['Username'], $attributes['Password']);
	break;

	default:
		print "I received a fuseaction called <b>'" . $Fusebox["fuseaction"] . "'</b> that circuit <b>'" . $Fusebox["circuit"] . "'</b> does not have a handler for.";
	break;
}
?>