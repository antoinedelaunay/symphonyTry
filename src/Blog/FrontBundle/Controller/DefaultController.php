<?php

namespace Blog\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Blog\FrontBundle\Resources\Objet\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller {

    /**
     * @Template("FrontBundle:Default:indexMaterial.html.twig")
     * @Route("/")
     */
    public function indexAction() {
        $article1 = new Article(9, "titre1", "auteur1", "01/01/2001", "<h3>CONTENT number 1</h3>");
        $article2 = new Article(55, "titre2", "auteur2", "02/02/2002", "<h3>CONTENT number 2</h3>");
        $article3 = new Article(46, "titre3", "auteur3", "03/03/2003", "<h3>CONTENT number 3</h3>");
        $article4 = new Article(666, "titre4", "auteur4", "04/04/2004", "<h3>CONTENT number 4</h3>");

        $info = array(
            'titre' => 'test',
            'articles' => array($article1, $article2, $article3, $article4),
        );
        return $info;
    }

    /**
     * @Template("FrontBundle:Default:aboutMaterial.html.twig")
     * @Route("/")
     */
    public function aboutAction() {
        
    }

    /**
     * @Template("FrontBundle:Default:formMaterial.html.twig")
     * @Route("/")
     */
    public function formAction() {
        
    }

    /**
     * @Template("FrontBundle:Default:livreMaterial.html.twig")
     * @Route("/")
     */
    public function livreAction() {
        
    }

}
