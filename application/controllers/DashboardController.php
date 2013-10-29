<?php

class DashboardController extends VanillaController
{

    function beforeAction()
    {
        
    }

    function view($categoryId = null)
    {
        
    }

    function index()
    {
        $dashboardItems = array(
            array(
                'css-icon' => 'icon-square-plus',
                'head-title' => 'Adauga marca',
                'tooltip-text' => 'Adauga marca noua',
                'link' => 'car/adaugaMarca'
            ),
        );
        $this->set('items', $dashboardItems);
    }

    function afterAction()
    {
        
    }

}
