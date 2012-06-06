<?php

/**
 * (c) Juan David Rodríguez <jazzywebvid.rodríguez@ite.educacion.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package MentorNotas
 * @author Juan David Rodríguez
 * @abstract Datos de ejemplo para los contratos
 */

namespace Jazzyweb\MentorNotasBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Contrato;
use Doctrine\Common\Persistence\ObjectManager;

class LoadContratoData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        // Tarifas
        $contrato1 = new Contrato();
        $contrato1->setFecha(new \DateTime());
        $contrato1->setTarifa($this->getReference('tarifa-trimestral'));
        $contrato1->setReferencia('TRIM00001');
        $contrato1->setUsuario($this->getReference('maximo'));
        $this->addReference('contrato-maximo', $contrato1);
        $manager->persist($contrato1);


        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }

}