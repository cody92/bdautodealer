<?php

class CarController extends VanillaController
{

    function beforeAction()
    {
        
    }

    function index()
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

    function afterAction()
    {
        
    }

    public function adaugaMarca()
    {
        //logo upload is not implemented yet
        if (isset($_POST['add'])) {
            $result = $this->validateData($_POST);
            if (count($result)) {
                $this->set('errors', $result);
                $this->set('data', $_POST);
            } else {
                $sql = "INSERT INTO auto (`name`, `description`) VALUES (?, ?)";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(array($_POST['nume_marca'], $_POST['descriere_marca']));
                $result = $stmt->rowCount();
                if ($result) {
                    $this->redirect('car/autoList');
                }
            }
        }
    }

    private function validateData($data)
    {
        $errors = array();
        if (!$this->validateInput($data['nume_marca'])) {
            $errors['nume_marca'][] = 'Campul "Nume marca" nu poate fi gol';
        }
        if (!$this->validateInput($data['descriere_marca'])) {
            $errors['descriere_marca'][] = 'Campul Descriere marca nu poate fi gol';
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

    public function getMarca($marcaName)
    {
        
    }
    
    public function autoList()
    {
        $sql = "SELECT * FROM auto ORDER BY name ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $this->set('data',$result);
    }

}
