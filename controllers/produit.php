<?php

/**
 * 
 */

class Produit extends Controller {

    function __construct() {
        parent::__construct();
        //Model instantiation
        //JS files for this controller

    }

    function index() {
        $this->view->title = "Produit";
        $this->view->js = array(
            "scripts/js/main.js",
            "scripts/js/produit.js"
        );
        //Display Produits' list before render it on the page
        $this->showProduitList();
        //Render the dashboard view here
        $this->view->render("produit/index", $content = true, $sidebar = true, $navbar =true);
    }

    public function create() {
        require 'libs/Form.php';
        require 'libs/Val.php';
        //Getting data from form
        //$data = null;
        $form = new Form();
        try {
            $form->post('denomination')
                ->post('prix')
                ->post('description');
            $form->submit();
            //echo "the form passed";
            $data = $form->fetch();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        //Real insert here
        $this->model->create($data);
        //Refresh the products list before render it on the page
        $this->showProduitList();
        $this->view->render("produit/index");
    }

    public function edit($id) {

        $this->view->title = "Modifier produit";
        $this->view->produit = $this->model->showSingleList($id);
        $this->view->render('produit/edit');
    }

    public function editSave($id) {

        require 'libs/Form.php';
        require 'libs/Val.php';
        //Getting data from form
        //$data = null;
        $form = new Form();
        try {
            $form->post('denomination')
                 ->post('prix')
                 ->post('description');
            $form->submit();
            //echo "the form passed";
            $data = $form->fetch();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        //Getting the user id here
        $data['idproduit'] = 1;//Get the coordonnee id from database

        // @TODO: Do your error checking!

        $this->model->editSave($data);
        header('location: ' . URL . 'produit');
    }

    public function delete($id) {

    }

    public function show() {

    }

    public function showProduitList() {
        //Showing all the Produits
        //Sending list of Produits on the view
        $this->view->listOfProduit = $this->model->showProduitList();
    }

    public function showAttributeOfProduitList($attribute) {
        $this->view->produitNameList = $this->model->showAttributeOfProduitList($attribute);
    }

    public function showSingleList($id) {
        $model = new Produit_Model();
        print_r($model->showSingleList($id));
    }

    public function deleteProduit($id) {
        $model = new Produit_Model();
        $model->deleteProduit($id);
        print_r($model->showProduitList());
    }

    /**/
    public function getservicesof($category){
      $this->view->servicesOfCategory = $this->model->getServicesOf($category);
      //Render all the service of $category
      $this->view->render("Produit/index");
    }
}