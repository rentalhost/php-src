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
Fatal error: The PhpCompilerAttribute can only be used by internal classes, use PhpAttribute instead in %s
