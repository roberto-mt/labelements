<?php

	$errors = array();

	// Check if name has been entered
	if (!isset($_POST['customer_name'])) {
		$errors['customer_name'] = 'Please enter your name';
	}

	// Check if email has been entered and is valid
	if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Please enter a valid email address';
	}

	//Check if inquiry_message has been entered
	if (!isset($_POST['inquiry_message'])) {
		$errors['inquiry_message'] = 'Please enter your message';
	}

	$errorOutput = '';

	if(!empty($errors)){

		$errorOutput .= '<div class="alert alert-danger alert-dismissible" role="alert">';
 		$errorOutput .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

		$errorOutput  .= '<ul>';

		foreach ($errors as $key => $value) {
			$errorOutput .= '<li>'.$value.'</li>';
		}

		$errorOutput .= '</ul>';
		$errorOutput .= '</div>';

		echo $errorOutput;
		die();
	}


	$customer_name = $_POST['customer_name'];
	$email = $_POST['email'];
	$inquiry_message = $_POST['inquiry_message'];

    require_once '../conn/config.php';
    session_start();

    $stmt = $pdo->prepare("INSERT INTO contact_us (customer_name, email, inquiry_message) VALUES(:customer_name, :email, :inquiry_message)");
    $stmt->bindParam(':customer_name', $customer_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':inquiry_message', $inquiry_message);
    // $stmt->execute();
	
	if ($stmt->execute()) {
		echo "Your message was submitted successfully!";
	} else {
		echo "Error: " . $stmt->errorInfo();
	}

    $pdo = null;
    exit();
?>