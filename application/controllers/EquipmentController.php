<?php

class EquipmentController extends BdController
{

    /**
     *
     * @var array variabila pentru campurile care trebuiesc verificate in formularul de adaugare/editare masina
     */
    private $addValidateFields = array(
        'name' => 'Nume echipament',
        'description' => 'Descriere echipament',
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

    /**
     * formulat adaugare echipament
     *
     * @param int $id
     */
    public function add()
    {
        //logo upload is not implemented yet
        if (isset($_POST['add'])) {
            $result = $this->validateData($_POST, $this->addValidateFields);
            if (count($result)) {
                $this->set('errors', $result);
                $this->set('data', $_POST);
            } else {
                $sql = "INSERT INTO equipments (`name`, `description`) VALUES (?, ?)";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(
                    array(
                        $_POST['name'],
                        $_POST['description']
                    )
                );
                $result = $stmt->rowCount();
                if ($result) {

                    $this->redirect('equipment/listEquipment');
                }
            }
        }
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
     * formular editare intrare tabela equipment, primeste ca parametru idul optiunii
     *
     * @param int $id
     */
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
                        . "name = ?, description = ? "
                        . "WHERE id = ?;";
                    $stmt = $this->db->prepare($sql);
                    $stmt->execute(
                        array(
                            $_POST['name'], $_POST['description'],
                            $id
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

    /**
     * pagina listare optiuni
     */
    public function listEquipment()
    {
        $sql = "SELECT * FROM equipments ORDER BY name ASC";
        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll();
        $this->set('data', $result);
    }

}
