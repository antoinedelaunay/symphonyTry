<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Blog\FrontBundle\Resources\Objet;
/**
 * Description of article
 *
 * @author adelaunay2015
 */
class Article {
    private $id;
    private $Titre;
    private $auteur;
    private $date;
    private $contenu_texte;

    function __construct($id, $titre, $auteur, $date, $content) {
        $this->id = $id;
        $this->Titre = $titre;
        $this->auteur = $auteur;
        $this->date = $date;
        $this->contenu_texte = $content;
    }

    function getId() {
        return $this->id;
    }

    function getTitre() {
        return $this->Titre;
    }

    function getAuteur() {
        return $this->auteur;
    }

    function getDate() {
        return $this->date;
    }

    function getContenu_texte() {
        return $this->contenu_texte;
    }

    function setId($val) {
        $this->id = $val;
    }
    
    function setTitre($val) {
        $this->Titre = $val;
    }

    function setAuteur($val) {
        $this->auteur = $val;
    }

    function setDate($val) {
        $this->date = $val;
    }

    function setContenu_texte($val) {
        $this->contenu_texte = $val;
    }
    
    
}
