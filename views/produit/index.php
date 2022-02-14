<pre>
<?php
var_dump($this->listOfProduit);
?>
</pre>
            <!-- Recent Sales Start -->
            <!-- Todo: Add a check user (admin or not), to display or not some options -->
            <h1>Gerer les articles / Effectuer une vente</h1>
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Articles</h6>
                        <a href="">Tout afficher</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Article</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Quantité en stock</th>                                    
                                    <th scope="col">Actions</th>
                                    <th scope="col">Quantité</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>                                    
                                    <td>
                                        <a class="btn btn-sm btn-success" href=""><i class="fa fa-money-bill"></i> Vendre</a>
                                        <a class="btn btn-sm btn-primary" href=""><i class="fa fa-edit"></i> Modifier</a>
                                        <a class="btn btn-sm btn-primary" href=""><i class="fa fa-plus"></i> Ajouter en stock</a>
                                        <a class="btn btn-sm btn-danger" href=""><i class="fa fa-times"></i> Supprimer</a>                                        
                                    </td>
                                    <td><input class="form-control" type="number" name="quantiteV" id="" width="4px"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div>
                        <?php
            //
            Utils::buttonize("Ajouter un produit", true, "#ajouterProduit");
            $formulaire_ajout_produit = [
              'Article:' => '<input type="text" name="denomination" class="form-control">',
              'Prix unitaire:' => '<input type="text" name="prix" class="form-control">',
              'Quantité:' => '<input type="text" name="quantite" class="form-control">',
              'Description:' => '<input type="text" name="description" class="form-control">'
            ];

            
            ?>
                        </div>
                    </div>

                </div>

            </div>
            <!-- Recent Sales End -->