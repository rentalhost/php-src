--TEST--
Basic attributes usage on all elements
--FILE--
<?php
class Attr {
    public $element;

    public function __construct(string $element) {
        $this->element = $element;
    }
}
class OtherAttr {}

function dump_attributes($reflection) {
    $arr = [];
    foreach ($reflection->getAttributes() as $attribute) {
        if (!isset($arr[$attribute->getName()])) {
            $arr[$attribute->getName()] = [];
        }
        $arr[$attribute->getName()][] = $attribute->getArguments();
    }
    var_dump($arr);
}

function f0() {}
dump_attributes(new ReflectionFunction("f0"));

<<Attr("function")>>
function foo() {}
dump_attributes(new ReflectionFunction("foo"));

// Class attributes
<<Attr("class")>>
class Bar {
	<<Attr("const")>>
	const C = 2;
	<<Attr("property")>>
	public $x = 3;

}
$reflectionClass = new ReflectionClass("Bar");
dump_attributes($reflectionClass);
dump_attributes($reflectionClass->getReflectionConstant("C"));
dump_attributes($reflectionClass->getProperty("x"));

$foo = <<Attr("closure")>>function () {};
dump_attributes(new ReflectionFunction($foo));

$foo = <<Attr("short closure")>>fn ($x) => $x;
dump_attributes(new ReflectionFunction($foo));

$anonClass = new <<Attr("anon class")>>class {};
dump_attributes(new ReflectionClass($anonClass));

// Multiple attributes with multiple values
<<Attr()>>
<<OtherAttr()>>
function f1() {}
dump_attributes(new ReflectionFunction("f1"));

// multiple instances of same attribute
<<Attr("foo")>>
<<Attr("bar")>>
function f2() {}
dump_attributes(new ReflectionFunction("f2"));
?>
--EXPECT--
array(0) {
}
array(1) {
  ["Attr"]=>
  array(1) {
    [0]=>
    array(1) {
      [0]=>
      string(8) "function"
    }
  }
}
array(1) {
  ["Attr"]=>
  array(1) {
    [0]=>
    array(1) {
      [0]=>
      string(5) "class"
    }
  }
}
array(1) {
  ["Attr"]=>
  array(1) {
    [0]=>
    array(1) {
      [0]=>
      string(5) "const"
    }
  }
}
array(1) {
  ["Attr"]=>
  array(1) {
    [0]=>
    array(1) {
      [0]=>
      string(8) "property"
    }
  }
}
array(1) {
  ["Attr"]=>
  array(1) {
    [0]=>
    array(1) {
      [0]=>
      string(7) "closure"
    }
  }
}
array(1) {
  ["Attr"]=>
  array(1) {
    [0]=>
    array(1) {
      [0]=>
      string(13) "short closure"
    }
  }
}
array(1) {
  ["Attr"]=>
  array(1) {
    [0]=>
    array(1) {
      [0]=>
      string(10) "anon class"
    }
  }
}
array(2) {
  ["Attr"]=>
  array(1) {
    [0]=>
    array(0) {
    }
  }
  ["OtherAttr"]=>
  array(1) {
    [0]=>
    array(0) {
    }
  }
}
array(1) {
  ["Attr"]=>
  array(2) {
    [0]=>
    array(1) {
      [0]=>
      string(3) "foo"
    }
    [1]=>
    array(1) {
      [0]=>
      string(3) "bar"
    }
  }
}
