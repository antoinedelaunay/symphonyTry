<?php

namespace DemoBundle\Controller;

use DemoBundle\Entity\Livre;
use DemoBundle\Form\LivreType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of LivreController
 *
 * @author sollivier
 */
class LivreController extends Controller {

    public function addAction(Request $request) {

        // Création de l'entité de données associée au formulaire.
        $livre = new Livre();
        
        // Création de l'objet Form
//        $form = $this->createFormBuilder($livre)
//                ->add('titre',TextType::class)
//                ->add('dateParution',  DateType::class)
//                ->add('categorie',ChoiceType::class,array(
//                            'choices'=>$this->getCurrentCategories(),
//                            'choices_as_values'=>true,
//                            'choice_label'=>'libelle'
//                        ))
//                ->add('ajouter',  SubmitType::class)
//                ->add('sauverEtAjouter',  SubmitType::class)
//                ->getForm();
        
        $form=  $this->createForm(LivreType::class,$livre);
        
        // Traiter la requête
        $form->handleRequest($request);
        // Si la requête fait suite ià la soumission du formulaire
        // et si les données du formulaire sont valides :
        if ($form->isSubmitted() && $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($livre);
            $em->flush();
            // redirection vers la page "résultat"
            $route = $form->get('ajouter')
                    ->isClicked()?'livre_index':'livre_add';
            return $this->redirectToRoute($route);
        }
        
        // Rendu du formulaire
        return $this->render(
                'DemoBundle:Livre:add.html.twig',
                array('maform'=>$form->createView())
                );
    }
    
    private function getCurrentCategories(){
        $rep=  $this->getDoctrine()->getRepository('DemoBundle:Categorie');
        return $rep->findAll();
    }

    public function editAction($id, Request $request) {
        // obtention du Repository pour les livres.
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('DemoBundle:Livre');

        $livre = $repository->find($id);
        $livre->setTitre('Symfony 2, le retour !');
        $em->persist($livre);
        $em->flush();

        return new Response("MAJ de " . $livre->getId() . " effectué : " . $livre->getTitre());
    }

    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("DemoBundle:Livre");

        $livre = $repo->find($id);
        $em->remove($livre);
        $em->flush();

        return new Response("Livre " . $livre->getTitre() . " supprimé !");
    }
    
    public function indexAction(){
        $rep = $this->getDoctrine()->getRepository('DemoBundle:Livre');
        $data = $rep->getAllTitres();
        
        return $this->render(
                'DemoBundle:Livre:index.html.twig',
                array('livres'=>$data));
    }

}
