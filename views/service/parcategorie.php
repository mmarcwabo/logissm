 <div class="container">

   <div class="row">
     <h5><?php echo $this->title; ?></h5>
   </div>
   <div class="row">
     <h6><?php echo $this->count_them. " résultats"; ?></h6>
   </div>

   <div class="row">
     <?php
      print_r($this->services_by_categories);
      ?>
   </div>

 </div>
