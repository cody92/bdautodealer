<?php

class CarController extends BdController
{

    /**
     *
     * @var array variabila pentru campurile care trebuiesc verificate in formularul de adaugare/editare masina
     */
    private $addValidateFields = array(
        'name' => 'Nume marca',
        'description' => 'Descriere marca',
    );

    public function beforeAction()
    {

    }

    public function index()
    {
        $this->redirect('dasboard/index');
    }

    public function afterAction()
    {

    }

    /**
     * formular adaugare marca noua
     */
    public function adaugaMarca()
    {
        /*
         * upload logo nu este implementat
         * daca este trimisa cererea verificam datele trimise
         */

        if (isset($_POST['add'])) {
            $result = $this->validateData($_POST, $this->addValidateFields);

            if (count($result)) {
                //daca sunt erori reincarcam formularul cu erori afisate si datele trimise in cerere
                $this->set('errors', $result);
                $this->set('data', $_POST);
            } else {
                //adaugam o inregistrare noua in tabela auto
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

    /**
     * formular editare marca, primeste ca parametru idul marcii care trebuie editat
     *
     * @param int $id
     * @return int
     */
    public function edit($id = null)
    {
        //daca nu este primit ca parametru idul marcii, redirect la pagina de home
        if (!$id && !is_numeric($id)) {
            $this->redirect('dashboard/index');
            return 0;
        }

        if (isset($_POST['add'])) {
            //validam datele trimise prin POST
            $result = $this->validateData($_POST, $this->addValidateFields);
            if (count($result)) {
                //daca sunt erori reincarcam formularul cu erori afisate si datele trimise in cerere
                $this->set('errors', $result);
                $this->set('data', $_POST);
            } else {
                // facem update la inregistrare curenta
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
            //incarcam datele despre marca in formular
            $sql = "SELECT * FROM auto WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($id));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->set('data', $result);
            $this->set('id', $id);
        }
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

    /**
     * listarea tuturor marcilor din baza de date, tabela auto
     */
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
