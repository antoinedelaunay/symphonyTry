<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Blog\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Auteur
 *
 * @author adelaunay2015
 * @ORM\Entity
 * @ORM\Table(name="Biography")}
 * 
 */
class Biography {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="description", type="string", length=150)
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="user", inversedBy="biography")
     */
    private $user;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Biography
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set user
     *
     * @param \Blog\FrontBundle\Entity\user $user
     * @return Biography
     */
    public function setUser(\Blog\FrontBundle\Entity\user $user = null) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Blog\FrontBundle\Entity\user 
     */
    public function getUser() {
        return $this->user;
    }

}
