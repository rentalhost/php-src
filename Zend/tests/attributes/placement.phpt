--TEST--
Attributes can be placed on all supported elements.
--FILE--
<?php

<<A1(1)>>
class Foo
{
    <<A1(2)>>
    public const FOO = 'foo', BAR = 'bar';
    
    <<A1(3)>>
    public $x, $y;
    
    <<A1(4)>>
    public function foo(<<A1(5)>> $a, <<A1(6)>> $b) { }
}

$object = new <<A1(7)>> class () { };

<<A1(8)>>
function f1() { }

$f2 = <<A1(9)>> function () { };

$f3 = <<A1(10)>> fn () => 1;

$ref = new \ReflectionClass(Foo::class);

$sources = [
    $ref,
    $ref->getReflectionConstant('FOO'),
    $ref->getReflectionConstant('BAR'),
    $ref->getProperty('x'),
    $ref->getProperty('y'),
    $ref->getMethod('foo'),
    $ref->getMethod('foo')->getParameters()[0],
    $ref->getMethod('foo')->getParameters()[1],
    new \ReflectionObject($object),
    new \ReflectionFunction('f1'),
    new \ReflectionFunction($f2),
    new \ReflectionFunction($f3)
];

foreach ($sources as $r) {
    foreach ($r->getAttributes() as $attr) {
        var_dump($attr->getName(), $attr->getArguments());
    }
}

?>
--EXPECT--
string(2) "A1"
array(1) {
  [0]=>
  int(1)
}
string(2) "A1"
array(1) {
  [0]=>
  int(2)
}
string(2) "A1"
array(1) {
  [0]=>
  int(2)
}
string(2) "A1"
array(1) {
  [0]=>
  int(3)
}
string(2) "A1"
array(1) {
  [0]=>
  int(3)
}
string(2) "A1"
array(1) {
  [0]=>
  int(4)
}
string(2) "A1"
array(1) {
  [0]=>
  int(5)
}
string(2) "A1"
array(1) {
  [0]=>
  int(6)
}
string(2) "A1"
array(1) {
  [0]=>
  int(7)
}
string(2) "A1"
array(1) {
  [0]=>
  int(8)
}
string(2) "A1"
array(1) {
  [0]=>
  int(9)
}
string(2) "A1"
array(1) {
  [0]=>
  int(10)
}
