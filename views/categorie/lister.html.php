<div class="container mx-auto mt-4 px-4">

    <div class="flex justify-between items-center mb-3">
        <h2 class="text-2xl font-bold">Liste des Catégories</h2>
        <!-- <button class="btn bg-green-500 text-white px-3 py-2 rounded"> -->
            <!-- <a href="<?= WEBROOT ?>?controller=categorie&action=form-categorie">Ajouter une catégorie</a>
        </button> -->
    </div>

    <!-- Formulaire d'ajout de catégorie -->
    <div class="flex justify-center mb-4">
        <form action="<?= WEBROOT ?>?controller=categorie&action=add-categorie" method="POST" class="w-full md:w-1/2 flex">
            <input type="hidden" name="controller" value="categorie">
            <input type="hidden" name="action" value="add-categorie">
            <input type="text" name="nomCategorie" placeholder="Nom de la catégorie" class="border px-4 py-2 w-full h-12 rounded-l-md" required>
            <button type="submit" class="btn bg-purple-600 text-white px-3 py-2 rounded-r-md">Ajouter</button>
        </form>
    </div>

    <div class="flex justify-center">
        <div class="overflow-x-auto w-full md:w-1/2">
            <table class="min-w-min w-full bg-white shadow-md rounded-md">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Numéro</th>
                        <th class="px-4 py-2 text-left">Nom de la Catégorie</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $categorie): ?>
                        <tr class="border-t">
                            <td class="px-4 py-2"><?php echo $categorie["id"]; ?></td>
                            <td class="px-4 py-2"><?php echo $categorie["nomCategorie"]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
