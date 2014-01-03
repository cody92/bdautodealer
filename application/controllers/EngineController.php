<?php

class EngineController extends BdController
{

    const GPL = 1;
    const DIESEL = 2;
    const GASOLINE = 3;
    const HYBRID = 4;
    const ELECTRIC = 5;

    /**
     *
     * @var array variabila pentru campurile care trebuiesc verificate in formularul de adaugare/editare masina
     */
    protected $addValidateFields = array(
        'name' => 'Nume motorizare',
        'type' => 'Tip motorizare',
        'capacity' => 'Capacitate motor',
        'horsePower' => 'Puter motor',
        'fuelAverage' => 'Consum Mediu',
        'fuelUrban' => 'Consum urban',
        'fuelExtra' => 'Consum extra urban',
        'autoId' => 'Marca auto'
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

    /**
     * formulat adaugare motorizare noua, primeste ca parametru marca
     *
     * @param int $id
     */
    public function add($id = null)
    {
        //verificam daca a fost trimisa cererea de post pentru adaugare intrare noua
        if (isset($_POST['add'])) {
            //validam datele primite prin POST
            $result = $this->validateData($_POST, $this->addValidateFields);

            //verificam daca sunt erori
            if (count($result)) {
                //adaugam erorile in vizualizare, si setam datele trimise prin POST
                $this->set('errors', $result);
                $this->set('data', $_POST);
            } else {
                //daca nu au fost erori adaugam o intrare noua pentru tabela engine
                $sql = "INSERT INTO engine (`type`, `capacity`, `name`, `horsePower`, `fuelAverage`, "
                    . "`fuelUrban`, `fuelExtra`, `autoId`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(
                    array(
                        $_POST['type'], $_POST['capacity'],
                        $_POST['name'], $_POST['horsePower'],
                        $_POST['fuelAverage'], $_POST['fuelUrban'],
                        $_POST['fuelExtra'], $_POST['autoId']
                    )
                );
                $result = $stmt->rowCount();
                if ($result) {
                    $this->redirect('engine/listEngine');
                }
            }
        }
        if ($id && is_numeric($id)) {
            $this->set('auto', $id);
            $this->set('autos', array());
        } else {
            $sql = "SELECT * FROM auto ORDER BY name ASC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $this->set('autos', $result);
        }
        $this->set('types', $this->listEngineType());
    }

    /**
     * formular editare intrare tabela engine, primeste ca parametru idul motorizarii
     *
     * @param int $id
     */
    public function edit($id = null)
    {
        if (!is_numeric($id)) {
            $this->redirect('engine/listEngine');
        } else {
            $this->set('id', $id);


            if (isset($_POST['add'])) {
                $validateFields = $this->addValidateFields;
                unset($validateFields['autoId']);
                $result = $this->validateData($_POST, $this->addValidateFields);
                if (count($result)) {
                    $this->set('errors', $result);
                    $this->set('data', $_POST);
                } else {
                    $sql = "UPDATE engine SET "
                        . "name = ?, type = ?, capacity = ?,"
                        . "horsePower = ?, fuelAverage = ?,"
                        . "fuelUrban = ?, fuelExtra = ?, "
                        . "autoId = ? "
                        . "WHERE id = ?;";
                    $stmt = $this->db->prepare($sql);
                    $stmt->execute(
                        array(
                            $_POST['name'], $_POST['type'],
                            $_POST['capacity'], $_POST['horsePower'],
                            $_POST['fuelAverage'], $_POST['fuelUrban'],
                            $_POST['fuelExtra'], $_POST['autoId'],
                            $id
                        )
                    );
                    $result = $stmt->rowCount();
                    if ($result) {
                        $this->redirect('engine/edit/' . $id);
                    }
                }
            } else {
                $sql = "SELECT * FROM engine WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(array($id));
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->set('data', $result);
                $this->set('types', $this->listEngineType());
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
     * listare motorizari
     *
     */
    public function listEngine()
    {
        $sql = "SELECT en. *, au.name as autoName "
            . "FROM engine AS en "
            . "LEFT JOIN auto AS au ON en.autoId = au.id "
            . "ORDER BY name ASC";

        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll();
        $this->set('data', $result);
        $this->set('type', $this->listEngineType());
    }

    /**
     *
     * @return array vector cu tipurile de motorizari
     */
    public static function listEngineType()
    {
        return array(
            self::GPL => 'GPL',
            self::DIESEL => 'Diesel',
            self::GASOLINE => 'Benzina',
            self::HYBRID => 'Hibrid',
            self::ELECTRIC => 'Electric',
        );
    }

}
