#
# Table structure for table 'tx_t3sbootstrap_domain_model_config'
#
CREATE TABLE tx_t3sbootstrap_domain_model_config (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(3) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(3) unsigned DEFAULT '0' NOT NULL,
	company varchar(255) DEFAULT '' NOT NULL,
	homepage_uid int(11) DEFAULT '0' NOT NULL,
	page_title varchar(9) DEFAULT '' NOT NULL,
	page_titlealign varchar(7) DEFAULT '' NOT NULL,
	meta_enable varchar(5) DEFAULT '' NOT NULL,
	meta_value varchar(255) DEFAULT '' NOT NULL,
	meta_container varchar(15) DEFAULT '' NOT NULL,
	meta_class varchar(255) DEFAULT '' NOT NULL,
	navbar_enable varchar(7) DEFAULT '' NOT NULL,
	navbar_entrylevel int(2) DEFAULT '0' NOT NULL,
	navbar_levels int(2) DEFAULT '0' NOT NULL,
	navbar_excludeuiduist varchar(255) DEFAULT '' NOT NULL,
	navbar_includespacer tinyint(1) unsigned DEFAULT '0' NOT NULL,
	navbar_justify tinyint(1) unsigned DEFAULT '0' NOT NULL,
	navbar_sectionmenu tinyint(1) unsigned DEFAULT '0' NOT NULL,
	navbar_megamenu tinyint(1) unsigned DEFAULT '0' NOT NULL,
	navbar_hover tinyint(1) unsigned DEFAULT '0' NOT NULL,
	navbar_brand varchar(7) DEFAULT '' NOT NULL,
	navbar_image varchar(255) DEFAULT '' NOT NULL,
	navbar_color varchar(9) DEFAULT '' NOT NULL,
	navbar_background varchar(255) DEFAULT '' NOT NULL,
	navbar_container varchar(12) DEFAULT '' NOT NULL,
	navbar_placement varchar(12) DEFAULT '' NOT NULL,
	navbar_class varchar(255) DEFAULT '' NOT NULL,
	navbar_toggler varchar(20) DEFAULT '' NOT NULL,
	navbar_breakpoint varchar(2) DEFAULT '' NOT NULL,
	navbar_height int(2) DEFAULT '0' NOT NULL,
	navbar_searchbox varchar(6) DEFAULT '' NOT NULL,
	navbar_lang_uid varchar(6) DEFAULT '' NOT NULL,
	navbar_lang_hreflang varchar(50) DEFAULT '' NOT NULL,
	navbar_lang_title varchar(100) DEFAULT '' NOT NULL,
	jumbotron_enable tinyint(1) unsigned DEFAULT '0' NOT NULL,
	jumbotron_bgimage varchar(255) DEFAULT '' NOT NULL,
	jumbotron_fluid tinyint(1) unsigned DEFAULT '0' NOT NULL,
	jumbotron_position varchar(8) DEFAULT '' NOT NULL,
	jumbotron_container varchar(15) DEFAULT '' NOT NULL,
	jumbotron_containerposition varchar(7) DEFAULT '' NOT NULL,
	jumbotron_class varchar(255) DEFAULT '' NOT NULL,
	breadcrumb_enable tinyint(1) unsigned DEFAULT '0' NOT NULL,
	breadcrumb_corner tinyint(1) unsigned DEFAULT '0' NOT NULL,
	breadcrumb_position varchar(8) DEFAULT '' NOT NULL,
	breadcrumb_container varchar(15) DEFAULT '' NOT NULL,
	breadcrumb_containerposition varchar(7) DEFAULT '' NOT NULL,
	breadcrumb_class varchar(255) DEFAULT '' NOT NULL,
	sidebar_enable varchar(7) DEFAULT '' NOT NULL,
	sidebar_rightenable varchar(7) DEFAULT '' NOT NULL,
	sidebar_levels int(2) DEFAULT '0' NOT NULL,
	sidebar_excludeuiduist varchar(255) DEFAULT '' NOT NULL,
	sidebar_includespacer tinyint(1) unsigned DEFAULT '0' NOT NULL,
	footer_enable tinyint(1) unsigned DEFAULT '0' NOT NULL,
	footer_fluid tinyint(1) unsigned DEFAULT '0' NOT NULL,
	footer_sticky tinyint(1) unsigned DEFAULT '0' NOT NULL,
	footer_container varchar(15) DEFAULT '' NOT NULL,
	footer_containerposition varchar(7) DEFAULT '' NOT NULL,
	footer_class varchar(255) DEFAULT '' NOT NULL,
	footer_pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),

);

#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
	tx_t3sbootstrap_header_display varchar(9) DEFAULT '' NOT NULL,
	tx_t3sbootstrap_header_class varchar(100) DEFAULT '' NOT NULL,
	tx_t3sbootstrap_padding_sides varchar(5) DEFAULT '' NOT NULL,
	tx_t3sbootstrap_padding_size varchar(1) DEFAULT '' NOT NULL,
	tx_t3sbootstrap_margin_sides varchar(5) DEFAULT '' NOT NULL,
	tx_t3sbootstrap_margin_size varchar(1) DEFAULT '' NOT NULL,
	tx_t3sbootstrap_flexbox_columns varchar(5) DEFAULT '' NOT NULL,
	tx_t3sbootstrap_flexbox_prefix varchar(3) DEFAULT '' NOT NULL,
	tx_t3sbootstrap_container varchar(255) DEFAULT '' NOT NULL,
	tx_t3sbootstrap_extra_class varchar(100) DEFAULT '' NOT NULL,
	tx_t3sbootstrap_bgcolor varchar(30) DEFAULT '' NOT NULL,
	tx_t3sbootstrap_contextcolor varchar(9) DEFAULT '' NOT NULL,
	tx_t3sbootstrap_textcolor varchar(7) DEFAULT '' NOT NULL,
	tx_t3sbootstrap_flexform mediumtext,
);

#
# Table structure for table 'sys_file_reference'
#
CREATE TABLE sys_file_reference (
	tx_t3sbootstrap_extra_class varchar(100) DEFAULT '' NOT NULL,
);

#
# Table structure for table 'pages'
#
CREATE TABLE pages (
	tx_t3sbootstrap_container varchar(255) DEFAULT '' NOT NULL,
	tx_t3sbootstrap_linkToTop tinyint(4) DEFAULT '0' NOT NULL,
	tx_t3sbootstrap_smallColumns varchar(1) DEFAULT '' NOT NULL,
);





