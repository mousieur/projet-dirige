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
            $stm = $this->pdo->prepare("SELECT idItems, nomItem, quantiteStock, itemType, prixUnitaire, poids, utilite, photo FROM Items WHERE idItems = :idItems;");
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
    public function getAllArmes(): array|null {
        $items = [];

        try {
            $result = $this->pdo->prepare("call GetAllArmes;");
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
    public function getAllMunitions(): array|null {
        $items = [];

        try {
            $result = $this->pdo->prepare("call getAllMunitions;");
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
    public function getAllMedicaments(): array|null {
        $items = [];

        try {
            $result = $this->pdo->prepare("call getAllMedicaments;");
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
    public function getAllArmures(): array|null {
        $items = [];

        try {
            $result = $this->pdo->prepare("call getAllArmures;");
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
    public function getAllNourritures(): array|null {
        $items = [];

        try {
            $result = $this->pdo->prepare("call getAllNourritures;");
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
}