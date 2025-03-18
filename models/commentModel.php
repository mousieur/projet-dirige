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
                        $row['etoiles']
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
                        $row['etoiles']
                    );
                }
                return $commentaires;
            }
            return [];
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
    
}