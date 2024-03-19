<?php
/* Smarty version 4.3.4, created on 2024-03-05 22:12:44
  from '/var/www/vtigercrm/layouts/v7/modules/ExtensionStore/Promotions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65e798dca14423_07276176',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c2770459962fa5584f8a974a0ea84810e7849405' => 
    array (
      0 => '/var/www/vtigercrm/layouts/v7/modules/ExtensionStore/Promotions.tpl',
      1 => 1706189738,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65e798dca14423_07276176 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['HEADER_SCRIPTS']->value, 'SCRIPT');
$_smarty_tpl->tpl_vars['SCRIPT']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['SCRIPT']->value) {
$_smarty_tpl->tpl_vars['SCRIPT']->do_else = false;
echo '<script'; ?>
 type="<?php echo $_smarty_tpl->tpl_vars['SCRIPT']->value->getType();?>
" src="<?php echo $_smarty_tpl->tpl_vars['SCRIPT']->value->getSrc();?>
" /><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><div class="banner-container" style="margin: 0px 10px;"><div class="row"></div><div class="banner"><ul class="bxslider"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PROMOTIONS']->value, 'PROMOTION');
$_smarty_tpl->tpl_vars['PROMOTION']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PROMOTION']->value) {
$_smarty_tpl->tpl_vars['PROMOTION']->do_else = false;
if (is_object($_smarty_tpl->tpl_vars['PROMOTION']->value)) {?><li><?php $_smarty_tpl->_assignInScope('SUMMARY', $_smarty_tpl->tpl_vars['PROMOTION']->value->get('summary'));
$_smarty_tpl->_assignInScope('EXTENSION_NAME', $_smarty_tpl->tpl_vars['PROMOTION']->value->get('label'));
if (is_numeric($_smarty_tpl->tpl_vars['SUMMARY']->value)) {
$_smarty_tpl->_assignInScope('LOCATION_URL', $_smarty_tpl->tpl_vars['PROMOTION']->value->getLocationUrl($_smarty_tpl->tpl_vars['SUMMARY']->value,$_smarty_tpl->tpl_vars['EXTENSION_NAME']->value));
} else {
ob_start();
echo $_smarty_tpl->tpl_vars['SUMMARY']->value;
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('LOCATION_URL', $_prefixVariable1);
}?><a onclick="window.open('<?php echo $_smarty_tpl->tpl_vars['LOCATION_URL']->value;?>
')"><img src="<?php if ($_smarty_tpl->tpl_vars['PROMOTION']->value->get('bannerURL')) {
echo $_smarty_tpl->tpl_vars['PROMOTION']->value->get('bannerURL');
}?>" title="<?php echo $_smarty_tpl->tpl_vars['PROMOTION']->value->get('label');?>
" /></a></li><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul></div></div>
<?php }
}
