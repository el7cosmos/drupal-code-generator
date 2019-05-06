<?php

namespace DrupalCodeGenerator\Command\Drupal_8\Plugin\Field;

use DrupalCodeGenerator\Command\PluginGenerator;

/**
 * Implements d8:plugin:field:formatter command.
 */
class Formatter extends PluginGenerator {

  protected $name = 'd8:plugin:field:formatter';
  protected $description = 'Generates field formatter plugin';
  protected $alias = 'field-formatter';

  protected $classSuffix = 'Formatter';

  /**
   * {@inheritdoc}
   */
  protected function generate() :void {
    $vars = &$this->collectDefault();
    $vars['configurable'] = $this->confirm('Make the formatter configurable?', FALSE);

    $this->addFile()
      ->path('src/Plugin/Field/FieldFormatter/{class}.php')
      ->template('d8/plugin/field/formatter.twig');

    if ($vars['configurable']) {
      $this->addFile()
        ->path('config/schema/{machine_name}.schema.yml')
        ->template('d8/plugin/field/formatter-schema.twig')
        ->action('append');
    }

  }

}
