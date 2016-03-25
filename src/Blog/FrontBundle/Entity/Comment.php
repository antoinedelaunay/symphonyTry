<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Blog\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of Auteur
 *
 * @author adelaunay2015
 * @ORM\Entity(repositoryClass="Blog\FrontBundle\Entity\Repository")
 * @ORM\Table(name="Comment")}
 * 
 */
class Comment {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=150)
     * @Assert\Length(min=5,max=150)
     */
    private $title;

    /**
     * @ORM\Column(name="description", type="string", length=150)
     * @Assert\Length(min=20,max=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments",cascade={"persist"})
     * 
     */
    private $post;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Comment
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Comment
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
     * Set post
     *
     * @param \Blog\FrontBundle\Entity\Post $post
     * @return Comment
     */
    public function setPost(\Blog\FrontBundle\Entity\Post $post = null) {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \Blog\FrontBundle\Entity\Post 
     */
    public function getPost() {
        return $this->post;
    }

}
