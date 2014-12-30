<?php namespace Codeography\Generators;

use Codeography\Contracts\GeneratorInterface;
use Codeography\Utils\FileSystem;
use Codeography\Traits\Resolver;
class ClassGenerator implements GeneratorInterface{

  protected $files;
  protected $attributeMaker;
  protected $classMaker;
  protected $methodMaker;

  use Resolver;
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
    return (isset($option) AND trim($option) != "");
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
    $options = $this->resolveConstructor($options);
    return ($this->checkAttributesAndMethods($options["methods"])) ? $this->methodMaker->make($options["methods"]) : null;
  }

  protected function resolveConstructor($options){
    if($options["skip-constructor"]) return $options;
    $methods = $this->getConstructorString($options["attributes"]) . " " . $options["methods"];
    $options["methods"] = trim($methods);
    return $options;
  }

  protected function getConstructorString($attributes){
    $constructor = "__construct";
    if(empty($attributes)) return $constructor;
    return $constructor."|".implode(",", array_keys($this->resolve($attributes)));
  }

}