<div class="container mt-4">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="filter-date">Date</label>
                    <input type="date" id="filter-date" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="filter-article">Article</label>
                    <input type="text" id="filter-article" class="form-control" placeholder="Rechercher un article">
                </div>
                <div class="col-md-3">
                    <label for="filter-client">Client</label>
                    <input type="text" id="filter-client" class="form-control" placeholder="Rechercher un client">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn btn-primary">Rechercher</button>
                </div>
            </div>
<div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-between">
                    <h2>Liste des Articles</h2>
                    <button class="btn btn-success"> <a href="<?=WEBROOT?>?action=form-article">Nouveau</a></button>
                </div>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Libellé</th>
                        <th>Prix</th>
                        <th>Quantité en Stock</th>
                        <th>Catégorie</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                        <?php foreach ($articles as $article) : ?>
                            <tr class="">
                                <td scope="row"><?php echo $article["libelle"]; ?></td>
                                <td><?php echo $article["prixAppro"]; ?></td>
                                <td><?php echo $article["qteStock"]; ?></td>
                                <td><?php echo $article["nomCategorie"]; ?></td>
                                <td><?php echo $article["nomType"]; ?></td>
                               
                            </tr>
                        <?php endforeach; ?>
            </tbody>
            </table>
        </div>
    </div>
