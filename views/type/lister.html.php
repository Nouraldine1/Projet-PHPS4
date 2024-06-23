<div class="container mx-auto mt-4 px-4">

    <div class="flex justify-between items-center mb-3">
        <h2 class="text-2xl font-bold">Liste des Types</h2>
    </div>

    <!-- Formulaire d'ajout de type -->
    <div class="flex justify-center mb-4">
        <form action="<?= WEBROOT ?>?controller=type&action=add-type" method="POST" class="w-full md:w-1/2 flex">
            <input type="hidden" name="controller" value="type">
            <input type="hidden" name="action" value="add-type">
            <input type="text" name="new-type" placeholder="Nom du type" class="border px-4 py-2 w-full h-12 rounded-l-md" required>
            <button type="submit" class="btn bg-blue-500 text-white px-3 py-2 rounded-r-md">Ajouter</button>
        </form>
    </div>

    <div class="flex justify-center">
        <div class="overflow-x-auto w-full md:w-1/2">
            <table class="min-w-min w-full bg-white shadow-md rounded-md">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Numéro</th>
                        <th class="px-4 py-2 text-left">Nom du Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($types as $type): ?>
                        <tr class="border-t">
                            <td class="px-4 py-2"><?php echo $type["id"]; ?></td>
                            <td class="px-4 py-2"><?php echo $type["nomType"]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
