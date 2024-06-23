<body class="bg-gray-100">

    <div class="container mx-auto mt-4 px-4">

        <div class="flex flex-wrap mb-3">
            <div class="w-full md:w-1/4 p-2">
                <label for="filter-date">Date</label>
                <input type="date" id="filter-date" class="form-input w-full rounded-md">
            </div>
            <div class="w-full md:w-1/4 p-2">
                <label for="filter-article">Article</label>
                <input type="text" id="filter-article" class="form-input w-full rounded-md"
                    placeholder="Rechercher un article">
            </div>
            <div class="w-full md:w-1/4 p-2">
                <label for="filter-client">Client</label>
                <input type="text" id="filter-client" class="form-input w-full rounded-md"
                    placeholder="Rechercher un client">
            </div>
            <div class="w-full md:w-1/4 p-2 flex items-end">
                <button class="btn bg-blue-500 text-white px-3 py-2 rounded">Rechercher</button>
            </div>
        </div>

        <div class="flex justify-between items-center mb-3">
            <h2 class="text-2xl font-bold">Liste des Articles</h2>
            <button class="btn bg-green-500 text-white px-3 py-2 rounded"><a
                    href="<?= WEBROOT ?>?controller=article&action=form-article">Nouveau</a></button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-md">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Libellé</th>
                        <th class="px-4 py-2 text-left">Prix</th>
                        <th class="px-4 py-2 text-left">Quantité en Stock</th>
                        <th class="px-4 py-2 text-left">Catégorie</th>
                        <th class="px-4 py-2 text-left">Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $article): ?>
                    <tr class="border-t">
                        <td class="px-4 py-2"><?php echo $article["libelle"]; ?></td>
                        <td class="px-4 py-2"><?php echo $article["prixAppro"]; ?></td>
                        <td class="px-4 py-2"><?php echo $article["qteStock"]; ?></td>
                        <td class="px-4 py-2"><?php echo $article["nomCategorie"]; ?></td>
                        <td class="px-4 py-2"><?php echo $article["nomType"]; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tailwind JS for interactivity (if needed) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.5.2/dist/cdn.min.js"></script> -->