<?php
//Set sessions here and manage them

 ?>

 <div class="container">
   <div class="row">
     <h5><?=$this->title?></h5>
   </div>
   <div class="row">
     <div class="col-lg-3 my-2">
       <?php
       Utils::overlyzeList(
         $this->servicesFromTownByCategory,
         "service/parcategorie/",
         $this->town_name
       );

       ?>
     </div>
     <div class="col-lg-9 my-2">
       <div class="list-group">
         <?php Utils::customflexcontent(
          $this->servicesFromTown,
          "service/details/",
          6

        ); ?>
       </div>
       <?php //echo Utils::htmlTable($this->servicesFromTown);?>

     </div>
   </div>
 </div>
