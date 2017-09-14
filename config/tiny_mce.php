<?php
/**
 * File to customize yor initial options for TinyMCE
 */

return [
    'TinyMCE' => [
        'loadScript' => true,
        'scriptBlock' => 'script',
        'js' => '//cdn.tinymce.com/4/tinymce.min.js',
        'editorOptions' => [
            'language_url' => '/tiny_m_c_e/js/i18n/es.js',
            'theme' => 'modern',
            'plugins' => 'advlist autolink lists link image charmap print preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table contextmenu directionality template paste textcolor colorpicker textpattern imagetools codesample toc help emoticons hr',
            'width' => 'auto',
            'height' => 200,
            'toolbar' => 'formatselect | bold italic  strikethrough  forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | codesample |',
            'image_advtab' => true,
        ],

    ]
];
