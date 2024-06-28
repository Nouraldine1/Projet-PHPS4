<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto mt-4 px-4">

        <!-- Filtres -->
        <div class="flex flex-wrap mb-3">
            <div class="w-full md:w-1/4 p-2">
            <form method="POST" action="<?= WEBROOT ?>?controller=user&action=lister-user" class="flex items-end w-full">
                    <div class="w-2/3">
                        <label for="filter-role">Rôle</label>
                        <select name="role" id="filter-role" class="form-select w-full rounded-md">
                            <option value="All" <?= (isset($_POST['role']) && $_POST['role'] == 'All') ? 'selected' : '' ?>>Tous</option>
                            <?php foreach ($roles as $role): ?>
                            <option value="<?php echo $role['id']; ?>" <?= (isset($_POST['role']) && $_POST['role'] == $role['id']) ? 'selected' : '' ?>>
                                <?php echo $role['name']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="w-1/3 pl-2">
                        <button type="submit" class="btn bg-purple-600 text-white px-3 py-2 rounded w-full">Filtrer</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Liste des utilisateurs -->
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-2xl font-bold">Liste des Utilisateurs</h2>
            <a href="<?= WEBROOT ?>?controller=user&action=form-add-user"
                class="btn bg-green-500 text-white px-3 py-2 rounded">Ajouter un utilisateur</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-md">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Nom Complet</th>
                        <th class="px-4 py-2 text-left">Login</th>
                        <th class="px-4 py-2 text-left">Role</th>
                        <th class="px-4 py-2 text-left">Téléphone</th>
                        <th class="px-4 py-2 text-left">Adresse</th>
                    </tr>
                </thead>
                <tbody id="user-table-body">
                    <?php foreach ($users as $user): ?>
                    <tr class="border-t">
                        <td class="px-4 py-2"><?php echo htmlspecialchars($user["id"]); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($user["nomComplet"]); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($user["login"]); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($user["role"]); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($user["tel"]); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($user["adresse"]); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
