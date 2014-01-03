<?php
/**
 * Created by PhpStorm.
 * User: Aaron
 * Date: 12/24/13
 * Time: 2:16 PM
 */

require 'Slim/Slim.php';
require 'database.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$sqlCon = new SQL();

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$app->get('/morph/card/:id', function ($id) use ($app) {
    global $sqlCon;
    $sql = "SELECT * FROM cards WHERE idCard=".$id;
    $result = $sqlCon->getSelectQuery($sql);
    //echo json_encode();
    $app->render("card.php", array('id' => $id, 'results' => json_encode($result)));
});

$app->post('morph/give/:id/give/:user', function ($id, $user) {
    global $sqlCon;
    $sql = "INSERT INTO owned (users_id, cards_idCard) VALUES ('".$user."', '".$id."')";
    echo json_encode($sqlCon->getInsertQuery($sql));
});

$app->run();