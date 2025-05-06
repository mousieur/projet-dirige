<?php
class CommentModel {
    public function __construct(private PDO $pdo) {}
    
    public function selectAll(): array|null {
        $commentaires = [];
    
        try {
            $result = $this->pdo->prepare("CALL GetAllCommentaires;");
            
            $result->execute();

            $data = $result->fetchAll();
    
            if (!empty($data)) {
                foreach ($data as $row) {
                    $commentaires[] = new Commentaire(
                        $row['idItem'],
                        $row['idJoueur'],
                        $row['titre'],
                        $row['commentaire'],
                        $row['date'],
                        $row['etoiles'],
                        $row['photo'] ?? 'fa-user', 
                        $row['alias'] ?? 'Anonyme', 
                        $row['couleur'] ?? 'pfp-gray'
                    );
                }
                return $commentaires;
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
    public function getCommentsByIdItem(int $idItem): array|null {
        $commentaires = [];
    
        try {
            $stmt = $this->pdo->prepare("CALL GetCommentairesByIdItem(:idItem)");
            $stmt->bindValue(":idItem", $idItem, PDO::PARAM_INT);
            $stmt->execute(); 
    
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            if (!empty($data)) {
                foreach ($data as $row) {
                    $commentaires[] = new Commentaire(
                        $row['idItem'],
                        $row['idJoueur'],
                        $row['titre'],
                        $row['commentaire'],
                        $row['date'],
                        $row['etoiles'],
                        $row['photo'] ?? 'fa-user', 
                        $row['alias'] ?? 'Anonyme', 
                        $row['couleur'] ?? 'pfp-gray'
                    );
                }
                return $commentaires;
            }
            return [];
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
    function createComment(int $idItem, int $idJoueur, string $titre, string $commentaire, int $etoiles): void {
        try {
            $stm = $this->pdo->prepare("CALL CreateCommentaire(?, ?, ?, ?, ?)");
            $stm->bindParam(1, $idItem, PDO::PARAM_INT);
            $stm->bindParam(2, $idJoueur, PDO::PARAM_INT);
            $stm->bindParam(3, $titre, PDO::PARAM_STR);
            $stm->bindParam(4, $commentaire, PDO::PARAM_STR);
            $stm->bindParam(5, $etoiles, PDO::PARAM_INT);

            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
    public function deleteComment(int $idItem, int $idJoueur): void {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM Commentaires WHERE idItem = :idItem AND idJoueur = :idJoueur");
            $stmt->bindValue(':idItem', $idItem, PDO::PARAM_INT);
            $stmt->bindValue(':idJoueur', $idJoueur, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
}