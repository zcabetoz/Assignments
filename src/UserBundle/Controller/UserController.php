<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Form\Type\UserType;

class UserController extends Controller
{
    /**
     * @Route("/user/index", name="app_index")
     */
    public function indexAction()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $users = $dm->getRepository('UserBundle:User')->findall();

        return $this->render('@User/User/index.html.twig',[
            'users'=>$users
        ]);
    }

    /**
     *@Route("/user/add", name="app_add")
     */
    public function addAction(){
        $form = $this->createForm(new UserType());
        return $this->render('@User/User/add.html.twig',[
            'form'=>$form->createView()
        ]);
    }

}