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
 * @subpackage AttributeText
 * @author     David Maack <david.maack@arcor.de>
 * @copyright  The MetaModels team.
 * @license    LGPL.
 * @filesource
 */

namespace MetaModels\Attribute\EncryptedText;

use MetaModels\Attribute\AbstractAttributeTypeFactory;

/**
 * Attribute type factory for text attributes.
 */
class AttributeTypeFactory extends AbstractAttributeTypeFactory
{

    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        parent::__construct();
        $this->typeName = 'encryptedtext';
        $this->typeIcon = 'system/modules/metamodelsattribute_text/html/text.png';
        $this->typeClass = 'MetaModels\Attribute\EncryptedText\EncryptedText';
    }

}
