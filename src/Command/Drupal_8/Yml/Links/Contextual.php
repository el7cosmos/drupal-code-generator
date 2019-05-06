<?php

namespace DrupalCodeGenerator\Command\Drupal_8\Yml\Links;

use DrupalCodeGenerator\Command\ModuleGenerator;
use DrupalCodeGenerator\Utils;
use Symfony\Component\Console\Question\Question;

/**
 * Implements d8:yml:links:contextual command.
 */
class Contextual extends ModuleGenerator {

  protected $name = 'd8:yml:links:contextual';
  protected $description = 'Generates links.contextual yml file';
  protected $alias = 'contextual-links';

  /**
   * {@inheritdoc}
   */
  protected function generate() :void {
    $questions['machine_name'] = new Question('Module machine name');
    $questions['machine_name']->setValidator([Utils::class, 'validateMachineName']);

    $this->collectVars($questions);

    $this->addFile()
      ->path('{machine_name}.links.contextual.yml')
      ->template('d8/yml/links.contextual.twig');
  }

}
