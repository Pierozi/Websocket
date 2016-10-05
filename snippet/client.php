 <?php
 
 require_once(dirname(__DIR__)
     . DIRECTORY_SEPARATOR . 'vendor'
     . DIRECTORY_SEPARATOR . 'autoload.php');
 
 
 $Context = \Hoa\Stream\Context::getInstance('SnippetTLS');
 $Context->setOptions([
     'ssl' => [
		'allow_self_signed' => true,
		'verify_peer'       => false,
		'verify_peer_name'  => false,
     ]
 ]);
 
// -------------------------------

$readline = new Hoa\Console\Readline\Readline();
$client   = new Hoa\Websocket\Client(
    new Hoa\Socket\Client('wss://127.0.0.1:8889', 30, -1, 'SnippetTLS')
);
$client->setHost('localhost');
$client->connect();

do {

    $line = $readline->readLine('> ');

    if(false === $line || 'quit' === $line)
        break;

    $client->send($line);

} while(true);
