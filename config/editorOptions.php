<?php
/**
 * File to customize yor initial options for TinyMCE
 */

return [
    'TinyMCE' => [
        'Initial' => [
            'theme' => 'modern',
            'plugins' => 'advlist autolink lists link image charmap print preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table contextmenu directionality template paste textcolor colorpicker textpattern imagetools codesample toc help emoticons hr',
            'width' => 800,
            'height' => 300,
            'toolbar' => 'formatselect | bold italic  strikethrough  forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | codesample |',
            'image_advtab' => true,
        ],
        'Assets' => [
            'loadScript' => true,
            'js' => '//cdn.tinymce.com/4/tinymce.min.js',
        ]
    ]
];