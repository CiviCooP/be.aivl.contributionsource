<?php

require_once 'contributionsource.civix.php';

/**
 * Implementation of hook_civicrm_config
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function contributionsource_civicrm_config(&$config) {
  _contributionsource_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function contributionsource_civicrm_xmlMenu(&$files) {
  _contributionsource_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function contributionsource_civicrm_install() {
  return _contributionsource_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function contributionsource_civicrm_uninstall() {
  return _contributionsource_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function contributionsource_civicrm_enable() {
  return _contributionsource_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function contributionsource_civicrm_disable() {
  return _contributionsource_civix_civicrm_disable();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function contributionsource_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _contributionsource_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function contributionsource_civicrm_managed(&$entities) {
  return _contributionsource_civix_civicrm_managed($entities);
}

/**
 * Implementation of hook_civicrm_caseTypes
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function contributionsource_civicrm_caseTypes(&$caseTypes) {
  _contributionsource_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implementation of hook_civicrm_alterSettingsFolders
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function contributionsource_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _contributionsource_civix_civicrm_alterSettingsFolders($metaDataFolders);
}
function contributionsource_civicrm_searchColumns( $objectName, &$headers, &$rows, &$selector ) {
  if ($objectName == 'contribution') {
    foreach ($rows as $rowNum => $row) {
      try {
        if (!empty($row['campaign'])) {
          $rows[$rowNum]['contribution_source'] = substr($row['campaign'], 0, 4).'...';
          if (!empty($row['contribution_source'])) {
            $rows[$rowNum]['contribution_source'] .= ' (source '.$row['contribution_source'].')';
          }
        }
      } catch (Exception $ex)
      {}
    }
    foreach ( $headers as $headerId => $header ) {
      if (isset($header['name']) && $header['name'] == 'Source' ) {
        $headers[$headerId]['name'] = 'Campaign (source)';
        unset( $headers[$headerId]['sort'] );
      }
    }
  }
}