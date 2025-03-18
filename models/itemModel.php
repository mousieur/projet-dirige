<?php
class ItemModel {
    public function __construct(private PDO $pdo) {}

    public function selectAll(): array|null {
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
    public function searchItemsByName(string $name): array|null {
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


    public function selectById(int $idItems): Item|null {
        try {
            $stm = $this->pdo->prepare("call ;");
            $stm->bindValue(":idItems", $idItems, PDO::PARAM_INT);
            $stm->execute();
            $data = $stm->fetch(PDO::FETCH_ASSOC);

            if (!empty($data)) {
                return new Item(
                    $data['idItems'],
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
    public function updateItemInPanier(int $idJoueur, int $idItem, int $quantite): void {
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

}
