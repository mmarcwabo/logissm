<?php

//Produit_model

class Produit_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function create($data) {
        //Inserting data from form in the database
        $this->db->insert('Produit', ['denomination' => $data['denomination'],
            'prix' => $data['prix'], 'description' => $data['description']
            ]);
        //Redirect to the view that sent the request to avoid data duplication on error
        header('location:'.URL.'produit');
    }

    public function showProduitList() {
        return $this->db->select("SELECT * FROM produit");
    }

    /**
     * showAttributeOfProduitList - Get lists for comboboxes and select html tags
     * @param string $attribute the table field we want to list
     */
    public function showAttributeOfProduitList($attribute) {
        return $this->db->select("SELECT ".$attribute." FROM produit");
    }

    public function showSingleList($id) {
        return $this->db->select("SELECT * FROM produit WHERE idproduit= :id", array(":id" => $id));
    }

    /**
     * editProduit - Saves the data edition to the database
     * @param array $data values to save to database
     */
    public function editProduit($data) {
        $this->db->update("Produit", ['denomination' => $data['denomination'],
        'prix' => $data['prix'], 'description' => $data['description']]
        , "`idproduit` = {$data['idproduit']}");
    }

    /**
     * deleteUser -
     * @param Integer $id
     * @return boolean
     */
    public function deleteUser($id) {
        $result = $this->db->select("SELECT * FROM utilisateur WHERE idutilisateurs= :id", array(":id" => $id));
        if ($result[0]['roleutilisateur'] == 'Administrateur') {
            return false;
        }
        $this->db->delete("utilisateur", "idutilisateurs= '$id'");
    }

    /**
    * getServicesOf
    * @param String $category - Category name
    * @return array() -
    */
    public function getServicesOf($category){
      return $this->db->select("SELECT * FROM produit WHERE titre= :titre", array(":titre" => $category));
    }

}