<?php

namespace DrupalCodeGenerator\Tests\Generator\Drupal_8\Yml;

use DrupalCodeGenerator\Tests\Generator\GeneratorBaseTest;

/**
 * Test for d8:yml:action-links command.
 */
class ActionLinksTest extends GeneratorBaseTest {

  protected $class = 'Drupal_8\Yml\ActionLinks';

  protected $interaction = [
    'Module machine name [%default_machine_name%]: ' => 'example',
  ];

  protected $fixtures = [
    'example.links.action.yml' => __DIR__ . '/_links.action.yml',
  ];

}
