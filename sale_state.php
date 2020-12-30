<?php
    include __DIR__.'./controller/SaleStateController.php';

    $controller = new SaleStateController();
    
    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            if(isset($_GET['id'])){
                $controller->getById($_GET['id']);                
            }else{
                $controller->getAll();
            }                        
            break;
        case 'POST':
            //do something
             //$_POST = json_decode(file_get_contents('php://input'), true);
            break;
        case 'PUT':
            //do something
                //estas varialbles no existen pero la creamos para llevar un order
                //$_PUT = json_decode(file_get_contents('php://input'), true);
            break;
        case 'DELETE':
            //do something
            //estas varialbles no existen pero la creamos para llevar un order
            //$_DELETE = json_decode(file_get_contents('php://input'), true);

            break;
    }

