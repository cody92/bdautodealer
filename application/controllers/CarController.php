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

        if (isset($_POST['add'])) {
            $result = $this->validateData($_POST);
            if ($result) {
                
            } else {
                
            }
        }
    }

    private function validateData($data)
    {
        $errors = array();
        if(!$this->validateInput($data['nume_marca']))
        {
            
        }
    }
    
    public function getMarca($marcaName)
    {
        
    }
    

}
