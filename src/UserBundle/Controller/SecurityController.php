<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use UserBundle\Entity\User;
use UserBundle\Form\Models\RegisterUserModel;
use UserBundle\Form\UserAccountType;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends Controller
{
    /**
     *
     * @Route("/login", name="login")
     */

    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('UserBundle:security:login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    public function registerAction(Request $request){

        $registerModel = $this->get('user.model');
        $form = $this->createForm(new UserAccountType(), $registerModel);
        $form->handleRequest($request);
        if($form->isSubmitted()){

            $user = $registerModel->getUserHandler();

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('login');


        }
        return $this->render('UserBundle:security:register.html.twig', [
            'register_form' => $form->createView()
        ]);
    }
}
