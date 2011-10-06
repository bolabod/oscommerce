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

<?php
  if ( $OSCOM_MessageStack->exists('LogIn') ) {
    echo $OSCOM_MessageStack->get('LogIn');
  }
?>

<div class="moduleBox">
  <form name="login" action="<?php echo OSCOM::getLink(null, null, 'LogIn&Process', 'SSL'); ?>" method="post">

  <h2><?php echo OSCOM::getDef('login_returning_customer_heading'); ?></h2>

  <div class="content">
    <p><?php echo OSCOM::getDef('login_returning_customer_text'); ?></p>

    <ol>
      <li><?php $label = OSCOM::getDef('field_customer_email_address'); echo HTML::inputField('email_address', $label, sprintf($onfocus, $label, $label)); ?></li>
      <li><?php $label = OSCOM::getDef('field_customer_password'); echo HTML::inputField('password', $label, sprintf($onfocuspassword, $label, $label)); ?></li>
    </ol>

    <p><?php echo sprintf(OSCOM::getDef('login_returning_customer_password_forgotten'), OSCOM::getLink(null, null, 'PasswordForgotten', 'SSL')); ?></p>

    <p align="right"><?php echo HTML::button(array('icon' => 'key', 'title' => OSCOM::getDef('button_sign_in'))); ?></p>
  </div>

  </form>
</div>

<div class="moduleBox">
    <h2><?php echo OSCOM::getDef('login_new_customer_heading'); ?></h2>

  <div class="content">
    <p><?php echo OSCOM::getDef('login_new_customer_text'); ?></p>

    <p align="right"><?php echo HTML::button(array('href' => OSCOM::getLink(null, null, 'Create', 'SSL'), 'icon' => 'triangle-1-e', 'title' => OSCOM::getDef('button_continue'))); ?></p>
  </div>
</div>
