<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2011 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  use osCommerce\OM\Core\HTML;
  use osCommerce\OM\Core\OSCOM;
?>

<h1><?php echo $OSCOM_Template->getPageTitle(); ?></h1>

<?php
  if ( $OSCOM_MessageStack->exists('Cart') ) {
    echo $OSCOM_MessageStack->get('Cart');
  }
?>

 <ul data-role="listview" data-inset="true" data-split-icon="plus">
 
<?php
    $_cart_date_added = null;

    foreach ( $OSCOM_ShoppingCart->getProducts() as $products ) {
?>

      <li>
        

<?php

	  $content = '<h3>'.$products['quantity'].'x '.$products['name'].(STOCK_CHECK == '1' && $OSCOM_ShoppingCart->isInStock($products['item_id']) === false ? '<span class="markProductOutOfStock">' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '</span>' : '').'</h3>';
      if ( $OSCOM_ShoppingCart->isVariant($products['item_id']) ) {
        foreach ( $OSCOM_ShoppingCart->getVariant($products['item_id']) as $variant) {
          $content .= '<p>- ' . $variant['group_title'] . ': ' . $variant['value_title'].'</p>';
        }
      }
	  
      echo HTML::link(OSCOM::getLink(null, 'Products', $products['keyword']), $content).'<a href="'.OSCOM::getLink(null, null, 'Delete=' . $products['item_id'], 'SSL').'"data-icon="minus">'.OSCOM::getDef('button_delete').'</a>';


?>

      </li>

<?php
    }
?>

 </ul>

  <table border="0" width="100%" cellspacing="0" cellpadding="2">

<?php
// HPDL
//    if ($osC_OrderTotal->hasActive()) {
//      foreach ($osC_OrderTotal->getResult() as $module) {
      foreach ( $OSCOM_ShoppingCart->getOrderTotals() as $module ) {
        echo '    <tr>' . "\n" .
             '      <td align="right">' . $module['title'] . '</td>' . "\n" .
             '      <td align="right">' . $module['text'] . '</td>' . "\n" .
             '    </tr>';
      }
//    }
?>

  </table>

<?php
    if ( (STOCK_CHECK == '1') && ($OSCOM_ShoppingCart->hasStock() === false) ) {
      if ( STOCK_ALLOW_CHECKOUT == '1' ) {
        echo '<p class="stockWarning" align="center">' . sprintf(OSCOM::getDef('products_out_of_stock_checkout_possible'), STOCK_MARK_PRODUCT_OUT_OF_STOCK) . '</p>';
      } else {
        echo '<p class="stockWarning" align="center">' . sprintf(OSCOM::getDef('products_out_of_stock_checkout_not_possible'), STOCK_MARK_PRODUCT_OUT_OF_STOCK) . '</p>';
      }
    }
?>

  <form name="checkout" action="<?php echo OSCOM::getLink(null, 'Checkout', null, 'SSL'); ?>" method="post">

  <div style="float: right;">
    <?php echo HTML::button(array('icon' => 'triangle-1-e', 'title' => OSCOM::getDef('button_checkout'))); ?>
  </div>

<?php
  if ( !$OSCOM_Customer->isLoggedOn() && $OSCOM_Application->requireCustomerAccount() ) {
?>

  <div class="content">
    <?php echo 'E-Mail Address: ' . HTML::inputField('email', $OSCOM_Customer->getEMailAddress()) . ' or ' . HTML::link(OSCOM::getLink(null, 'Account', 'LogIn', 'SSL'), 'Sign-In') . ' to process this order'; ?>
  </div>

<?php
  }
?>

  </form>