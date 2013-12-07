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
            array(
                'css-icon' => 'icon-square-plus',
                'head-title' => 'Lista Marci Auto',
                'tooltip-text' => 'Lista Marci Auto',
                'link' => 'car/autoList'
            ),
        );
        $this->set('items', $dashboardItems);
    }

    function afterAction()
    {
        
    }

}
