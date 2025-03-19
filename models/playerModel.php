<?php

class PlayerModel {
    public function __construct(private PDO $pdo) {}

    public function createUser(string $alias, string $nom, string $prenom, string $email, string $password): void {
        try {
            $stmt = $this->pdo->prepare('CALL CreatePlayer(:alias, :nom, :prenom, :email, :password)');
            $stmt->bindValue(':alias', $alias, PDO::PARAM_STR);
            $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindValue(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }

    public function selectAll(): array|null {
        $players = [];

        try {
            $stm = $this->pdo->prepare("SELECT idJoueur, alias, nom, prenom, caps, dexterite, pointsDeVie, poidsMax, photo, couleur, email, password FROM user;");
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($data)) {
                foreach ($data as $row) {
                    $players[] = new Player(
                        $row['idJoueur'],
                        $row['alias'],
                        $row['nom'],
                        $row['prenom'],
                        $row['caps'],
                        $row['dexterite'],
                        $row['pointsDeVie'],
                        $row['poidsMax'],
                        $row['photo'],
                        $row['couleur'],
                        $row['email'],
                        $row['password']
                    );
                }
                return $players;
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }

    public function selectById(int $idJoueur): Player|null {
        try {
            $stm = $this->pdo->prepare("SELECT idJoueur, alias, nom, prenom, caps, dexterite, pointsDeVie, poidsMax, photo, couleur, email, password FROM user WHERE idJoueur = :idJoueur;");
            $stm->bindValue(":idJoueur", $idJoueur, PDO::PARAM_INT);
            $stm->execute();
            $data = $stm->fetch(PDO::FETCH_ASSOC);

            if (!empty($data)) {
                return new Player(
                    $data['idJoueur'],
                    $data['alias'],
                    $data['nom'],
                    $data['prenom'],
                    $data['caps'],
                    $data['dexterite'],
                    $data['pointsDeVie'],
                    $data['poidsMax'],
                    $data['photo'],
                    $data['couleur'],
                    $data['email'],
                    $data['password']
                );
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }

    public function selectByEmail(string $email): Player|null {
        try {
            $stm = $this->pdo->prepare("SELECT idJoueur, alias, nom, prenom, caps, dexterite, pointsDeVie, poidsMax, photo, couleur, email, password FROM user WHERE email = :email;");
            $stm->bindValue(":email", $email, PDO::PARAM_STR);
            $stm->execute();
            $data = $stm->fetch(PDO::FETCH_ASSOC);

            if (!empty($data)) {
                return new Player(
                    $data['idJoueur'],
                    $data['alias'],
                    $data['nom'],
                    $data['prenom'],
                    $data['caps'],
                    $data['dexterite'],
                    $data['pointsDeVie'],
                    $data['poidsMax'],
                    $data['photo'],
                    $data['couleur'],
                    $data['email'],
                    $data['password']
                );
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }
    public function getInventaireById(int $idJoueur): array|null {
        try {
            $stm = $this->pdo->prepare("call getInventaireById(?);");
            $stm->bindParam(1, $idJoueur);
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
            $output = [];
            if (!empty($data)) {
                foreach ($data as $row) { //pas sure des attributs que la procedure retourne
                    $output[] = [
                        'idItem' => $row['idItem'],
                        'quantite' => $row['quantite'],
                        'prixUnitaire' => $row['prixUnitaire'],
                        'nomItem' => $row['nomItem'],
                        'photo' => $row['photo'],
                        'poids' => $row['poids']
                    ];
                }
                return $output;
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
    public function getPanierById(int $idJoueur): array|null {
        try {
            $stm = $this->pdo->prepare("call getPanierById(?);");
            $stm->bindParam(1, $idJoueur);
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
            $output = [];
            if (!empty($data)) {
                foreach ($data as $row) {
                    $output[] = [
                        'idItem' => $row['idItem'],
                        'quantite' => $row['quantite'],
                        'prixUnitaire' => $row['prixUnitaire'],
                        'nomItem' => $row['nomItem'],
                        'photo' => $row['photo'],
                        'poids' => $row['poids']
                    ];
                }
                return $output;
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
    function payCart(int $idJoueur): void {
        try {
            $stm = $this->pdo->prepare("call BuyPanier(?)");
            $stm->bindParam(1, $idJoueur);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }
}
