<?php

namespace Jazzyweb\AulasMentor\NotasFrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Usuario;
use Jazzyweb\AulasMentor\NotasFrontendBundle\Form\Type\RegistroType;

class LoginController extends Controller {

    public function loginAction() {
        if ($this->get('request')->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $this->get('request')->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $this->get('session')->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('JAMNotasFrontendBundle:Login:login.html.twig', array(
                    'last_username' => $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME),
                    'error' => $error,
                ));
    }

    public function registroAction() {
        
        $request = $this->getRequest();
        $usuario = new Usuario();
        
        $form = $this->createForm(new RegistroType(), $usuario);

        if ($request->getMethod() == "POST") {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $serviceRegistro = $this->get('jam_notas_frontend.registro');
                $serviceRegistro->registra($usuario, $form->get('password')->getData());

                return $this->render('JAMNotasFrontendBundle:Login:registro_success.html.twig', array('usuario' => $usuario));
            }
        }

        return $this->render('JAMNotasFrontendBundle:Login:registro.html.twig', array('form' => $form->createView()));
    }
        
    public function activarAction()
    {
        $request = $this->getRequest();
        
        $em = $this->get('doctrine')->getEntityManager();

        $usuario = $em->getRepository('JAMNotasFrontendBundle:Usuario')
                ->findOneByTokenRegistro($request->get('token'));

        if (!$usuario) {
            throw $this->createNotFoundException('Usuario no registrado');
        }
        
        $usuario->setIsActive(true);        
        $em->persist($usuario);
        
        $em->flush();

        return $this->render('JAMNotasFrontendBundle:Login:activar_success.html.twig', array('usuario' => $usuario));
    }
}
