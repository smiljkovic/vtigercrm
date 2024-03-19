<?php
/* Smarty version 4.3.4, created on 2024-03-07 17:58:26
  from '/var/www/vtigercrm/layouts/v7/modules/Vtiger/Footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65ea0042b06485_91241412',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eeb897f781c8786ee821acded8e5b68da8b3632c' => 
    array (
      0 => '/var/www/vtigercrm/layouts/v7/modules/Vtiger/Footer.tpl',
      1 => 1709834303,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65ea0042b06485_91241412 (Smarty_Internal_Template $_smarty_tpl) {
?>
<footer class="app-footer">
	<p>
		Powered by Pro Konsalting 021 - &nbsp;&nbsp;© 2004 - <?php echo date('Y');?>
&nbsp;&nbsp;
	</p>
</footer>
</div>
<div id='overlayPage'>
	<!-- arrow is added to point arrow to the clicked element (Ex:- TaskManagement), 
	any one can use this by adding "show" class to it -->
	<div class='arrow'></div>
	<div class='data'>
	</div>
</div>
<div id='helpPageOverlay'></div>
<div id="js_strings" class="hide noprint"><?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['LANGUAGE_STRINGS']->value);?>
</div>
<div class="modal myModal fade"></div>
<?php $_smarty_tpl->_subTemplateRender(vtemplate_path('JSResources.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</body>

</html><?php }
}
