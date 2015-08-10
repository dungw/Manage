<?php
$serverIp = '14.162.203.188';

error_reporting(E_ALL);

/* Get the port for the WWW service. */
//$service_port = getservbyname('www', 'tcp');
$service_port = 31337;

/* Get the IP address for the target host. */
//$address = gethostbyname('www.example.com');
$address = $serverIp;

/* Create a TCP/IP socket. */
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
}

$result = socket_connect($socket, $address, $service_port);
if ($result === false) {
    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
}

$in = '533db2&TR01&alarm&khong co internet';

socket_write($socket, $in, strlen($in));
$bytes = socket_recv($socket, $buf, 2048, MSG_WAITALL);

//$buf = 'This is my buffer.';
//if (false !== ($bytes = socket_recv($socket, $buf, 2048, MSG_WAITALL))) {
//    echo "Read $bytes bytes from socket_recv(). Closing socket...\n";
//} else {
//    echo "socket_recv() failed; reason: " . socket_strerror(socket_last_error($socket)) . "\n";
//}

socket_close($socket);

echo $buf . "\n";
echo "OK.\n\n";