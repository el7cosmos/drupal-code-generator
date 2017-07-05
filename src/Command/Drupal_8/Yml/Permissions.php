<?php

namespace DrupalCodeGenerator\Command\Drupal_8\Yml;

use DrupalCodeGenerator\Command\BaseGenerator;
use DrupalCodeGenerator\Utils;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

/**
 * Implements d8:yml:permissions command.
 */
class Permissions extends BaseGenerator {

  protected $name = 'd8:yml:permissions';
  protected $description = 'Generates a permissions yml file';
  protected $alias = 'permissions.yml';

  /**
   * {@inheritdoc}
   */
  protected function interact(InputInterface $input, OutputInterface $output) {
    $questions['machine_name'] = new Question('Module machine name');
    $questions['machine_name']->setValidator([Utils::class, 'validateMachineName']);

    $vars = $this->collectVars($input, $output, $questions);

    $this->setFile($vars['machine_name'] . '.permissions.yml', 'd8/yml/permissions.yml.twig', $vars);
  }

}
