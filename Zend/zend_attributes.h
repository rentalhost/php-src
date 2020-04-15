#ifndef ZEND_ATTRIBUTES_H
#define ZEND_ATTRIBUTES_H

#define ZEND_ATTRIBUTE_TARGET_CLASS			1
#define ZEND_ATTRIBUTE_TARGET_FUNCTION		2
#define ZEND_ATTRIBUTE_TARGET_METHOD		4
#define ZEND_ATTRIBUTE_TARGET_PROPERTY		8
#define ZEND_ATTRIBUTE_TARGET_CLASS_CONST	16
#define ZEND_ATTRIBUTE_TARGET_PARAMETER		32
#define ZEND_ATTRIBUTE_TARGET_ALL			63

zend_class_entry *zend_ce_php_attribute;
zend_class_entry *zend_ce_php_compiler_attribute;

typedef void (*zend_attributes_internal_validator)(zval *attribute, int target);
HashTable zend_attributes_internal_validators;

void zend_compiler_attribute_register(zend_class_entry *ce, zend_attributes_internal_validator validator);
void zend_register_attribute_ce(void);
#endif
