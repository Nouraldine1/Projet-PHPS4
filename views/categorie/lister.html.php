<div class="container mx-auto mt-4 px-4">

<div class="flex justify-between items-center mb-3">
    <h2 class="text-2xl font-bold">Liste des Catégories</h2>
    <button class="btn bg-green-500 text-white px-3 py-2 rounded"><a
            href="<?= WEBROOT ?>?action=add-categorie">Ajouter une catégorie</a></button>
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

<!-- Tailwind JS for interactivity (if needed) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.5.2/dist/cdn.min.js"></script> -->