<?php
class ItemModel
{
    public function __construct(private PDO $pdo)
    {
    }

    public function selectAll(): array|null
    {
        $items = [];

        try {
            $result = $this->pdo->query("call GetAllItems;");
            $data = $result->fetchAll();

            if (!empty($data)) {
                foreach ($data as $row) {
                    $items[] = new Item(
                        $row['idItem'],
                        $row['nomItem'],
                        $row['quantiteStock'],
                        $row['itemType'],
                        $row['prixUnitaire'],
                        $row['poids'],
                        $row['utilite'],
                        $row['photo'],
                    );
                }
                return $items;
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
    public function searchItemsByName(string $name): array|null
    {
        $items = [];

        try {
            $result = $this->pdo->prepare("call SearchItemsByName(:name);");
            $result->bindValue(":name", $name, PDO::PARAM_STR);
            $result->execute();
            $data = $result->fetchAll();

            if (!empty($data)) {
                foreach ($data as $row) {
                    $items[] = new Item(
                        $row['idItem'],
                        $row['nomItem'],
                        $row['quantiteStock'],
                        $row['itemType'],
                        $row['prixUnitaire'],
                        $row['poids'],
                        $row['utilite'],
                        $row['photo'],
                    );
                }
                return $items;
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }


    public function selectById(int $idItems): Item|null
    {
        try {
            $stm = $this->pdo->prepare("SELECT idItem, nomItem, quantiteStock, itemType, prixUnitaire, poids, utilite, photo FROM Items WHERE idItem = :idItem");
            $stm->bindValue(":idItem", $idItems, PDO::PARAM_INT);
            $stm->execute();
            $data = $stm->fetch(PDO::FETCH_ASSOC);

            if (!empty($data)) {
                return new Item(
                    $data['idItem'],
                    $data['nomItem'],
                    $data['quantiteStock'],
                    $data['itemType'],
                    $data['prixUnitaire'],
                    $data['poids'],
                    $data['utilite'],
                    $data['photo']
                );
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }
    public function updateItemInPanier(int $idJoueur, int $idItem, int $quantite): void
    {
        try {
            $stm = $this->pdo->prepare("call updateItemInPanier(?, ?, ?);");
            $stm->bindParam(1, $idJoueur);
            $stm->bindParam(2, $idItem);
            $stm->bindParam(3, $quantite);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }

    public function getItemsByType(string $type): array|null
    {
        $items = [];

        try {
            $result = $this->pdo->prepare("call GetItemsByType(:type);");
            $result->bindValue(":type", $type, PDO::PARAM_STR);
            $result->execute();
            $data = $result->fetchAll();

            if (!empty($data)) {
                foreach ($data as $row) {
                    $items[] = new Item(
                        $row['idItem'],
                        $row['nomItem'],
                        $row['quantiteStock'],
                        $row['itemType'],
                        $row['prixUnitaire'],
                        $row['poids'],
                        $row['utilite'],
                        $row['photo'],
                    );
                }
                return $items;
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
    public function getItemsByTypes(array $types): array
    {
        $items = [];

        try {
            foreach ($types as $type) {
                $result = $this->pdo->prepare("call GetItemsByType(:type);");
                $result->bindValue(":type", $type, PDO::PARAM_STR);
                $result->execute();
                $data = $result->fetchAll();

                if (!empty($data)) {
                    foreach ($data as $row) {
                        $items[] = new Item(
                            $row['idItem'],
                            $row['nomItem'],
                            $row['quantiteStock'],
                            $row['itemType'],
                            $row['prixUnitaire'],
                            $row['poids'],
                            $row['utilite'],
                            $row['photo'],
                        );
                    }
                }
            }
            return $items;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
    public function getItemDetailsByType(int $idItem, string $itemType): array|null
    {
        try {
            switch ($itemType) {
                case 'Arme':
                    $stm = $this->pdo->prepare("SELECT * FROM Armes WHERE idArme = :idItem");
                    break;
                case 'Munition':
                    $stm = $this->pdo->prepare("SELECT * FROM Munitions WHERE idMunition = :idItem");
                    break;
                case 'Armure':
                    $stm = $this->pdo->prepare("SELECT * FROM Armures WHERE idArmure = :idItem");
                    break;
                case 'Nourriture':
                    $stm = $this->pdo->prepare("SELECT * FROM Nourritures WHERE idNourriture = :idItem");
                    break;
                case 'Medicament':
                    $stm = $this->pdo->prepare("SELECT * FROM Medicaments WHERE idMedicament = :idItem");
                    break;
                default:
                    return null;
            }
            $stm->bindValue(":idItem", $idItem, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }

    public function moveUploadedPicture(string $destinationPath = 'public/img/')
    {
        if (!empty($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $uniqueFileName = uniqid() . '_' . basename($_FILES['photo']['name']);
            $targetFilePath = $destinationPath . $uniqueFileName;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
                return $uniqueFileName; 
            } else {
                throw new Exception("Failed to upload the image.");
            }
        } else {
            throw new Exception("No valid image uploaded.");
        }
    }
    
    public function CreateItem(array $itemData): void
    {
        try {
            $this->pdo->beginTransaction();

            switch ($itemData['itemType']) {
                case 'Arme':
                    $stm = $this->pdo->prepare("CALL CreateArme(:nomItem, :quantiteStock, :prixUnitaire, :poids, :utilite, :photo, :flagDispo, :efficacite, :typeArme, :description)");
                    $stm->bindValue(':efficacite', $itemData['dynamicFields']['efficacite'], PDO::PARAM_INT);
                    $stm->bindValue(':typeArme', $itemData['dynamicFields']['typeArme'], PDO::PARAM_STR);
                    $stm->bindValue(':description', $itemData['dynamicFields']['description'], PDO::PARAM_STR);
                    break;

                case 'Munition':
                    $stm = $this->pdo->prepare("CALL CreateMunition(:nomItem, :quantiteStock, :prixUnitaire, :poids, :utilite, :photo, :flagDispo, :calibre)");
                    $stm->bindValue(':calibre', $itemData['dynamicFields']['calibre'], PDO::PARAM_STR);
                    break;

                case 'Armure':
                    $stm = $this->pdo->prepare("CALL CreateArmure(:nomItem, :quantiteStock, :prixUnitaire, :poids, :utilite, :photo, :flagDispo, :composite, :taille)");
                    $stm->bindValue(':composite', $itemData['dynamicFields']['composite'], PDO::PARAM_STR);
                    $stm->bindValue(':taille', $itemData['dynamicFields']['taille'], PDO::PARAM_STR);
                    break;

                case 'Nourriture':
                    $stm = $this->pdo->prepare("CALL CreateNourriture(:nomItem, :quantiteStock, :prixUnitaire, :poids, :utilite, :photo, :flagDispo, :apportCalorique, :composantNutritif, :mineralPrincipal, :ptsVie)");
                    $stm->bindValue(':apportCalorique', $itemData['dynamicFields']['apportCalorique'], PDO::PARAM_INT);
                    $stm->bindValue(':composantNutritif', $itemData['dynamicFields']['composantNutritif'], PDO::PARAM_STR);
                    $stm->bindValue(':mineralPrincipal', $itemData['dynamicFields']['mineralPrincipal'], PDO::PARAM_STR);
                    $stm->bindValue(':ptsVie', $itemData['dynamicFields']['ptsVie'], PDO::PARAM_INT);
                    break;

                case 'Medicament':
                    $stm = $this->pdo->prepare("CALL CreateMedicament(:nomItem, :quantiteStock, :prixUnitaire, :poids, :utilite, :photo, :flagDispo, :attendu, :duree, :indesirable, :ptsVie)");
                    $stm->bindValue(':attendu', $itemData['dynamicFields']['attendu'], PDO::PARAM_STR);
                    $stm->bindValue(':duree', $itemData['dynamicFields']['duree'], PDO::PARAM_INT);
                    $stm->bindValue(':indesirable', $itemData['dynamicFields']['indesirable'], PDO::PARAM_STR);
                    $stm->bindValue(':ptsVie', $itemData['dynamicFields']['ptsVie'], PDO::PARAM_INT);
                    break;

                default:
                    throw new Exception("Type d'item invalide.");
            }


            $stm->bindValue(':nomItem', $itemData['nomItem'], PDO::PARAM_STR);
            $stm->bindValue(':quantiteStock', $itemData['quantiteStock'], PDO::PARAM_INT);
            $stm->bindValue(':prixUnitaire', $itemData['prixUnitaire'], PDO::PARAM_INT);
            $stm->bindValue(':poids', $itemData['poids'], PDO::PARAM_STR);
            $stm->bindValue(':utilite', $itemData['utilite'], PDO::PARAM_INT);
            $stm->bindValue(':photo', $itemData['photo'], PDO::PARAM_STR);
            $stm->bindValue(':flagDispo', 1, PDO::PARAM_INT); 

            $stm->execute();
            $this->pdo->commit();
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            throw new PDOException($e->getMessage(), $e->getCode());
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
}