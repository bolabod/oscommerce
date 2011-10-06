<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2011 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  use osCommerce\OM\Core\DateTime;
  use osCommerce\OM\Core\HTML;
  use osCommerce\OM\Core\OSCOM;
  use osCommerce\OM\Core\Site\Shop\Products;
  use osCommerce\OM\Core\Site\Shop\ProductVariants;
  use osCommerce\OM\Core\Site\Shop\Reviews;
?>

<h1><?php echo $OSCOM_Template->getPageTitle(); ?></h1>

<div align="center">

<?php
  if ( $OSCOM_Product->hasImage() ) {
?>

    <?php echo HTML::link(OSCOM::getLink(null, 'Products', 'Images&' . $OSCOM_Product->getKeyword()), $OSCOM_Image->show($OSCOM_Product->getImage(), $OSCOM_Product->getTitle(), null, 'product_info'), 'data-rel="dialog"'); ?>

</div><br />

<?php
  }
?>

    <form name="cart_quantity" action="<?php echo OSCOM::getLink(null, 'Cart', 'Add&' . $OSCOM_Product->getKeyword()); ?>" method="post">

    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="productInfoKey">Price:</td>
        <td class="productInfoValue"><span id="productInfoPrice"><?php echo $OSCOM_Product->getPriceFormated(true); ?></span> (plus <?php echo HTML::link(OSCOM::getLink(null, 'Info', 'Shipping'), 'shipping'); ?>)</td>
      </tr>

<?php
  if ( $OSCOM_Product->hasAttribute('shipping_availability') ) { // HPDL check case
?>

      <tr>
        <td class="productInfoKey">Availability:</td>
        <td class="productInfoValue" id="productInfoAvailability"><?php echo $OSCOM_Product->getAttribute('shipping_availability'); ?></td>
      </tr>

<?php
  }
?>

    </table>

<?php
  if ( $OSCOM_Product->hasVariants() ) {
?>

    <div id="variantsBlock">
      <div id="variantsBlockTitle"><?php echo OSCOM::getDef('product_attributes'); ?></div>

      <div id="variantsBlockData">

<?php
    foreach ( $OSCOM_Product->getVariants() as $group_id => $value ) {
      echo ProductVariants::parse($value['module'], $value);
    }

    echo ProductVariants::defineJavascript($OSCOM_Product->getVariants(false));
?>

      </div>
    </div>

<?php
  }
?>

<table border="0" cellspacing="0" cellpadding="0">

<?php
  if ( $OSCOM_Product->hasAttribute('manufacturers') ) { // HPDL check case
?>

  <tr>
    <td class="productInfoKey">Manufacturer:</td>
    <td class="productInfoValue"><?php echo $OSCOM_Product->getAttribute('manufacturers'); // HPDL check case ?></td>
  </tr>

<?php
  }
?>

  <tr>
    <td class="productInfoKey">Model:</td>
    <td class="productInfoValue"><span id="productInfoModel"><?php echo $OSCOM_Product->getModel(); ?></span></td>
  </tr>

<?php
  if ( $OSCOM_Product->hasAttribute('date_available') ) { // HPDL check case
?>

  <tr>
    <td class="productInfoKey">Date Available:</td>
    <td class="productInfoValue"><?php echo DateTime::getShort($OSCOM_Product->getAttribute('date_available')); ?></td>
  </tr>

<?php
  }
?>

</table>

      <?php echo HTML::button(array('icon' => 'cart', 'title' => OSCOM::getDef('button_add_to_cart'))); ?><br />

    </form>

<?php
  if ( $OSCOM_Product->hasVariants() ) {
?>

<script language="javascript" type="text/javascript">
  var originalPrice = '<?php echo $OSCOM_Product->getPriceFormated(true); ?>';
  var productInfoNotAvailable = '<span id="productVariantCombinationNotAvailable">Not available in this combination. Please select another combination for your order.</span>';
  var productInfoAvailability = '<?php if ( $OSCOM_Product->hasAttribute('shipping_availability') ) { echo addslashes($OSCOM_Product->getAttribute('shipping_availability')); } ?>';

  refreshVariants();
</script>

<?php
  }
?>

<div>
  <?php echo $OSCOM_Product->getDescription(); ?>
</div>

<?php
  if ($OSCOM_Service->isStarted('Reviews') && Reviews::exists(Products::getProductID($OSCOM_Product->getID()), true)) {
?>

<p><?php echo OSCOM::getDef('number_of_product_reviews') . ' ' . Reviews::getTotal(Products::getProductID($OSCOM_Product->getID())); ?></p>

<?php
  }

  if ( $OSCOM_Product->hasURL() ) {
?>

<p><?php echo sprintf(OSCOM::getDef('go_to_external_products_webpage'), OSCOM::getLink(null, 'Redirect', 'action=url&goto=' . urlencode($OSCOM_Product->getURL()), 'NONSSL', null, false)); ?></p>

<?php
  }
?>

<div class="submitFormButtons" style="text-align: right;">

<?php
  if ( $OSCOM_Service->isStarted('Reviews')) {
    echo HTML::button(array('href' => OSCOM::getLink(null, null, 'Reviews&' . OSCOM::getAllGET()), 'icon' => 'comment', 'title' => OSCOM::getDef('button_reviews')));
  }
?>

</div>
