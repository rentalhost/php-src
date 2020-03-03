--TEST--
Basic attributes usage
--FILE--
<?php
function dump_attributes($attributes) {
    $arr = [];
    foreach ($attributes as $attribute) {
        if (!isset($arr[$attribute->getName()])) {
            $arr[$attribute->getName()] = [];
        }
        $arr[$attribute->getName()][] = $attribute->getArguments();
    }
    var_dump($arr);
}
// No attributes
function f0() {
}
$r = new ReflectionFunction("f0");
dump_attributes($r->getAttributes());

// Function attributes
<<TestFunction>>
function foo() {
}
$r = new ReflectionFunction("foo");
dump_attributes($r->getAttributes());

// Class attributes
<<TestClass>>
class Bar {
	<<TestConst>>
	const C = 2;
	<<TestProp>>
	public $x = 3;

}
$r = new ReflectionClass("Bar");
dump_attributes($r->getAttributes());
$r1 = $r->getReflectionConstant("C");
dump_attributes($r1->getAttributes());
$r2 = $r->getProperty("x");
dump_attributes($r2->getAttributes());

// Multiple attributes with multiple values
<<a1,a2(1),a3(1,2)>>
function f1() {}
$r = new ReflectionFunction("f1");
dump_attributes($r->getAttributes());

// Attributes with AST
<<a1,a2(1+1),a3(1+3,2+2),a4(["a"=>1,"b"=>2])>>
function f2() {}
$r = new ReflectionFunction("f2");
dump_attributes($r->getAttributes());

// Attributes with namespaces
<<Foo\Bar>>
function f4() {
}
$r = new ReflectionFunction("f4");
dump_attributes($r->getAttributes());
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
