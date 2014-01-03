<?php

class ModelEquipmentController extends VanillaController
{

    private $addValidateFields = array(
        'equipmentId' => 'Nume optiune',
        'modelId' => 'Model',
        'price' => 'Pret',
        'value' => 'Optiune',
    );
    private $editValidateFields = array(
        'price' => 'Pret',
        'value' => 'Optiune',
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
        if (!($id && is_numeric($id))) {
            $this->redirect('dashboard/index');
            return 0;
        }
        //logo upload is not implemented yet
        if (isset($_POST['add'])) {
            $result = $this->validateData($_POST, $this->addValidateFields);
            if (count($result)) {
                $this->set('errors', $result);
                $this->set('data', $_POST);
            } else {
                $sql = "INSERT INTO equipmentoptions (`equipmentId`, `modelId`, `price`, `value`) VALUES (?, ?, ?, ?)";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(
                    array(
                        $_POST['equipmentId'], $_POST['modelId'],
                        $_POST['price'], $_POST['value']
                    )
                );
                $result = $stmt->rowCount();
                if ($result) {
                    $this->redirect('modelEquipment/listEquipment/' . $id);
                }
            }
        } else {

            $sql = "SELECT e.* "
                . "FROM equipments AS e "
                . "WHERE e.id NOT IN "
                . "(SELECT equipmentId FROM equipmentoptions WHERE modelId = ?) "
                . "ORDER BY e.name ASC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($id));
            $result = $stmt->fetchAll();
            $this->set('equipments', $result);

            $this->set('modelId', $id);
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

    public function edit($id)
    {
        if (!is_numeric($id)) {
            $this->redirect('dashboard/index');
        } else {
            $this->set('id', $id);


            if (isset($_POST['add'])) {
                $result = $this->validateData($_POST, $this->editValidateFields);
                if (count($result)) {
                    $this->set('errors', $result);
                    $this->set('data', $_POST);
                } else {
                    $sql = "UPDATE equipmentoptions SET "
                        . "price = ?, value = ? "
                        . "WHERE id = ?;";
                    $stmt = $this->db->prepare($sql);
                    $stmt->execute(
                        array(
                            $_POST['price'], $_POST['value'],
                            $id
                        )
                    );
                    $result = $stmt->rowCount();
                    if ($result) {
                        $this->redirect('modelEquipment/edit/' . $id);
                    }
                }
            } else {
                $sql = "SELECT * FROM equipmentoptions WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(array($id));
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->set('data', $result);
            }
        }
    }

    public function listEquipment($id = null)
    {
        if (!($id && is_numeric($id))) {
            $this->redirect('dashboard/index');
            return 0;
        }
        $sql = "SELECT m.name as mName, a.name as aName, eq.name as eqName, eqo.* "
            . "FROM equipmentoptions AS eqo "
            . "INNER JOIN model AS m ON eqo.modelId = m.id "
            . "INNER JOIN equipments AS eq ON eqo.equipmentId = eq.id "
            . "INNER JOIN auto AS a ON m.autoId = a.id "
            . "WHERE m.id = ? "
            . "ORDER BY eq.name ASC, eqo.price DESC";

        $stmt = $this->db->prepare($sql);
        if ($id) {
            $stmt->execute(array($id));
        } else {
            $stmt->execute();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->set('data', $result);
        $this->set('model', $id);
    }

}
