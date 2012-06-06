<?php

/**
 * (c) Juan David Rodríguez <jazzywebvid.rodríguez@ite.educacion.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package MentorNotas
 * @author Juan David Rodríguez
 * @abstract Datos de ejemplo para las etiquetas
 *
 */

namespace Jazzyweb\MentorNotasBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Etiqueta;
use Doctrine\Common\Persistence\ObjectManager;

class LoadEtiquetaData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $etiqueta1 = new Etiqueta();
        $etiqueta1->setTexto('php');
        $etiqueta1->setUsuario($this->getReference('alberto'));
        $this->addReference('etiqueta1-alberto', $etiqueta1);
        $manager->persist($etiqueta1);

        $etiqueta2 = new Etiqueta();
        $etiqueta2->setTexto('symfony2');
        $etiqueta2->setUsuario($this->getReference('alberto'));
        $this->addReference('etiqueta2-alberto', $etiqueta2);
        $manager->persist($etiqueta2);

        $etiqueta3 = new Etiqueta();
        $etiqueta3->setTexto('cake-php');
        $etiqueta3->setUsuario($this->getReference('alberto'));
        $this->addReference('etiqueta3-alberto', $etiqueta3);
        $manager->persist($etiqueta3);

        $etiqueta9 = new Etiqueta();
        $etiqueta9->setTexto('java');
        $etiqueta9->setUsuario($this->getReference('alberto'));
        $this->addReference('etiqueta4-alberto', $etiqueta9);
        $manager->persist($etiqueta9);

        $etiqueta10 = new Etiqueta();
        $etiqueta10->setTexto('javascript');
        $etiqueta10->setUsuario($this->getReference('alberto'));
        $this->addReference('etiqueta5-alberto', $etiqueta10);
        $manager->persist($etiqueta10);

        $etiqueta4 = new Etiqueta();
        $etiqueta4->setTexto('documentacion');
        $etiqueta4->setUsuario($this->getReference('maximo'));
        $this->addReference('etiqueta4-maximo', $etiqueta4);
        $manager->persist($etiqueta4);

        $etiqueta5 = new Etiqueta();
        $etiqueta5->setTexto('fotos');
        $etiqueta5->setUsuario($this->getReference('maximo'));
        $this->addReference('etiqueta5-maximo', $etiqueta5);
        $manager->persist($etiqueta5);

        $etiqueta6 = new Etiqueta();
        $etiqueta6->setTexto('tareas');
        $etiqueta6->setUsuario($this->getReference('maximo'));
        $this->addReference('etiqueta6-maximo', $etiqueta6);
        $manager->persist($etiqueta6);

        $etiqueta7 = new Etiqueta();
        $etiqueta7->setTexto('html');
        $etiqueta7->setUsuario($this->getReference('maximo'));
        $this->addReference('etiqueta7-maximo', $etiqueta7);
        $manager->persist($etiqueta7);

        $etiqueta8 = new Etiqueta();
        $etiqueta8->setTexto('fisica');
        $etiqueta8->setUsuario($this->getReference('isaac'));
        $this->addReference('etiqueta8-isaac', $etiqueta8);
        $manager->persist($etiqueta8);

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }

}
