<?php

namespace Blog\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Blog\FrontBundle\Entity\Post;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Blog\FrontBundle\Entity\repository;
use Blog\FrontBundle\Resources\Objet\sessionObject;
use Blog\FrontBundle\Entity\Comment;
use Blog\FrontBundle\Form\CommentType;

class PostController extends Controller {

    /**
     * @Template("FrontBundle:Default:postMaterial.html.twig")
     * @Route("/")
     */
    public function viewAction($id, Request $request) {
        if (is_numeric($id)) {
            if ($id > 0) {
                //$session = $request->getSession();
                //$tempPost = $session->get('post');
                $res = $this->getDoctrine()
                        ->getRepository('FrontBundle:Post')
                        ->getPost($id);
                $comment = $this->getDoctrine()
                        ->getRepository('FrontBundle:Comment')
                        ->getComment($id);
                $result = array('id' => $id,
                    'comment' => $comment,
                    'article' => $res[0]);
            } else
                throw $this->createNotFoundException($id . " n'est pas un chiffre valide");
        } else
            throw $this->createNotFoundException($id . " n'est pas un chiffre");


        $commentaire = new Comment();

        $form = $this->createForm(CommentType::class, $commentaire);

        $result['form'] = $form->createView();
        // Traiter la requête
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $commentaire->setPost($res[0]);
            $em->persist($commentaire);
            $em->flush();
            return $this->redirectToRoute('blog_view', array('id'=>$id));
        }

        // Rendu du formulaire
        return $result;
    }

    public function addAction($userid, Request $request) {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('FrontBundle:User');
        $user = $repository->findby($userid);

        $post = new Post();
        $post->setUser($user)
                ->setText("test1")
                ->setTitle("titre1")
                ->setDatePublish(new DateTime('2016-01-01'));

        $em->persist($post);
        $em->flush();
        return new Response("<HTML><BODY>post{$post->getTitle()} ajouté a la liste des posts {$categorie->getId()} </BODY></HTML>");
    }

    public function getLastPostsAction(Request $request) {
        //$session = $request->getSession();
        $nbPosts = 50;
        $post = $this->getDoctrine()
                ->getRepository('FrontBundle:Post')
                ->lastElementPost($nbPosts);
        // $session->set('post', $post);
        $res = array('article' => $post);
        return $this->render('FrontBundle:Default:ResMaterial.html.twig', $res);
    }

}
