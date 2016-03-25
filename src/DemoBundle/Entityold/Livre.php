<?php

namespace DemoBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of Livre
 *
 * @author sollivier
 * @ORM\Entity(repositoryClass="DemoBundle\Entity\LivreRepository")
 * @ORM\Table(
 *    name="livres",
 *    indexes={@ORM\Index(name="IDX_LIVRE_TITRE",columns={"titre"})},
 *    uniqueConstraints={@ORM\UniqueConstraint(name="UQ_TITRE_DATE",columns={"titre","date_parution"})}
 * )
 * 
 */
class Livre {
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;
    
    /**
     * @ORM\Column(type="string",length=150)
     * @Assert\NotBlank(message="Le titre doit être spécifié")
     * @Assert\Length(min=5,max=50)
     */
    private $titre;
    
    /**
     * @ORM\Column(name="date_parution",type="date",nullable=true)
     * @Assert\Date()
     */
    private $dateParution;
    
    /**
     *
     * @var \DemoBundle\Entity\Categorie
     * @ORM\ManyToOne(targetEntity="Categorie",inversedBy="livres",cascade={"persist","remove"})
     * @Assert\NotNull(message="La catégorie du livre doit être indiquée")     
     */
    private $categorie;
    
    /**
     *
     * @ORM\ManyToMany(targetEntity="Auteur",inversedBy="livres")
     */
    private $auteurs;
    

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
     * Set titre
     *
     * @param string $titre
     *
     * @return Livre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set dateParution
     *
     * @param \DateTime $dateParution
     *
     * @return Livre
     */
    public function setDateParution($dateParution)
    {
        $this->dateParution = $dateParution;

        return $this;
    }

    /**
     * Get dateParution
     *
     * @return \DateTime
     */
    public function getDateParution()
    {
        return $this->dateParution;
    }

    /**
     * Set categorie
     *
     * @param \DemoBundle\Entity\Categorie $categorie
     *
     * @return Livre
     */
    public function setCategorie(\DemoBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \DemoBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->auteurs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add auteur
     *
     * @param \DemoBundle\Entity\Auteur $auteur
     *
     * @return Livre
     */
    public function addAuteur(\DemoBundle\Entity\Auteur $auteur)
    {
        $this->auteurs[] = $auteur;

        return $this;
    }

    /**
     * Remove auteur
     *
     * @param \DemoBundle\Entity\Auteur $auteur
     */
    public function removeAuteur(\DemoBundle\Entity\Auteur $auteur)
    {
        $this->auteurs->removeElement($auteur);
    }

    /**
     * Get auteurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuteurs()
    {
        return $this->auteurs;
    }
}
