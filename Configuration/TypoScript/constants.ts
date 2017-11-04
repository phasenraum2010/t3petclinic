
plugin.tx_t3petclinic_t3petclinicplugin {
    view {
        # cat=plugin.tx_t3petclinic_t3petclinicplugin/file; type=string; label=Path to template root (FE)
        templateRootPath = EXT:t3petclinic/Resources/Private/Templates/
        # cat=plugin.tx_t3petclinic_t3petclinicplugin/file; type=string; label=Path to template partials (FE)
        partialRootPath = EXT:t3petclinic/Resources/Private/Partials/
        # cat=plugin.tx_t3petclinic_t3petclinicplugin/file; type=string; label=Path to template layouts (FE)
        layoutRootPath = EXT:t3petclinic/Resources/Private/Layouts/
    }
    persistence {
        # cat=plugin.tx_t3petclinic_t3petclinicplugin//a; type=string; label=Default storage PID
        storagePid =
    }
}
