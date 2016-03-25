<?php

namespace Blog\FrontBundle\Resources\Objet;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Config\Definition\Exception\Exception;

class sessionObject {

    var $session;

    public function __construct() {
        try {
            $this->session = new Session();
            $this->session->start();
        } catch (Exception $e) {
            //la session est déja initialisée
            $this->session->clear();
        }
    }

    public function setData($dataName, $dataValue) {
        $this->session->set($dataName, $dataValue);
        return $this;
    }

    public function getData($dataName) {
        return $this->session->get($dataName);
    }

    public function closeSession() {
        $this->session->clear();
    }

}
