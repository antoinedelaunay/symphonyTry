<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DemoBundle\Controller;

use DemoBundle\Entity\Categorie;
use DemoBundle\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of CategController
 *
 * @author sollivier
 */
class CategController extends Controller {

    public function addAction($libelle) {

        $em = $this->getDoctrine()->getManager();

        $categ = new Categorie();
        
        $libelle = filter_var($libelle);
        
        $categ->setLibelle($libelle);

        $em->persist($categ);
        $em->flush();

        return new Response("Catégorie $libelle ajoutée avec l'id " . $categ->getId());
    }

    public function removeAction($id) {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('DemoBundle:Categorie');

        $categ = $rep->find($id);

        if ($categ !== null) {
            $em->remove($categ);
            $em->flush();

            $response = "Categorie " . $categ->getLibelle() . " suppimée !";
        } else {
            $response = "Pas de catégorie avec l'ID $id.";
        }
        return new Response($response);
    }

    public function insertAction(Request $request){
        $categorie = new Categorie();

        $form = $this->createForm(CategorieType::class,$categorie);
        $form->add('ajouterCategorie',SubmitType::class); 
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('livre_index');
        }
        
        return $this->render(
                'DemoBundle:Categorie:insert.html.twig',
                array('maform'=>$form->createView())
                );
        
    }
}
