<?php

 namespace Jazzyweb\AulasMentor\NotasFrontendBundle\Controller;

 use Symfony\Bundle\FrameworkBundle\Controller\Controller;
 use Symfony\Component\Security\Core\SecurityContext;

 class LoginController extends Controller
 {

     public function loginAction()
     {
         if ($this->get('request')->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
             $error = $this->get('request')->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
         } else {
             $error = $this->get('session')->get(SecurityContext::AUTHENTICATION_ERROR);
         }

         return $this->render('JAMNotasFrontendBundle:Login:login.html.twig', array(
             'last_username' => $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME),
             'error'         => $error,

             ));
     }
 }
