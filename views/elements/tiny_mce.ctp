<?php echo $javascript->link('/tiny_mce/js/tiny_mce'); ?>
<script type="text/javascript">
	tinyMCE.init({
		theme : "advanced",
		relative_urls : false,
		document_base_url : "http://converge.zz/",
		height:"150px",
		width:"100%",
<?php if(isset($field)): ?>
<?php if(is_array($field)): ?>
		elements :"<?php echo implode(",",$$field)?>",
<?php else: ?>
		elements : "<?php echo $field; ?>",
<?php endif; ?>
		mode : "exact",
<?php else: ?>
		mode : "textareas",
<?php endif; ?>
		plugins : "uploadimage,codesnippet",
		theme_advanced_buttons1 : "code,bold,italic,underline,strikethrough,|bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons1_add : "separator,uploadimage,separator,codesnippet",
		theme_advanced_buttons2_add : "separator,uploadimage,separator",
		convert_urls : false
	});
</script>