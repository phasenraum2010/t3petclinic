
plugin.tx_t3petclinic_t3petclinicplugin {
    view {
        templateRootPaths.0 = EXT:t3petclinic/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_t3petclinic_t3petclinicplugin.view.templateRootPath}
        partialRootPaths.0 = EXT:t3petclinic/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_t3petclinic_t3petclinicplugin.view.partialRootPath}
        layoutRootPaths.0 = EXT:t3petclinic/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_t3petclinic_t3petclinicplugin.view.layoutRootPath}
    }
    persistence {
        storagePid = {$plugin.tx_t3petclinic_t3petclinicplugin.persistence.storagePid}
        #recursive = 1
    }
    features {
        #skipDefaultArguments = 1
        # if set to 1, the enable fields are ignored in BE context
        ignoreAllEnableFieldsInBe = 0
        # Should be on by default, but can be disabled if all action in the plugin are uncached
        requireCHashArgumentForActionArguments = 1
    }
    mvc {
        #callDefaultActionIfActionCantBeResolved = 1
    }
}

# these classes are only used in auto-generated templates
plugin.tx_t3petclinic._CSS_DEFAULT_STYLE (
    textarea.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    input.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    .tx-t3petclinic table {
        border-collapse:separate;
        border-spacing:10px;
    }

    .tx-t3petclinic table th {
        font-weight:bold;
    }

    .tx-t3petclinic table td {
        vertical-align:top;
    }

    .typo3-messages .message-error {
        color:red;
    }

    .typo3-messages .message-ok {
        color:green;
    }
)
