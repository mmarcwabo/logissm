<?php

/*
Dashboard controller

*/

class Dashboard extends Controller{

    function __construct(){
        parent::__construct();
        //JS files for this controller
        $this->view->js=array(
          "scripts/js/main.js",
          "scripts/js/dashboard.js",
          "scripts/js/service.js"
        );
    }
    /**
     *
     */
    function index(){
        $this->view->title = "Tableau de Bord";
        //Instanciate service here
        /*require_once "service.php";
        $service = new Service();*/
        //Call a service method here
        $this->listAttributeOfCategorie("titre");
        //Render the dashboard view here
        $this->view->isactive = "active";
        $this->view->render("dashboard/index", $content = true, $sidebar = true, $navbar =true);
    }

    public function listAttributeOfCategorie($attribute) {
        require_once 'models/produit_model.php';
        $model = new Produit_Model();
        $this->view->paysNameList = Model::listItemFromDbTable("produit", "denomination");
        $this->view->paysIdFromVilleList = Model::listItemFromDbTable("produit", "denomination");
        $this->view->villeNameList = Model::listItemFromDbTable("produit", "denomination");
        //$this->view->categorieNameList = $model->showAttributeOfCategorieList($attribute);
    }

    function logout(){
        Session::destroy();
        header('location: ../login');
        exit;
    }

}
