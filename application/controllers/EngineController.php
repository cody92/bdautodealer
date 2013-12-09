<?php

class EngineController extends VanillaController
{

    const GPL = 1;
    const DIESEL = 2;
    const GASOLINE = 3;
    const HYBRID = 4;
    const ELECTRIC = 5;

    function index()
    {
        $this->redirect('dashboard/index');
    }

    function beforeAction()
    {

    }

    function afterAction()
    {

    }

    public function add()
    {

        if (isset($_POST['add'])) {
            $result = $this->validateData($_POST);
            if (count($result)) {
                $this->set('errors', $result);
                $this->set('data', $_POST);
            } else {
                $sql = "INSERT INTO engine (`type`, `capacity`, `name`, `horsePower`, `fuelAverage`, "
                    . "`fuelUrban`, `fuelExtra`) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(
                    array(
                        $_POST['engine_type'], $_POST['engine_capacity'],
                        $_POST['engine_name'], $_POST['engine_power'],
                        $_POST['engine_average'], $_POST['engine_urban'],
                        $_POST['engine_extra']
                    )
                );
                $result = $stmt->rowCount();
                if ($result) {
                    $this->redirect('engine/listEngine');
                }
            }
        } else {
            $this->set('types', $this->listEngineType());
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

    public function edit($id)
    {
        if (!is_numeric($id)) {
            $this->redirect('engine/listEngine');
        } else {
            $this->set('id', $id);


            if (isset($_POST['add'])) {
                $result = $this->validateEditData($_POST);
                if (count($result)) {
                    $this->set('errors', $result);
                    $this->set('data', $_POST);
                } else {
                    $sql = "UPDATE engine SET "
                        . "name = ?, type = ?, capacity = ?,"
                        . "horsePower = ?, fuelAverage = ?,"
                        . "fuelUrban = ?, fuelExtra = ? "
                        . "WHERE id = ?;";
                    $stmt = $this->db->prepare($sql);
                    $stmt->execute(
                        array(
                            $_POST['name'], $_POST['type'],
                            $_POST['capacity'], $_POST['horsePower'],
                            $_POST['fuelAverage'], $_POST['fuelUrban'],
                            $_POST['fuelExtra'], $id
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

    private function validateData($data)
    {
        $errors = array();
        if (!$this->validateInput($data['engine_name'])) {
            $errors['engine_name'][] = 'Campul "Nume motrizare" nu poate fi gol';
        }
        if (!$this->validateInput($data['engine_type'])) {
            $errors['engine_type'][] = 'Campul Tip model nu poate fi gol';
        }
        if (!$this->validateInput($data['engine_capacity'])) {
            $errors['engine_capacity'][] = 'Campul Capacitate nu poate fi gol';
        }
        if (!$this->validateInput($data['engine_average'])) {
            $errors['engine_average'][] = 'Campul Consum mediu nu poate fi gol';
        }
        if (!$this->validateInput($data['engine_extra'])) {
            $errors['engine_extra'][] = 'Campul Consum extra-urban nu poate fi gol';
        }
        if (!$this->validateInput($data['engine_urban'])) {
            $errors['engine_urban'][] = 'Campul Consum urban nu poate fi gol';
        }
        return $errors;
    }

    private function validateEditData($data)
    {
        $errors = array();
        if (!$this->validateInput($data['name'])) {
            $errors['name'][] = 'Campul "Nume motrizare" nu poate fi gol';
        }
        if (!$this->validateInput($data['type'])) {
            $errors['type'][] = 'Campul Tip model nu poate fi gol';
        }
        if (!$this->validateInput($data['capacity'])) {
            $errors['capacity'][] = 'Campul Capacitate nu poate fi gol';
        }
        if (!$this->validateInput($data['fuelAverage'])) {
            $errors['fuelAverage'][] = 'Campul Consum mediu nu poate fi gol';
        }
        if (!$this->validateInput($data['fuelExtra'])) {
            $errors['fuelExtra'][] = 'Campul Consum extra-urban nu poate fi gol';
        }
        if (!$this->validateInput($data['fuelUrban'])) {
            $errors['fuelUrban'][] = 'Campul Consum urban nu poate fi gol';
        }
        return $errors;
    }

    public function listEngine()
    {
        $sql = "SELECT * FROM engine ORDER BY name ASC";

        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll();
        $this->set('data', $result);
        $this->set('type', $this->listEngineType());
    }

    public function listEngineType()
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
