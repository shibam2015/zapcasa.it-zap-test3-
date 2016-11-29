/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */
var base_url = document.getElementById('global_base_url').value;

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For the complete reference:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons, provided by the standard plugins, which we don't
	// need to have in the Standard(s) toolbar.
	//config.removeButtons = 'Underline,Subscript,Superscript';
	
    config.filebrowserBrowseUrl = base_url + 'assets/ckfinder/ckfinder.html',
	config.filebrowserImageBrowseUrl = base_url + 'assets/ckfinder/ckfinder.html?type=Images',
	config.filebrowserFlashBrowseUrl = base_url + 'assets/ckfinder/ckfinder.html?type=Flash',
	//config.filebrowserUploadUrl = base_url + 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',	config.filebrowserUploadUrl = base_url + 'assets/ckupload.php',
	config.filebrowserImageUploadUrl = base_url + 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	config.filebrowserFlashUploadUrl = base_url + 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
	
	// Se the most common block elements.
	// config.format_tags = 'p;h1;h2;h3;pre;div';
	
	// Allow all contents.
	config.allowedContent = true;
	config.extraAllowedContent = 'div(*)';

	// Make dialogs simpler.
	config.removeDialogTabs = 'image:advanced;link:advanced';
};

