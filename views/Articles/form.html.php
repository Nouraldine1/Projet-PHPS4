<div class="container mx-auto mt-5">
    <div class="flex justify-center">
        <div class="w-full md:w-1/2">
            <div class="bg-white shadow-md rounded-md p-6">
                <h2 class="text-2xl font-bold mb-4 text-center">Ajouter un nouvel Article</h2>
                <form method="POST" action="<?= WEBROOT ?>?action=add-article&controller=article">
                    <div class="mb-4">
                        <label for="libelle" class="block text-sm font-medium text-gray-700">Libellé</label>
                        <input type="text" id="libelle" name="libelle" placeholder="Libellé"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="prix" class="block text-sm font-medium text-gray-700">Prix</label>
                        <input type="text" id="prix" name="prix" placeholder="Prix"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="qteStock" class="block text-sm font-medium text-gray-700">Quantité en Stock</label>
                        <input type="text" id="qteStock" name="qteStock" placeholder="Quantité en Stock"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="categorie" class="block text-sm font-medium text-gray-700">Catégorie</label>
                        <select id="categorie" name="categorie"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                            <?php foreach ($categories as $categorie): ?>
                            <option value="<?= $categorie['id'] ?>"><?= $categorie['nomCategorie'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                        <select id="type" name="type"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                            <?php foreach ($types as $type): ?>
                            <option value="<?= $type['id'] ?>"><?= $type['nomType'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                            Enregistrer
                        </button>
                    </div>
                </form>
                <div class="mt-4 flex justify-end">
                    <a href="<?= WEBROOT ?>?action=Fermer-form"
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 focus:outline-none focus:bg-gray-400">
                        Fermer
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
