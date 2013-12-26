<?php

class DashboardController extends VanillaController
{

    public function beforeAction()
    {

    }

    public function view($categoryId = null)
    {

    }

    public function index()
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
            array(
                'css-icon' => 'icon-square-plus',
                'head-title' => 'Adauga Model',
                'tooltip-text' => 'Adauga Model',
                'link' => 'model/add'
            ),
            array(
                'css-icon' => 'icon-square-plus',
                'head-title' => 'Lista Modele Auto',
                'tooltip-text' => 'Lista Modele Auto',
                'link' => 'model/listModels'
            ),
            array(
                'css-icon' => 'icon-square-plus',
                'head-title' => 'Adauga motorizare',
                'tooltip-text' => 'Adauga motorizare',
                'link' => 'engine/add'
            ),
            array(
                'css-icon' => 'icon-square-plus',
                'head-title' => 'Listare motorizari',
                'tooltip-text' => 'Listare motorizari',
                'link' => 'engine/listEngine'
            ),
            array(
                'css-icon' => 'icon-square-plus',
                'head-title' => 'Adauga echipament',
                'tooltip-text' => 'Adauga echipament',
                'link' => 'equipment/add'
            ),
            array(
                'css-icon' => 'icon-square-plus',
                'head-title' => 'Lista echipamente',
                'tooltip-text' => 'Lista echipamente',
                'link' => 'equipment/listEquipment'
            ),
        );
        $this->set('items', $dashboardItems);
    }

    public function afterAction()
    {

    }

}
