<?php
/* Smarty version 4.3.4, created on 2024-03-05 22:08:04
  from '/var/www/vtigercrm/layouts/v7/modules/Install/InstallPreProcess.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65e797c4264dd6_39994966',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '73f1bc9a36123f246e473d09e4f536ac10270b15' => 
    array (
      0 => '/var/www/vtigercrm/layouts/v7/modules/Install/InstallPreProcess.tpl',
      1 => 1706189738,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65e797c4264dd6_39994966 (Smarty_Internal_Template $_smarty_tpl) {
?>
<input type="hidden" id="module" value="Install" />
<input type="hidden" id="view" value="Index" />
<div class="container-fluid page-container">
	<div class="row">
		<div class="col-sm-6">
			<div class="logo">
				<img src="<?php echo vimage_path('logo.png');?>
"/>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="head pull-right">
				<h3><?php echo vtranslate('LBL_INSTALLATION_WIZARD','Install');?>
</h3>
			</div>
		</div>
	</div>
<?php }
}
