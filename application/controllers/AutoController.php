<?php

class AutoController extends BdController
{

    /**
     *
     * @var array variabila pentru campurile care trebuiesc verificate in formularul de adaugare/editare masina
     */
    private $addValidateFields = array(
        'engineId' => 'Motorizare',
        'name' => 'Nume masina',
        'weight' => 'Greutate',
        'price' => 'Pret',
        'seatsNumber' => 'Numar locuri',
        'doorsNumber' => 'Numar usi',
    );

    public function index()
    {
        $this->redirect('dashboard/index');
    }

    public function beforeAction()
    {

    }

    public function afterAction()
    {

    }

    /**
     * pagina adaugare intrare noua pentru tabela auto_version, primeste ca parametru id-ul modelului pentru care
     * adaugam masina noua
     *
     * @param int $id
     * @return int
     */
    public function add($id = null)
    {
        //daca nu este primit id ca parametru facem redirect la pagina de home
        if (!$id && !is_numeric($id)) {
            $this->redirect('dashboard/index');
            return 0;
        }

        //verificam daca a fost trimisa cererea de post pentru adaugare intrare noua
        if (isset($_POST['add'])) {
            //validam datele primite prin POST
            $result = $this->validateData($_POST, $this->addValidateFields);

            //verificam daca sunt erori
            if (count($result)) {
                //adaugam erorile in vizualizare, si setam datele trimise la POST
                $this->set('errors', $result);
                $this->set('data', $_POST);
            } else {
                //daca nu au fost erori adaugam o intrare noua pentru tabela auto_version
                $sql = "INSERT INTO auto_version (`name`, `engineId`, `weight`, `seatsNumber`, `doorsNumber`, "
                    . "`price`, `modelId`) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(
                    array(
                        $_POST['name'], $_POST['engineId'],
                        $_POST['weight'], $_POST['seatsNumber'],
                        $_POST['doorsNumber'], $_POST['price'],
                        $id
                    )
                );
                $result = $stmt->rowCount();
                if ($result) {
                    $this->redirect('model/listAuto/' . $id);
                }
            }
        }
        //selectam din baza de date toate motorizarile pentru marca din care face parte masina
        $sql = "SELECT en.* "
            . "FROM engine AS en "
            . "LEFT JOIN auto AS au ON en.autoId = au.id "
            . "LEFT JOIN model AS m ON au.id = m.autoId "
            . "WHERE m.id = ? "
            . "ORDER BY name ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($id));
        $result = $stmt->fetchAll();
        $this->set('engines', $result);
        $this->set('modelId', $id);
    }

    /**
     * metoda pentru verificarea datelor inainte de ediatare si adaugare, verificare doar pentru campurile care sunt
     * obligatorii
     *
     * @todo mutare metoda in clasa BdController, si rescriere unde este cazul
     * @param array $data datele care trebuiesc validate primite prin POST
     * @param array $columns coloanele care trebuiesc validate
     * @return array returneaza un vector multidimensional cu erori
     */
    public function edit($id = null)
    {
        //daca nu este primit id ca parametru facem redirect la pagina de home
        if (!$id && !is_numeric($id)) {
            $this->redirect('dashboard/index');
            return 0;
        }

        //verificam daca a fost trimisa cererea de post pentru editare
        if (isset($_POST['add'])) {
            $result = $this->validateData($_POST, $this->addValidateFields);
            if (count($result)) {
                $this->set('errors', $result);
                $this->set('data', $_POST);
            } else {
                $sql = "UPDATE auto_version SET name = ?, engineId = ?, weight = ?, seatsNumber = ?, doorsNumber = ?"
                    . " price = ? WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(
                    array(
                        $_POST['name'], $_POST['engineId'],
                        $_POST['weight'], $_POST['seatsNumber'],
                        $_POST['doorsNumber'], $_POST['price'],
                        $id
                    )
                );
                $result = $stmt->rowCount();
                if ($result) {
                    $this->redirect('auto/edit/' . $id);
                }
            }
        } else {
            //daca nu a fost trimisa cererea de editare vom completa campurile cu valorile intrarii din baza de date
            $sql = "SELECT * FROM auto_version WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($id));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->set('data', $result);
        }
        //selectam din baza de date toate motorizarile pentru marca din care face parte masina
        $sql = "SELECT en.* "
            . "FROM engine AS en "
            . "LEFT JOIN auto AS au ON en.autoId = au.id "
            . "LEFT JOIN model AS m ON au.id = m.autoId "
            . "LEFT JOIN auto_version AS av ON m.id = av.modelId "
            . "WHERE av.id = ? "
            . "ORDER BY name ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($id));
        $result = $stmt->fetchAll();
        $this->set('engines', $result);
        $this->set('id', $id);
    }

    /**
     * metoda pentru verificarea datelor inainte de ediatare si adaugare, verificare doar pentru campurile care sunt
     * obligatorii
     *
     * @param array $data datele care trebuiesc validate primite prin POST
     * @param array $columns coloanele care trebuiesc validate
     * @return array returneaza un vector multidimensional cu erori
     */
    private function validateData($data, $columns)
    {
        $errors = array();
        foreach ($columns as $columnName => $columnLabel) {
            if (!$this->validateInput($data[$columnName])) {
                $errors[$columnName][] = "Campul \"$columnLabel\" nu poate fi gol";
            }
        }
        return $errors;
    }

    /**
     * adaugare optiunilor specifice fiecarei masini
     *
     * @param int $id id ul masinii pentru care se adauga optiunile
     * @return int
     */
    public function addEquipment($id = null)
    {
        if (!$id && !is_numeric($id)) {
            $this->redirect('dashboard/index');
            return 0;
        }
        if (isset($_POST['add']) && isset($_POST['equipments']) && count($_POST['equipments'])) {


            $database = $this->db;
            $database->beginTransaction();
            $sql = "INSERT INTO carequipment (`equipmentId`, `autoId`, `type`) "
                . " VALUES (?, ?, ?)";
            try {
                $stmt = $database->prepare("DELETE FROM carequipment WHERE autoId = ?");
                $stmt->execute(array($id));
                foreach ($_POST['equipments'] as $equipment) {
                    $stmt = $database->prepare($sql);
                    $stmt->execute(
                        array(
                            $equipment, $id, 1
                        )
                    );
                }

                $database->commit();
            } catch (PDOException $e) {
                $database->rollback();
            }
            $this->redirect('model/listAuto/' . $id);
        }
        $sql = "SELECT eqo.id, eq.name, eqo.value, ce.id  as selected "
            . "FROM equipmentoptions AS eqo "
            . "INNER JOIN equipments AS eq ON eqo.equipmentId = eq.id "
            . "INNER JOIN model AS m ON eqo.modelId = m.id "
            . "INNER JOIN auto_version AS av ON m.id = av.modelId "
            . "LEFT JOIN carequipment AS ce ON ce.equipmentId = eqo.id  "
            . "WHERE av.id = ? "
            . "ORDER BY eq.name ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($id));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->set('equipments', $result);
        $this->set('id', $id);
    }

    /**
     * listarea optiunilor si echipamentelor pentru o masina, din tabela carequipment
     *
     * @param int $id coloana id pentru intrarea din tabela auto_version
     * @return int
     */
    public function listEquipment($id = null)
    {
        if (!$id && !is_numeric($id)) {
            $this->redirect('dashboard/index');
            return 0;
        }
        $sql = "SELECT eq.name, eq. description, eqo.price, ce.id "
            . "FROM carequipment AS ce "
            . "INNER JOIN equipmentoptions AS eqo ON ce.equipmentId = eqo.id "
            . "INNER JOIN equipments AS eq ON eqo.equipmentId = eq.id "
            . "WHERE ce.autoId = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($id));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->set('data', $result);

        $sql = "SELECT CONCAT(a.name,' ', m.name, ' ', av.name) AS name "
            . "FROM auto_version AS av "
            . "INNER JOIN model AS m ON av.modelId = m.id "
            . "INNER JOIN auto AS a ON m.autoId = a.id "
            . "WHERE av.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($id));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->set('modelName', $result[0]['name']);
    }

    /**
     * stergea unei inregistrari din tabela carequipment
     *
     * @param int $id valoarea coloanei id a intrarii din tabela carequipment care trebuie stearsa
     * @return int
     */
    public function deleteEquipment($id = null)
    {
        if (!$id && !is_numeric($id)) {
            $this->redirect('dashboard/index');
            return 0;
        }

        $sql = "SELECT autoId AS id FROM carequipment WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($id));
        $result = $stmt->fetchColumn();

        $sql = "DELETE FROM carequipment WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($id));

        $this->redirect('auto/listEquipment/' . $result);
    }

}
