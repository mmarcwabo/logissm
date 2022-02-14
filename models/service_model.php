<?php
//user_model

class Service_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * showAttributeOfCategorieList - Get lists for comboboxes and select html tags
     * @param string $attribute the table field we want to list
     */
    public function create($data) {
        //Inserting data from form in the database
        //If a new town has been created
        $nouvelleVille = isset($data['nouvelleVille']) ? $data['nouvelleVille'] : null;
        $pays = "";
        $idVille = 0;
        //If old town
        $idVille = ($nouvelleVille==null) ? Model::getFieldFromAnyElse("ville", "idville", "nom", $data['ville']) : 0;

        if($nouvelleVille!=null && $idVille==0){
            $pays = $data['pays'];
            //Let's write the new town to database
            //Cordinates gotta be gotten from leaflet or google map API
            //Check for duplicate
            //if(!(Model::doesKeyExist($tableName, $field, $keyValue)){}
            $this->db->insert('ville',
                [
                    'nom'=> $nouvelleVille,
                    'pays_idpays'=>
                     Model::getFieldFromAnyElse("pays", "idpays", "nom",
                     $pays),
                    'latitude'=> -4.40129060,
                    'longitude'=> 15.18265780
                ]);
        //Getting the lastly inserted town id, to the service writting to database
        $idVille = Model::getFieldFromAnyElse("ville", "idville", "nom", $nouvelleVille);
        }


        $this->db->insert('servicereferenced',
            [
                'denomination' => $data['denomination'],
                'contacts' => "T : ".($data['telephone']).",E : ".($data['adressemail']),
                'adresse' => $data['adresse'],
                'horairedisponibilite' => $data['horairedisponibilite'],
                'details' => $data['details'],
                'idville' => $idVille,
                'categorie_idcategorie' =>
                 Model::getFieldFromAnyElse("categorie", "idcategorie", "titre",
                 $data['categorie'])
            ]);
        //Redirect to the view that sent the request to avoid data duplication on error
        header('location:'.URL.'service');
    }

    /**
     * showAttributeOfCategorieList - Get lists for comboboxes and select html tags
     * @param string $attribute the table field we want to list
     */
    public function showAttributeOfCategorieList($attribute) {
        return $this->db->select("SELECT ".$attribute." FROM categorie");
    }

    public function showServiceList() {
        return $this->db->select("SELECT * FROM servicereferenced");
    }

    public function showSingleList($id) {
        return $this->db->select("SELECT * FROM servicereferenced WHERE idservicereferenced= :id", array(":id" => $id));
    }

    /**
     * editCategorie - Saves the data edition to the database
     * @param array $data values to save to database
     */
    public function editService($data) {
        $this->db->update("servicereferenced", [
            'denomination' => $data['denomination'],
            'contacts' => "T".$data['telephone']."E".$data['adressemail'],
            'adresse' => $data['adresse'],
            'horairedisponibilite' => $data['horairedisponibilite'],
            'details' => $data['details'],
            'idville' => $data['idville'],
            'categorie_idcategorie' => $data['categorie_idcategorie']]
            , "`idservicereferenced` = {$data['idservicereferenced']}");
    }

    /**
     * deleteCategorie -
     * @param Integer $id
     * @return boolean
     */
    public function deleteCategorie($id) {
        $result = $this->db->select("SELECT * FROM servicereferenced WHERE idservicereferenced= :id", array(":id" => $id));
        $this->db->delete("idservicereferenced", "idservicereferenced= '$id'");
    }

    /**
    * getServicesFrom
    * @param String $ville - Town name
    * @return array() -
    */
    public function getServicesFrom($ville){
      $id_ville = Model::getFieldFromAnyElse("ville", "idville", "nom",
      $ville);
      return $this->db->select("SELECT * FROM servicereferenced WHERE idville= :idville",
      array(":idville" => $id_ville));
    }

    /**
    * countServicesPerCategory
    * @param String $ville - Town name
    * @return array() -
    */
    public function countServicesPerCategory($ville){
      $id_ville = Model::getFieldFromAnyElse("ville", "idville", "nom",
      $ville);
      $sql_query ="SELECT COUNT(categorie_idcategorie), categorie_idcategorie ";
      $sql_query.=" FROM (SELECT * FROM servicereferenced WHERE idville = :idville) services_in_town ";
      $sql_query.=" GROUP BY categorie_idcategorie";
      return $this->db->select($sql_query, array(":idville" => $id_ville));
    }
    /**
    * countCategories
    * @return Integer
    */
    public function countCategories(){
      return (int) $this->db->count_rows("categorie")[0][0];
    }

    /**
    * parcategorie
    * @param String $ville - Town name
    * @param String $categorie - Category name
    * @return array() -
    */
    public function parcategorie($ville, $categorie){

      $id_categorie = Model::getFieldFromAnyElse("categorie", "idcategorie", "titre", $categorie);
      $id_ville = Model::getFieldFromAnyElse("ville", "idville", "nom", $ville);
      $sql_query = "SELECT  * FROM servicereferenced WHERE idville = :idville ";
      $sql_query.= "AND categorie_idcategorie=:categorie_idcategorie";
      return $this->db->select($sql_query, array(":idville" => $id_ville, ":categorie_idcategorie" => $id_categorie));
    }

    /**
    * parvilleetparpay  -
    * @param String $ville - Town name
    * @param String $pay - Country name
    * @return array() - Return the services located in a town
    */
    public function parvilleetparpay($ville){
      $id_ville = Model::getFieldFromAnyElse("ville", "idville", "nom", $ville);
      $sql_query = "SELECT  * FROM servicereferenced WHERE idville = :idville ";
      return $this->db->select($sql_query, array(":idville" => $id_ville));
    }
}
