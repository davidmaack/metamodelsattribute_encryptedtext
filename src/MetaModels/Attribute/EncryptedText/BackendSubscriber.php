<?php
/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 *
 * @package    AttributeText
 * @subpackage Core
 * @author     David Maack <david.maack@arcor.de>
 * @copyright  The MetaModels team.
 * @license    LGPL.
 * @filesource
 */

namespace MetaModels\Attribute\EncryptedText;

use MetaModels\Attribute\Text\BackendSubscribe as TextBackendSubscriber;

/**
 * Handles event operations on tl_metamodel_dcasetting.
 */
class BackendSubscriber extends TextBackendSubscriber
{

}
