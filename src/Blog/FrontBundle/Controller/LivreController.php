<?php

namespace Blog\FrontBundle\Controller;

use Blog\FrontBundle\Entity\Livre;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LivreController extends Controller {

    public function addAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $repCategorie = $em->getRepository('FrontBundle:Categorie');
        $categorie = $repCategorie->findOneBy(array('libelle' => 'technique'));

        $livre = new Livre();
        $livre->setTitre("petit paunay")
                ->setDateParution(new DateTime('2014-07-07'))
                ->setCategorie($categorie);

        $em->persist($livre);
        $em->flush();
        return new Response("<HTML><BODY>OK pour l'ajour de {$livre->getTitre()} </BODY></HTML>");
    }

    public function editAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('FrontBundle:Livre');
        $livre = $repository->find($id);

        $livre->setTitre("un nouveau titre");
        $em->persist($livre);
        $em->flush();
        return new Response("<HTML><BODY>OK pour la mise a jour de {$livre->getTitre()} </BODY></HTML>");
    }

    public function deleteAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('FrontBundle:Livre');
        $livre = $repository->find($id);

        if ($livre != null) {
            $em->remove($livre);
            $em->flush();
            $responce = "<HTML><BODY>Livre ayant l'id {$id} correctement supprimé</BODY></HTML>";
        } else {
            $responce = "<HTML><BODY>Une erreur est survenue, le livre ayant l'id {$id} n'a pas été supprimé</BODY></HTML>";
        }
        return new Response($responce);
    }

    public function getLibelleCategotyToEntities() {
        $arraytoReturn = $this->getDoctrine()->getRepository("FrontBundle:Categorie");
        return $arraytoReturn->findAll();
    }

    public function formAction(Request $request) {
        $Livre = new Livre();
        $form = $this->createFormBuilder($Livre)
                ->add('titre', TextType::class)
                ->add('dateParution', DateType::class)
                ->add('categorie', Choicetype::class, array(
                    'choices' => $this->getLibelleCategotyToEntities(),
                    'choices_as_values' => true,
                    'choice_label' => 'libelle'
                ))
                ->add('valider', SubmitType::class)
                ->getForm();
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Livre);
            $em->flush();
            $responce = "ajout effectué";
            return new Response($responce);
        }
        return $this->render("FrontBundle:Default:formTest.html.twig", array('form' => $form->createView(),
                    'titre' => 'test du formulaire'));
    }

}
