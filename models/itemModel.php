<?php
class ItemModel {
    public function __construct(private PDO $pdo) {}

    public function selectAll(): array|null {
        $items = [];

        try {
            $stm = $this->pdo->prepare("SELECT idItems, nomItem, quantiteStock, itemType, prixUnitaire, poids, utilite, photo FROM item;");
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($data)) {
                foreach ($data as $row) {
                    $items[] = new Item(
                        $row['idItems'],
                        $row['nomItem'],
                        $row['quantiteStock'],
                        $row['itemType'],
                        $row['prixUnitaire'],
                        $row['poids'],
                        $row['utilite'],
                        $row['photo']
                    );
                }
                return $items;
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }

    public function selectById(int $idItems): Item|null {
        try {
            $stm = $this->pdo->prepare("SELECT idItems, nomItem, quantiteStock, itemType, prixUnitaire, poids, utilite, photo FROM item WHERE idItems = :idItems;");
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
}
