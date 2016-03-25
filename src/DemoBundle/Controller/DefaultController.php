<?php

namespace DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller {

    public function indexAction(Request $request) {
        return $this->render('DemoBundle:Default:index.html.twig');
        //return new Response("<html><body>Hello world</body></html>");
    }

    public function totoAction() {
        //return new Response("<html><body>Hello Toto</body></html>");
        $infos = array(
            'titre' => 'Bonjour les aminches !',
            'noms' => array('Tony', 'Manly', 'Christopher'),
        );

        return $this->render('DemoBundle:Default:toto.html.twig',$infos);
    }

    /**
     * @Template()
     */
    public function helloAction($name) {
        if ($name === 'toto') {
            throw $this->createNotFoundException("Pas de hello pour toto !");
        }
        //return new Response("<html><body>Hello $name</body></html>");
        //return $this->render(
        //'DemoBundle:Default:hello.html.twig', 
        //Array('info'=>$name));

        return array('info' => $name,);
    }

    public function redirectAction($name) {
//       $url = $this->generateUrl('demo_param', Array('name'=>$name));
//       return $this->redirect($url);

        return $this->redirectToRoute('demo_param', Array('name' => $name));
    }

    public function forwardAction() {
        return $this->forward('DemoBundle:Default:toto');
    }

}
