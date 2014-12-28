<?php namespace Codeography\Generators;

use Codeography\Utils\FileSystem;

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
    foreach($methods as $method => $access){
      $methodRaw[] = str_replace("{{accessmodifier}}", $access, str_replace("{{method}}", $method, $stub));
    }
    return implode(PHP_EOL.PHP_EOL, $methodRaw);
  }
}