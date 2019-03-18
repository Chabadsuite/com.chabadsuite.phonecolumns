<?php

require_once 'phonecolumns.civix.php';
use CRM_Phonecolumns_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function phonecolumns_civicrm_config(&$config) {
  _phonecolumns_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function phonecolumns_civicrm_xmlMenu(&$files) {
  _phonecolumns_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function phonecolumns_civicrm_install() {
  _phonecolumns_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function phonecolumns_civicrm_postInstall() {
  _phonecolumns_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function phonecolumns_civicrm_uninstall() {
  _phonecolumns_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function phonecolumns_civicrm_enable() {
  _phonecolumns_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function phonecolumns_civicrm_disable() {
  _phonecolumns_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function phonecolumns_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _phonecolumns_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function phonecolumns_civicrm_managed(&$entities) {
  _phonecolumns_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function phonecolumns_civicrm_caseTypes(&$caseTypes) {
  _phonecolumns_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function phonecolumns_civicrm_angularModules(&$angularModules) {
  _phonecolumns_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function phonecolumns_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _phonecolumns_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function phonecolumns_civicrm_entityTypes(&$entityTypes) {
  _phonecolumns_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_alterReportVar().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterReportVar
 */
function phonecolumns_civicrm_alterReportVar($varType, &$var, &$object) {
  if ('CRM_Birthdays_Form_Report_Birthdays' == get_class($object)) {
    if ($varType == 'columns') {
      $var = array_merge($var, $object->getPhoneColumns());
    }
    if ($varType == 'sql' && !empty($object->getVar('_params')['fields']['phone'])) {
      $from = $object->getVar('_from');
      $aliases = $object->getVar('_aliases');
      $from .= " LEFT JOIN civicrm_phone {$aliases['civicrm_phone']}
        ON {$aliases['civicrm_contact']}.id =
          {$aliases['civicrm_phone']}.contact_id AND
          {$aliases['civicrm_phone']}.is_primary = 1 ";
      $object->setVar('_from', $from);
    }
  }
}
