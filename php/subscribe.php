<?php

	// MailChimp
	// $APIKey = '53bb3bcad3947b9c5b45884b439097f4-us3';
	// $listID = 'fd1b8baf3f';

	$email   = $_POST['email'];
	$name   = $_POST['name'];
	$count   = $_POST['count'];

	$data_array = array('name' => $name, 'email' => $email, 'count' => $count );


	require_once('inc/callApi.php');

	// $api = new MCAPI($APIKey);
	// $list_id = $listID;

	// if($api->listSubscribe($list_id, $email) === true) {
	// 	$sendstatus = 1;
	// 	$message = '<div class="alert alert-success subscription-success" role="alert"><strong>Success!</strong> Check your email to confirm sign up.</div>';
	// } else {
	// 	$sendstatus = 0;
	// 	$message = '<div class="alert alert-danger subscription-error" role="alert"><strong>Error:</strong> ' . $api->errorMessage.'</div>';
	// }

	// $result = array(
	// 	'sendstatus' => $sendstatus,
	// 	'message' => $message
	// );

	$call = callApi('POST', 'http://localhost:3030', json_encode($data_array));
	$response = json_decode($call, true);
	$errors   = $response['response']['errors'];
	$data     = $response['response']['data'][0];

	if ($errors) {
	$sendstatus = 0;
	$message = '<div class="alert alert-danger subscription-error" role="alert"><strong>Error:</strong> ' . $errors.'</div>';
	} else {
 	$sendstatus = 1;
 	$message = '<div class="alert alert-success subscription-success" role="alert"><strong>Succes!</strong> Je inschrijving werd goed ontvangen!.</div>';
	}

	$result = array(
		'sendstatus' => $sendstatus,
		'message' => $message
	);

	echo json_encode($result);

?>