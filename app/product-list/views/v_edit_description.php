<script>
	
	$(document).ready(function(){
		
		$('#edit').submit(function(e){
			e.preventDefault();
			
			var id = "<?php echo $this->getData('block_id'); ?>";
			var type = $('#type').val();
			<?php if($this->getData('block_type') == 'wysiwyg') { ?>
				
				tinyMCE.triggerSave();
			
			<?php } ?>
			var content = $('#field').val();
			
			var dataString = 'id=' + id + '&field=' + content + '&type=' + type;
			
			$.ajax({
				type: "POST",
				url: "http://marcinwitek.com/cms/app/product-list/edit_description.php",
				data: dataString,
				cache: false,
				success: function(html){
					$('#cboxLoadedContent').html(html);
				}
			});
		});
		
		$('#sk_cancel').live('click', function(e){
			if(tinyMCE.getInstanceById('field')){
				tinyMCE.execCommand('mceFocus',false,'field');
				tinyMCE.execCommand('mceRemoveControl',false,'field');
			}
			e.preventDefault();
			$.colorbox.close();
			
		});
		
	});
	
</script>

<?php if($this->getData('block_type') == 'wysiwyg'){ ?>

<script type="text/javascript">
tinyMCE.init({
        // General options
        mode : "none",
        theme : "advanced",
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
        width: "800px",
        height: "300px",

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Example content CSS (should be your site CSS)
        content_css : "css/example.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
});

setTimeout(function() {tinyMCE.execCommand('mceAddControl',false,'field');},0)
</script>


<?php } ?>
<div class="form-wrapper">
	
	<form action="" method="post" id="edit" class="well">
		<legend>Id w bazie danych: <i><?php echo $this->getData('block_id') ?></i></legend>
		<?php echo $this->getData('cms_field') ?>
		<input type="hidden" id="type" value="<?php echo $this->getData('block_id') ?>" />
		<hr />
		<input type="submit" name="submit" class="btn btn-primary" value="Wyślij" />
		<a href="#" id="sk_cancel" class="btn">Wróć</a>
	</form>
</div>