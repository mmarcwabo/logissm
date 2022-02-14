<div class="container">

  <div class="row">
    <h5><?php echo $this->title; ?></h5>
  </div>
  <div class="row">
    <h6><?php echo $this->count_them. " résultats"; ?></h6>
  </div>

  <div class="row">
     <div class="col-lg-9 my-2">
       <div class="list-group">
         <?php Utils::customflexcontent(
          $this->list_service_by_town,
          "service/details/",
          7

        ); ?>
       </div>
       <?php //echo Utils::htmlTable($this->servicesFromTown);?>

     </div>
  </div>

</div>
