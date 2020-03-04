--TEST--
Resolve attribute names
--FILE--
<?php
function dump_attributes($attributes) {
    $arr = [];
    foreach ($attributes as $attribute) {
        $arr[$attribute->getName()] = $attribute->getArguments();
    }
    var_dump($arr);
}

namespace Doctrine\ORM\Mapping {
    class Entity {
    }
}

namespace Foo {
    use Doctrine\ORM\Mapping\Entity;

    <<Entity(["foo" => "bar"])>>
    function foo() {
    }
}

namespace {
    dump_attributes((new ReflectionFunction('Foo\foo'))->getAttributes());
}
--EXPECTF--
array(1) {
  ["Doctrine\ORM\Mapping\Entity"]=>
  array(1) {
    [0]=>
    array(1) {
      ["foo"]=>
      string(3) "bar"
    }
  }
}
