<?php

namespace Jazzyweb\MentorNotasBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Usuario;

class LoadUsuarioData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        // Usuarios
        $usuario1 = new Usuario();
        $usuario1->setNombre('Alberto');
        $usuario1->setApellidos('Einstein');
        $usuario1->setUsername('alberto');
        $usuario1->setPassword('620a7de82763527406a413ca7ee267816d332811');
        $usuario1->setEmail('alberto@mentornotas.es');
        $usuario1->setSalt('');
        $usuario1->setIsActive(1);
        $usuario1->setTokenRegistro('');

        $usuario1->addGrupo($this->getReference('grupo-registrado'));

        $manager->persist($usuario1);
        $this->addReference('alberto', $usuario1);

        $usuario2 = new Usuario();
        $usuario2->setNombre('Máximo');
        $usuario2->setApellidos('Planck');
        $usuario2->setUsername('maximo');
        $usuario2->setPassword('620a7de82763527406a413ca7ee267816d332811');
        $usuario2->setEmail('maximo@mentornotas.es');
        $usuario2->setSalt('');
        $usuario2->setIsActive(1);
        $usuario2->setTokenRegistro('');

        $usuario2->addGrupo($this->getReference('grupo-premium'));

        $manager->persist($usuario2);
        $this->addReference('maximo', $usuario2);

        $usuario3 = new Usuario();
        $usuario3->setNombre('María');
        $usuario3->setApellidos('Curie');
        $usuario3->setUsername('maria');
        $usuario3->setPassword('620a7de82763527406a413ca7ee267816d332811');
        $usuario3->setEmail('maria@mentornotas.es');
        $usuario3->setSalt('');
        $usuario3->setIsActive(1);
        $usuario3->setTokenRegistro('');

        $usuario3->addGrupo($this->getReference('grupo-admin'));

        $manager->persist($usuario3);
        $this->addReference('maria', $usuario3);

        $usuario4 = new Usuario();
        $usuario4->setNombre('Isaac');
        $usuario4->setApellidos('Newton');
        $usuario4->setUsername('isaac');
        $usuario4->setPassword('620a7de82763527406a413ca7ee267816d332811');
        $usuario4->setEmail('isaac@kk.es');
        $usuario4->setSalt('');
        $usuario4->setIsActive(1);
        $usuario4->setTokenRegistro('');

        $usuario4->addGrupo($this->getReference('grupo-premium'));
        $usuario4->addGrupo($this->getReference('grupo-admin'));

        $manager->persist($usuario4);
        $this->addReference('isaac', $usuario4);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }

}