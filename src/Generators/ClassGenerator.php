<?php namespace Codeography\Generators;

use Codeography\Contracts\GeneratorInterface;
use Codeography\Utils\FileSystem;
class ClassGenerator implements GeneratorInterface{

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


  public function generate($name, $options=null){
    $codes = $this->prepareClass($name, $options);
    $this->files->put($this->getFileName($name), $codes);
  }



  protected function getFileName($name){
    $chunks = explode("\\",$name);
    return getcwd().DIRECTORY_SEPARATOR.array_pop($chunks).".php";
  }


  protected function checkAttributesAndMethods($option) {
    return (isset($option) AND $option != "");
  }

  protected function prepareClass($name, $options){
    $attributes = $this->getAttributes($options);
    $methods = $this->getMethods($options);    
    return $this->classMaker->make($name, $attributes, $methods);
  }


  protected function getAttributes($options){
    return ($this->checkAttributesAndMethods($options["attributes"])) ? $this->attributeMaker->make($options["attributes"]) : null;
  }

  protected function getMethods($options){
    return  ($this->checkAttributesAndMethods($options["methods"])) ? $this->methodMaker->make($options["methods"]) : null;
  }
}