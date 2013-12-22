<?php

class AutoController extends VanillaController
{

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

    public function add($id)
    {
        if (!$id && !is_numeric($id)) {
            $this->redirect('dashboard/index');
            return 0;
        }
        if (isset($_POST['add'])) {
            $result = $this->validateData($_POST, $this->addValidateFields);
            if (count($result)) {
                $this->set('errors', $result);
                $this->set('data', $_POST);
            } else {
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
                    $this->redirect('model/listCars/' . $id);
                }
            }
        }
        $sql = "SELECT * FROM engine ORDER BY name ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $this->set('engines', $result);
        $this->set('modelId', $id);
    }

    public function edit($id)
    {
        if (!$id && !is_numeric($id)) {
            $this->redirect('dashboard/index');
            return 0;
        }

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
            $sql = "SELECT * FROM auto_version WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($id));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->set('data', $result);
        }
        $sql = "SELECT * FROM engine ORDER BY name ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $this->set('engines', $result);
        $this->set('id', $id);
    }

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

}
