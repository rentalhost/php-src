--TEST--
attributes: Add PhpCompilerAttribute
--FILE--
<?php

<<PhpCompilerAttribute>>
class Foo
{
}

$ref = new ReflectionClass(Foo::class);
var_dump($ref->getAttributes()[0]->getAsObject());
--EXPECTF--
object(PhpCompilerAttribute)#3 (0) {
}
