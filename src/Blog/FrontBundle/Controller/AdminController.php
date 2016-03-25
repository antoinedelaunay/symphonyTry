<?php

namespace Blog\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Blog\FrontBundle\Resources\Objet\Article;
use Blog\FrontBundle\Entity\Post;
use Blog\FrontBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Blog\FrontBundle\Form\AdminType;
use Blog\FrontBundle\Form\AdminAddType;
use Blog\FrontBundle\Form\AdminDeleteType;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;

class AdminController extends Controller {

    /**
     * @Template("FrontBundle:Default:adminFormMaterial.html.twig")
     * @Route("/")
     */
    public function editAction($id, Request $request) {

        $post = $this->getDoctrine()
                ->getRepository('FrontBundle:Post')
                ->getPost($id);
        $form = $this->createForm(AdminType::class, $post[0]);
        $result = array('form' => $form->createView());
// Traiter la requête
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post[0]);
            $em->flush();
            return $this->redirectToRoute('blog_view', array('id' => $id));
        }
        return $result;
    }

    /**
     * @Template("FrontBundle:Default:adminFormAjoutMaterial.html.twig")
     * @Route("/")
     */
    public function addAction(Request $request) {
        $post = new Post();
        $form = $this->createForm(AdminAddType::class, $post);
        $result = array('form' => $form->createView());
// Traiter la requête
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            //return new Response('ok');
            return $this->redirectToRoute('blog_index');
        }
        return $result;
    }

    /**
     * @Template("FrontBundle:Default:adminFromDeleteMaterial.html.twig")
     * @Route("/")
     */
    public function deleteAction(Request $request) {

        $CommentPost = new Post();
        $form = $this->createForm(AdminDeleteType::class, $CommentPost);
        $result = array('form' => $form->createView());
// Traiter la requête
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
//            $responce = var_dump($CommentPost->getTitle()->getId());
//            return new \Symfony\Component\BrowserKit\Response($responce);
//            $em->remove($CommentPost);
//            $em->flush();
//            $Comment = $CommentPost->getId(); 
            
            //pour récuperer mon id du commentaire, je passe par le titre, aucune idée de pourquoi du comment
            $post = $this->getDoctrine()
                ->getRepository('FrontBundle:Comment')
                ->deleteComment($CommentPost->getTitle()->getId());
            return $this->redirectToRoute('blog_index');
        }
        return $result;
    }

}
