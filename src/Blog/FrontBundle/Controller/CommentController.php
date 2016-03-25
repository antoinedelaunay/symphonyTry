<?php

namespace Blog\FrontBundle\Controller;
use Blog\FrontBundle\Form\CommentType;
use Blog\FrontBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller {

    
    /**
     * @Template("FrontBundle:form:formTest.html.twig")
     * @Route("/")
     */
    public function indexAction(Request $request) {
    
        $commentaire = new Comment();
        
        $form=  $this->createForm(CommentType::class,$commentaire);
        
        // Traiter la requête
        $form->handleRequest($request);
        // Si la requête fait suite ià la soumission du formulaire
        // et si les données du formulaire sont valides :
        if ($form->isSubmitted() && $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();
            // redirection vers la page "résultat"
//            $route = $form->get('ajouter')
//                    ->isClicked()?'livre_index':'livre_add';
//            return $this->redirectToRoute($route);
            $responce = "ok";
            return new Response($responce);
            }
        
        // Rendu du formulaire
        return $this->render(
                'FrontBundle:Form:formTest.html.twig',
                array('form'=>$form->createView())
                );
    }
}