<?php

/**
 * (c) Juan David Rodríguez <jazzywebvid.rodríguez@ite.educacion.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package MentorNotas
 * @author Juan David Rodríguez
 * @abstract Datos de ejemplo para las tarifas
 */

namespace Jazzyweb\MentorNotasBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Tarifa;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTarifaData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        // Tarifas
        $tarifa1 = new Tarifa();
        $tarifa1->setNombre('mes');
        $tarifa1->setPeriodo(1);
        $tarifa1->setPrecio(10);
        $this->addReference('tarifa-mes', $tarifa1);
        $manager->persist($tarifa1);

        $tarifa2 = new Tarifa();
        $tarifa2->setNombre('trimestral');
        $tarifa2->setPeriodo(3);
        $tarifa2->setPrecio(25);
        $this->addReference('tarifa-trimestral', $tarifa2);
        $manager->persist($tarifa2);

        $tarifa3 = new Tarifa();
        $tarifa3->setNombre('anual');
        $tarifa3->setPeriodo(12);
        $tarifa3->setPrecio(250);
        $this->addReference('tarifa-anual', $tarifa3);
        $manager->persist($tarifa3);

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }

}
