<?php

class ModelController extends VanillaController
{

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
            $result = $this->validateData($_POST);
            if (count($result)) {
                $this->set('errors', $result);
                $this->set('data', $_POST);
            } else {
                $sql = "INSERT INTO model (`autoId`, `name`, `description`, `releaseYear`) VALUES (?, ?, ?, ?)";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(
                    array(
                        $_POST['carId'], $_POST['nume_model'],
                        $_POST['descriere_model'], date('Y', strtotime($_POST['year']))
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

    private function validateData($data)
    {
        $errors = array();
        if (!$this->validateInput($data['nume_model'])) {
            $errors['nume_model'][] = 'Campul "Nume model" nu poate fi gol';
        }
        if (!$this->validateInput($data['descriere_model'])) {
            $errors['descriere_model'][] = 'Campul Descriere model nu poate fi gol';
        }
        if (!$this->validateInput($data['year'])) {
            $errors['year'][] = 'Campul An nu poate fi gol';
        }
        if (!$this->validateInput($data['carId'])) {
            $errors['carId'][] = 'Campul Marca nu poate fi gol';
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

}
