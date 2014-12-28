# What is codeography?

Dillinger is a commandline php class generator. (Well, it's just my pet project. but I would love to maintain it as much as I can) :P

### Version
1.0 beta

###How to use
clone this repo and cd into the directory, and run `composer install`
### `codeography generate:class` command
```sh
$ codeography generate:class Person
```
or if you are on windows
```sh
$ php path\to\codeography generate:class Person
```
will generate a plain php file with empty class in it like below.
```php
<?php 

class Person{

}
```
`codeography` can also handle namespaces
```sh
$ codeography generate:calss SomeNamespace\SubNamespace\Person
```
will give you namepsaced class like below
```php
<?php namespace SomeNamespace\SubNamespace;

class Person{

}
```

###Properties and Methods
if you want to generate class with attribute and mtehods there's `--attibutes` and `--methods` options available for you.
```sh
$ codeography generate:class --attributes="name age" --methods="someMethod anotherMethod" Person
```

will generate
```php
<?php 

class Person{

  public $name;

  public $age;

  public function someMethod(){
    //
  }

  public function anotherMethod(){
    //
  }
}
```

you can also specify access modifiers
```sh
$ codeography generate:class --attributes="name:public age:protected" --methods="someMethod:private anotherMethod:public" Person
```
will generate
```php
<?php 

class Person{

  public $name;

  protected $age;

  private function someMethod(){
    //
  }

  public function anotherMethod(){
    //
  }
}
```
### codeography depends on fllowing composer packages
- symfony/console
- symfony/finder
### Todo's

 - Write Tests
 - Generate class including constructor
 - Methods with arguments
 - Interface to create custom generators and extensions
 - Add Night Mode

License
----

MIT