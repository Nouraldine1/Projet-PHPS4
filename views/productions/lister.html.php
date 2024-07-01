<body class="bg-gray-100">

    <div class="container mx-auto mt-4 px-4">

        <!-- Filtrer les approvisionnements -->
        <form method="POST" action="<?= WEBROOT ?>?controller=appro&action=filtrer-appro">
            <div class="flex flex-wrap mb-3">
                <div class="w-full md:w-1/4 p-2">
                    <label for="filter-date">Date</label>
                    <input type="date" id="filter-date" name="date" class="form-input w-full rounded-md"
                        value="<?= $_GET['date'] ?? '' ?>">
                </div>
                <div class="w-full md:w-1/4 p-2">
                    <label for="filter-fournisseur">Fournisseur</label>
                    <form method="POST" action="?action=filtrer-appro">
                        <select id="filter-fournisseur" name="fournisseur" class="form-input w-full rounded-md">
                            <option value="">Sélectionner un fournisseur</option>
                            <option value="All" <?= (isset($_POST['fournisseur']) && $_POST['fournisseur'] == 'All') ? 'selected' : '' ?>>Tous</option>
                            <?php foreach ($fournisseurs as $fournisseur): ?>
                                <option value="<?= $fournisseur['nomFour']; ?>" <?= (isset($_POST['fournisseur']) && $_POST['fournisseur'] == $fournisseur['nomFour']) ? 'selected' : '' ?>>
                                    <?= $fournisseur['nomFour']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    </form>

                </div>
                <div class="w-full md:w-1/4 p-2 flex items-end">
                    <button type="submit" class="btn bg-purple-600 text-white px-3 py-2 rounded">
                        Filtrer
                    </button>
                </div>
            </div>
        </form>




        <div class="container mx-auto mt-4 px-4">
            <!-- ... Filtrage et titre ... -->

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-md">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 text-left">Date</th>
                            <th class="px-4 py-2 text-left">Montant</th>
                            <th class="px-4 py-2 text-left">Fournisseur</th>
                            <th class="px-4 py-2 text-left">Auteur</th>
                            <th class="px-4 py-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody id="appro-list">
                        <?php foreach ($appros as $appro): ?>
                            <tr class="border-t" x-data="{ openDetails: null, openModify: null }">
                                <td class="px-4 py-2">
                                    <?= date('d-m-Y', strtotime($appro['date'])); ?>
                                </td>
                                <td class="px-4 py-2"><?= $appro["montant"]; ?></td>
                                <td class="px-4 py-2"><?= $appro["fournisseur_nom"]; ?></td>
                                <td class="px-4 py-2"><?= $appro["user_nom"]; ?></td>
                                <td class="px-4 py-2 relative bg-violet-200">
                                    <!-- Bouton pour afficher les détails -->
                                    <button
                                        @click="openDetails = openDetails === <?= $appro['id']; ?> ? null : <?= $appro['id']; ?>"
                                        class="btn-details">...</button>

                                    <div x-show="openDetails === <?= $appro['id']; ?>" @click.outside="openDetails = null"
                                        class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5"
                                        style="background-color: #8a2be2; color: white;" role="menu" tabindex="-1">
                                        <div id="details">
                                            <p>Date: <?= date('d-m-Y', strtotime($appro['date'])); ?></p>
                                            <p>Montant: <?= $appro["montant"]; ?></p>
                                            <!-- Ajoutez d'autres détails ici si nécessaire -->
                                            <a href="?action=show-appro-details&id=<?= $appro['id']; ?>">Voir Détails</a>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.5.2/dist/cdn.min.js" defer></script>
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('approsList', () => ({
                    openModify: null,
                    openDetails: null,
                }));
            });
        </script>




</body>