<?php
require 'src/class/player.php';
class PlayerModel {
    public function __construct(private PDO $pdo) {}

    public function createUser(string $alias, string $nom, string $prenom, string $email, string $password): void {
        try {
            $stmt = $this->pdo->prepare('call CreatePlayer(:alias, :nom, :prenom, :caps, :dexterite, :pointsDeVie, :poidsMax, :photo, :couleur, :email, :password);');
            $stmt->bindValue(':alias', $alias, PDO::PARAM_STR);
            $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindValue(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindValue(':caps', 1000, PDO::PARAM_INT); 
            $stmt->bindValue(':dexterite', 100, PDO::PARAM_INT); 
            $stmt->bindValue(':pointsDeVie', 100, PDO::PARAM_INT); 
            $stmt->bindValue(':poidsMax', 100.0, PDO::PARAM_STR); 
            $stmt->bindValue(':photo', 'default.jpg', PDO::PARAM_STR); 
            $stmt->bindValue(':couleur', 'none', PDO::PARAM_STR); 
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
                        $row['password'],
                        $row['estAdmin'],
                        $row['requestCount'] ?? 0
                    );
                }
                return $players;
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }

    public function getPlayerById(int $idJoueur): Player|null {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM Joueurs WHERE idJoueur = :idJoueur;");
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
                    $data['pasword'],
                    $data['estAdmin'],
                    $data['requestCount'] ?? 0
                );
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }

    public function selectByEmail(string $email): Player|null {
        try {
            $stm = $this->pdo->prepare("SELECT idJoueur, alias, nom, prenom, caps, dexterite, pointsDeVie, poidsMax, photo, couleur, email, pasword FROM Joueurs WHERE email = :email;");
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
                    $data['pasword'],
                    $data['estAdmin'],
                    $data['requestCount'] ?? 0
                );
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
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
                foreach ($data as $row) {
                    $output[] = [
                        'idItem' => $row['idItem'],
                        'quantite' => $row['quantite'],
                        'prixDeVente' => $row['prixDeVente'],
                        'nomItem' => $row['nomItem'],
                        'photo' => $row['photo'],
                        'poids' => $row['poids'],
                        'type' => $row['itemType'],
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
            redirect('/cart');
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }
    function getPoidsInventaireById(int $idJoueur): int {
        try {
            $stm = $this->pdo->prepare("call GetPoidsInventaireById(?)");
            $stm->bindParam(1, $idJoueur);
            $stm->execute();
            return (int)$stm->fetch()[0];
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }
    function getPoidsPanierById(int $idJoueur): int {
        try {
            $stm = $this->pdo->prepare("call GetPoidsPanierById(?)");
            $stm->bindParam(1, $idJoueur);
            $stm->execute();
            return (int)$stm->fetch()[0];
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }
    function connectPlayer(string $alias, string $password): bool {
        try {
            $stm = $this->pdo->prepare("CALL PlayerConnected(:alias, :password, @connection_status);");
    
            $stm->bindParam(':alias', $alias, PDO::PARAM_STR);
            $stm->bindParam(':password', $password, PDO::PARAM_STR);
    
            $stm->execute();
    
            $result = $this->pdo->query("SELECT @connection_status AS bool;")->fetch(PDO::FETCH_ASSOC);

            return $result['bool'] == 1;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }
    function getPlayerByAlias(string $alias) {
        try {
            $stm = $this->pdo->prepare("CALL GetJoueurByAlias(:alias);");
    
            $stm->bindValue(':alias', $alias, PDO::PARAM_STR);
    
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
                    $data['pasword'],
                    $data['estAdmin'],
                    $data['requestCount'] ?? 0
                );
            }

            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }
    function sellItem(int $idJoueur, int $idItem, int $quantite): void {
        try {
            $stm = $this->pdo->prepare("call SellItem(?, ?, ?);");
            $stm->bindParam(1, $idJoueur);
            $stm->bindParam(2, $idItem);
            $stm->bindParam(3, $quantite);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
    function consumeItem(int $idJoueur, int $idItem, int $quantite): void {
        try {
            $stm = $this->pdo->prepare("call ConsumeItem(?, ?, ?);");
            $stm->bindParam(1, $idJoueur);
            $stm->bindParam(2, $idItem);
            $stm->bindParam(3, $quantite);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }

    function AcceptRequest(int $idJoueur): void {
        try {
            $stm = $this->pdo->prepare("call AcceptRequest(?);");
            $stm->bindParam(1, $idJoueur);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
    function RefuseRequest(int $idJoueur): void {
        try {
            $stm = $this->pdo->prepare("call DenyRequest(?);");
            $stm->bindParam(1, $idJoueur);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
    function getAllRequest(): array|null {
        try {
            $stm = $this->pdo->prepare("call GetAllRequest();");
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($data)) {
                $output = [];
                foreach ($data as $row) {
                    $output[] = [
                        'idJoueur' => $row['idJoueur'],
                        'requestedCaps' => $row['requestedCaps'],
                        'solde' => $row['caps'],
                    ];
                }
                return $output;
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
    function requestCaps(int $idJoueur): void {
        try {
            $stm = $this->pdo->prepare("call AddRequest(?);");
            $stm->bindParam(1, $idJoueur);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
    function updateAvatar(int $idJoueur, string $image, string $couleur): void{
        try {
            $stm = $this->pdo->prepare("call UpdateAvatar(?, ?, ?);");
            $stm->bindParam(1, $idJoueur);
            $stm->bindParam(2, $image);
            $stm->bindParam(3, $couleur);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
}
