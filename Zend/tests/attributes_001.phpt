--TEST--
Basic attributes usage
--FILE--
<?php
// No attributes
function f0() {
}
$r = new ReflectionFunction("f0");
var_dump($r->getAttributes());

// Function attributes
<<TestFunction>>
function foo() {
}
$r = new ReflectionFunction("foo");
var_dump($r->getAttributes());

// Class attributes
<<TestClass>>
class Bar {
	<<TestConst>>
	const C = 2;
	<<TestProp>>
	public $x = 3;

}
$r = new ReflectionClass("Bar");
var_dump($r->getAttributes());
$r1 = $r->getReflectionConstant("C");
var_dump($r1->getAttributes());
$r2 = $r->getProperty("x");
var_dump($r2->getAttributes());

// Multiple attributes with multiple values
<<a1,a2(1),a3(1,2)>>
function f1() {}
$r = new ReflectionFunction("f1");
var_dump($r->getAttributes());

// Attributes with AST
<<a1,a2(1+1),a3(1+3,2+2),a4(["a"=>1,"b"=>2])>>
function f2() {}
$r = new ReflectionFunction("f2");
var_dump($r->getAttributes());

// Attributes with namespaces
<<Foo\Bar>>
function f4() {
}
$r = new ReflectionFunction("f4");
var_dump($r->getAttributes());
?>
--EXPECT--
array(0) {
}
array(1) {
  ["TestFunction"]=>
  array(0) {
  }
}
array(1) {
  ["TestClass"]=>
  array(0) {
  }
}
array(1) {
  ["TestConst"]=>
  array(0) {
  }
}
array(1) {
  ["TestProp"]=>
  array(0) {
  }
}
array(3) {
  ["a1"]=>
  array(0) {
  }
  ["a2"]=>
  array(1) {
    [0]=>
    int(1)
  }
  ["a3"]=>
  array(2) {
    [0]=>
    int(1)
    [1]=>
    int(2)
  }
}
array(4) {
  ["a1"]=>
  array(0) {
  }
  ["a2"]=>
  array(1) {
    [0]=>
    int(2)
  }
  ["a3"]=>
  array(1) {
    [0]=>
    int(4)
  }
  ["a4"]=>
  array(1) {
    [0]=>
    array(2) {
      ["a"]=>
      int(1)
      ["b"]=>
      int(2)
    }
  }
}
array(1) {
  ["Foo\Bar"]=>
  array(0) {
  }
}
