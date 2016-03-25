<?php

namespace Blog\FrontBundle\Controller;

use Blog\FrontBundle\Entity\Categorie;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategorieController extends Controller {

    public function addAction($libelle) {
        $em = $this->getDoctrine()->getManager();
        $categorie = new Categorie();
        $categorie->setLibelle($libelle);
        $em->persist($categorie);
        $em->flush();
        return new Response("<HTML><BODY>libelle{$categorie->getLibelle()} ajouté a la catégorie {$categorie->getId()} </BODY></HTML>");
    }

    public function removeAction($id) {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('FrontBundle:Categorie');
        $categorie = $repository->find($id);
        if ($categorie != null) {
            $em->remove($categorie);
            $em->flush();
            $responce = "<HTML><BODY>catégorie ayant l'id {$id} deleted</BODY></HTML>";
        } else {
            $responce = "<HTML><BODY>Un erreur est survenue, la catégorie ayant l'id {$id} n'a pas été supprimée</BODY></HTML>";
        }
        return new Response($responce);
    }

}
