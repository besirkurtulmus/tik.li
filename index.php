<?php

include('./lib.php');
include('./api.php');

if(isset($_GET['l'])){
    // If it gets an id, serve it using an the api
    $url = './api.php';
/*
    $data = array(
        'l' => $_GET['l']
    );

    $options = array(
        'http' => array(
            'header' => 'Content-type: application/json; charset=UTF-8\r\n',
            'method' => 'POST',
            'content' => ''
        )
    );*/
}else if(isset($_GET['i'])){
    $api = new Api();

    header('Location: ' . $api->getLink($_GET['i']));
}else{
    $app->run();
}
