[globalVar = LIT:1 = {$bootstrap.ext.form.ajax}]
plugin.tx_form.settings.yamlConfigurations.100 >
module.tx_form.settings.yamlConfigurations.100 >
plugin.tx_form.settings.yamlConfigurations.100 = fileadmin/T3SBForm/BaseSetup.yaml
module.tx_form.settings.yamlConfigurations.100 = fileadmin/T3SBForm/BaseSetup.yaml

plugin.tx_form.settings.bootstrap.form.modal = {$bootstrap.ext.form.modal}
plugin.tx_form.settings.bootstrap.form.ajax = {$bootstrap.ext.form.ajax}

page.includeJSFooter.formplugin = EXT:t3sbootstrap/Resources/Public/Contrib/formPlugin.js

page.jsFooterInline.111 = TEXT
page.jsFooterInline.111.value (


// EXT:form ajax call
function initAjaxForms() {
	$('form[data-ajaxuri]').each(function() {
		var form = $(this);
		var form_id = '#' + form.attr('id');
		var ajaxuri = form.attr("data-ajaxuri");
		var options = {
			target: form_id,
			url: ajaxuri,
			success: function() {
				$(form_id).html('{$bootstrap.ext.form.success}');
			}
		};
		form.ajaxForm(options);
	})
};
initAjaxForms();


)
[global]
