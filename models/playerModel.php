<?php

class playerModel {
    public function __construct(private PDO $pdo) {}

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
}
