<?php
require '../vendor/autoload.php';

use BraspagSplit\Auth\API\Environment;
use BraspagSplit\Auth\API\BraspagAuth;
use BraspagSplit\Auth\API\Auth;

$environment = Environment::sandbox();

// Configure o Objeto de Autenticação
$id = 'e5861a00-5ed2-4928-b73b-a37c89aa9370';
$key = 'KKRt8N4elSspkntWkgJhlSeaks8wbSXL4fYxQPoUOis=';
$auth = new Auth($id, $key);

try {
    // Obtenha o Token de Acesso para a API SPLIT da Braspag
    $access_token = (new BraspagAuth($environment))->createAuthToken($auth);

    print_r($access_token);
} catch (BraspagRequestException $e) {
    print_r($e);
}

