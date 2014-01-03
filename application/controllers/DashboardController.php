<?php

class DashboardController extends BdController
{

    /**
     *
     * @var array itemi pentru pagina principala si pentru meniu
     */
    public static $dashboardItems = array(
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

    public function beforeAction()
    {

    }

    public function index()
    {
        // generam pagina principala
        $this->set('items', self::$dashboardItems);
    }

    public function afterAction()
    {

    }

}
