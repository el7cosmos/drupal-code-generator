<?php

namespace DrupalCodeGenerator\Tests\Drupal_7;

use DrupalCodeGenerator\Tests\GeneratorTestCase;

/**
 * Test for d7:install-file command.
 */
class InstallTest extends GeneratorTestCase {

  protected $class = 'Drupal_7\Install';

  protected $answers = [
    'Example',
    'example',
  ];

  protected $fixtures = [
    'example.install' => __DIR__ . '/_.install',
  ];

}
