<?php
class SmashingMagazine_LogProductUpdate_Model_Observer
{
    public function logUpdate(Varien_Event_Observer $observer)
    {




      if (
          Mage::app()->getRequest()->getParam('item_id') &&
          Mage::app()->getRequest()->getParam('qty')
        ) {

        //Empty Cart
        Mage::getSingleton('checkout/cart')->truncate();

        $item_id = Mage::app()->getRequest()->getParam('item_id');
        $qty = Mage::app()->getRequest()->getParam('qty');

    // http://tutorialsplane.com/magento-add-product-to-cart-in-programmatically/
      //  $item_id = '2';
      //  $qty = '3';
        $product = Mage::getModel('catalog/product')->load($item_id);
        $cart = Mage::getModel('checkout/cart');
        $cart->init();
        $cart->addProduct($product, array('qty' => $qty));
        $cart->save();
        Mage::getSingleton('checkout/session')->setCartWasUpdated(true);
      }

    }
}
