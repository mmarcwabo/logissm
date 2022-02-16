<?php
#Class name : Utils
#Purpose : Usual fonctions to format data and so on
#Author : mwabo
#email : mwabo@exsofth.com

class Utils{
//Show a php array as an html table
public static function htmlTable($data = array()){
    $rows = array();
    foreach ($data as $row) {
        $cells = array();
        foreach ($row as $cell) {
            $cells[] = "<td>{$cell}</td>";
        }
        $rows[] = "<tr>" . implode('', $cells) . "</tr>";
    }
    return "<table class='hci-table'>" . implode('', $rows) . "</table>";
}

/**
 *For array of arrays
 *
 */
public static function arrayToList($data = array()){
    $rows = array();
    foreach ($data as $row) {
    	$items = array();
    	foreach ($row as $item) {
    		$items[] = $item;
    	}
    	$rows[] = "<option>" . implode('', $items) . "</option>";
    }
    return implode('', $rows);
}

/*
 *For array of simple items
 *
 */
public static function arrayItemToList($data = array()){
    $options = array();
    for($i = 0; $i< count($data); $i++){

        $options[] = "<option>" . $data[$i] . "</option>";
  }
  return implode('', $options);
 }


/*
 *Show items as grid
 *
 */
public static function showItemsAsCards($towns = array(), $category = false){

echo "<div class='card-deck mt-4'>";
  foreach ($towns as $town) {
    $description = "";
    $count_services = 0;
    $details_link = APP_ROOT . "service/getservicesfrom";
    if ($category) {
      $details_link = "";
      $details_link = APP_ROOT . "categorie/getservicesof";
      $description = Model::getFieldFromAnyElse("categorie",
      "description", "titre", $town);
    }

  echo '<div class="card text-center"><br>
          <div class="card-block"><br>
            <h4 class="card-title">'.$town
            .'</h4><p class="card-text">'.
            $description
            .'
              <br>
            </p>
            <br>
        </div>
        <div class="card-footer" style="color:#333; background-color: #6dac29;
        border-top : 3px solid #0a6fa5">
            <p><a href="'
            .$details_link.'/'.$town.
            '" style="color:#0a6fa5;"><b>Plus de détails</b><a><p/>
        </div>
    </div>';
  }
echo "</div>";

}

/*
 *Show a breadcumb on pages
*/

public static function addBreadCumb(){

  /*echo "<a href='".basename($_SERVER["SCRIPT_FILENAME"], '.php').
        "''>".basename($_SERVER["SCRIPT_FILENAME"], '.php').
        "</a> >".basename($_SERVER['PHP_SELF'], '.php');*/
}

/**
 * $title_array
 * $data_array
 */

public static function showDatatable($table_head, $table_data){
  //
  $data_table = '<table><thead><tr>';
  foreach ($table_head as $th) {
    $data_table .= '<th>' . $th . '<th>';
  }
  $data_table .= '</tr></thead><tbody>';
  //
  foreach ($table_data as $td) {
    $data_table .= '<tr>';
    for ($i = 0; $i < count($table_head); $i++) {
      $data_table .= '<td>' . $td[$i] . '</td>';
    }
    $data_table .= '</tr>';
  }
  $data_table .= '</tbody></table>';

  echo $data_table;
}

public static function getRandowItems($items_table, $number){
  $items_table = shuffle(shuffle($items_table));
  $random_items = array();
  for ($i=0;$ $i < $number; $i++){
    // Get random elements from the shuffled array
    // Countries, towns and other element
    $random_items[i] = $items_table [i];
  }
  return $random_items;
}

/*
 *Main button style
 *
 */
public static function buttonize($label, $isForModal, $targetID){
  $modal_setting = "";
  if($isForModal){
    $modal_setting = 'data-toggle="modal" data-target="'.$targetID;
  }
  echo  '<button type="button" class="btn btn-lg"'.
        $modal_setting.
        '" style="background-color:#6dac29; color:white;">
        '.$label.'
        </button>';
}
/**
* overlyzeList is specific to display categories
* @param $array_list - Array of categories to Displays
* @param $route - The link on the showed Category
* @param $town_name - The town which services, or professionals
* are classified by categories
* @return String - html list
*/
public static function overlyzeList($array_list, $route, $town_name){

$route = URL.$route.$town_name;

echo '<ul class="list-group">';
//Specific for categories
for($i = 0; $i<count($array_list); $i++){
  $category_name = Model::getFieldFromAnyElse(
    "categorie","titre", "idcategorie",$array_list[$i]['categorie_idcategorie']
  );
  $category_count = $array_list[$i]['COUNT(categorie_idcategorie)'];

  echo '<a href="'
  .$route.'/'.$category_name.'">
  <li  class="list-group-item d-flex justify-content-between align-items-center">'
  .$category_name.'<span class="badge badge-success badge-pill">'
  .$category_count.'</span></li></a>';
}

echo '</u>';
}
/**
* overlyzeList is specific to display services of a Category
* on a town page.
* @param $array_list - Array of services to Displays
* @param $route -
* @param $limit - Define the number of element to display in the list
* @return String - html link to show a single service
*/
public static function customflexcontent($array_list, $route, $limit){
//Number of items in the array
$item_number = count ($array_list);

if($item_number == 0){
  echo "Aucun service de cette ville enregistré dans les annuaires";
  exit;
}
//Setting up a limit of item to Display
//Thinking about a pagination system
$number_of_pages = 1;
$for_loop_var = 1;
$next = "";
if($item_number > $limit){
  //item number is gt the Limit
  //Let check the modulo
  $for_loop_var = $limit;
  if(($item_number%$limit)==0){
  $number_of_pages = 1;
  }else{

    $number_of_pages = $number_of_pages + ($item_number/$limit - ($item_number%$limit));
  }
}else{
  //If the limit is gt the number of returned items in the array
  $number_of_pages = $number_of_pages;
  $for_loop_var = $limit - $item_number;
}
$link = URL.$route;
if ($limit > 0){
  for($i=0; $i<$for_loop_var;$i++){
    $heading = $array_list[$i]['denomination'];
    $horaire = $array_list[$i]['horairedisponibilite'];
    $details = $array_list[$i]['details'];
    $contact = $array_list[$i]['contacts'];
    $phone  = substr((explode(',', $contact)[0]), 4, -1);
    $email = substr((explode(',', $contact)[1]), 4, -1);
    $adresse = $array_list[$i]['adresse'];
    //Create a new variable to avoid concatenation
    //of all denomination white looping
    $the_link = $link.$array_list[$i]['denomination'];
    if($number_of_pages>1){
      $next = '<a href="'.$link.'/'.$number_of_pages;
      $next.= '">Suivant</a>';
    }else{
      $the_link = $link.$array_list[$i]['denomination']."/1";
    }
      //
      $number_of_pages--;
    echo '
    <a href="'.$the_link.'" class="list-group-item list-group-item-action flex-column align-items-start">
      <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">'.$heading.'</h5>
        <small>'.$horaire.'</small>
      </div>
      <p class="mb-1">'.$details.'</p>
      <small>'.$phone.' - '.$email.' - '.$adresse.'</small>
    </a>
    ';
    //Check here the purpose of next int
    //echo $next;
  }
}

}
/**
* iconize
* @param $image - Image path
* @param $sizex - X Dimension of the image
* @param $sizey - Y Dimension of the image
* @return Html - img tag
*/
public static function iconize($image, $size){
  echo '
  <img src="' . APP_ROOT . 'images/'
  .$image.'" alt="icon" height="'
  .$size.'" width="'.$size.'"/>
  ';
}
/**
* modalize
* @param $title - Modal dialog title
* @param $form_action - Form action
* @param $form_fields - Array of inputs (label => field)
* @param $modal_id - Modal id
* @return Html - Modal dialog
*/
public static function modalize($title, $form_action, $method = "post", $form_fields, $modal_id, $btn_value, $btn_icon){

    $modal_dialog = '<div class="modal fade" id="' . $modal_id;

    $modal_dialog .= '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">' . $title;
    $modal_dialog .= '</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><i class="fa fa-times"></i></span></button></div><div class="modal-body">';
  
    $modal_dialog .= '<form action ="' . $form_action . '" method="' . $method . '">';
    
    foreach ($form_fields as $label => $field) {
        $modal_dialog .= '<div class="form-group"><label for="'.$label.'">' . $label;
        $modal_dialog .= '</label>' . $field . '<div>';
    }

    $modal_dialog .= '</div><div class="modal-footer"><button type="submit" class="btn btn-primary"><b>' . $btn_value 
    . '</b>  <i class="fa fa-' . $btn_icon . '"></i></button></form>';

    $modal_dialog .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>';
    $modal_dialog .= '</div></div></div></div>';
  
    echo $modal_dialog;
}

public static function remarkBox($remark_title, $remark_body, $remark_footer = false,  $type_ = "danger"){

  $remark = '<p><div class="alert alert-'. $type_ .'" role="alert"><h4 class="alert-heading">';
  $remark .= $remark_title; 
  $remark .= '</h4><p>' . $remark_body . '</p>';
  $remark .= '<hr><p class="mb-0">'. $remark_footer ? $remark_footer : "" .'</p></div></p>';

  echo $remark;
}

}//class Utils end
