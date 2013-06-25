<?php

/*
{
    "apids": [
        "some APID",
        "another APID"
    ],
    "aliases": ["my_alias"],
    "tags": ["tag1", "tag2"],
    "android": {
         "alert": "Hello from Urban Airship!",
         "extra": {"a_key":"a_value"}
    }
}
*/

define('APPKEY','eY8zjzbcTtea8McPhVTSpA');  // this is your application key
define('PUSHSECRET', 'yNY-H6TkRTaWV_kqPKQdKg'); //  this is your master secret
define('PUSHURL', 'https://go.urbanairship.com/api/push/');

$alert = "Hello ";

// Setting up the android field
$android = array();
$android['alert'] = $alert;
// $android['extra'] = $extra;

// Setting up the entire object
$push = array();
$push['android'] = $android;
$push['apids'] = array("74d0ec32-93f6-48cc-ac26-4567db3fea3b");

$json = json_encode($push);

$session = curl_init(PUSHURL);
curl_setopt($session, CURLOPT_USERPWD, APPKEY . ':' . PUSHSECRET);
curl_setopt($session, CURLOPT_POST, True);
curl_setopt($session, CURLOPT_POSTFIELDS, $json);
curl_setopt($session, CURLOPT_HEADER, False);
curl_setopt($session, CURLOPT_RETURNTRANSFER, True);
curl_setopt($session, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
$content = curl_exec($session);

$response = curl_getinfo($session);
if($response['http_code'] != 200)
{
    echo "Server returned some error with http code: ".
        $response['http_code'] . "\n";
}
else
{

    echo "Sweet success";
}

curl_close($session);

?>