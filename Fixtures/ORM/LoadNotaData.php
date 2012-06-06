<?php

/**
 * (c) Juan David Rodríguez <jazzywebvid.rodríguez@ite.educacion.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package MentorNotas
 * @author Juan David Rodríguez
 * @abstract Datos de ejemplo para las notas
 */

namespace Jazzyweb\MentorNotasBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Nota;
use Doctrine\Common\Persistence\ObjectManager;

class LoadNotaData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        // Tarifas

        $nota1 = new Nota();
        $nota1->setFecha(new \DateTime());
        $nota1->setTitulo('Nota 1');
        $nota1->setTexto(' Lorem ipsum dolor sit amet, consectetur adipisicing
elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $nota1->setUsuario($this->getReference('alberto'));
        $nota1->addEtiqueta($this->getReference('etiqueta1-alberto'));
        $nota1->addEtiqueta($this->getReference('etiqueta2-alberto'));
        $this->addReference('nota1', $nota1);
        $manager->persist($nota1);

        $nota2 = new Nota();
        $nota2->setFecha(new \DateTime());
        $nota2->setTitulo('Nota 2');
        $nota2->setTexto(' Lorem ipsum dolor sit amet, consectetur adipisicing
elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $nota2->setUsuario($this->getReference('alberto'));
        $nota2->addEtiqueta($this->getReference('etiqueta2-alberto'));
        $this->addReference('nota2', $nota2);
        $manager->persist($nota2);

        $nota6 = new Nota();
        $nota6->setFecha(new \DateTime());
        $nota6->setTitulo('Nota 6');
        $nota6->setTexto(' Lorem ipsum dolor sit amet, consectetur adipisicing
elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $nota6->setUsuario($this->getReference('alberto'));
        $nota6->addEtiqueta($this->getReference('etiqueta3-alberto'));
        $this->addReference('nota6', $nota6);
        $manager->persist($nota6);

        $nota7 = new Nota();
        $nota7->setFecha(new \DateTime());
        $nota7->setTitulo('Nota 7');
        $nota7->setTexto(' Lorem ipsum dolor sit amet, consectetur adipisicing
e7it, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $nota7->setUsuario($this->getReference('alberto'));
        $nota7->addEtiqueta($this->getReference('etiqueta3-alberto'));
        $nota7->addEtiqueta($this->getReference('etiqueta1-alberto'));
        $this->addReference('nota7', $nota7);
        $manager->persist($nota7);

        $nota3 = new Nota();
        $nota3->setFecha(new \DateTime());
        $nota3->setTitulo('Nota 3');
        $nota3->setTexto(' Lorem ipsum dolor sit amet, consectetur adipisicing
elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $nota3->setUsuario($this->getReference('maximo'));
        $nota3->addEtiqueta($this->getReference('etiqueta4-maximo'));
        $this->addReference('nota3', $nota3);
        $manager->persist($nota3);

        $nota4 = new Nota();
        $nota4->setFecha(new \DateTime());
        $nota4->setTitulo('Nota 4');
        $nota4->setTexto(' Lorem ipsum dolor sit amet, consectetur adipisicing
elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $nota4->setUsuario($this->getReference('isaac'));
        $this->addReference('nota4', $nota4);
        $manager->persist($nota4);

        $nota5 = new Nota();
        $nota5->setFecha(new \DateTime());
        $nota5->setTitulo('Nota 5');
        $nota5->setTexto(' Lorem ipsum dolor sit amet, consectetur adipisicing
elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $nota5->setUsuario($this->getReference('isaac'));
        $nota5->addEtiqueta($this->getReference('etiqueta8-isaac'));
        $this->addReference('nota5', $nota5);
        $manager->persist($nota5);


        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }

}