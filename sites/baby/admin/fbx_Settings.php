<?PHP
	session_start();

	// default variables
	$page = isset($attributes['page']) ? $attributes['page'] : 1;

	function MakeTableLogins($sqlDbConnection) {//create the logins table
		$sqlDbConnection->query("create table logins (user char(32), pasword char(32))") or die ("Failed to create table 'logins'");
	}

	function Encrypt($string) {//hash then encrypt a string
		$crypted = crypt(md5($string), md5($string));
		return $crypted;
	}

	function AddUser($sqlDbConnection, $username, $password) { //add user to table logins
		$password = encrypt($password);
		$username = encrypt($username);
		$sqlDbConnection->query("insert into logins values ('$username', '$password')") or die ("Failed to add user");
	}

	function Login($sqlDbConnection, $user, $password) { //attempt to login false if invalid true if correct
		$user = Encrypt($user);
		$result = $sqlDbConnection->query("select password from logins where user = '$user'") or die ("Failed to run login query");
		$pass = mysqli_fetch_row($result);
		$sqlDbConnection->close();
		return $pass[0] === (Encrypt($password));
	}

	function Logoff() {
		session_unset();
		session_destroy();
	}

	function CreateLoginSession($sqlDbConnection, $user, $password) {
		if ( Login($sqlDbConnection, $user, $password) ) {
			$_SESSION["LoggedIn"] = true;
		} else {
			$_SESSION["LoggedIn"] = false;
		}
	}

	function ValidateUser() {
		if ( !isset($_SESSION['LoggedIn']) ) {
			print ("<script language=javascript>window.location = 'index.php?fuseaction=login.home';</script>");
			die ("You do not have access to this page. <a href='index.php?fuseaction=login.home'>Login</a>.");
			Logoff();
		}
	}

	function isLoggedOn() {
		return isset($_SESSION['LoggedIn']);
	}

?>
