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
 * @ORM\Table(name="posts")}
 */
class Post {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=150)
     */
    private $title;

    /**
     * @ORM\Column(name="text", type="string")
     */
    private $text;

    /**
     * @ORM\Column(name="datePublish", type="datetime", nullable=true)
     */
    private $datePublish;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     * @ORM\JoinColumn(onDelete="CASCADE") 
     */
    private $comments;

    /**
     * coté propriétaire de la relation vers user
     * @var \Blog\FrontBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="posts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct() {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Post
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
     * Set text
     *
     * @param string $text
     * @return Post
     */
    public function setText($text) {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText() {
        return $this->text;
    }

    /**
     * Set datePublish
     *
     * @param \DateTime $datePublish
     * @return Post
     */
    public function setDatePublish($datePublish) {
        $this->datePublish = $datePublish;

        return $this;
    }

    /**
     * Get datePublish
     *
     * @return \DateTime 
     */
    public function getDatePublish() {
        return $this->datePublish;
    }
    
    /**
     * Add comments
     *
     * @param \Blog\FrontBundle\Entity\Comment $comments
     * @return Post
     */
    public function addComment(\Blog\FrontBundle\Entity\Comment $comments) {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Blog\FrontBundle\Entity\Comment $comments
     */
    public function removeComment(\Blog\FrontBundle\Entity\Comment $comments) {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments() {
        return $this->comments;
    }

    /**
     * Set user
     *
     * @param \Blog\FrontBundle\Entity\User $user
     * @return Post
     */
    public function setUser(\Blog\FrontBundle\Entity\User $user = null) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Blog\FrontBundle\Entity\User 
     */
    public function getUser() {
        return $this->user;
    }
    
    public function traitementTextPreview(){
        if( strlen($this->text)>50){
            $res = substr($this->text, 0, 50);
            $res .="[...]";
            return $res;
        }
        else{
            return $this->text;
        }
    }

}
