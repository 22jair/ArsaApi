<?php
    include __DIR__.'./controller/ZoneController.php';

    $controller = new ZoneController();
    
    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            if(isset($_GET['id'])){
                $controller->getById($_GET['id']); die();  

            }else if(isset($_GET['id_land'])){
                $controller->getByIdLand($_GET['id_land']); die();   

            }else if(isset($_GET['lands'])){
                //retorna la lista de land pero con orderby number - para una tabla 
                $controller->getAllWithLands(false); die(); 

            }else if(isset($_GET['lands_mask'])){
                //retorna la lista de land pero con orderby mask_number - para el diseño 
                $controller->getAllWithLands(true); die(); 
            }
            else{
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

