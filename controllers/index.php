<?php

/*
Index controller

*/

class Index extends Controller{

    function __construct(){
        parent::__construct();
        //JS files for this controller
        $this->view->js=array(
          "scripts/js/main.js",
          "scripts/js/service.js"
        );

    }

    function index(){
        $this->view->title = "Logis - Stock Manager";
        $this->listAttributeOfProduit("denomination");
        //Render the dashboard view here
        $this->view->render("index/index");
    }

    public function listAttributeOfProduit($attribute) {
        require_once 'models/produit_model.php';
        $model = new Produit_Model();
        /*$this->view->paysNameList = Model::listItemFromDbTable("pays", "nom");
        $this->view->paysIdFromVilleList = Model::listItemFromDbTable("ville", "pays_idpays");
        $this->view->villeNameList = Model::listItemFromDbTable("ville", "nom");*/
    }
}
