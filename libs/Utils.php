<?php
#Class name : Utils
#Purpose : Usual fonctions to format data and so on
#Author : mwabo
#email : marcellin@wabo.work

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

public static function getRandomItems($items_table, $number){
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
//
public static function table_th($th_array){
   foreach($th_array as $th) {
     echo '<th>' . $th . '</th>';
   }
}

public static function table_td($items_array, $db_columns, $actions = false, $quantity = false){
    //Config actions
    $action_buttons = '';
    $quantity_field = '';
    if ($actions == true) {
        $action_buttons .= '<td><a class="btn btn-sm btn-success" href=""><i class="fa fa-money-bill"></i> Vendre</a>
            <a class="btn btn-sm btn-primary" href=""><i class="fa fa-edit"></i> Modifier</a>
            <a class="btn btn-sm btn-primary" href=""><i class="fa fa-plus"></i> Ajouter</a>
            <a class="btn btn-sm btn-danger" href=""><i class="fa fa-times"></i> Supprimer</a></td>';
    }
    if ($quantity == true) {
        $quantity_field .= '<td><input class="form-control" type="number" name="quantiteV" id="" size="4"></td>';
    }

    foreach($items_array as $item) {
        echo '<tr>';
            foreach($db_columns as $item_property) {
                echo '<td>' . $item[$item_property] . '</td>';
            }
            echo $quantity_field . $action_buttons;
        echo '</tr>';
    }
}

}//class Utils end
