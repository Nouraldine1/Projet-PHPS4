<?php 
require_once("../core/Model.php");

class ApproModel extends Model {
    public function __construct() {
        $this->ouvrirConnexion();
        $this->table="appro";
    }

    

    // public function save(PanierModel $panier): int {
    //     $user_Id=Session::get('userConnect')['id'];
    //     $date=new \DateTime();
    //     $sql="INSERT INTO `appro` (`date`, `montant`, `fournisseur_Id`, `user_Id`) VALUES ($date, $panier->total, $panier->fournisseur, $user_Id ";
    //     return $this->executeUpdate($sql);
    // }

    public function save(PanierModel $panier): int {
        $user_Id = Session::get('userConnect')['id'];
        $date = new \DateTime();
        $formattedDate = $date->format('Y-m-d H:i:s'); // Format adapté pour MySQL
        
        // Requête SQL avec des marqueurs nommés pour insérer l'approvisionnement
        $sqlAppro = "INSERT INTO `appro` (`date`, `montant`, `fournisseur_Id`, `user_Id`) 
                     VALUES (:date, :montant, :fournisseur_Id, :user_Id)";
        
        try {
            // Préparation de la requête pour l'approvisionnement
            $stmtAppro = $this->pdo->prepare($sqlAppro);
            
            // Liaison des valeurs avec les marqueurs nommés
            $stmtAppro->bindParam(':date', $formattedDate);
            $stmtAppro->bindParam(':montant', $panier->total);
            $stmtAppro->bindParam(':fournisseur_Id', $panier->fournisseur);
            $stmtAppro->bindParam(':user_Id', $user_Id);
            
            // Exécution de la requête pour l'approvisionnement
            $stmtAppro->execute();
            
            // Récupération de l'id de l'approvisionnement inséré
            $appro_Id = $this->pdo->lastInsertId();
            
            // Fermeture du statement de l'approvisionnement
            $stmtAppro->closeCursor();
    
            // Boucle pour insérer les détails de l'approvisionnement dans la table `detail`
            foreach ($panier->articles as $article) {
                $article_Id = $article['id'];
                $qteAppro = $article['qteAppro'];
                $montant = $article['montantArticle'];
    
                // Requête SQL avec des marqueurs nommés pour insérer le détail de l'approvisionnement
                $sqlDetail = "INSERT INTO `detail` (`qteAppro`, `article_Id`, `appro_Id`, `montant`) 
                              VALUES (:qteAppro, :article_Id, :appro_Id, :montant)";
                
                // Préparation de la requête pour le détail de l'approvisionnement
                $stmtDetail = $this->pdo->prepare($sqlDetail);
    
                // Liaison des valeurs avec les marqueurs nommés
                $stmtDetail->bindParam(':qteAppro', $qteAppro);
                $stmtDetail->bindParam(':article_Id', $article_Id);
                $stmtDetail->bindParam(':appro_Id', $appro_Id);
                $stmtDetail->bindParam(':montant', $montant);
    
                // Exécution de la requête pour le détail de l'approvisionnement
                $stmtDetail->execute();
    
                // Fermeture du statement du détail de l'approvisionnement
                $stmtDetail->closeCursor();
    
                // Mise à jour de la quantité en stock de l'article
                $newQteStock = $article['qteStock'] + $qteAppro; // Calcul de la nouvelle quantité en stock
                $sqlUpdateStock = "UPDATE `article` SET `qteStock` = :newQteStock WHERE `id` = :article_Id";
                
                // Préparation de la requête pour la mise à jour du stock
                $stmtUpdateStock = $this->pdo->prepare($sqlUpdateStock);
    
                // Liaison des valeurs avec les marqueurs nommés
                $stmtUpdateStock->bindParam(':newQteStock', $newQteStock);
                $stmtUpdateStock->bindParam(':article_Id', $article_Id);
    
                // Exécution de la requête pour la mise à jour du stock
                $stmtUpdateStock->execute();
    
                // Fermeture du statement de la mise à jour du stock
                $stmtUpdateStock->closeCursor();
            }
    
            return $appro_Id;
        } catch (PDOException $e) {
            // Gestion des exceptions en cas d'erreur
            echo 'Erreur d\'exécution de la requête : ' . $e->getMessage();
            return 0; // Ou une autre gestion d'erreur appropriée
        }
    }
    
    
    
    

    public function typeExiste(string $nomtype): bool {
        $sql = "SELECT COUNT(*) as count FROM type WHERE nomtype = :nomtype";
        $params = [':nomtype' => $nomtype];
        $result = $this->executeSelect($sql, $params);
        return $result[0]['count'] > 0;
    }
    
    public function findAll(): array {
        $query = "SELECT a.*, u.nomComplet as user_nom, f.nomFour as fournisseur_nom 
                  FROM $this->table a
                  LEFT JOIN user u ON a.user_Id = u.id
                  LEFT JOIN fournisseur f ON a.fournisseur_Id = f.id";
        
        return $this->executeSelect($query);
    }
    

//     public function Filter($date, $fournisseur): array {
//         $sql = "SELECT appro.date, appro.montant, fournisseur.nomFour AS fournisseur_nom, user.nomComplet AS user_nom 
//                 FROM appro
//                 LEFT JOIN fournisseur ON appro.fournisseur_Id = fournisseur.id
//                 LEFT JOIN user ON appro.user_Id = user.id
//                 WHERE 1 = 1";

//         $params = [];
//         if ($date) {
//             $sql .= " AND appro.date = :date";
//             $params[':date'] = $date;
//         }
//         if ($fournisseur) {
//             $sql .= " AND fournisseur.nomFour LIKE :fournisseur";
//             $params[':fournisseur'] = '%' . $fournisseur . '%';
//         }

//         return $this->executeSelect($sql, $params);
//     }

public function Filter($date, $fournisseur): array {
    $sql = "SELECT appro.id, appro.date, appro.montant, fournisseur.id AS fournisseur_id, fournisseur.nomFour AS fournisseur_nom, user.id AS user_id, user.nomComplet AS user_nom 
            FROM appro
            LEFT JOIN fournisseur ON appro.fournisseur_Id = fournisseur.id
            LEFT JOIN user ON appro.user_Id = user.id
            WHERE 1 = 1";

    $params = [];
    if ($date) {
        $sql .= " AND appro.date = :date";
        $params[':date'] = $date;
    }
    if ($fournisseur) {
        $sql .= " AND fournisseur.nomFour LIKE :fournisseur";
        $params[':fournisseur'] = '%' . $fournisseur . '%';
    }

    return $this->executeSelect($sql, $params);
}

}
?>
