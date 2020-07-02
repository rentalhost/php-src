--TEST--
Named params in attributes
--FILE--
<?php

<<Attribute>>
class MyAttribute {
    public function __construct(
        public $a = 'a',
        public $b = 'b',
        public $c = 'c',
    ) {}
}

<<MyAttribute('A', c: 'C')>>
class Test {}

$attr = (new ReflectionClass(Test::class))->getAttributes()[0];
var_dump($attr->getName());
var_dump($attr->getArguments());
var_dump($attr->newInstance());

?>
--EXPECT--
string(11) "MyAttribute"
array(2) {
  [0]=>
  string(1) "A"
  ["c"]=>
  string(1) "C"
}
object(MyAttribute)#1 (3) {
  ["a"]=>
  string(1) "A"
  ["b"]=>
  string(1) "C"
  ["c"]=>
  string(1) "c"
}
