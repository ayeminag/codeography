# What is codeography?

Codeogrphy is a commandline php class generator. (Well, it's just my pet project. but I would love to maintain it as much as I can) :P

### Version
1.0 beta

###How to use
clone this repo and cd into the directory, and run `composer install` and make sure you add codeography to your environment PATH vairable.
### `codeography generate:class` command
```sh
$ codeography generate:class Person
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
$ codeography generate:class --attributes="public:name protected:age" --methods="private:someMethod public:anotherMethod" Person
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

if you want your methods to accept arguments you can also do that as follow,
just type a `|` after your method's name and continue typing your list of arguments separated by commas like this 
`--methods="accessmodifier:methodName|arg1,arg2,arg3"`

`codeography generate:class Car --attributes="model make enginepower" --methods="drive refillGas|amount,type"`
will generate 

```php
<?php 

class Car{

  public $model;

  public $make;

  public $enginepower;

  public function drive(){
    //
  }

  public function refillGas($amount, $type){
    //
  }

}
```
### codeography depends on fllowing composer packages
- symfony/console
- symfony/finder

### Contributions
feel free to fork this repo and submit pull requests, I will review them as soon as I can,
and merge them (if it's appropriate), and I will name you as a contributor here.
Thank [nainglinaung](http://github.com/nainglinaung) for contributions.
### Todo's

 - Write Tests
 - Generate class including constructor
 - <del>Methods with arguments</del>
 - Interface to create custom generators and extensions

License
----

MIT