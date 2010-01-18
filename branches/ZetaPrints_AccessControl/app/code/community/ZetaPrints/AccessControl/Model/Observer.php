<?php

/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category   Netzarbeiter
 * @package    Netzarbeiter_GroupsCatalog
 * @copyright  Copyright (c) 2008 Vinai Kopp http://netzarbeiter.com/
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/**
 * Observer for the groups catalog extension. Remove hidden items from the collections
 *
 * @category   Netzarbeiter
 * @package    Netzarbeiter_GroupsCatalog
 * @author     Vinai Kopp <vinai@netzarbeiter.com>
 */
class ZetaPrints_AccessControl_Model_Observer extends Mage_Core_Model_Abstract {

  /**
   * Remove hidden caegories from the collection
   * Since Mageto 1.3.1 this is also used for flat category collections
   *
   * @param Varien_Event_Observer $observer
   */
  public function catalogCategoryCollectionLoadAfter ($observer) {
    if (!Mage::helper('accesscontrol')->is_extension_enabled() || $this->_is_api_request())
      return;

    Mage::helper('accesscontrol')->filter_out_categories($observer->getCategoryCollection());
  }

  /**
   * Return true if the reqest is made via the api
   *
   * @return boolean
   */
  protected function _is_api_request() {
    return Mage::app()->getRequest()->getModuleName() === 'api';
  }
}

