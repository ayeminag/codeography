<?php namespace Codeography\Generators;

use Codeography\Utils\FileSystem;

class ClassMaker{
  protected $files;
  public function __construct(FileSystem $files){
    $this->files = $files;
  }

  public function make($className, $attributes = "", $methods = ""){
    return $this->generateClass($this->getClass($className), $attributes, $methods);
  }

  protected function generateClass($stubs, $attributes, $methods){
    return str_replace("{{attributes}}", $attributes, str_replace("{{methods}}", $methods, $stubs));
  }

  protected function getClass($className){
    $stubs = $this->files->get(__DIR__."/stubs/class.stub");
    $classinfo = $this->resolveNamespace($className);
    return str_replace("{{namespace}}", "{$classinfo[0]}", str_replace("{{class}}", $classinfo[1], $stubs));
  }

  protected function resolveNamespace($className){
    $chunks = explode("\\", trim($className));
    $className = array_pop($chunks);
    $namespace = implode("\\", $chunks);
    $namespace = (empty($namespace)) ? "" : "namespace ".$namespace.";";
    return array($namespace, $className);
  }

}