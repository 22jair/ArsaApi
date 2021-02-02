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
        
            if(isset($_GET['_method'])){  
                // EDIT                                   
                if($_GET['_method'] == 'PUT'){                
                    $_POST = (array) json_decode($_POST["user"]);                
                    $file = null;                    
                    if(isset($_FILES['file'])) $file = $_FILES['file'];                    
                    $controller->update($_POST, $file);                                                    
                    die();
                }                                 
            }else{
                //POST - CREATE
                $_POST = (array) json_decode($_POST["user"]);                
                $file = null;
                if(isset($_FILES['file'])) $file = $_FILES['file'];
                $controller->add($_POST, $file);
            }
            
            break;      

        case 'DELETE':           
            $_DELETE = json_decode(file_get_contents('php://input'), true);
            $id_admin = '1';
            $controller->delete($_GET["id"], $id_admin);
            break;
    }

    function edit(){
        var_dump("EDITAMOS");
    }

    function delete(){
        var_dump("ELIMINAMOS");
    }

