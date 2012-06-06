<?php

/**
 * (c) Juan David Rodríguez <jazzywebvid.rodríguez@ite.educacion.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package MentorNotas
 * @author Juan David Rodríguez
 * @abstract Datos de ejemplo para la publicidad
 */

namespace Jazzyweb\MentorNotasBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Publicidad;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPublicidadData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $publicidad1 = new Publicidad();
        $publicidad1->setNombre('publi1');
        $publicidad1->setTexto('texto publi1');
        $this->addReference('publi1', $publicidad1);
        $manager->persist($publicidad1);

        $publicidad2 = new Publicidad();
        $publicidad2->setNombre('publi2');
        $publicidad2->setTexto('texto publi2');
        $this->addReference('publi2', $publicidad2);
        $manager->persist($publicidad2);

        $publicidad3 = new Publicidad();
        $publicidad3->setNombre('publi3');
        $publicidad3->setTexto('texto publi3');
        $this->addReference('publi3', $publicidad3);
        $manager->persist($publicidad3);

        $manager->flush();
    }

    public function getOrder()
    {
        return 7;
    }

}
