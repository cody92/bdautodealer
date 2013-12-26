<?php

class EquipmentController extends VanillaController
{

    private $addValidateFields = array(
        'name' => 'Nume echipament',
        'description' => 'Descriere echipament',
        'price' => 'Pret',
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
                $sql = "INSERT INTO equipments (`name`, `description`, `price`) VALUES (?, ?, ?)";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(
                    array(
                        $_POST['name'],
                        $_POST['description'], $_POST['price']
                    )
                );
                $result = $stmt->rowCount();
                if ($result) {

                    $this->redirect('equipment/listEquipment');
                }
            }
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
        return $errors;
    }

    public function edit($id = null)
    {
        if (!is_numeric($id)) {
            $this->redirect('equipments/listEquipment');
        } else {
            $this->set('id', $id);


            if (isset($_POST['add'])) {
                $result = $this->validateData($_POST, $this->addValidateFields);
                if (count($result)) {
                    $this->set('errors', $result);
                    $this->set('data', $_POST);
                } else {
                    $sql = "UPDATE equipments SET "
                        . "name = ?, description = ?, price = ? "
                        . "WHERE id = ?;";
                    $stmt = $this->db->prepare($sql);
                    $stmt->execute(
                        array(
                            $_POST['name'], $_POST['description'],
                            $_POST['price'], $id
                        )
                    );
                    $result = $stmt->rowCount();
                    if ($result) {
                        $this->redirect('equipment/edit/' . $id);
                    }
                }
            } else {
                $sql = "SELECT * FROM equipments WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(array($id));
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->set('data', $result);
            }
        }
    }

    public function listEquipment()
    {
        $sql = "SELECT * FROM equipments ORDER BY name ASC";
        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll();
        $this->set('data', $result);
    }

}
