<?php
//Session::add_to_session('message_type_', 'success');
print_r($_SESSION);
$message_ = (null !== (Session::get_from_session('message_'))) ? Session::get_from_session('message_') : '';
$message_type_ = (null !== (Session::get_from_session('message_type_'))) ? Session::get_from_session('message_type_') : 'danger';
$remark = ($message_ != '') ? $message_ : "Une erreur est survenue";
$remark_type = $message_type_;
Session::remove_from_session('message_type_');

//Get products from database
//Setup the way they will be presented here
$th_array_produit = ["Produit", "Prix (USD)", "Quantité", "Actions"];
$items_array_produit = $this->listOfProduit;
$db_columns_produit = ["denomination", "prix"];

echo $message_;

?>
<!-- Recent Sales Start -->
            <!-- Todo: Add a check user (admin or not), to display or not some options -->
                
            <div class="container-fluid pt-4 px-4">
                <div class="container-fluid pt-4 px-4">
                    <h1>Gerer les articles / Effectuer une vente</h1>
                    <?=Utils::remarkBox("Succès", $remark, $remark_footer = false,$remark_type)?>
                </div>
                <p><a class="btn btn-sm btn-success" data-toggle="modal" data-target="#ajouterProduit"><i class="fa fa-plus"></i> Nouveau produit</a></p>
                
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Articles (<?=count($items_array_produit)?>)</h6>
                        <a href="">Tout afficher</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <?php Utils::table_th($th_array_produit); ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php Utils::table_td($items_array_produit, $db_columns_produit, $actions = true, $quantity = true); ?>
                            </tbody>
                        </table>
                        <div>
                    </div>

                </div>
            </div>
            <!-- Recent Sales End -->



