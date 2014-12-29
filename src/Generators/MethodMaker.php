<?php namespace Codeography\Generators;

use Codeography\Utils\FileSystem;
use Codeography\Traits\Resolver;

class MethodMaker{

  protected $files;

  use Resolver;
  
  public function __construct(FileSystem $files){
    $this->files = $files;
  }

  public function make($methods){
    $methods = $this->resolve($methods);
    $stub = $this->files->get(__DIR__."/stubs/method.stub");
    return $this->generateMethods($methods, $stub);
  }

  protected function generateMethods($methods, $stub){
    $methodRaw = [];
    foreach($methods as $method => $properties){
      $methodRaw[] = str_replace("{{arguments}}", $properties[1] ,str_replace("{{accessmodifier}}", $properties[0], str_replace("{{method}}", $method, $stub)));
    }
    return implode(PHP_EOL.PHP_EOL, $methodRaw);
  }
}