<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un nouvel Article</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?= WEBROOT ?>?action=add-article">
                        <div class="form-group">
                            <label for="libelle">Libellé</label>
                            <input type="text" class="form-control" id="libelle" name="libelle" placeholder="Libellé"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="prix">Prix</label>
                            <input type="text" class="form-control" id="prix" name="prix" placeholder="Prix" required>
                        </div>
                        <div class="form-group">
                            <label for="quantite">Quantité en Stock</label>
                            <input type="text" class="form-control" id="qteStock" name="qteStock"
                                placeholder="Quantité en Stock" required>
                        </div>
                        <div class="form-group">
                            <label for="categorie">Catégorie</label>
                            <select class="form-control" id="categorie" name="categorie" required>
                                <?php foreach ($categories as $categorie): ?>
                                    <option value="<?= $categorie['id'] ?>"><?= $categorie['nomCategorie'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" id="type" name="type" required>
                                <?php foreach ($types as $type): ?>
                                    <option value="<?= $type['id'] ?>"><?= $type['nomType'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="<?= WEBROOT ?>?action=Fermer-form" class="btn btn-secondary" data-dismiss="modal">Fermer</a>
                </div>

            </div>
        </div>
    </div>
</div>