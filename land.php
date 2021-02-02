<?php
    include __DIR__.'./controller/LandController.php';

    $controller = new LandController();
    
    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            if(isset($_GET['id'])){
                //$controller->getById($_GET['id']); die();             
            }else if(isset($_GET['id_zone']) && isset($_GET['state']) ){
                $controller->getByIdZoneAndState($_GET['id_zone'], $_GET['state']); die();                            
            }else{
                $controller->getAll(); die(); 
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

