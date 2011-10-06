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
  if ( $OSCOM_MessageStack->exists('Create') ) {
    echo $OSCOM_MessageStack->get('Create');
  }
?>

<form name="create" action="<?php echo OSCOM::getLink(null, null, 'Create&Process', 'SSL'); ?>" method="post" onsubmit="return check_form(create);">

<div class="moduleBox">
  <em style="float: right;"><?php echo OSCOM::getDef('form_required_information'); ?></em>
  <div style="clear:both;"></div><br />
  <div class="content">
    <ol>

<?php
  if ( ACCOUNT_GENDER > -1 ) {
    $gender_array = array(array('id' => 'm', 'text' => OSCOM::getDef('gender_male')),
                          array('id' => 'f', 'text' => OSCOM::getDef('gender_female')));
?>

      <li><fieldset data-role="controlgroup" data-type="horizontal"><?php echo HTML::radioField('gender', $gender_array, null, null, ''); ?></fieldset></li>

<?php
  }
?>

      <li><?php $label = OSCOM::getDef('field_customer_first_name'); echo HTML::inputField('firstname', $label, sprintf($onfocus, $label, $label)); ?></li>
      <li><?php $label = OSCOM::getDef('field_customer_last_name'); echo HTML::inputField('lastname', $label, sprintf($onfocus, $label, $label)); ?></li>

<?php
  if ( ACCOUNT_DATE_OF_BIRTH == '1' ) {
?>

      <li><?php echo HTML::label(OSCOM::getDef('field_customer_date_of_birth'), 'dob_days', null, true) . '<fieldset data-role="controlgroup" data-type="horizontal">' . HTML::dateSelectMenu('dob', null, false, null, null, date('Y')-1901, -5).'</fieldset>'; ?></li>

<?php
  }
?>

      <li><?php $label = OSCOM::getDef('field_customer_email_address'); echo HTML::inputField('email_address', $label, sprintf($onfocus, $label, $label)); ?></li>

<?php
  if ( ACCOUNT_NEWSLETTER == '1' ) {
?>

      <li><?php echo HTML::label(OSCOM::getDef('field_customer_newsletter'), 'newsletter') . HTML::checkboxField('newsletter', '1'); ?></li>

<?php
  }
?>

      <li><?php $label = OSCOM::getDef('field_customer_password'); echo HTML::inputField('password', $label, sprintf($onfocuspassword, $label, $label)); ?></li>
      <li><?php $label = OSCOM::getDef('field_customer_password_confirmation'); echo HTML::inputField('confirmation', $label, sprintf($onfocuspassword, $label, $label)); ?></li>
    </ol>
  </div>
</div>

<?php
  if ( DISPLAY_PRIVACY_CONDITIONS == '1' ) {
?>

<div class="moduleBox">
  <h6><?php echo OSCOM::getDef('create_account_terms_heading'); ?></h6>

  <div class="content">
    <?php echo sprintf(OSCOM::getDef('create_account_terms_description'), OSCOM::getLink(null, 'Info', 'Privacy', 'AUTO')) . '<br /><br /><ol><li>' . HTML::checkboxField('privacy_conditions', array(array('id' => 1, 'text' => OSCOM::getDef('create_account_terms_confirm')))) . '</li></ol>'; ?>
  </div>
</div>

<?php
  }
?>

<div class="submitFormButtons">
  <span style="float: right;"><?php echo HTML::button(array('icon' => 'triangle-1-e', 'title' => OSCOM::getDef('button_continue'))); ?></span>
</div>

</form>
