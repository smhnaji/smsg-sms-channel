<?php

namespace Smhnaji;

require './nusoap.php';

class Smsg
{

private $username;
private $password;
private $from;

public function __construct($username, $password, $from)
{
    $this->username = $username;
    $this->password = $password;
    $this->from = $from;

    $this->handler = new soapclient_nu('http://s1.smsg.ir/webservice/?wsdl', 'wsdl');
}

public function send($message, $to)
{
    $params = [
        'username' => $this->username,
        'password' => $this->password,
        'from'     => $this->from,
        'message'  => $message,
        'to'       => $to,
    ];

    $result = $this->handler->call('send', $params);
    return isset($result['status']) ? $result['status'] : ['type' => 'error', 'body' => 'No status returned'];
}

}

