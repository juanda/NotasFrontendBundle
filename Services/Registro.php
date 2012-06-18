<?php

namespace Jazzyweb\AulasMentor\NotasFrontendBundle\Services;

class Registro {

    public function __construct($doctrine, $mailer, $templating, $factory_encoder) {
        $this->doctrine = $doctrine;
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->factory_encoder = $factory_encoder;
    }

    public function registra($usuario, $password) {
        $usuario->setIsActive(false);
        $usuario->setTokenRegistro(substr(md5(uniqid(rand(), true)), 0, 32));

        $em = $this->doctrine->getEntityManager();
        
        $grupo = $em->getRepository('JAMNotasFrontendBundle:Grupo')
                ->findOneByRol('ROLE_REGISTRADO');
        
        $usuario->addGrupo($grupo);
        
        $encoder = $this->factory_encoder->getEncoder($usuario);

        $salt = substr(md5(uniqid(rand(), true)), 0, 10);
        $usuario->setSalt($salt);        
        $password = $encoder->encodePassword($password, $usuario->getSalt());

        $usuario->setPassword($password);
        
        $em->persist($usuario);       

        $em->flush();

        $message = \Swift_Message::newInstance()
                ->setSubject('Alta en la aplicación MentorNotas')
                ->setFrom('noreplay@mentornotas.com')
                ->setTo($usuario->getEmail())
                ->setBody($this->templating->render('JAMNotasFrontendBundle:Login:email_registro.html.twig', array('usuario' => $usuario)))
        ;
        $this->mailer->send($message);
    }
  
}
