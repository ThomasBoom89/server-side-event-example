<?php

// headers
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header("Connection: keep-alive");

// if you have problems with CORS uncomment this line to allow access
header('Access-Control-Allow-Origin: *');

// to demonstrate different attributes, generating a random number
$number = rand(0, 2);

switch ($number) {
    case 0:
        echo 'data: this is a normal message with random number: ' . rand(0, 1000);
        break;
    case 1:
        // current time to see changes at the frontend
        $dateTime = new DateTime();
        $time = $dateTime->format('d.m.Y H:i:s');
        echo 'event: time';
        echo PHP_EOL;
        echo 'data: {"text": "this is a specific declared event at: ", "time": "' . $time . '"}';
        break;
    case 2:
        $retry = rand(1, 7);
        echo 'event: setReconnect';
        echo PHP_EOL;
        echo 'data: reconnect time set to ' . $retry . ' seconds';
        echo PHP_EOL;
        echo 'retry: ' . $retry * 1000 . '';
        break;
}

// two PHP_EOL/\n will send the message
echo PHP_EOL;
echo PHP_EOL;

ob_end_flush();
flush();