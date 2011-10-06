<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2011 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  use osCommerce\OM\Core\HTML;
  use osCommerce\OM\Core\OSCOM;
  use osCommerce\OM\Core\Registry;
  
  $onfocus = 'onfocus="this.value = this.value ==\'%s\' ? \'\' : this.value" onblur="this.value = this.value == \'\' ? \'%s\' : this.value"';
  $onfocuspassword = 'onfocus="if(this.value ==\'%s\'){ this.type = \'password\'; this.value = \'\' }" onblur="if(this.value == \'\'){ this.type = \'text\'; this.value = \'%s\' }"';
  
?>

<!doctype html>
<html dir="<?php echo $OSCOM_Language->getTextDirection(); ?>" lang="<?php echo $OSCOM_Language->getCode(); ?>">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $OSCOM_Language->getCharacterSet(); ?>" />
 <title><?php echo STORE_NAME . ($OSCOM_Template->hasPageTitle() ? ': ' . $OSCOM_Template->getPageTitle() : ''); ?></title>
 <link rel="icon" type="image/png" href="<?php echo OSCOM::getPublicSiteLink('images/store_icon.png'); ?>" />
 <meta name="generator" value="osCommerce Online Merchant" />
 <script type="text/javascript" src="public/external/jquery/jquery-1.6.1.min.js"></script>
 <link rel="stylesheet" type="text/css" href="public/external/jquery/ui/themes/start/jquery-ui-1.8.13.custom.css" />
 <script type="text/javascript" src="public/external/jquery/ui/jquery-ui-1.8.13.custom.min.js"></script>
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
 <script type="text/javascript" src="public/external/jquery/mobile/jquery.mobile-1.0b2.min.js"></script>
 <link rel="stylesheet" type="text/css" href="public/external/jquery/mobile/jquery.mobile-1.0b2.min.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo OSCOM::getPublicSiteLink('templates/oscom/stylesheets/general.css'); ?>" />

<?php
  if ( $OSCOM_Template->hasPageTags() ) {
    echo $OSCOM_Template->getPageTags();
  }

// Moved it inside <div data-role="page"> in order to workaround jQuery Mobile bug.
//  if ($OSCOM_Template->hasJavascript()) {
//    $OSCOM_Template->getJavascript();
//  }
?>

</head>

<body>
<div data-role="page">
 <?php

  if ($OSCOM_Template->hasJavascript()) {
    $OSCOM_Template->getJavascript();
  }
 
 ?>
 <?php if ( $OSCOM_Template->hasPageHeader() ) : ?>
 <div data-role="header">
  <?php echo HTML::link(OSCOM::getLink(OSCOM::getDefaultSite(), OSCOM::getDefaultSiteApplication()), 'Home', 'data-icon="home" data-iconpos="notext"') ?>
  <h1><?php echo STORE_NAME ?></h1>
  <?php echo HTML::link(OSCOM::getLink(null, 'Cart'), OSCOM::getDef('cart_contents'), ' data-icon="cart" data-iconpos="notext"') ?>
 </div>
 <?php else : ?>
 <div data-role="header">
  <h1><?php echo $OSCOM_Product->getTitle() ? $OSCOM_Product->getTitle() : STORE_NAME ?></h1>
 </div> 
 <?php endif; ?>
 <div data-role="content">
 <?php

  if ( $OSCOM_MessageStack->exists('header') ) {
    echo $OSCOM_MessageStack->get('header');
  }
  
  if ( $OSCOM_Template->getPageContentsFilename() == 'main.php' && !isset($_REQUEST['Products']) && !isset($_REQUEST['Cart']) ) { // For home page we are displaying cetegories
   $OSCOM_Box = new osCommerce\OM\Core\Site\Shop\Module\Box\Categories\Controller();
   $OSCOM_Box->initialize();
   if ( $OSCOM_Box->hasContent() ) {
        if ( $OSCOM_Template->getCode() == DEFAULT_TEMPLATE ) {
          include(OSCOM::BASE_DIRECTORY . 'Core/Site/' . OSCOM::getSite() . '/Module/Box/' . $OSCOM_Box->getCode() . '/pages/main.php');
        } else { //HPDL old
          if (file_exists('templates/' . $osC_Template->getCode() . '/modules/boxes/' . $osC_Box->getCode() . '.php')) {
            include('templates/' . $osC_Template->getCode() . '/modules/boxes/' . $osC_Box->getCode() . '.php');
          } else {
            include('templates/' . DEFAULT_TEMPLATE . '/modules/boxes/' . $osC_Box->getCode() . '.php');
          }
        }
    }
  } else { // For the rest of the pages just content area
   if ( $OSCOM_Template->getCode() == DEFAULT_TEMPLATE ) {
     include(OSCOM::BASE_DIRECTORY . 'Core/Site/' . OSCOM::getSite() . '/Application/' . OSCOM::getSiteApplication() . '/pages/' . $OSCOM_Template->getPageContentsFilename());
   } else { // HPDL old
     if (file_exists('templates/' . $osC_Template->getCode() . '/content/' . $osC_Template->getGroup() . '/' . $osC_Template->getPageContentsFilename())) {
       include('templates/' . $osC_Template->getCode() . '/content/' . $osC_Template->getGroup() . '/' . $osC_Template->getPageContentsFilename());
     } else {
       include('templates/' . DEFAULT_TEMPLATE . '/content/' . $osC_Template->getGroup() . '/' . $osC_Template->getPageContentsFilename());
     }
   }
  }
  
   
 ?>
 </div>
 <?php if ( $OSCOM_Template->hasPageFooter() ) : ?>
 <div data-role="footer">
  <?php echo strip_tags(sprintf(preg_replace('/<br[^>]*>/ism', ' ', OSCOM::getDef('footer')), date('Y'), OSCOM::getLink(), STORE_NAME)); ?>
 </div>
 <?php endif; ?>
</div>
</body>
</html>