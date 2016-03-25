<?php

namespace Blog\FrontBundle\Controller;

use Blog\FrontBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserController extends Controller {

    public function addAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        
        $user = new User();
        $user   ->setFirstname("toto3")
                ->setLastname("tata3")
                ->setEmail("pouet3@gmail.com")
                ->setBiography();
        
        $em->persist($user);
        $em->flush();
        return new Response("<HTML><BODY>OK pour l'ajour de {$user->getFirstname()} </BODY></HTML>");
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
        
        if($livre != null){
            $em->remove($livre);
            $em->flush();
            $responce = "<HTML><BODY>Livre ayant l'id {$id} correctement supprimé</BODY></HTML>";
        }
        else{
            $responce = "<HTML><BODY>Une erreur est survenue, le livre ayant l'id {$id} n'a pas été supprimé</BODY></HTML>";
        }
        return new Response($responce);
    }
    
    
    /**
     * @Template("FrontBundle:Default:listMaterial.html.twig")
     * @Route("/")
     */
    public function listAction(){
        
        $users = $this->getDoctrine()
                ->getRepository('FrontBundle:User')
                ->getAllUserSortByName();
        $result = array('users' => $users);
        return $result;
    }

}
