<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Document\User;
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
    public function addAction(Request $request){
        $user = new User();

        $form = $this->createForm(new UserType(), $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            
            $password = $form->get('password')->getData();
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $password);
            $user->setPassword($encoded);

            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($user);
            $dm->flush();
            return $this->redirectToRoute('app_index');
        }
        return $this->render('@User/User/add.html.twig',[
            'form'=>$form->createView()
        ]);
    }

}