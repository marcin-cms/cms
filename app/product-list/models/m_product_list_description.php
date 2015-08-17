<?php
	
	class Product_list_description {
		
		private $content_types = array('wysiwyg','textarea','oneline');
		private $SK;
		
		function Product_list_description(){
			global $SK;
			$this->SK =& $SK;
		}
		
		function clean_block_id($id){
			$id = str_replace(' ', '_', $id);
			$id = str_replace('-', '_', $id);
			$id = preg_replace("/[^a-zA-Z0-9_]/",'',$id);
			return strtolower($id);
		}
		function display_block($id, $type = 'wysiwyg'){
			$id = $this->clean_block_id($id);
			$type = strtolower(htmlentities($type, ENT_QUOTES));
			if(in_array($type, $this->content_types) == FALSE){
				echo "<script>alert('Nieprawidłowy typ zawartości')</script>";
				return;
			}
			$content = $this->load_block($id);
			if($this->SK->Auth->checkLoginStatus()){
				$edit_start = '<div class="sk_edit">';
				$edit_type = '<a class="sk_edit_type label label-inverse" href="'. SITE_PATH.'app/product-list/edit_description.php?id='.$id.'&type='.
				$type. '">'.$type . '</a>';
				$edit_link = '<a class="sk_edit_link" href="'.SITE_PATH. 'app/product-list/edit_description.php?id='.$id.'&type='.
				$type . '">Edytuj blok</a>';
				$edit_end = '</div>';
				
				echo $edit_start . $edit_type;
				echo $edit_link. $content . $edit_end;
			} else {
				echo $content;
			}
		
		
		}
		
		function generate_field($type, $content){
			if($type == 'wysiwyg'){
				return '<textarea name="field" id="field" class="wysiwyg">'.$content. '</textarea>';
			} else if ($type == 'textarea') {
				return '<textarea name="field" id="field" class="textarea">'.$content. '</textarea>';
			} else if ($type == 'oneline') {
				return '<input name="field" id="field" class="oneline" value="'.$content.'">';
			} else {
				$error = '<p>Użyj właściwego typu treści</p>';
				return $error;
			}
		}
		
		function load_block($id){
			if($stmt = $this->SK->Database->prepare("SELECT description From products WHERE id = ?")){
				$stmt->bind_param('s',$id);
				$stmt->execute();
				$stmt->store_result();
				
				if($stmt->num_rows != FALSE){
					$stmt->bind_result($content);
					$stmt->fetch();
					$stmt->close();
					return $content;
				} else {
					$stmt->close();
					return FALSE;
				}
			}
			
		}
		
		
		function update_block($id,$content){
				if($stmt = $this->SK->Database->prepare("UPDATE products SET description = ? WHERE id = ?")){
				$stmt->bind_param('ss',$content, $id);
				$stmt->execute();
				$stmt->close();
			
			}
		}
		
		
		
		
	
	}

?>