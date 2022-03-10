<?php
/*
Error controller

*/

class AnError extends Controller {

    function __construct(){
        parent::__construct();
        //Displaying an error message
        //echo "<br/>Error, file <b>".$arg."</b> not found :-(";    
        //$this->index();
        
    }

    //defaultly loaded function
    function index($arg=false){
        //Extracting the page name to display an error message
        $page = explode("/",rtrim($arg, ".php"))[0];
        //echo $page;
        $this->view->title = "Ressource non trouvée";
        $this->view->message = "La page <b>".$page."</b> est introuvable.";
        $this->view->render("error/index", "");

        exit;
    }

}