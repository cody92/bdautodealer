<?php

class BdController
{

    protected $_controller;
    protected $_action;
    protected $_template;
    protected $showLayout = true;
    protected $title = 'BD Auto Dealer';
    public $show = true;
    public $db;

    /**
     * constructor pentru clasa BdController, care va fi folosit ca controller de baza din care vor fi extinse celelalte
     * controller
     * fiecare actiune dintr-o clasa va fi o pagina din aplicatie care va fi apelata sub forma
     * {url_aplicatie}/nume_controller/nume_actiune[/parametru_1/parametru_2]
     *
     * @param string $controller
     * @param string $action
     */
    function __construct($controller, $action)
    {
        //instantierea componentei pentru baza de date
        $this->db = MySqlAdapter::connect();

        //setarea controllerului
        $this->_controller = ucfirst($controller);

        //setarea actiunii
        $this->_action = $action;
        //instantierea tempplateului
        $this->_template = new Template($controller, $action);

        //setarea numelui paginii
        $this->_template->setPageTitle($this->title);
    }

    /**
     * setarea unei variabile in template
     *
     * @param string $name nume variabila template
     * @param string $value valoare variabila template
     */
    function set($name, $value)
    {
        $this->_template->set($name, $value);
    }

    /**
     * desctructor pentru controller
     */
    function __destruct()
    {
        // daca este setat sa afisam pagina, incarcam templateul cu datele
        if ($this->show) {
            $this->_template->render($this->showLayout);
        }
        // inchidem conexiunea la baza de date
        $this->db = null;
    }

    /**
     * metoda pentru validare unui input dintr-un formular, verifcare daca este completat
     *
     * @param string $input
     * @return boolean
     */
    public function validateInput($input)
    {
        if (is_string($input) && (('' === $input) || preg_match('/^\s+$/s', $input))
        ) {
            return false;
        } elseif (!is_string($input) && empty($input)) {
            return false;
        }
        return true;
    }

    /**
     * metoda pentru redirect catre alta pagina in aplicatie
     *
     * @param string $url url de forma {nume_controller}/{nume_actiune}[/parametru]
     */
    public function redirect($url)
    {
        header('Location: ' . $this->_template->url($url));
        exit;
    }

}
