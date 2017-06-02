<?php

/*
* Special Note: Currently the API cannot differentiate between a lead rejected due to server error or one rejected due to bad email address.
* The lead system requires email addresses that are correctly formatted to cut down on garbage accounts, and they need to have a valid MX record.
* Most 500 error from this method are a result of bad email addresses.
* In future versions we will differentiate the error and make the MX record requirement optional.
*/

    // access URL and request method
    $url = 'https://api.idxbroker.com/leads/lead';
    $apiKey = 'YourAPIKey';
    $method = 'PUT';

    // Note: The updatable fields need to be in a URL encoded, ampersand delineated query string format
    // and need to be supplied as PUT data.
    $data = array(
      'firstName' => 'IDX',
      'lastName' => 'Robot',
      'email' => 'IDXRobot@example.com'
    );
    $data = http_build_query($data); // encode and & delineate

    // headers (required and optional)
    $headers = array(
      'Content-Type: application/x-www-form-urlencoded', // required
      'accesskey: ' . $apiKey, // required - replace with your own
      'outputtype: json',
      'apiversion: 1.4.0'// optional - overrides the preferences in our API control page
    );
    // set up cURL
    $handle = curl_init();
      curl_setopt($handle, CURLOPT_URL, $url);
      curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($handle, CURLOPT_CUSTOMREQUEST, $method);
      // send the data
      curl_setopt($handle, CURLOPT_POSTFIELDS, $data);

// exec the cURL request and returned information. Store the returned HTTP code in $code for later reference
  $response = curl_exec($handle);
  $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
  if ($code >= 200 || $code < 300) {
      $response = json_decode(response,true);
    }
      else {
      $error = $code;
    }
?>
