<?php

class ModelController extends BdController
{

    /**
     *
     * @var array variabila pentru campurile care trebuiesc verificate in formularul de adaugare model
     */
    private $addValidateFields = array(
        'name' => 'Nume model',
        'description' => 'Descriere Marca',
        'releaseYear' => 'An',
        'carId' => 'Marca',
    );

    /**
     *
     * @var array variabila pentru campurile care trebuiesc verificate in formularul de editare model
     */
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

    /**
     * pagina adaugare intrare noua pentru tabela model, primeste ca parametru id-ul marcii pentru care
     * adaugam model nou
     *
     * @param int $id
     * @return int
     */
    public function add($id = null)
    {
        //verificam daca a fost trimisa cererea de post pentru adaugare intrare noua
        if (isset($_POST['add'])) {
            //validam datele primite prin POST
            $result = $this->validateData($_POST, $this->addValidateFields);
            //verificam daca sunt erori, daca sunt erori le afisam in formular cu datele care sunt deja completate
            if (count($result)) {
                $this->set('errors', $result);
                $this->set('data', $_POST);
            } else {
                //daca nu au fost erori adaugam o intrare noua pentru tabela model

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
        //daca nu avem trimis parametrul pentru marca, afisam un select cu toate marcile listate
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
     * listare tuturor modelor din baza de date(tabela model), daca avem parametru id - ul marcii listam doar
     * modelele pentru marca respectiva
     *
     * @param int $id
     */
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

    /**
     * editare unei inregistrari din tabela model
     *
     * @param int $id
     */
    public function edit($id)
    {
        if (!is_numeric($id)) {
            $this->redirect('model/listModels');
        } else {
            //setam idul inregistrarii pentru vizualizare
            $this->set('id', $id);


            if (isset($_POST['add'])) {
                //daca a fost trimisa cererea de editare, validam datele introduse
                $result = $this->validateData($_POST, $this->editValidateFields);
                if (count($result)) {
                    //daca sunt erori incarcam formularul cu datele completate si afisam erorile
                    $this->set('errors', $result);
                    $this->set('data', $_POST);
                } else {
                    //facem update inregistrarii existente
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
                //daca nu este trimisa cererea de POST incarcam in formular inregistrarea curenta
                $sql = "SELECT * FROM model WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(array($id));
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->set('data', $result);
            }
        }
    }

    /**
     * listarea masinilor pentru un model
     *
     * @param int $id
     */
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
