<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DemoBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Auteur
 *
 * @author sollivier
 * @ORM\Entity
 * @ORM\Table(
 *  name="auteurs",
 *  indexes={@ORM\Index(name="IDX_AUTEUR_NOM_PRENOM",columns={"nom","prenom"})} 
 *  )
 * 
 */
class Auteur {
    /**
     *
     * @var type 
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     *
     * @var type 
     * @ORM\Column(length=100)
     */
    private $nom;
    /**
     *
     * @var type 
     * @ORM\Column(length=100)
     */
    private $prenom;
    /**
     *
     * @var type 
     * @ORM\Column(length=50,nullable=true)
     */
    private $nationalite;
    
    /**
     * @ORM\ManyToMany(targetEntity="Livre",mappedBy="auteurs")
     */
    private $livres;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->livres = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Auteur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Auteur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nationalite
     *
     * @param string $nationalite
     *
     * @return Auteur
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get nationalite
     *
     * @return string
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * Add livre
     *
     * @param \DemoBundle\Entity\Livre $livre
     *
     * @return Auteur
     */
    public function addLivre(\DemoBundle\Entity\Livre $livre)
    {
        $this->livres[] = $livre;

        return $this;
    }

    /**
     * Remove livre
     *
     * @param \DemoBundle\Entity\Livre $livre
     */
    public function removeLivre(\DemoBundle\Entity\Livre $livre)
    {
        $this->livres->removeElement($livre);
    }

    /**
     * Get livres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLivres()
    {
        return $this->livres;
    }
}
