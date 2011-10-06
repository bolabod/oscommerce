<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2011 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  use osCommerce\OM\Core\HTML;
  use osCommerce\OM\Core\OSCOM;

  $large_image = $OSCOM_Image->show($OSCOM_Product->getImage(), $OSCOM_Product->getTitle(), 'id="productImageLarge"', 'large');
?>

<script language="javascript" type="text/javascript">
function loadImage(imageUrl) {
  $("#productImageLarge").fadeOut('fast', function() {
    $("#productImageLarge").attr('src', imageUrl);
    $("#productImageLarge").fadeIn("slow");
  });
}
</script>

<div align="center"><?php echo $large_image ?></div>

<?php
  if ( $OSCOM_Product->numberOfImages() > 1 ) {
    foreach ( $OSCOM_Product->getImages() as $images ) {
      echo HTML::link('#', $OSCOM_Image->show($images['image'], $OSCOM_Product->getTitle(), 'height="' . $OSCOM_Image->getHeight($OSCOM_Image->getCode(DEFAULT_IMAGE_GROUP_ID)) . '" style="max-width: ' . $OSCOM_Image->getWidth($OSCOM_Image->getCode(DEFAULT_IMAGE_GROUP_ID)) . 'px;"'), 'onclick="loadImage(\'' . $OSCOM_Image->getAddress($images['image'], 'large') . '\'); return false;"').' &nbsp; ';
    }
  }
?>
