--TEST--
Doctrine-like attributes usage
--FILE--
<?php
namespace Doctrine\ORM {

	class Entity {
		private $name;
		public function __construct($name) {
			$this->name = $name;
		}
	}

	function GetClassAttributes($class_name) {
		$reflClass = new \ReflectionClass($class_name);
		$attrs = $reflClass->getAttributes();
		foreach ($attrs as $name => $values) {
			$attrs[$name] = new $name($values[0][0]);
		}
		return $attrs;
	}
}

namespace Doctrine\ORM\Mapping {
    class Entity {
        public $tableName;
        public $repository;

        public function __construct(array $values)
        {
            foreach ($values as $k => $v) {
                $this->$k = $v;
            }
        }
    }
}

namespace {
    use Doctrine\ORM\Mapping as ORM;

	<<ORM\Entity(["tableName" => "user", "repository" => UserRepository::class])>>
	class User {}

	var_dump(Doctrine\ORM\GetClassAttributes("User"));
}
?>
--EXPECT--
array(1) {
  ["ORM\Entity"]=>
  object(Doctrine\ORM\Entity)#2 (1) {
    ["name":"Doctrine\ORM\Entity":private]=>
    string(4) "user"
  }
}
