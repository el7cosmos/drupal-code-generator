<?php

namespace DrupalCodeGenerator\Command\Drupal_8\Yml;

use DrupalCodeGenerator\Command\ModuleGenerator;
use DrupalCodeGenerator\Utils;
use Symfony\Component\Console\Question\Question;

/**
 * Implements d8:yml:module-info command.
 */
class ModuleInfo extends ModuleGenerator {

  protected $name = 'd8:yml:module-info';
  protected $description = 'Generates a module info yml file';
  protected $alias = 'module-info';

  /**
   * {@inheritdoc}
   */
  protected function generate() :void {
    $questions = Utils::moduleQuestions();
    $questions['description'] = new Question('Description', 'Module description.');
    $questions['package'] = new Question('Package', 'Custom');
    $questions['configure'] = new Question('Configuration page (route name)');
    $questions['dependencies'] = new Question('Dependencies (comma separated)');

    $vars = &$this->collectVars($questions);
    if ($vars['dependencies']) {
      $vars['dependencies'] = array_map('trim', explode(',', strtolower($vars['dependencies'])));
    }

    $this->addFile()
      ->path('{machine_name}.info.yml')
      ->template('d8/yml/module-info.twig');
  }

}
