<?php
namespace DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of Categorie
 *  
 * @author sollivier
 * @ORM\Entity
 * @ORM\Table(name="categories")
 */
class Categorie {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;
    
    /**
     * @ORM\Column(length=50)
     * @Assert\NotBlank(message="Libellé de catégorie obligatoire")
     */
    private $libelle;
    
    /**
     *
     * @var type 
     * @ORM\OneToMany(targetEntity="Livre",mappedBy="categorie",cascade={"persist","remove"})
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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Categorie
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Add livre
     *
     * @param \DemoBundle\Entity\Livre $livre
     *
     * @return Categorie
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
