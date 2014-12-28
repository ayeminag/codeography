<?php namespace Codeography\Generators;

trait Resolver{

  protected function resolve($attributes){
    $attributes = $this->fetch($attributes);
    $attributes = $this->determineAccesses($attributes);
    return $attributes;
  }

  protected function fetch($attributes){
    return explode(" ", $attributes);
  }

  protected function determineAccesses($attributes){
    $accesses = [];
    foreach ($attributes as $attribute) {
      list($attribute, $access) = $this->getAccess($attribute);
      $accesses[$attribute] = $access;
    }
    return $accesses;
  }

  protected function getAccess($attribute){
    $access = explode(":", $attribute);
    if(count($access) == 1) $access = array($access, "public");
    return $access;
  }
  
}