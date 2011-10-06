<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2011 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  use osCommerce\OM\Core\HTML;
  use osCommerce\OM\Core\OSCOM;
  use osCommerce\OM\Core\PDO;
  use osCommerce\OM\Core\Site\Shop\Product;
  use osCommerce\OM\Core\Site\Shop\Products;

// create column list
  $define_list = array('PRODUCT_LIST_MODEL' => PRODUCT_LIST_MODEL,
                       'PRODUCT_LIST_NAME' => PRODUCT_LIST_NAME,
                       'PRODUCT_LIST_MANUFACTURER' => PRODUCT_LIST_MANUFACTURER,
                       'PRODUCT_LIST_PRICE' => PRODUCT_LIST_PRICE,
                       'PRODUCT_LIST_QUANTITY' => PRODUCT_LIST_QUANTITY,
                       'PRODUCT_LIST_WEIGHT' => PRODUCT_LIST_WEIGHT,
                       'PRODUCT_LIST_IMAGE' => PRODUCT_LIST_IMAGE,
                       'PRODUCT_LIST_BUY_NOW' => PRODUCT_LIST_BUY_NOW);

  asort($define_list);

  $column_list = array();

  foreach ( $define_list as $key => $value ) {
    if ($value > 0) $column_list[] = $key;
  }

  if ( (count($products_listing['entries']) > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {
?>

<div class="listingPageLinks">
  <span style="float: right;"><?php echo PDO::getBatchPageLinks('page', $products_listing['total'], OSCOM::getAllGET('page')); ?></span>

  <?php echo PDO::getBatchTotalPages(OSCOM::getDef('result_set_number_of_products'), (isset($_GET['page']) ? $_GET['page'] : 1), $products_listing['total']); ?>
</div>

<?php
  }
?>

<div>
  
<?php
  if ( count($products_listing['entries']) > 0 ) {
?>

 <ul data-role="listview" data-inset="true" data-split-icon="plus">

<?php

    foreach ( $products_listing['entries'] as $p ) {
      $OSCOM_Product = new Product($p['products_id']);

	  $content = $OSCOM_Image->show($OSCOM_Product->getImage(), $OSCOM_Product->getTitle());
	  $content .= '<h3>'.$OSCOM_Product->getTitle().'</h3>';
	  $content .= '<p>'.$OSCOM_Product->getPriceFormated().'</p>';
	  $buynow = '<a href="'.OSCOM::getLink(null, 'Cart', 'Add&' . $OSCOM_Product->getKeyword()).'">'.OSCOM::getDef('button_buy_now').'</a>';
	  
      echo '<li>'.HTML::link(OSCOM::getLink(null, 'Products', $OSCOM_Product->getKeyword() . ($OSCOM_Category->getID() > 0 ? '&cPath=' . $OSCOM_Category->getPath() : '')), $content).$buynow.'</li>';
    }
?>

 </ul>

<?php
  } else {
    echo OSCOM::getDef('no_products_in_category');
  }
?>

</div>

<?php
  if ( (count($products_listing['entries']) > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>

<div class="listingPageLinks">
  <span style="float: right;"><?php echo PDO::getBatchPageLinks('page', $products_listing['total'], OSCOM::getAllGET('page')); ?></span>

  <?php echo PDO::getBatchTotalPages(OSCOM::getDef('result_set_number_of_products'), (isset($_GET['page']) ? $_GET['page'] : 1), $products_listing['total']); ?>
</div>

<?php
  }
?>
