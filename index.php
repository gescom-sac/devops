<?php
require_once __DIR__.'/vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Kachkaev\PHPR\RCore;
use Kachkaev\PHPR\Engine\CommandLineREngine;

$config = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$app = new \Slim\App($config);
$app->get('/hello/{name}', 'index');
$app->run();


function  index (Request $request, Response $response) {
    $name = $request->getAttribute('name');

	//$args = array();
	//$args['pathToErrorFile'] = 'D:/error.txt';
	//$r = new RCore(new CommandLineREngine('C:\Program Files\R\R-3.4.2\bin\R.exe',$args));

	$r = new RCore(new CommandLineREngine('/usr/bin/R'));
	
	$result = $r->run('a = 1
	b = 2
	a + b',true);
	//$response->withHeader('Content-Type','application/json');
	//$response->getBody()->write("Hello, $result");
	
	//$data = array('name' => 'Bob', 'age' => 40);
	//$newResponse = $response->withJson($data);

    //return $response;
	return $result[0];
};

/*
*TODO:
*
*D:\Apache2\htdocs\devops\vendor\bin\phpunit --bootstrap Email.php --testdox tests  
*D:\Apache2\htdocs\devops\vendor\bin\phpunit --bootstrap Email.php tests/EmailTest
*
*/
?>