<?php

namespace DrupalCodeGenerator\Command\Drupal_7;

use DrupalCodeGenerator\Command\BaseGenerator;
use DrupalCodeGenerator\Utils;
use Symfony\Component\Console\Question\Question;

/**
 * Implements d7:module-info command.
 */
class ModuleInfo extends BaseGenerator {

  protected $name = 'd7:module-info';
  protected $description = 'Generates Drupal 7 info file for a module';
  protected $label = 'Info (module)';

  /**
   * {@inheritdoc}
   */
  protected function generate() :void {
    $questions = Utils::moduleQuestions();
    $questions['description'] = new Question('Module description', 'Module description.');
    $questions['package'] = new Question('Package', 'Custom');
    $this->collectVars($questions);
    $this->addFile()
      ->path('{machine_name}.info')
      ->template('d7/module-info.twig');
  }

}
