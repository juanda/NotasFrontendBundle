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
                $mentorNotasService = $this->get('jazzyweb_mentor_notas_service');
                $mentorNotasService->registra($usuario);

                return $this->render('JazzywebMentorNotasBundle:Registro:registrosuccess.html.twig', array('usuario' => $usuario));
            }
        }

        return $this->render('JAMNotasFrontendBundle:Login:registro.html.twig', array('form' => $form->createView()));
    }
}
