<?php

class CarController extends BdController
{

    private $addValidateFields = array(
        'name' => 'Nume marca',
        'description' => 'Descriere marca',
    );

    public function beforeAction()
    {

    }

    public function index()
    {
        $dashboardItems = array(
            array(
                'css-icon' => 'icon-user',
                'head-title' => 'Add new car',
                'tooltip-text' => 'Add a new car',
                'link' => ''
            ),
        );
        $this->set('items', $dashboardItems);
    }

    public function afterAction()
    {

    }

    public function adaugaMarca()
    {
        //logo upload is not implemented yet
        if (isset($_POST['add'])) {
            $result = $this->validateData($_POST, $this->addValidateFields);
            if (count($result)) {
                $this->set('errors', $result);
                $this->set('data', $_POST);
            } else {
                $sql = "INSERT INTO auto (`name`, `description`) VALUES (?, ?)";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(array($_POST['name'], $_POST['description']));
                $result = $stmt->rowCount();
                if ($result) {
                    $this->redirect('car/autoList');
                }
            }
        }
    }

    public function edit($id = null)
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
                $sql = "UPDATE auto SET name = ?, description = ? WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(
                    array(
                        $_POST['name'], $_POST['description'],
                        $id
                    )
                );
                $result = $stmt->rowCount();
                if ($result) {
                    $this->redirect('car/autoList');
                }
            }
        } else {
            $sql = "SELECT * FROM auto WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($id));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->set('data', $result);
            $this->set('id', $id);
        }
    }

    private function validateData($data, $columns)
    {
        $errors = array();
        foreach ($columns as $columnName => $columnLabel) {
            if (!$this->validateInput($data[$columnName])) {
                $errors[$columnName][] = "Campul \"$columnLabel\" nu poate fi gol";
            }
        }
        if (!count($errors)) {
            $sql = "SELECT name FROM auto WHERE name = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($data['nume_marca']));
            $result = $stmt->rowCount();
            if ($result) {
                $errors['nume_marca'][] = 'Aceasta marca exista deja, adauga alt nume de marca';
            }
        }
        return $errors;
    }

    public function autoList()
    {
        $sql = "SELECT a.*, (SELECT COUNT(m.id) FROM model as m WHERE m.autoId = a.id) AS totalModels, "
            . "(SELECT COUNT(e.id) FROM engine as e WHERE e.autoId = a.id) AS totalEngines "
            . "FROM auto AS a "
            . "ORDER BY a.name ASC";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $this->set('data', $result);
    }

}
