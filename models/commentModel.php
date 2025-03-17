<?php
class CommentModel {
    public function __construct(private PDO $pdo) {}
    
    public function selectAll(): array|null {
        $commentaires = [];
    
        try {
            $result = $this->pdo->query("CALL GetAllCommentaires;");
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
}