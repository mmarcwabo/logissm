<?php

#Class name : Service
#Purpose : Service controller
#Author : mwabo
#email : mwabo@exsofth.com

class Service extends Controller {

    function __construct() {
        parent::__construct();
        //Model instantiation
        //JS files for this controller
        $this->view->js = array(
            "scripts/js/main.js",
            "scripts/js/service.js"

        );
    }

    function index() {
        $this->view->title = "Service";
        //Drag attributes to list if needed
        //and drop them to the view
        $this->listAttributeOfCategorie("titre");
        $this->view->render("service/index");
    }

    public function create() {
        require 'libs/Form.php';
        require 'libs/Val.php';
        //Getting data from form
        //$data = null;
        $form = new Form();
        try {
            $form->post('denomination')
                ->post('telephone')
                ->post('adressemail')
                ->post('adresse')
                ->post('horairedisponibilite')
                ->post('pays')
                ->post('ville')
                ->post('nouvelleVille')
                ->post('details')
                ->post('categorie');
            $form->submit();
            //echo "the form passed";
            $data = $form->fetch();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        //Getting the user id here
        //Real insert here
        $this->model->create($data);
        $this->view->render("service/index");
    }

    public function edit($id) {

        $this->view->title = "Modifier categorie";
        $this->view->categorie = $this->model->categorieSingleList($id);

        $this->view->render('service/edit');
    }

    public function editSave($id) {

        require 'libs/Form.php';
        require 'libs/Val.php';
        //Getting data from form
        //$data = null;
        $form = new Form();
        try {
            $form->post('denomination')
                ->post('telephone')
                ->post('adressemail')
                ->post('adresse')
                ->post('horairedisponibilite')
                ->post('ville')
                ->post('details')
                ->post('categorie');
            $form->submit();
            //echoing something for debug purpose
            //echo "the form passed";
            $data = $form->fetch();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        //Getting the user id here
        $data['idcategorie'] = 1;//Get the coordonnee id from database

        // @TODO: Do your error checking!

        $this->model->editSave($data);
        header('location: ' . URL . 'service');
    }

    public function delete($id) {

    }

    public function show() {

    }

    public function listAttributeOfCategorie($attribute) {
        require_once 'models/categorie_model.php';
        $model = new Categorie_Model();
        $this->view->paysNameList = Model::listItemFromDbTable("pays", "nom");
        $this->view->paysIdFromVilleList = Model::listItemFromDbTable("ville", "pays_idpays");
        $this->view->villeNameList = Model::listItemFromDbTable("ville", "nom");
        $this->view->categorieNameList = $model->showAttributeOfCategorieList($attribute);
    }

    /**
    * getservicesfrom  -
    * @param String $town - Town name
    * @return array() - Render the view
    */
    public function getservicesfrom($town){
      $this->view->title ="(".count($this->model->getServicesFrom($town)).
                          ") Annuaire ".$town.
                          " : cyber café, coworking, parking et dépannage dans la ville";
      $this->view->paysNameList = Model::listItemFromDbTable("pays", "nom");
      $this->view->servicesFromTown = $this->model->getServicesFrom($town);
      $this->view->town_name = $town;
      //Services from town, by category
      $this->view->servicesFromTownByCategory = $this->model->countServicesPerCategory($town);
      $this->view->render("service/servicefromtown");
      //$this->model->getServicesFrom($country);
    }

    /**
    * parcategorie  -
    * @param String $ville - Town name
    * @param String $categorie - category name
    * @return array() - Return the services located in a town
    */
    public function parcategorie($ville, $categorie){

      //Classifying the town's services by category
      //$services_by_categories = array();
      //$index = 0;
      //echo "OK";
      //var_dump($all_services_of_town);
      $this->view->title =$categorie." à ".$ville. "(".count($this->model->getServicesFrom($ville)).")";
      $this->view->paysNameList = Model::listItemFromDbTable("pays", "nom");
      $this->view->paysNameList = Model::listItemFromDbTable("pays", "nom");
      $this->view->count_them = count($this->model->parcategorie($ville, $categorie));
      $this->view->services_by_categories = $this->model->parcategorie($ville, $categorie);
      $this->view->render("service/parcategorie");
      //return $services_by_categories;
    }
    /**
    * details  -
    * @param String $service - Service name
    * @return array() - Renders the details about the services
    */
    public function details($service){
      $this->view->title = "".$service;
      $this->view->render("service/details");
    }
    /**
    * parvilleetparpay  -
    * @param String $service - Service name
    * @return array() - Renders the details about the services
    */
    public function parvilleetparpay($ville){
      $this->view->title = "Service à".$ville;
      $this->view->count_them = count($this->model->parvilleetparpay($ville));
      $this->view->list_service_by_town = $this->model->parvilleetparpay($ville);
      $this->view->render("service/parville");

    }
    /**/
    public function showCategorieList() {

        print_r($model->showServiceList());
    }

    public function showSingleList($id) {
        $model = new Service_Model();
        print_r($model->showSingleList($id));
    }

    public function deleteCategorie($id) {
        $model = new Service_Model();
        $model->deleteService($id);
        print_r($model->showCategorieList());
    }

}
