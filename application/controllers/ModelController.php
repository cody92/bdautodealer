<?php

class ModelController extends VanillaController
{

    private $addValidateFields = array(
        'name' => 'Nume model',
        'description' => 'Greutate',
        'releaseYear' => 'An',
        'carId' => 'Marca',
    );
    private $editValidateFields = array(
        'name' => 'Nume model',
        'description' => 'Greutate',
        'year' => 'An',
    );

    function beforeAction()
    {

    }

    function index()
    {
        $this->redirect('dashboard/index');
    }

    function afterAction()
    {

    }

    public function add($command = null, $value = null)
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
                        $_POST['description'], date('Y', strtotime($_POST['releaseYear']))
                    )
                );
                $result = $stmt->rowCount();
                if ($result) {
                    $this->redirect('model/listModels/carId/' . $this->db->lastInsertId());
                }
            }
        }

        if (!($command && $command == 'carId' && $value && is_numeric($value))) {
            $sql = "SELECT * FROM auto ORDER BY name ASC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $this->set('cars', $result);
            $value = null;
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

    public function listModels($var = null, $carId = null)
    {
        if (!($carId && is_numeric($carId))) {
            $carId = null;
        }
        $sql = "SELECT m.*, a.name as numeMarca FROM model AS m INNER JOIN auto AS a ON m.autoId = a.id";

        if ($carId) {
            $sql .= " WHERE m.autoId = ? ";
        }
        $sql .= " ORDER BY m.name ASC";
        $stmt = $this->db->prepare($sql);
        if ($carId) {
            $stmt->execute(array($carId));
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

        $sql = "SELECT * FROM auto_version WHERE modelId = ?";
        $stmt = $this->db->prepare($sql);

        $stmt->execute(array($id));

        $result = $stmt->fetchAll();
        $this->set('data', $result);
    }

}
