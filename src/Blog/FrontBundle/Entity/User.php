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
 * @ORM\Entity(repositoryClass="Blog\FrontBundle\Entity\Repository")
 * @ORM\Table(name="User")}
 * 
 */
class User {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="lastname", type="string", length=150)
     */
    private $lastname;

    /**
     * @ORM\Column(name="firstname", type="string", length=150)
     */
    private $firstname;

    /**
     * @ORM\Column(name="email", type="string", length=150)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="user")
     */
    private $posts;

    /**
     * @ORM\OneToOne(targetEntity="Biography", mappedBy="user")
     */
    private $biography;

    /**
     * Constructor
     */
    public function __construct() {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname() {
        if ($this->firstname == null)
            return "unknow";
        else
            return $this->firstname;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Add posts
     *
     * @param \Blog\FrontBundle\Entity\Post $posts
     * @return User
     */
    public function addPost(\Blog\FrontBundle\Entity\Post $posts) {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param \Blog\FrontBundle\Entity\Post $posts
     */
    public function removePost(\Blog\FrontBundle\Entity\Post $posts) {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts() {
        return $this->posts;
    }

    /**
     * Set biography
     *
     * @param \Blog\FrontBundle\Entity\Biography $biography
     * @return User
     */
    public function setBiography(\Blog\FrontBundle\Entity\Biography $biography = null) {
        $this->biography = $biography;

        return $this;
    }

    /**
     * Get biography
     *
     * @return \Blog\FrontBundle\Entity\Biography 
     */
    public function getBiography() {
        return $this->biography;
    }

}
