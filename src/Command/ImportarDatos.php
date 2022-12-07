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
    $this->setName('csv:import')->setDescription('Importar datos del Csv');
  }

  protected function execute(InputInterface $input, OutputInterface $output){
    $io = new SymfonyStyle($input, $output);
    $io->title('Importando...');

    $reader = Reader::createFromPath('%kernel.root_dir%/../src/AppBundle/Data/PREMIOS.csv');
    $premios = $reader->fetchAssoc();
    $maximos = array();
    $codes = array();

    $firstLine = true;
    foreach($results as $row){
      $premio = null;
      if ($firstLine) {
        $premio = (new Premio())->setTitulo('Otro / Sin premio');
        $maximos['otro'] = '1000000';
        $firstLine = false;
      } else {
         $premio = (new Premio())->setTitulo($row['premio']);
         $maximos[$row['premio']] = intval($row['cantidad']);
      }

      if ($premio != null){
        $this->em->persist($premio);
      }
    }

    $max_codes = 1000000;
    $code_length = 8;
    $caracteres = '1234567890abcdefghijklmnopqrstuvwxyz';

    for ($code = 1 ; $code <= $max_codes ; $code++){
      $code_value = '';
      $max = strlen($caracteres)-1;
      for($i = 0; $i < $code_legth ; $i++ ) {
        $code_value .= $caracteres{ mt_rand(0,$max) };
      }

      $register_code = false;
      if (count($codes) === 0 || !in_array( $code_value , $codes )){
        $register_code = true;
      }

      if ($register_code){
        $random = 0;
        do {
          $random = array_rand($maximos);
        } while ($random < 0);
        $random = $random--;

        $thiscode = (new Codigo())->setNombre($code)->setIdPremio($random);
        array_push($codes, $code);
        $this->em->persist($code);
      }

    }

    $io->success('Importación completada correctamente.');

  }

}
