<?php

namespace DrupalCodeGenerator\Command\Drupal_8\Service;

use DrupalCodeGenerator\Command\ModuleGenerator;
use DrupalCodeGenerator\Utils;

/**
 * Implements d8:service:route-subscriber command.
 */
class RouteSubscriber extends ModuleGenerator {

  protected $name = 'd8:service:route-subscriber';
  protected $description = 'Generates a route subscriber';
  protected $alias = 'route-subscriber';

  /**
   * {@inheritdoc}
   */
  protected function generate() :void {
    $questions = Utils::moduleQuestions();

    $vars = &$this->collectVars($questions);
    $vars['class'] = Utils::camelize($vars['name']) . 'RouteSubscriber';

    $this->addFile()
      ->path('src/EventSubscriber/{class}.php')
      ->template('d8/service/route-subscriber.twig');

    $this->addServicesFile()
      ->template('d8/service/route-subscriber.services.twig');
  }

}
