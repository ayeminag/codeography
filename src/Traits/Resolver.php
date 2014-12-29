<?php namespace Codeography\Traits;

trait Resolver{
  protected $attributes;

  protected function resolve($attributes){
    return $this->extractAttributes($attributes)->resolveAttributes();
  }

  protected function extractAttributes($attributes){
    $this->attributes = explode(" ", $attributes);
    return $this;
  }

  protected function resolveAttributes(){
    $resolved = [];
    foreach($this->attributes as $attribute){
      list($attribute, $arguments) = $this->separateArrtibuteAndArguments($attribute);
      list($access, $attribute) = $this->getAccess($attribute);
      $resolved[$attribute][] = $access;
      $resolved[$attribute][] = $this->getArguments($arguments);
    }
    return $resolved;
  }

  protected function separateArrtibuteAndArguments($attribute){
    $separated = explode("|", $attribute);
    if(count($separated) == 1) $separated = array($separated[0], null);
    return $separated;
  }

  protected function getArguments($arguments){
    //if argument is null or empty string just return empty string
    if(is_null($arguments) || empty($arguments)) return "";

    //otherwise explode the string from commas and append $ to each words and 
    //finally join all the words together with a comma and space and retrun it
    $arguments = array_map(function($argument){
      return "$".$argument;
    }, explode(",", $arguments));
    return implode(", ", $arguments);
  }

  protected function getAccess($attribute){
    $access = explode(":", $attribute);
    if(count($access) == 1) $access = array("public", $access[0]);
    return $access;
  }
  
}