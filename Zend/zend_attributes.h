#ifndef ZEND_ATTRIBUTES_H
#define ZEND_ATTRIBUTES_H

zend_class_entry *zend_ce_php_attribute;
zend_class_entry *zend_ce_php_compiler_attribute;

typedef void (*zend_attributes_internal_validator)(zval *attribute);
HashTable zend_attributes_internal_validators;

static void zend_compiler_attribute_register(zend_class_entry *ce, zend_attributes_internal_validator *validator)
{
	zend_string *attribute_name = zend_string_tolower_ex(ce->name, 1);

	zend_hash_update_mem(&zend_attributes_internal_validators, attribute_name, validator, sizeof(zend_attributes_internal_validator));
}
#endif
