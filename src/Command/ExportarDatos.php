<?php

namespace AppBundle\Command;

use AppBundle\Entity\Athlete;
use AppBundle\Entity\Competitor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Componente\Console\Command\Command;
use Symfony\Componente\Console\Input\InputInterface;
use Symfony\Componente\Console\Output\OutputInterface;
use Symfony\Componente\Console\Style\SymfonyStyle;

class ImportarDatosCommand extends Command {

  public function __construct(EntityManagerInterface $em){
    parent::__construct();
    $this->em = $em;
  }

  protected function configure() {
    $this->setName('csv:export')->setDescription('Exportar datos de la tabla');
  }

  protected function execute(InputInterface $input, OutputInterface $output){

    $results = $this->getDoctrine()->getManager()
        ->getRepository('Codigos')->findAll();

    $response = new StreamedResponse();
    $response->setCallback(
        function () use ($results) {
            $handle = fopen('php://output', 'r+');
            foreach ($results as $row) {
                $data = array(
                    $row->getNombre(),
                    $row->getIdPremio(),
                );
                fputcsv($handle, $data);
            }
            fclose($handle);
        }
    );
    $response->headers->set('Content-Type', 'application/force-download');
    $response->headers->set('Content-Disposition', 'attachment; filename="RESULTADOS.csv"');

    $io->success('Importación completada correctamente.');

  }

}
