<?php

Route::get('/', function (Request $request) {
    $ip_address = gethostbyname("www.google.com");  
    echo "IP Address of Google is - ".$ip_address;  
    echo "</br>";  
    $ip_address = gethostbyname("www.javatpoint.com");  
    echo "IP Address of javaTpoint is - ".$ip_address;  
});