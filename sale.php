<?php
    include __DIR__.'./controller/SaleController.php';

    $controller = new SaleController();
    
    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            if(isset($_GET['id'])){
                $controller->getById($_GET['id']);                
            }else{
                $controller->getAll();
            }                        
            break;
        case 'POST':            
            $_POST = json_decode(file_get_contents('php://input'), true);
            $controller->add($_POST);
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

