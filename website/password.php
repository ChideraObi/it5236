<?php

// Import the application classes
require_once('include/classes.php');

// Create an instance of the Application class
$app = new Application();
$app->setup();

$errors = array();
$messages = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

	$passwordrequestid = $_GET['id'];

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Grab or initialize the input values
	$password = $_POST['password'];
	$passwordrequestid = $_POST['passwordrequestid'];

	// Request a password reset email message
	$app->updatePassword($password, $passwordrequestid, $errors);

	if (sizeof($errors) == 0) {
		$message = "Password updated";
	}

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
<body>
	<script src="js/site.js"></script>
	<?php include 'include/header.php'; ?>
<div class="section group">
	<main id="wrapper">
		<div class="col span_1_of_2">

		</div>
		<div class="col span_1_of_2">
				<img src="css/images/logo_full_lat_a.png" alt="Food Pantry Logo" class="center" id="logo">
				<br/>
					<div class="center">
			<h2>Reset Password</h2>
			<?php include('include/messages.php'); ?>
			<form method="post" action="password.php">
				New password:
				<input type="password" name="password" id="password" required="required" size="40" />
				<input type="submit" value="Submit" />
				<input type="hidden" name="passwordrequestid" id="passwordrequestid" value="<?php echo $passwordrequestid; ?>" />
			</form>
		</div>
		</div>
	</main>
</div>
	<?php include 'include/footer.php'; ?>
</body>
</html>
