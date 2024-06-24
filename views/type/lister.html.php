<?php
Session::ouvrir();
$errors = Session::get("errors") ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Types</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .is-invalid {
            border-color: #e3342f; /* Rouge */
        }
    </style>
</head>
<body>
    <div class="container mx-auto mt-4 px-4">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-2xl font-bold">Liste des Types</h2>
        </div>

        <!-- Formulaire d'ajout de type -->
        <div class="flex justify-center mb-4">
            <form action="<?= WEBROOT ?>?controller=type&action=add-type" method="POST" class="w-full md:w-1/2 flex flex-col">
                <input type="hidden" name="controller" value="type">
                <input type="hidden" name="action" value="add-type">
                <div class="flex">
                    <input type="text" name="new-type" placeholder="Nom du type" class="border px-4 py-2 w-full h-12 rounded-l-md <?= add_class_invalid('new-Type') ?>" value="<?= htmlspecialchars($_POST['new-type'] ?? '') ?>" required>
                    <button type="submit" class="btn bg-purple-600 text-white px-3 py-2 rounded-r-md">Ajouter</button>
                </div>
                <?php if (!empty($errors['new-Type'])): ?>
                    <div class="text-sm text-red-500 mt-2"><?= htmlspecialchars($errors['new-Type']) ?></div>
                    <?php Session::remove("errors"); ?> <!-- Supprimer les erreurs après affichage -->
                <?php endif; ?>
            </form>
        </div>

        <!-- Affichage de la liste des types -->
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
                                <td class="px-4 py-2"><?= htmlspecialchars($type["id"]) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($type["nomType"]) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
