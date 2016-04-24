<?php
/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 *
 * @package    MetaModels
 * @subpackage AttributeEncryptedText
 * @author     David Maack <david.maack@arcor.de>
 * @copyright  The MetaModels team.
 * @license    LGPL.
 * @filesource
 */

/**
 * Add the templates
 */
TemplateLoader::addFiles(
    array
    (
        'mm_attr_encryptedtext' => 'system/modules/metamodelsattribute_encryptedtext/templates',
    )
);
