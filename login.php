<?php 
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

$error_msg = "";
if(isset($_POST['email']) && isset($_POST['passwort'])) {
	$email = $_POST['email'];
	$passwort = $_POST['passwort'];

	$statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
	$result = $statement->execute(array('email' => $email));
	$user = $statement->fetch();

	//Überprüfung des Passworts
	if ($user !== false && password_verify($passwort, $user['passwort'])) {
		$_SESSION['userid'] = $user['id'];

		//Möchte der Nutzer angemeldet beleiben?
		if(isset($_POST['angemeldet_bleiben'])) {
			$identifier = random_string();
			$securitytoken = random_string();
				
			$insert = $pdo->prepare("INSERT INTO securitytokens (user_id, identifier, securitytoken) VALUES (:user_id, :identifier, :securitytoken)");
			$insert->execute(array('user_id' => $user['id'], 'identifier' => $identifier, 'securitytoken' => sha1($securitytoken)));
			setcookie("identifier",$identifier,time()+(3600*24*365)); //Valid for 1 year
			setcookie("securitytoken",$securitytoken,time()+(3600*24*365)); //Valid for 1 year
		}

		header("location: dashboard/internal.php");
		exit;
	} else {
		$error_msg =  "E-Mail oder Passwort war ungültig";
	}

}


$email_value = "";
if(isset($_POST['email']))
	$email_value = htmlentities($_POST['email']); 

include("templates/header.inc.php");
?>
<form action="login.php" method="post">
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a><b>Rox</b><a id=textinhalt></a>
  </div>
	
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">
		Bitte zu erst Einloggen!!
		<?php 
if(isset($error_msg) && !empty($error_msg)) {
	echo $error_msg;
}
?></p>

    
      <div class="form-group has-feedback">
		  <label for="inputEmail" class="sr-only">E-Mail</label>
	<input type="email" name="email" id="inputEmail" class="form-control" placeholder="E-Mail" value="<?php echo $email_value; ?>" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label for="inputPassword" class="sr-only">Passwort</label>
		 <input type="password" name="passwort" id="inputPassword" class="form-control" placeholder="Passwort" required>
		  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
           
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
		  </div>
        <!-- /.col -->
      </div>
    </form>
	  <?php 
include("templates/footer.inc.php")
?>

    
<!-- /.login-box -->

