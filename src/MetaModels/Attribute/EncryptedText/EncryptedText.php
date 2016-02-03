<?php
/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 *
 * @package     MetaModels
 * @subpackage  AttributeText
 * @author     David Maack <david.maack@arcor.de>
 * @copyright   The MetaModels team.
 * @license     LGPL.
 * @filesource
 */

namespace MetaModels\Attribute\EncryptedText;

use MetaModels\Attribute\IComplex;
use MetaModels\Attribute\Text\Text;

/**
 * This is the MetaModelAttribute class for handling text fields.
 *
 * @package    MetaModels
 * @subpackage AttributeText
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 */
class EncryptedText extends Text implements IComplex
{
    /**
     * {@inheritDoc}
     */
    public function setDataFor($arrValues)
    {
        $strTable   = $this->getMetaModel()->getTableName();
        $strColName = $this->getColName();
        foreach ($arrValues as $intId => $varData) {
            $this->getMetaModel()->getServiceContainer()->getDatabase()
                ->prepare(sprintf('UPDATE %s SET %s=? WHERE id=%s', $strTable, $strColName, $intId))
                ->execute(\Encryption::encrypt($varData));
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getDataFor($arrIds)
    {
        $strTable   = $this->getMetaModel()->getTableName();
        $strColName = $this->getColName();

        $objDB = $this->getMetaModel()->getServiceContainer()->getDatabase();

        $objValue = $this->getMetaModel()->getServiceContainer()->getDatabase()
                ->prepare(sprintf('SELECT id, %s FROM %s WHERE id IN (' . $this->parameterMask($arrIds) . ')' , $strColName, $strTable))
                ->execute($arrIds);

        $arrReturn = array();
        while ($objValue->next()) {
            $arrReturn[$objValue->id] = \Encryption::decrypt($objValue->$strColName);
        }

        return $arrReturn;
    }

    /**
     * {@inheritDoc}
     */
    public function unsetDataFor($arrIds)
    {
        $strTable   = $this->getMetaModel()->getTableName();
        $strColName = $this->getColName();

        $objDB = $this->getMetaModel()->getServiceContainer()->getDatabase();

        $objValue = $this->getMetaModel()->getServiceContainer()->getDatabase()
                ->prepare(sprintf('DELETE FROM %s WHERE id IN (' . $this->parameterMask($arrIds) . ')' , $strTable))
                ->execute($arrIds);
    }

    /**
     * {@inheritDoc}
     */
    public function searchFor($strPattern)
    {
        // Base implementation, do a simple search on given column.
        $objQuery = $this->getMetaModel()->getServiceContainer()->getDatabase()
            ->prepare(
                sprintf(
                    'SELECT id FROM %s WHERE %s LIKE ?',
                    $this->getMetaModel()->getTableName(),
                    $this->getColName()
                )
            )
            ->execute(str_replace(array('*', '?'), array('%', '_'), $strPattern));

        $arrIds = $objQuery->fetchEach('id');
        return $arrIds;
    }
}
