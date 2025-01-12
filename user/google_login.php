<?php
$clientId = '234589116240-ahqd0f91morqrgo62no2k2sb8m3ov96o.apps.googleusercontent.com';
$directUrl = urlencode('http://phithienmon.net/user/google_auth/');
header("location: http://accounts.google.com/o/oauth2/auth?response_type=code&redirect_uri={$directUrl}&client_id={$clientId}&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email&access_type=offline&approval_prompt=force");
