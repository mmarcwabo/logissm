<?php
//Add a product form modal
$formulaire_ajout_produit = [
    'Article:' => '<input type="text" name="denomination" class="form-control">',
    'Prix unitaire:' => '<input type="text" name="prix" class="form-control">',
    'Quantité:' => '<input type="text" name="quantite" class="form-control">',
    'Description:' => '<input type="text" name="description" class="form-control">'
  ];
Utils::modalize(
            "Ajouter un article",
            APP_ROOT."produit/create",
            $method = "POST",
            $formulaire_ajout_produit,
            "ajouterProduit",
            "Ajouter",
            "plus"
);