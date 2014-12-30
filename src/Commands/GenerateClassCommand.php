<?php namespace Codeography\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Codeography\Generators\ClassGenerator;

class GenerateClassCommand extends Command{

  protected $generator;

  public function __construct(ClassGenerator $generator){
    $this->generator = $generator;
    parent::__construct();
  }

  protected function configure(){
    $this
      ->setName("generate:class")
      ->setDescription("Generate class with the given name base on the options")
      ->addArgument("name", InputArgument::REQUIRED, "class name")
      ->addOption("attributes",
          null,
          InputOption::VALUE_REQUIRED,
          "Attribute names separated by spaces (e.g, name age job).
          If you want to specicify accessmodifier append it with colum for each attributes,
          (e.g, name:public age:public job:private)" ,
          "")
      ->addOption("methods",
        null, 
        InputOption::VALUE_REQUIRED,
        "Method names separated by spaces (e.g, getJob setJob).
        If you want to specicify accessmodifier append it with colum for each method,
        (e.g, getJob:public setJob:public)",
        "")
      ->addOption("skip-constructor",
        null,
        InputOption::VALUE_NONE,
        "flag to exclude constructor");
  }

  protected function execute(InputInterface $input, OutputInterface $output){
    $name = $input->getArgument("name");
    $options["attributes"] = $input->getOption("attributes");
    $options["methods"] = $input->getOption("methods");
    $options["skip-constructor"] = $input->getOption("skip-constructor");
    $output->writeln("<comment>Generating Class...</comment>");
    $this->generate($name, $options);
    $output->writeln("<info>Class Generated Successfully!!<info>");
  }


  protected function generate($name, $options){
    $this->generator->generate($name, $options);
  }
}