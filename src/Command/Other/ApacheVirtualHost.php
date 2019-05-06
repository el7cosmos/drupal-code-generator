<?php

namespace DrupalCodeGenerator\Command\Other;

use DrupalCodeGenerator\Command\BaseGenerator;
use Symfony\Component\Console\Question\Question;

/**
 * Implements other:apache-virtual-host command.
 */
class ApacheVirtualHost extends BaseGenerator {

  protected $name = 'other:apache-virtual-host';
  protected $description = 'Generates an Apache site configuration file';
  protected $alias = 'apache-virtual-host';
  protected $destination = '/etc/apache2/sites-available';

  /**
   * {@inheritdoc}
   */
  protected function generate() :void {

    $questions = [
      'hostname' => new Question('Host name', 'example.com'),
      'docroot' => new Question('Document root', '/var/www/{hostname}/public'),
    ];

    $this->collectVars($questions);

    $this->addFile()
      ->path('{hostname}.conf')
      ->template('other/apache-virtual-host.twig');
  }

}
