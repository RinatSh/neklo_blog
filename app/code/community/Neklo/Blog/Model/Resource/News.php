<?php

/**
 * Class  Neklo_Blog_Model_Resource_News
 */

class Neklo_Blog_Model_Resource_News extends Mage_Core_Model_Mysql4_Abstract
{

    /**
     * Resource initialization
     */

    protected function _construct()
    {

        $this->_init('neklo_blog/news', 'entity_id');

    }



    /**
     * Check if
     *
     * @param string $identifier_url
     * @return string
     */
    public function checkIdentifierUrl($identifier_url)
    {
        $select = $this->_getReadAdapter()->select()->from( $this->getMainTable(), 'entity_id')
            ->where('identifier_url=?', $identifier_url);

        return $this->_getReadAdapter()->fetchOne($select);
    }


}