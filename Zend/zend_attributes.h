#ifndef ZEND_ATTRIBUTES_H
#define ZEND_ATTRIBUTES_H

zend_class_entry *zend_ce_php_attribute;
zend_class_entry *zend_ce_php_compiler_attribute;

typedef void (*zend_attributes_internal_validator)(zval *attribute);
HashTable zend_attributes_internal_validators;

void zend_compiler_attribute_register(zend_class_entry *ce, zend_attributes_internal_validator *validator);
void zend_register_attribute_ce(void);
#endif
