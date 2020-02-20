--TEST--
Resolve attribute names
--FILE--
<?php

namespace Doctrine\ORM\Mapping {
    class Entity {
    }
}

namespace {
    use Doctrine\ORM\Mapping\Entity;

    <<Entity(["foo"])>>
    function foo() {
    }
    var_dump((new ReflectionFunction('foo'))->getAttributes());
}
--EXPECTF--
