<div class="container mx-auto mt-5">
    <div class="flex justify-center">
        <div class="w-full md:w-1/2">
            <div class="bg-white shadow-md rounded-md p-6">
                <h2 class="text-2xl font-bold mb-4 text-center">Nouvel Approvisionnement</h2>
                <form method="POST" action="<?= WEBROOT ?>">
                    
                    <input type="hidden" name="action" value="add-appro">
                    <input type="hidden" name="controller" value="appro">

                    <div class="mb-4">
                        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" id="date" name="date" placeholder="Date"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="montant" class="block text-sm font-medium text-gray-700">Montant</label>
                        <input type="number" id="montant" name="montant" placeholder="Montant"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="fournisseur" class="block text-sm font-medium text-gray-700">Fournisseur</label>
                        <select id="fournisseur" name="fournisseur"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                            <?php foreach ($fournisseurs as $fournisseur): ?>
                            <option value="<?= $fournisseur['id'] ?>"><?= $fournisseur['nom'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="user" class="block text-sm font-medium text-gray-700">Utilisateur</label>
                        <select id="user" name="user"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                            <?php foreach ($users as $user): ?>
                            <option value="<?= $user['id'] ?>"><?= $user['nom'] ?></option>
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
