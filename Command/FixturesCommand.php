<?php

// src/Acme/DemoBundle/Command/GreetCommand.php

namespace Jazzyweb\AulasMentor\NotasFrontendBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FixturesCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
                ->setName('jamn:fixtures:load')
                ->setDescription('Load fixtures')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $doctrine = $this->getContainer()->get('doctrine');

        try {
            $em = $doctrine->getEntityManager();

            $query = $em
                    ->createQuery('DELETE FROM JAMNotasFrontendBundle:Grupo g');
            $query = $em
                    ->createQuery('DELETE FROM JAMNotasFrontendBundle:Usuario u');


            $result = $query->getResult();

            $objects = \Nelmio\Alice\Fixtures::load(__DIR__ . '/../Fixtures/Fixtures.yml', $em);


            $output->writeln("Fixtures have been loaded");
        } catch (\Exception $e) {
            $output->writeln("<error>" . $e->getMessage() . "</error>");
        }
    }

}
