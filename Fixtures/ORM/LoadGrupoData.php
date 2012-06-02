<?php

namespace Jazzyweb\MentorNotasBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Grupo;

class LoadGrupoData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        // Grupos
        $grupo1 = new Grupo();
        $grupo1->setNombre('registrado');
        $grupo1->setRol('ROLE_REGISTRADO');
        $this->addReference('grupo-registrado', $grupo1);
        $manager->persist($grupo1);

        $grupo2 = new Grupo();
        $grupo2->setNombre('premium');
        $grupo2->setRol('ROLE_PREMIUM');
        $this->addReference('grupo-premium', $grupo2);
        $manager->persist($grupo2);

        $grupo3 = new Grupo();
        $grupo3->setNombre('administrador');
        $grupo3->setRol('ROLE_ADMIN');
        $this->addReference('grupo-admin', $grupo3);
        $manager->persist($grupo3);


        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }

}