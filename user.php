<?php
    include __DIR__.'./controller/UserController.php';

    $controller = new UserController();
    
    
    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            if(isset($_GET['id'])){
                $controller->getById($_GET['id']);  
                die();              
            }if(isset($_GET['dni'])){
                $controller->getByDNI($_GET['dni']);                
                die();
            }else{
                $controller->getAll();
                die();
            }                        
            break;
        case 'POST':            
            $_POST = json_decode(file_get_contents('php://input'), true);
            $controller->add($_POST);
            break;
        case 'PUT':
            $_PUT = json_decode(file_get_contents('php://input'), true);
            $controller->update($_PUT);
            break;
        case 'DELETE':           
            $_DELETE = json_decode(file_get_contents('php://input'), true);
            $id_admin = '1';
            $controller->delete($_GET["id"], $id_admin);
            break;
    }

