<?php

require_once(dirname(__DIR__)
    . DIRECTORY_SEPARATOR . 'vendor'
    . DIRECTORY_SEPARATOR . 'autoload.php');


$Context = \Hoa\Stream\Context::getInstance('SnippetTLS');
$Context->setOptions([
    'ssl' => [
        'local_cert' => __DIR__ . DIRECTORY_SEPARATOR . 'cert' . DIRECTORY_SEPARATOR . 'cert.pem',
    ]
]);

// -------------------------------

$websocket = new Hoa\Websocket\Server(
    new Hoa\Socket\Server('wss://127.0.0.1:8889', 30, -1, 'SnippetTLS')
    //new Hoa\Socket\Server('ws://127.0.0.1:8889')
);
$websocket->on('open', function (Hoa\Event\Bucket $bucket) {
    echo 'new connection', "\n";

    return;
});
$websocket->on('message', function (Hoa\Event\Bucket $bucket) {
    $data = $bucket->getData();
    echo '> message ', $data['message'], "\n";
    $bucket->getSource()->send($data['message']);
    echo '< echo', "\n";

    return;
});
$websocket->on('close', function (Hoa\Event\Bucket $bucket) {
    echo 'connection closed', "\n";

    return;
});
$websocket->run();
