<div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-3">
                <input type="text" id="filter-type" class="form-control" placeholder="Rechercher un catégorie">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-primary">Rechercher</button>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12 d-flex align-items-center justify-content-between">
                <h2>Liste des Types</h2>
                <form method="POST" action="<?= WEBROOT ?>?action=add-type" class="form-inline">
                    <div class="input-group" style="width: 100%;">
                        <input type="text" name="new-type" id="new-type" class="form-control" placeholder="Ajouter une nouvelle catégorie">
                        <div class="input-group-append">
                            <button class="btn btn-primary text-success ml-4" type="submit">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Numero</th>
                    <th>Types</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($types as $type): ?>
                    <tr>
                        <td><?php echo $type["id"]; ?></td>
                        <td><?php echo $type["nomType"]; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>