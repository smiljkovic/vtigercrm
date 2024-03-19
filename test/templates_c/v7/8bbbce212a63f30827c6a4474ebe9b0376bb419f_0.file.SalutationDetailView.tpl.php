<?php
/* Smarty version 4.3.4, created on 2024-03-19 14:48:48
  from '/var/www/vtigercrm/layouts/v7/modules/Vtiger/uitypes/SalutationDetailView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65f9a5d00021a5_31247870',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8bbbce212a63f30827c6a4474ebe9b0376bb419f' => 
    array (
      0 => '/var/www/vtigercrm/layouts/v7/modules/Vtiger/uitypes/SalutationDetailView.tpl',
      1 => 1706189738,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65f9a5d00021a5_31247870 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('salutationtype');?>


<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value);
}
}
