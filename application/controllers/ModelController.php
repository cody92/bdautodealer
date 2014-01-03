<?php

class ModelController extends VanillaController
{

    private $addValidateFields = array(
        'name' => 'Nume model',
        'description' => 'Descriere Marca',
        'releaseYear' => 'An',
        'carId' => 'Marca',
    );
    private $editValidateFields = array(
        'name' => 'Nume model',
        'description' => 'Greutate',
        'year' => 'An',
    );

    public function beforeAction()
    {

    }

    public function index()
    {
        $this->redirect('dashboard/index');
    }

    public function afterAction()
    {

    }

    public function add($id = null)
    {
        //logo upload is not implemented yet
        if (isset($_POST['add'])) {
            $result = $this->validateData($_POST, $this->addValidateFields);
            if (count($result)) {
                $this->set('errors', $result);
                $this->set('data', $_POST);
            } else {
                $sql = "INSERT INTO model (`autoId`, `name`, `description`, `releaseYear`) VALUES (?, ?, ?, ?)";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(
                    array(
                        $_POST['carId'], $_POST['name'],
                        $_POST['description'], $_POST['releaseYear']
                    )
                );
                $result = $stmt->rowCount();
                if ($result) {
                    if ($id && is_numeric($id)) {
                        $this->redirect('model/listModels/' . $id);
                    } else {
                        $this->redirect('model/listModels');
                    }
                }
            }
        }

        if (!$id || !is_numeric($id)) {
            $sql = "SELECT * FROM auto ORDER BY name ASC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $this->set('cars', $result);
            $value = null;
        } else {
            $value = $id;
        }
        $this->set('carId', $value);
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

    public function listModels($id = null)
    {
        if (!($id && is_numeric($id))) {
            $id = null;
        }
        $sql = "SELECT m.*, a.name as numeMarca, COUNT(av.id) as totalCars "
            . "FROM model AS m "
            . "INNER JOIN auto AS a ON m.autoId = a.id "
            . "LEFT JOIN auto_version AS av ON m.id = av.modelId";

        if ($id) {
            $sql .= " WHERE m.autoId = ? ";
        }
        $sql .= " GROUP BY m.id ORDER BY m.name ASC";
        $stmt = $this->db->prepare($sql);
        if ($id) {
            $stmt->execute(array($id));
        } else {
            $stmt->execute();
        }
        $result = $stmt->fetchAll();
        $this->set('data', $result);
    }

    public function edit($id)
    {
        if (!is_numeric($id)) {
            $this->redirect('model/listModels');
        } else {
            $this->set('id', $id);


            if (isset($_POST['add'])) {
                $result = $this->validateData($_POST, $this->editValidateFields);
                if (count($result)) {
                    $this->set('errors', $result);
                    $this->set('data', $_POST);
                } else {
                    $sql = "UPDATE engine SET "
                        . "name = ?, description = ?, releaseYear = ? "
                        . "WHERE id = ?;";
                    $stmt = $this->db->prepare($sql);
                    $stmt->execute(
                        array(
                            $_POST['name'], $_POST['description'],
                            $_POST['releaseYear'], $id
                        )
                    );
                    $result = $stmt->rowCount();
                    if ($result) {
                        $this->redirect('model/edit/' . $id);
                    }
                }
            } else {
                $sql = "SELECT * FROM model WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(array($id));
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->set('data', $result);
            }
        }
    }

    public function listAuto($id)
    {
        if (!($id && is_numeric($id))) {
            $this->redirect('dashboard/index');
        }

        $sql = "SELECT av.*, m.name AS mName, m.description AS mDescription, "
            . "e.type AS eType, e.capacity AS eCapacity, e.name AS eName, "
            . "e.horsePower AS eHorsePower, ROUND(e.fuelAverage, 2) AS eFuelAverage, "
            . "ROUND(e.fuelUrban, 2) AS eFuelUrban, ROUND(e.fuelExtra, 2) AS eFuelExtra, "
            . "a.name AS aName, "
            . "(SELECT SUM(eqo.price) "
            . "FROM carequipment AS ce "
            . "INNER JOIN equipmentoptions AS eqo ON ce.equipmentId = eqo.id "
            . "WHERE ce.autoId = av.id) AS optionsPrice "
            . "FROM auto_version AS av "
            . "INNER JOIN model AS m ON av.modelId = m.id "
            . "INNER JOIN auto AS a ON m.autoId = a.id "
            . "INNER JOIN engine AS e ON av.engineId = e.id "
            . "WHERE av.modelId = ? "
            . "ORDER BY av.name ASC";


        $stmt = $this->db->prepare($sql);

        $stmt->execute(array($id));

        $result = $stmt->fetchAll();
        $this->set('data', $result);
    }

}
