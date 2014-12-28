<?php namespace Codeography\Generators;

use Codeography\Utils\FileSystem;
class Generator{

  protected $files;
  protected $attributeMaker;
  protected $classMaker;
  protected $methodMaker;
  public function __construct(FileSystem $files, 
                              AttributeMaker $attributeMaker,
                              ClassMaker $classMaker,
                              MethodMaker $methodMaker){
    $this->files = $files;
    $this->attributeMaker = $attributeMaker;
    $this->classMaker = $classMaker;
    $this->methodMaker = $methodMaker;
  }


  public function generate($className, $options){
    $codes = $this->prepareClass($className, $options);
    $this->files->put($this->getFileName($className), $codes);
  }

  protected function getFileName($className){
    $chunks = explode("\\",$className);
    return getcwd().DIRECTORY_SEPARATOR.array_pop($chunks).".php";
  }

  protected function prepareClass($className, $options){
    $attributes = $this->getAttributes($options);
    $methods = $this->getMethods($options);
    return $this->classMaker->make($className, $attributes, $methods);
  }

  protected function getAttributes($options){
    return (isset($options["attributes"])) ? $this->attributeMaker->make($options["attributes"]) : "";
  }

  protected function getMethods($options){
    return (isset($options["methods"])) ? $this->methodMaker->make($options["methods"]) : "";
  }
}