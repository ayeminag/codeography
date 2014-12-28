<?php namespace Codeography\Generators;

use Codeography\Utils\FileSystem;

class AttributeMaker{

  protected $files;
  use Resolver;
  
  public function __construct(FileSystem $files){
    $this->files = $files;
  }

  public function make($attributes){
    $attributes = $this->resolve($attributes);
    $stub = $this->files->get(__DIR__."/stubs/attribute.stub");
    return $this->generateAttributes($attributes, $stub);
  }

  protected function generateAttributes($attributes, $stub){
    $attrRaw = [];
    foreach($attributes as $attribute => $access){
      $attrRaw[] = str_replace("{{accessmodifier}}", $access, str_replace("{{attribute}}", $attribute, $stub));
    }
    return implode(PHP_EOL.PHP_EOL, $attrRaw).PHP_EOL;
  }
}