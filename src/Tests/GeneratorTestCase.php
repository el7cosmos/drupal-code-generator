<?php

namespace DrupalCodeGenerator\Tests;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Base class for generators tests.
 *
 * @TODO: Cleanup.
 */
abstract class GeneratorTestCase extends \PHPUnit_Framework_TestCase {

  protected $application;

  /**
   * Generator command to be tested.
   *
   * @var \Symfony\Component\Console\Command\Command
   */
  protected $command;

  protected $commandName;

  protected $answers;

  protected $commandTester;

  protected $display;

  /**
   * The generated file.
   *
   * @var string
   *
   * @deprecated
   */
  protected $target;

  /**
   * The fixture.
   *
   * @var string
   *
   * @deprecated
   */
  protected $fixture;

  protected $fixtures;

  protected $filesystem;

  protected $class;

  protected $destination;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    $command_class = 'DrupalCodeGenerator\Commands\\' . $this->class;
    $this->command = $command_class::create([DCG_ROOT . '/src/Templates']);
    $this->commandName = $this->command->getName();

    $this->application = new Application();
    $this->application->add($this->command);

    $this->mockQuestionHelper();
    $this->commandTester = new CommandTester($this->command);

    $this->destination = DCG_SANDBOX . '/tests';
  }

  /**
   * {@inheritdoc}
   */
  public function tearDown() {
    (new Filesystem())->remove($this->destination);
  }

  /**
   * Mocks question helper.
   */
  protected function mockQuestionHelper() {
    $question_helper = $this->createMock('Symfony\Component\Console\Helper\QuestionHelper');

    foreach ($this->answers as $key => $answer) {
      // @TODO: Figure out where this key ofset comes from.
      $question_helper->expects($this->at($key + 2))
        ->method('ask')
        ->willReturn($answer);
    }

    // We override the question helper with our mock.
    $this->command->getHelperSet()->set($question_helper, 'question');
  }

  /**
   * {@inheritdoc}
   */
  protected function execute() {
    $this->commandTester->execute([
      'command' => $this->command->getName(),
      '--destination' => $this->destination,
    ]);

    $this->display = $this->commandTester->getDisplay();
  }

  /**
   * Checks the file.
   */
  protected function checkFile($file, $fixture) {
    $this->assertFileExists($this->destination . '/' . $file);
    $this->assertFileEquals($this->destination . '/' . $file, $fixture);
  }

  /**
   * Test callback.
   */
  public function testExecute() {
    $this->execute();

    if ($this->fixtures) {
      $targets = implode("\n- ", array_keys($this->fixtures));
      $output = "The following directories and files have been created or updated:\n- $targets\n";
      $this->assertEquals($output, $this->commandTester->getDisplay());
      foreach ($this->fixtures as $target => $fixture) {
        $this->checkFile($target, $fixture);
      }
    }
    // TODO: Update all tests to provide fixtures array.
    else {
      $output = "The following directories and files have been created or updated:\n- $this->target\n";
      $this->assertEquals($output, $this->commandTester->getDisplay());
      $this->checkFile($this->target, $this->fixture);
    }

  }

}
