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
}
