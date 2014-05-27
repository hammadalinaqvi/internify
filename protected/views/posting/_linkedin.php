<?php
// Change these
define('API_KEY',      'q85si84q2vqp');
define('API_SECRET',   'fa3EWc3688fk1Nvt');
define('REDIRECT_URI', 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'].'/posting/linkedin');
define('SCOPE',        'r_basicprofile r_fullprofile r_emailaddress r_contactinfo');

// You'll probably use a database
session_name('linkedin');
session_start();

// OAuth 2 Control Flow
if (isset($_GET['error'])) {
	// LinkedIn returned an error
	print $_GET['error'] . ': ' . $_GET['error_description'];
	exit;
}

elseif (isset($_GET['code'])) {
	// User authorized your application
	if ($_SESSION['state'] == $_GET['state']) {
		// Get token so you can make API calls
		getAccessToken();
	}
	else {
		// CSRF attack? Or did you mix up your states?
		exit;
	}
}

else { 
	if ((empty($_SESSION['expires_at'])) || (time() > $_SESSION['expires_at'])) {
		// Token has expired, clear the state
		$_SESSION = array();
	}
	if (empty($_SESSION['access_token'])) {
		// Start authorization process
		getAuthorizationCode();
	}
}

// Congratulations! You have a valid token. Now fetch your profile 
$linkedin_id = fetch('GET', '/v1/people/~/id');
$email = fetch('GET', '/v1/people/~/email-address'); 
$bio_data = fetch('GET', '/v1/people/~:(firstName,lastName)');
$education_all = fetch('GET', '/v1/people/~/educations');
$picture = fetch('GET', '/v1/people/~/picture-url');

$first_name = $bio_data->firstName;
$last_name = $bio_data->lastName;

/*echo "<pre>";
print_r($email);
print_r($bio_data);
print_r($education_all->_total);
exit;
*/

if($education_all->_total > 0) {
//print_r($education_all->values[0]);


if (array_key_exists('degree', $education_all->values[0])) { $degree = $education_all->values[0]->degree; } else { $degree = "" ; }
if (array_key_exists('fieldOfStudy', $education_all->values[0])) { $field_of_study = $education_all->values[0]->fieldOfStudy; } else { $field_of_study = "" ; }
if (array_key_exists('schoolName', $education_all->values[0])) { $school = $education_all->values[0]->schoolName; } else { $school = "Institute Here" ; }
if (array_key_exists('endDate', $education_all->values[0])) { $graduation_date = $education_all->values[0]->endDate->year; } else { $graduation_date = "Year Here" ; }

	$this->redirect('internship?linkedin_id='.$linkedin_id.'&first_name='.$first_name.'&last_name='.$last_name.'&picture='.$picture.'&degree='.$degree.'&field_of_study='.$field_of_study.'&school='.$school.'&graduation_date='.$graduation_date.'&email='.$email);

}

else {
	$this->redirect('internship?linkedin_id='.$linkedin_id.'&first_name='.$first_name.'&last_name='.$last_name.'&picture='.$picture.'&email='.$email);
	
	}

//print_r($picture);
//exit;



exit; // INTENTIONALLY WRITTEN HERE

function getAuthorizationCode() {
	$params = array('response_type' => 'code',
					'client_id' => API_KEY,
					'scope' => SCOPE,
					'state' => uniqid('', true), // unique long string
					'redirect_uri' => REDIRECT_URI,
			  );

	// Authentication request
	$url = 'https://www.linkedin.com/uas/oauth2/authorization?' . http_build_query($params);
	
	// Needed to identify request when it returns to us
	$_SESSION['state'] = $params['state'];

	// Redirect user to authenticate
	header("Location: $url");
	exit;
}
	
function getAccessToken() {
	$params = array('grant_type' => 'authorization_code',
					'client_id' => API_KEY,
					'client_secret' => API_SECRET,
					'code' => $_GET['code'],
					'redirect_uri' => REDIRECT_URI,
			  );
	
	// Access Token request
	$url = 'https://www.linkedin.com/uas/oauth2/accessToken?' . http_build_query($params);
	
	// Tell streams to make a POST request
	$context = stream_context_create(
					array('http' => 
						array('method' => 'POST',
	                    )
	                )
	            );

	// Retrieve access token information
	$response = file_get_contents($url, false, $context);

	// Native PHP object, please
	$token = json_decode($response);

	// Store access token and expiration time
	$_SESSION['access_token'] = $token->access_token; // guard this! 
	$_SESSION['expires_in']   = $token->expires_in; // relative time (in seconds)
	$_SESSION['expires_at']   = time() + $_SESSION['expires_in']; // absolute time
	
	return true;
}

function fetch($method, $resource, $body = '') {
	$params = array('oauth2_access_token' => $_SESSION['access_token'],
					'format' => 'json',
			  );
	
	// Need to use HTTPS
	$url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
	// Tell streams to make a (GET, POST, PUT, or DELETE) request
	$context = stream_context_create(
					array('http' => 
						array('method' => $method,
	                    )
	                )
	            );


	// Hocus Pocus
	$response = file_get_contents($url, false, $context);

	// Native PHP object, please
	return json_decode($response);
}
	?>