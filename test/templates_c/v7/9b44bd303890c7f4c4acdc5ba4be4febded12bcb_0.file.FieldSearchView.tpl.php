<?php
/* Smarty version 4.5.1, created on 2024-03-25 18:43:19
  from '/var/www/vtigercrm/layouts/v7/modules/Vtiger/uitypes/FieldSearchView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.1',
  'unifunc' => 'content_6601c5c79a1109_92897977',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9b44bd303890c7f4c4acdc5ba4be4febded12bcb' => 
    array (
      0 => '/var/www/vtigercrm/layouts/v7/modules/Vtiger/uitypes/FieldSearchView.tpl',
      1 => 1711392074,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6601c5c79a1109_92897977 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('FIELD_INFO', Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo()));?><div class=""><input type="text" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" class="listSearchContributor inputElement" value="<?php echo $_smarty_tpl->tpl_vars['SEARCH_INFO']->value['searchValue'];?>
" data-field-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType();?>
" data-fieldinfo='<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['FIELD_INFO']->value, ENT_QUOTES, 'UTF-8', true);?>
'/></div><?php }
}
