/*
   +----------------------------------------------------------------------+
   | Zend Engine                                                          |
   +----------------------------------------------------------------------+
   | Copyright (c) Zend Technologies Ltd. (http://www.zend.com)           |
   +----------------------------------------------------------------------+
   | This source file is subject to version 2.00 of the Zend license,     |
   | that is bundled with this package in the file LICENSE, and is        |
   | available through the world-wide-web at the following url:           |
   | http://www.zend.com/license/2_00.txt.                                |
   | If you did not receive a copy of the Zend license and are unable to  |
   | obtain it through the world-wide-web, please send a note to          |
   | license@zend.com so we can mail you a copy immediately.              |
   +----------------------------------------------------------------------+
   | Authors: Sterling Hughes <sterling@php.net>                          |
   |          Marcus Boerger <helly@php.net>                              |
   +----------------------------------------------------------------------+
*/

#include "zend.h"
#include "zend_API.h"
#include "zend_builtin_functions.h"
#include "zend_interfaces.h"
#include "zend_exceptions.h"
#include "zend_closures.h"
#include "zend_generators.h"
#include "zend_weakrefs.h"

zend_class_entry *zend_ce_php_attribute;
zend_class_entry *zend_ce_php_compiler_attribute;

static void zend_register_attribute_ce(void)
{
	zend_class_entry ce;

	INIT_CLASS_ENTRY(ce, "PhpAttribute", NULL);
	zend_ce_php_attribute = zend_register_internal_class(&ce);
	zend_ce_php_attribute->ce_flags |= ZEND_ACC_FINAL;

	//zend_hash_init_ex(zend_ce_php_attribute->attributes, 8, NULL, NULL, 1, 0);
	//zend_hash_str_add_empty_element(zend_ce_php_attribute->attributes, "phpattribute", sizeof("phpattribute")-1);

	INIT_CLASS_ENTRY(ce, "PhpCompilerAttribute", NULL);
	zend_ce_php_compiler_attribute = zend_register_internal_class(&ce);
	zend_ce_php_compiler_attribute->ce_flags |= ZEND_ACC_FINAL;

	//zend_hash_init_ex(zend_ce_php_attribute->attributes, 8, NULL, NULL, 1, 0);
	//zend_hash_str_add_empty_element(zend_ce_php_attribute->attributes, "phpattribute", sizeof("phpattribute")-1);
}

ZEND_API void zend_register_default_classes(void)
{
	zend_register_interfaces();
	zend_register_default_exception();
	zend_register_iterator_wrapper();
	zend_register_closure_ce();
	zend_register_generator_ce();
	zend_register_weakref_ce();
	zend_register_attribute_ce();
}
