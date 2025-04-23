<?php

class enigmeModel {
    public function __construct(private PDO $pdo) {}
    
    public function getAllIdEnigmes() {
        $enigmes = [];

        try {
            $result = $this->pdo->prepare("CALL GetAllEnigmesById;");
            $result->execute();
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            
            if (!empty($data)) {
                foreach ($data as $row) {
                    $enigmes[] = new EnigmeNotSolved(
                        $row['idEnigme'],
                        $row['difficulte']
                    );
                }
                return $enigmes;
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }

    }
    public function GetEnigmeById($idEnigme) {
        $enigme = [];
        try{
            $result = $this->pdo->prepare("CALL GetEnigmeById(:idEnigme);");
            $result->bindValue(":idEnigme", $idEnigme, PDO::PARAM_INT);
            $result->execute();
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($data)) {

                $firstRow = $data[0];

                $answers = [];
                foreach ($data as $row) {
                    $answers[] = new EnigmeAnswer(
                        $row['idReponse'], 
                        $row['texteReponse'],
                        $row['estCorrecte'] === 1 ? true : false
                    );
                }
    
                return new Enigme(
                    $data[0]['idEnigme'],
                    $data[0]['question'],
                    $data[0]['difficulte'],
                    $answers
                );
            }
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
}