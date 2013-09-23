/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
    config.skin = 'v2';
    config.toolbar = 'Full'; //функциональность редактора, Basic-минимум, Full-максимум
    config.toolbar_Full =
    [
    {
        name: 'document',    
        items : [ 'Source'/*,'-','Save','NewPage','DocProps','Preview','Print','-','Templates' */]
    },
    {
        name: 'clipboard',   
        items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ]
    },
    {
        name: 'editing',     
        items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ]
    },
    /*{
        name: 'forms',       
        items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ]
    },*/
    {
        name: 'basicstyles', 
        items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ]
    },
    {
        name: 'paragraph',   
        items : [ 'NumberedList','BulletedList','-',/*'Outdent','Indent','-',*/'Blockquote',/*'CreateDiv',*/'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'/*,'-','BidiLtr','BidiRtl' */]
    },
    {
        name: 'links',       
        items : [ 'Link','Unlink','Anchor' ]
    },
    {
        name: 'insert',      
        items : [ 'Image','Flash','Table'/*,'HorizontalRule','Smiley','SpecialChar','PageBreak'*/ ]
    },
    {
        name: 'styles',      
        items : [ 'Styles','Format','Font','FontSize', 'Youtube' ]
    },
    /*{ name: 'colors',      items : [ 'TextColor','BGColor' ] },*/
    /*{ name: 'tools',       items : [ 'Maximize', 'ShowBlocks','-','About' ] }*/
    ];
    config.width = '100%'; //ширина окна редактора
    config.filebrowserBrowseUrl = '/packages/ckfinder/ckfinder.html';
    config.filebrowserImageBrowseUrl = '/packages/ckfinder/ckfinder.html?type=Images';
    config.filebrowserFlashBrowseUrl = '/packages/ckfinder/ckfinder.html?type=Flash';
    config.filebrowserUploadUrl = '/packages/ckfinder/core/connector/java/connector.java?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = '/packages/ckfinder/core/connector/java/connector.java?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl = '/packages/ckfinder/core/connector/java/connector.java?command=QuickUpload&type=Flash';
    
    config.contentsCss = '/css/main.css';
};
