<?php

// Import the application classes
require_once('include/classes.php');

// Create an instance of the Application class
$app = new Application();
$app->setup();

// Declare a set of variables to hold the username and password for the user
$username = "";
$password = "";

// Declare an empty array of error messages
$errors = array();

// If someone has clicked their email validation link, then process the request
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

	if (isset($_GET['id'])) {

		$success = $app->processEmailValidation($_GET['id'], $errors);
		if ($success) {
			$message = "Email address validated. You may login.";
		}

	}

}

// If someone is attempting to login, process their request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Pull the username and password from the <form> POST
	$username = $_POST['username'];
	$password = $_POST['password'];

	// Attempt to login the user and capture the result flag
	$result = $app->login($username, $password, $errors);

	// Check to see if the login attempt succeeded
	if ($result == TRUE) {

		// Redirect the user to the topics page on success
		header("Location: recipes.php");
		exit();

	}

}

if (isset($_GET['register']) && $_GET['register']== 'success') {
	$message = "Registration successful. Please check your email. A message has been sent to validate your address.";
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Feed Me</title>
	<meta name="description" content="Chidera's Web App for IT 5233">
	<meta name="author" content="Chidera Obinali">
	<link rel="stylesheet" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<!--1. Display Errors if any exists
	2. Display Login form (sticky):  Username and Password -->

<body>
			<?php include 'include/header.php';
			include 'include/bg.php'; ?>
<div class="section group">
	<div class="col span_1_of_2">

		</div>
		<div class="col span_1_of_2">
				<img src="css/images/logo_full_lat_a.png" alt="Food Pantry Logo" class="center" id="logo">
				<br/>
					<div class="center">
				<h2>Login</h2>
				<?php include('include/messages.php'); ?>
	<div>
				<form method="post" action="login.php">

					<input type="text" name="username" id="username" placeholder="Username" onclick="doPageLoad()" value="<?php echo $username; ?>" />
					<br/>

					<input type="password" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
					<br/>

					<input type="submit" value="Login" name="login" />
				</form>
			</div>
		Remember my username <input type="checkbox" name="saveUsername" class="saveUser" id="saveLocal" onclick="doSubmit()" />
			<br/>
			<a href="register.php">Need to create an account?</a>
			<br/>
			<a href="reset.php">Forgot your password?</a>
						<?php include 'include/footer.php'; ?>
		</div>
	</div>
</div>
	<script src="js/site.js"></script>
	<script src="js/saveUser.js"></script>

</body>
</html>
