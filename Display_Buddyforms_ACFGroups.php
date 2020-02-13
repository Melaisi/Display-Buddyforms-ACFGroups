<?php
/**
 * Plugin Name: Display Buddyforms ACFGroups
 */


add_filter( 'the_content', 'filter_the_content_in_the_main_loop' );

/* function v1 ; 
 * This function should call three other functions, 
 * The first is confirm_location_of_display() 
 * The second is get_the_forms_data()
 * The third one is display_form_data_in_post_manually()
 * The fourth one is display_form_data_in_post_automatically()
 * This function should return an empty content at the end. 
 */

function confirm_location_of_display($location){
	switch($location){
		case 'single-post':
			if(is_home() || is_page() || is_front_page()) {
				return false;
			}
			// Check if we're inside the main loop in a single post page.
    		if ( is_single() && in_the_loop() && is_main_query() ) {
				return true;
				
			}
			break;
		default:
			return false;
	
	}
}

function get_the_forms_data(){
	//get all the post meta 
	$MiM_post_meta_array = get_post_custom();
	
	//check if form exist
	if(!isset($MiM_post_meta_array['_bf_form_slug'])) {
  	
			return false;
	}
	//check if form is set 
	if($MiM_post_meta_array['_bf_form_slug'][0] === "none"){
			return false;
	}
		//return the post_meta_array 
	
		//Now that we know there is a buddy form we need to display each buddyform field
		//To do so all the fields and there values are assigned to an array called display_field_array
		// $display_field_array[field_label]=value;
		$display_field_array = array();
		// we get the buddyforms field using there Field Slug from the form 
		
		// we need to check if the field isset 
		// isset($MiM_post_meta_array[field_slug])
		// 
		// ================================================================
		// =============== Add meta keys and fields here  =================
		// ==== for each fields repeat the same few lines of code code ====
		// ================================================================
	
	// ________________________________________________________________________________________________________
	// 
	// ===================================== For ACF Fields =============================================================		
	// in case it is an acf field, you need to make sure the value of the field is not 0 because it is the default value 
	//
	// __________________________________________________________________________________________________________________
		if(isset($MiM_post_meta_array['تاريخ_الإجراء'])){
			// because this is an acf we need to make sure the value is not an empty string ''  
			if ($MiM_post_meta_array['تاريخ_الإجراء'][0] !== ''){
				//this means the user entered a value for this field so we need to assign it to the display array
			 	//Change date formating 
			 	$formatted_date = date_i18n( get_option( 'date_format' ),strtotime($MiM_post_meta_array['تاريخ_الإجراء'][0]));
				//$display_field_array['تاريخ الإجراء'] = $MiM_post_meta_array['تاريخ_الإجراء'][0];
				$display_field_array['تاريخ الإجراء'] = $formatted_date;
			}
		}
	// __________________________________________________________________________________________________________________
		if(isset($MiM_post_meta_array['تاريخ_عمل_الإجراء'])){
			// because this is an acf we need to make sure the value is not an empty string ''  
			if ($MiM_post_meta_array['تاريخ_عمل_الإجراء'][0] !== ''){
				//this means the user entered a value for this field so we need to assign it to the display array
			 	//Change date formating 
			 	$formatted_date = date_i18n( get_option( 'date_format' ),strtotime($MiM_post_meta_array['تاريخ_عمل_الإجراء'][0]));
				//$display_field_array['تاريخ الإجراء'] = $MiM_post_meta_array['تاريخ_الإجراء'][0];
				$display_field_array['تاريخ عمل الإجراء'] = $formatted_date;
			}
		}
	// ____________________________________________________________________________________________________________________	
	//	
	//
	//	
	// ____________________________________________________________________________________________________________________	
		
		if(isset($MiM_post_meta_array['تكلفة_الإجراء'])){
			// because this is an acf we need to make sure the value is not an empty string ''
			if ($MiM_post_meta_array['تكلفة_الإجراء'][0] !== ''){
				//this means the user entered a value for this field so we need to assign it to the display array
			 	$display_field_array['تكلفة الإجراء'] = $MiM_post_meta_array['تكلفة_الإجراء'][0];
			}
		}
	// ____________________________________________________________________________________________________________________	
	//	
	//
	//	
	// ____________________________________________________________________________________________________________________	
		
		if(isset($MiM_post_meta_array['صور_ماقبل_الإجراء'])){
			// because this is an acf we need to make sure the value is not an empty string ''
			if ($MiM_post_meta_array['صور_ماقبل_الإجراء'][0] !== ''){
				//this means the user entered a value for this field so we need to assign it to the display array
			 	//$display_field_array['تكلفة الإجراء'] = $MiM_post_meta_array['تكلفة_الإجراء'][0];
			 	//This is an image and I am not sure how it is saved in the database 
			}
		}
	// ____________________________________________________________________________________________________________________	
	//	
	//
	//	
	// ____________________________________________________________________________________________________________________	
		
		if(isset($MiM_post_meta_array['تقييم_الإجراء'])){
			// because this is an acf we need to make sure the value is not an empty string ''
			if ($MiM_post_meta_array['تقييم_الإجراء'][0] !== ''){
				//this means the user entered a value for this field so we need to assign it to the display array
			 	$display_field_array['تقييم الإجراء'] = $MiM_post_meta_array['تقييم_الإجراء'][0];
			 	 
			}
		}
	// ____________________________________________________________________________________________________________________	
	//	
	//
	//	
	// ____________________________________________________________________________________________________________________	
		
		if(isset($MiM_post_meta_array['تقييم_الطبيب'])){
			// because this is an acf we need to make sure the value is not an empty string ''
			if ($MiM_post_meta_array['تقييم_الطبيب'][0] !== ''){
				//this means the user entered a value for this field so we need to assign it to the display array
			 	$display_field_array['تقييم الطبيب'] = $MiM_post_meta_array['تقييم_الطبيب'][0];
			 	 
			}
		}
	// ____________________________________________________________________________________________________________________	
		
		if(isset($MiM_post_meta_array['اسم_القائم_بعمل_الإجراء'])){
			// because this is an acf we need to make sure the value is not an empty string ''
			if ($MiM_post_meta_array['اسم_القائم_بعمل_الإجراء'][0] !== ''){
				//this means the user entered a value for this field so we need to assign it to the display array
			 	$display_field_array['اسم القائم بعمل الإجراء'] = $MiM_post_meta_array['اسم_القائم_بعمل_الإجراء'][0];
			 	 
			}
		}
	// ____________________________________________________________________________________________________________________	
	//	
	//
	//	
	// ____________________________________________________________________________________________________________________	
		
		if(isset($MiM_post_meta_array['تقييم_تعاون_طاقم_العمل'])){
			// because this is an acf we need to make sure the value is not an empty string ''
			if ($MiM_post_meta_array['تقييم_تعاون_طاقم_العمل'][0] !== ''){
				//this means the user entered a value for this field so we need to assign it to the display array
			 	$display_field_array['تقييم تعاون_طاقم العمل'] = $MiM_post_meta_array['تقييم_تعاون_طاقم_العمل'][0];
			 	
			}
		}
	// ____________________________________________________________________________________________________________________	
	//	
	//
	//	
	// ____________________________________________________________________________________________________________________	
		
		if(isset($MiM_post_meta_array['تقييم_النظافة_والتعقيم'])){
			// because this is an acf we need to make sure the value is not an empty string ''
			if ($MiM_post_meta_array['تقييم_النظافة_والتعقيم'][0] !== ''){
				//this means the user entered a value for this field so we need to assign it to the display array
			 	$display_field_array['تقييم النظافة والتعقيم'] = $MiM_post_meta_array['تقييم_النظافة_والتعقيم'][0];
			 	
			}
		}
		
	// ________________________________________________________________________________________________________ 		
		/*if(isset($MiM_post_meta_array['صور_ماقبل_الإجراء'])){
			//this mean the user entered a value for this field so we need to assign it to the display array
			// 
			//$display_field_array['صورة مابعد الاجراء'] = $MiM_post_meta_array['featured_image'][0];
			//This is an image and I am not sure how it is saved in the database
			$display_field_array['صورة ما قبل الاجراء'] = wp_get_attachment_image( $MiM_post_meta_array['صور_ماقبل_الإجراء'][0]);
		}*/
		if(isset($MiM_post_meta_array['صور_ماقبل_الإجراء'])){
			$image_url = wp_get_attachment_image_src($MiM_post_meta_array['صور_ماقبل_الإجراء'][0], 'full');
			$html_img_tag = wp_get_attachment_image( $MiM_post_meta_array['صور_ماقبل_الإجراء'][0]);
			$html_a_tag = '<a href="'.$image_url[0].'">'.$html_img_tag.'</a>';
			
			$display_field_array['صورة ما قبل الاجراء'] =$html_a_tag;
		}
	
	
		/*if(isset($MiM_post_meta_array['صورة_اضافية'])){
			$display_field_array['صورة اضافية'] = wp_get_attachment_image( $MiM_post_meta_array['صورة_اضافية'][0]);
		}*/
		if(isset($MiM_post_meta_array['صورة_اضافية'])){
			$image_url = wp_get_attachment_image_src($MiM_post_meta_array['صورة_اضافية'][0], 'full');
			$html_img_tag = wp_get_attachment_image( $MiM_post_meta_array['صورة_اضافية'][0]);
			$html_a_tag = '<a href="'.$image_url[0].'">'.$html_img_tag.'</a>';
			
			$display_field_array['صورة اضافية'] =$html_a_tag;
		}
		
	
	    /*if(isset($MiM_post_meta_array['صورة_اضافية_ثانية'])){
			$display_field_array['صورة اضافية ثانية'] = wp_get_attachment_image( $MiM_post_meta_array['صورة_اضافية_ثانية'][0]);
		}*/
		if(isset($MiM_post_meta_array['صورة_اضافية_ثانية'])){
			$image_url = wp_get_attachment_image_src($MiM_post_meta_array['صورة_اضافية_ثانية'][0], 'full');
			$html_img_tag = wp_get_attachment_image( $MiM_post_meta_array['صورة_اضافية_ثانية'][0]);
			$html_a_tag = '<a href="'.$image_url[0].'">'.$html_img_tag.'</a>';
			
			$display_field_array['صورة اضافية ثانية'] =$html_a_tag;
		}
	
     	/*if(isset($MiM_post_meta_array['صورة_اضافية_ثالثة'])){
			$display_field_array['صورة اضافية ثالثة'] = wp_get_attachment_image( $MiM_post_meta_array['صورة_اضافية_ثالثة'][0]);
		}*/
		
		if(isset($MiM_post_meta_array['صورة_اضافية_ثالثة'])){
			$image_url = wp_get_attachment_image_src($MiM_post_meta_array['صورة_اضافية_ثالثة'][0], 'full');
			$html_img_tag = wp_get_attachment_image( $MiM_post_meta_array['صورة_اضافية_ثالثة'][0]);
			$html_a_tag = '<a href="'.$image_url[0].'">'.$html_img_tag.'</a>';
			
			$display_field_array['صورة اضافية ثالثة'] =$html_a_tag;
		}
	
	    /*if(isset($MiM_post_meta_array['صورة_اضافية_رابعة'])){
			$display_field_array['صورة اضافية رابعة'] = wp_get_attachment_image( $MiM_post_meta_array['صورة_اضافية_رابعة'][0]);
		}*/
		
		if(isset($MiM_post_meta_array['صورة_اضافية_رابعة'])){
			$image_url = wp_get_attachment_image_src($MiM_post_meta_array['صورة_اضافية_رابعة'][0], 'full');
			$html_img_tag = wp_get_attachment_image( $MiM_post_meta_array['صورة_اضافية_رابعة'][0]);
			$html_a_tag = '<a href="'.$image_url[0].'">'.$html_img_tag.'</a>';
			
			$display_field_array['صورة اضافية رابعة'] =$html_a_tag;
		}
	

	
		
	// ===================================== For BuddyForms Fields =============================================================	
	//  _______________________________________________________________________________________________________
		if(isset($MiM_post_meta_array['buddyforms_form_title'])){                                   
			//this mean the user entered a value for this field so we need to assign it to the display array
			//echo $MiM_post_meta_array['buddyforms_form_title'][0];
			//$display_field_array['عنوان الموضوع'] = $MiM_post_meta_array['buddyforms_form_title'][0];
			
		}
	// ________________________________________________________________________________________________________
	// 
	// 
	// 
	// 
	// 
	// 
	// ________________________________________________________________________________________________________ 		
		if(isset($MiM_post_meta_array['buddyforms_form_content'])){
			//this mean the user entered a value for this field so we need to assign it to the display array
			// 
			$display_field_array['كيف كانت التجربة؟'] = $MiM_post_meta_array['buddyforms_form_content'][0];
		}
	// ________________________________________________________________________________________________________
	// 
	// 
	// 
	// 
	// ________________________________________________________________________________________________________ 		
		if(isset($MiM_post_meta_array['categories'])){
			//this mean the user entered a value for this field so we need to assign it to the display array
			// 
			//$display_field_array['نوع الإجراء'] = $MiM_post_meta_array['categories'][0];
			// Attempt to display the categories: 
			$display_field_array['نوع الإجراء']= get_the_category_list(',','');
		}
	// ________________________________________________________________________________________________________
	// 
	// 
	// 
	// 
	// ________________________________________________________________________________________________________ 		
		if(isset($MiM_post_meta_array['tags'])){
			//this mean the user entered a value for this field so we need to assign it to the display array
			// 
			$display_field_array['الدولة'] = $MiM_post_meta_array['tags'][0];
		}
	// ________________________________________________________________________________________________________
	// 
	// 
	// 
	// 
	// ________________________________________________________________________________________________________ 		
		/*if(isset($MiM_post_meta_array['featured_image'])){
			//this mean the user entered a value for this field so we need to assign it to the display array
			// 
			//$display_field_array['صورة مابعد الاجراء'] = $MiM_post_meta_array['featured_image'][0];
			//This is an image and I am not sure how it is saved in the database
			$display_field_array['صورة مابعد الاجراء'] = wp_get_attachment_image( $MiM_post_meta_array['featured_image'][0]);
		}*/
	
		if(isset($MiM_post_meta_array['featured_image'])){
			$image_url = wp_get_attachment_image_src($MiM_post_meta_array['featured_image'][0], 'full');
			$html_img_tag = wp_get_attachment_image( $MiM_post_meta_array['featured_image'][0]);
			$html_a_tag = '<a href="'.$image_url[0].'">'.$html_img_tag.'</a>';
			
			$display_field_array['صورة مابعد الاجراء'] =$html_a_tag;
		}
	
	// ________________________________________________________________________________________________________ 		
		if(isset($MiM_post_meta_array['tags'])){
			//this mean the user entered a value for this field so we need to assign it to the display array
			// 
			$display_field_array['الدولة'] = $MiM_post_meta_array['tags'][0];
		}
	// _____________
	// 
		if(isset($MiM_post_meta_array['country'])){
			//this mean the user entered a value for this field so we need to assign it to the display array
			// 
			$display_field_array['الدولة'] = getcountry_code($MiM_post_meta_array['country'][0]);
		}
		
	return $display_field_array;
}

function display_form_data_in_post_automatically($display_field_array){
	if(empty($display_field_array)){
			//the form is empty 
			return false;
		}
		
		//Now we need to display all the fields in a table 
		?>
		
		<table rules="all" style="border-color: #666;" cellpadding="10">
		<?php
		$row = 1;
		foreach ($display_field_array as $label => $field_value){
			if ($row %2 === 0){
				echo "<tr style='background: #eee;'>";
			}
			else{
				echo "<tr >";
			}
		?>
		
			
				<td><?php echo $label; ?></td>
				<td><?php echo $field_value; ?></td>
			</tr>
		<?php 
			$row++;
		} ?>
		
		</table>
		
		<?php 
}

function display_form_data_in_post_manually($display_field_array){
		if(empty($display_field_array)){
			//the form is empty 
			return false;
		}
		
		
		?>
		
<table class="tajtable">
			<?php if (isset($display_field_array['نوع الإجراء'])) { ?>
			<tr>
				<td><p>نوع الاجراء</p></td>
				<td><?php echo $display_field_array['نوع الإجراء']; ?></td>
			</tr>
			<?php } ?>
	
			<?php if (isset($display_field_array['تكلفة الإجراء'])) { ?>
			<tr>
				<td><p>تكلفة الاجراء</p></td>
				<td><?php echo $display_field_array['تكلفة الإجراء']; ?></td>
			</tr>
			<?php } ?>
			
			<?php if (isset($display_field_array['تاريخ عمل الإجراء'])) { ?>
			<tr>
				<td><p>تاريخ عمل الاجراء</p></td>
				<td><?php echo $display_field_array['تاريخ عمل الإجراء']; ?></td>
			</tr>
			<?php } ?>		
	
			<?php if (isset($display_field_array['الدولة'])) {
					if ($display_field_array['الدولة'] != ""){
			?>
			<tr>
				<td><p>الدولة</p></td>
				<td><?php echo $display_field_array['الدولة']; ?></td>
			</tr>
			<?php 	} 
				} 
			?>
			
			<?php if (isset($display_field_array['اسم القائم بعمل الإجراء'])) { ?>
			<tr>
				<td><p>اسم القائم بعمل الاجراء</p></td>
				<td><?php echo $display_field_array['اسم القائم بعمل الإجراء']; ?></td>
			</tr>
			<?php } ?>
	
			<?php if (isset($display_field_array['تقييم الإجراء'])) { ?>
			<tr >
				<td><p>تقييم الاجراء</p></td>
				<td><?php echo $display_field_array['تقييم الإجراء']; ?></td>
			</tr>
			<?php } ?>
	
			<?php if (isset($display_field_array['تقييم الطبيب'])) { ?>
			<tr>
				<td ><p>تقييم الطبيب أو القائم بالعمل</p></td>
				<td><?php echo $display_field_array['تقييم الطبيب']; ?></td>
			</tr>
			<?php } ?>
	
			<?php if (isset($display_field_array['تقييم تعاون_طاقم العمل'])) { ?>
			<tr >
				<td><p>تقييم تعاون طاقم العمل</p></td>
				<td><?php echo $display_field_array['تقييم تعاون_طاقم العمل']; ?></td>
			</tr>
			<?php } ?>
			
			<?php if (isset($display_field_array['تقييم النظافة والتعقيم'])) { ?>
			<tr>
				<td><p>تقييم النظافة والتعقيم</p></td>
				<td><?php echo $display_field_array['تقييم النظافة والتعقيم']; ?></td>
			</tr>
			<?php } ?>
			
		
			<?php 
				if(	isset($display_field_array['صورة مابعد الاجراء']) || 
				  	isset($display_field_array['صورة اضافية']) || 
				  	isset($display_field_array['صورة اضافية ثانية']) || 
				  	isset($display_field_array['صورة اضافية ثالثة']) || 
				  	isset($display_field_array['صورة اضافية رابعة']) ){ ?>
			<tr>
				<td class="tajimage">
<?php if(isset($display_field_array['صورة مابعد الاجراء'])) { if ($display_field_array['صورة مابعد الاجراء'] != ""){ echo $display_field_array['صورة مابعد الاجراء']; } } ?>
					
<?php if(isset($display_field_array['صورة اضافية'])) { if ($display_field_array['صورة اضافية'] != ""){ echo $display_field_array['صورة اضافية']; }}?>
					
<?php if(isset($display_field_array['صورة اضافية ثانية'])) { if ($display_field_array['صورة اضافية ثانية']!= ""){ echo $display_field_array['صورة اضافية ثانية']; }} ?>
					
<?php if(isset($display_field_array['صورة اضافية ثالثة'])) { if ($display_field_array['صورة اضافية ثالثة'] != ""){ echo $display_field_array['صورة اضافية ثالثة']; }} ?>
					
<?php if(isset($display_field_array['صورة اضافية رابعة'])) { if ($display_field_array['صورة اضافية رابعة'] != ""){ echo $display_field_array['صورة اضافية رابعة']; }} ?>
				</td>
			</tr>
			<?php } ?>
	
		</table>
		
		
		<?php 
		
}
function filter_the_content_in_the_main_loop ($content){
	if(!confirm_location_of_display('single-post')){
		return $content;
	}
	$display_field_array = get_the_forms_data();
	if(!$display_field_array){
		return $content;
	}
	
	/*if(!display_form_data_in_post_automatically($display_field_array)){
		return $content;
	}*/
	
	if(!display_form_data_in_post_manually($display_field_array)){
		return $content;
	}
	get_post()->post_content = "";
	return $content="";
}

/* function v0 ; this function display un-order! (Automatic -using foreach- display ) data
 
function filter_the_content_in_the_main_loop( $content ) {
 	
	if(is_home() || is_page() || is_front_page()) {
		
		//echo "<h>This is home<h>";
		return $content;
	}
	if(is_front_page()){
		//echo "<h>This is front page <h>";
		return $content;
	}
    // Check if we're inside the main loop in a single post page.
    if ( is_single() && in_the_loop() && is_main_query() ) {
        
		//get all the post meta 
		$MiM_post_meta_array = get_post_custom();
		
		//Debug code to Display all the post meta 
		
		foreach($MiM_post_meta_array as $key => $value) {
     		//echo $key.': '.$value[0].'<br />';
		}
		
		
		// check if there is a buddy form in the post meta. 
		// (https://wordpress.stackexchange.com/questions/114055/how-to-display-value-of-custom-fields-in-page)
		// When a buddyform is attached, a post meta with a key called _bf_form_slug is set to the form title 
		// We check if the form exist using the isset php function and we check the value in the $MiM_post_meta_array
		// If it is not set that's means there is not form and thus we can exit the function by returning. 
		// And if it is set, we need to check its value, if the form is not filled the value should be "none" meaning no form 
		if(!isset($MiM_post_meta_array['_bf_form_slug'])) {
    		// this a debug echo 
				//echo "There is no buddyform.";
			
			return $content;
		}
		
		if($MiM_post_meta_array['_bf_form_slug'][0] === "none"){
			
			
			// this a debug echo 
			//echo "The buddyform is not filled.";
			//the form is not filled. we need to return the content
			return $content;
		}
		
		// this a debug echo 
		//echo "There is a form.";
		
		//Now that we know there is a buddy form we need to display each buddyform field
		//To do so all the fields and there values are assigned to an array called display_field_array
		// $display_field_array[field_label]=value;
		$display_field_array = array();
		// we get the buddyforms field using there Field Slug from the form 
		
		// we need to check if the field isset 
		// isset($MiM_post_meta_array[field_slug])
		// 
		// ================================================================
		// =============== Add meta keys and fields here  =================
		// ==== for each fields repeat the same few lines of code code ====
		// ================================================================
	
	// ________________________________________________________________________________________________________
	// 
	// ===================================== For ACF Fields =============================================================		
	// in case it is an acf field, you need to make sure the value of the field is not 0 because it is the default value 
	//
	// __________________________________________________________________________________________________________________
		if(isset($MiM_post_meta_array['تاريخ_الإجراء'])){
			// because this is an acf we need to make sure the value is not an empty string ''  
			if ($MiM_post_meta_array['تاريخ_الإجراء'][0] !== ''){
				//this means the user entered a value for this field so we need to assign it to the display array
			 	//Change date formating 
			 	$formatted_date = date_i18n( get_option( 'date_format' ),strtotime($MiM_post_meta_array['تاريخ_الإجراء'][0]));
				//$display_field_array['تاريخ الإجراء'] = $MiM_post_meta_array['تاريخ_الإجراء'][0];
				$display_field_array['تاريخ الإجراء'] = $formatted_date;
			}
		}
	// ____________________________________________________________________________________________________________________	
	//	
	//
	//	
	// ____________________________________________________________________________________________________________________	
		
		if(isset($MiM_post_meta_array['تكلفة_الإجراء'])){
			// because this is an acf we need to make sure the value is not an empty string ''
			if ($MiM_post_meta_array['تكلفة_الإجراء'][0] !== ''){
				//this means the user entered a value for this field so we need to assign it to the display array
			 	$display_field_array['تكلفة الإجراء'] = $MiM_post_meta_array['تكلفة_الإجراء'][0];
			}
		}
	// ____________________________________________________________________________________________________________________	
	//	
	//
	//	
	// ____________________________________________________________________________________________________________________	
		
		if(isset($MiM_post_meta_array['صور_ماقبل_الإجراء'])){
			// because this is an acf we need to make sure the value is not an empty string ''
			if ($MiM_post_meta_array['صور_ماقبل_الإجراء'][0] !== ''){
				//this means the user entered a value for this field so we need to assign it to the display array
			 	//$display_field_array['تكلفة الإجراء'] = $MiM_post_meta_array['تكلفة_الإجراء'][0];
			 	//This is an image and I am not sure how it is saved in the database 
			}
		}
	// ____________________________________________________________________________________________________________________	
	//	
	//
	//	
	// ____________________________________________________________________________________________________________________	
		
		if(isset($MiM_post_meta_array['تقييم_الإجراء'])){
			// because this is an acf we need to make sure the value is not an empty string ''
			if ($MiM_post_meta_array['تقييم_الإجراء'][0] !== ''){
				//this means the user entered a value for this field so we need to assign it to the display array
			 	$display_field_array['تقييم الإجراء'] = $MiM_post_meta_array['تقييم_الإجراء'][0];
			 	 
			}
		}
	// ____________________________________________________________________________________________________________________	
	//	
	//
	//	
	// ____________________________________________________________________________________________________________________	
		
		if(isset($MiM_post_meta_array['تقييم_الطبيب'])){
			// because this is an acf we need to make sure the value is not an empty string ''
			if ($MiM_post_meta_array['تقييم_الطبيب'][0] !== ''){
				//this means the user entered a value for this field so we need to assign it to the display array
			 	$display_field_array['تقييم الطبيب'] = $MiM_post_meta_array['تقييم_الطبيب'][0];
			 	 
			}
		}
	// ____________________________________________________________________________________________________________________	
	//	
	//
	//	
	// ____________________________________________________________________________________________________________________	
		
		if(isset($MiM_post_meta_array['تقييم_تعاون_طاقم_العمل'])){
			// because this is an acf we need to make sure the value is not an empty string ''
			if ($MiM_post_meta_array['تقييم_تعاون_طاقم_العمل'][0] !== ''){
				//this means the user entered a value for this field so we need to assign it to the display array
			 	$display_field_array['تقييم تعاون_طاقم العمل'] = $MiM_post_meta_array['تقييم_تعاون_طاقم_العمل'][0];
			 	
			}
		}
	// ____________________________________________________________________________________________________________________	
	//	
	//
	//	
	// ____________________________________________________________________________________________________________________	
		
		if(isset($MiM_post_meta_array['تقييم_النظافة_والتعقيم'])){
			// because this is an acf we need to make sure the value is not an empty string ''
			if ($MiM_post_meta_array['تقييم_النظافة_والتعقيم'][0] !== ''){
				//this means the user entered a value for this field so we need to assign it to the display array
			 	$display_field_array['تقييم النظافة والتعقيم'] = $MiM_post_meta_array['تقييم_النظافة_والتعقيم'][0];
			 	
			}
		}
		
	// ________________________________________________________________________________________________________ 		
		if(isset($MiM_post_meta_array['صور_ماقبل_الإجراء'])){
			//this mean the user entered a value for this field so we need to assign it to the display array
			// 
			//$display_field_array['صورة مابعد الاجراء'] = $MiM_post_meta_array['featured_image'][0];
			//This is an image and I am not sure how it is saved in the database
			$display_field_array['صورة ما قبل الاجراء'] = wp_get_attachment_image( $MiM_post_meta_array['صور_ماقبل_الإجراء'][0]);
		}
	
		
	// ===================================== For BuddyForms Fields =============================================================	
	//  _______________________________________________________________________________________________________
		if(isset($MiM_post_meta_array['buddyforms_form_title'])){                                   
			//this mean the user entered a value for this field so we need to assign it to the display array
			//echo $MiM_post_meta_array['buddyforms_form_title'][0];
			//$display_field_array['عنوان الموضوع'] = $MiM_post_meta_array['buddyforms_form_title'][0];
			
		}
	// ________________________________________________________________________________________________________
	// 
	// 
	// 
	// 
	// 
	// 
	// ________________________________________________________________________________________________________ 		
		if(isset($MiM_post_meta_array['buddyforms_form_content'])){
			//this mean the user entered a value for this field so we need to assign it to the display array
			// 
			$display_field_array['كيف كانت التجربة؟'] = $MiM_post_meta_array['buddyforms_form_content'][0];
		}
	// ________________________________________________________________________________________________________
	// 
	// 
	// 
	// 
	// ________________________________________________________________________________________________________ 		
		if(isset($MiM_post_meta_array['categories'])){
			//this mean the user entered a value for this field so we need to assign it to the display array
			// 
			//$display_field_array['نوع الإجراء'] = $MiM_post_meta_array['categories'][0];
			// Attempt to display the categories: 
			$display_field_array['نوع الإجراء']= get_the_category_list(',','');
		}
	// ________________________________________________________________________________________________________
	// 
	// 
	// 
	// 
	// ________________________________________________________________________________________________________ 		
		if(isset($MiM_post_meta_array['tags'])){
			//this mean the user entered a value for this field so we need to assign it to the display array
			// 
			$display_field_array['الدولة'] = $MiM_post_meta_array['tags'][0];
		}
	// ________________________________________________________________________________________________________
	// 
	// 
	// 
	// 
	// ________________________________________________________________________________________________________ 		
		if(isset($MiM_post_meta_array['featured_image'])){
			//this mean the user entered a value for this field so we need to assign it to the display array
			// 
			//$display_field_array['صورة مابعد الاجراء'] = $MiM_post_meta_array['featured_image'][0];
			//This is an image and I am not sure how it is saved in the database
			$display_field_array['صورة مابعد الاجراء'] = wp_get_attachment_image( $MiM_post_meta_array['featured_image'][0]);
		}
	
	// ________________________________________________________________________________________________________ 		
		if(isset($MiM_post_meta_array['tags'])){
			//this mean the user entered a value for this field so we need to assign it to the display array
			// 
			$display_field_array['الدولة'] = $MiM_post_meta_array['tags'][0];
		}
	// _____________
	// 
		if(isset($MiM_post_meta_array['country'])){
			//this mean the user entered a value for this field so we need to assign it to the display array
			// 
			$display_field_array['الدولة'] = getcountry_code($MiM_post_meta_array['country'][0]);
		}
	// ========================================== Here we display the table with the information ============================	
		// we need to check if the display array is empty or not
		// if it is empty we return the content and exit the function
		// if it has values then we display them 
		
		if(empty($display_field_array)){
			//the form is empty 
			return $content;
		}
		
		//Now we need to display all the fields in a table 
		?>
		
		<table rules="all" style="border-color: #666;" cellpadding="10">
		<?php
		$row = 1;
		foreach ($display_field_array as $label => $field_value){
			if ($row %2 === 0){
				echo "<tr style='background: #eee;'>";
			}
			else{
				echo "<tr >";
			}
		?>
		
			
				<td><?php echo $label; ?></td>
				<td><?php echo $field_value; ?></td>
			</tr>
		<?php 
			$row++;
		} ?>
		
		</table>
		
		<?php 
		
    }
 
    return $content="";
} */

// This code from: https://phpans.com/get-country-name-from-country-code-in-php/ 
function getcountry_code( $country_code ){
	//Array of countries in Arabic 
	$Ar_countries = [
    "SA" =>'المملكة العربية السعودية',
    "ET" =>'إثيوبيا',
    "AZ" =>'أذربيجان',
    "AM" =>'أرمينيا',
    "AW" =>'أروبا',
    "ER" =>'إريتريا',
    "ES" =>'أسبانيا',
    "AU" =>'أستراليا',
    "EE" =>'إستونيا',
    "AF" =>'أفغانستان',
    "IO" =>'إقليم المحيط الهندي البريطاني',
    "EC" =>'إكوادور',
    "AR" =>'الأرجنتين',
    "JO" =>'الأردن',
    "AE" =>'الإمارات العربية المتحدة',
    "AL" =>'ألبانيا',
    "BR" =>'البرازيل',
    "PT" =>'البرتغال',
    "BA" =>'البوسنة والهرسك',
    "GA" =>'الجابون',
    "DZ" =>'الجزائر',
    "DK" =>'الدانمارك',
    "CV" =>'الرأس الأخضر',
    "PS" =>'السلطة الفلسطينية',
    "SV" =>'السلفادور',
    "SN" =>'السنغال',
    "SD" =>'السودان',
    "SE" =>'السويد',
    "SO" =>'الصومال',
    "CN" =>'الصين',
    "IQ" =>'العراق',
    "PH" =>'الفلبين',
    "CM" =>'الكاميرون',
    "CG" =>'الكونغو',
    "CD" =>'الكونغو (جمهورية الكونغو الديمقراطية)',
    "KW" =>'الكويت',
    "DE" =>'ألمانيا',
    "HU" =>'المجر',
    "MA" =>'المغرب',
    "MX" =>'المكسيك',
    "UK" =>'المملكة المتحدة',
    "TF" =>'المناطق الفرنسية الجنوبية ومناطق انتراكتيكا',
    "NO" =>'النرويج',
    "AT" =>'النمسا',
    "NE" =>'النيجر',
    "IN" =>'الهند',
    "US" =>'الولايات المتحدة',
    "JP" =>'اليابان',
    "YE" =>'اليمن',
    "GR" =>'اليونان',
    "AQ" =>'أنتاركتيكا',
    "AG" =>'أنتيغوا وبربودا',
    "AD" =>'أندورا',
    "ID" =>'إندونيسيا',
    "AO" =>'أنغولا',
    "AI" =>'أنغويلا',
    "UY" =>'أوروجواي',
    "UZ" =>'أوزبكستان',
    "UG" =>'أوغندا',
    "UA" =>'أوكرانيا',
    "IR" =>'إيران',
    "IE" =>'أيرلندا',
    "IS" =>'أيسلندا',
    "IT" =>'إيطاليا',
    "PG" =>'بابوا-غينيا الجديدة',
    "PY" =>'باراجواي',
    "BB" =>'باربادوس',
    "PK" =>'باكستان',
    "PW" =>'بالاو',
    "BM" =>'برمودا',
    "BN" =>'بروناي',
    "BE" =>'بلجيكا',
    "BG" =>'بلغاريا',
    "BD" =>'بنجلاديش',
    "PA" =>'بنما',
    "BJ" =>'بنين',
    "BT" =>'بوتان',
    "BW" =>'بوتسوانا',
    "PR" =>'بورتو ريكو',
    "BF" =>'بوركينا فاسو',
    "BI" =>'بوروندي',
    "PL" =>'بولندا',
    "BO" =>'بوليفيا',
    "PF" =>'بولينزيا الفرنسية',
    "PE" =>'بيرو',
    "BY" =>'بيلاروس',
    "BZ" =>'بيليز',
    "TH" =>'تايلاند',
    "TW" =>'تايوان',
    "TM" =>'تركمانستان',
    "TR" =>'تركيا',
    "TT" =>'ترينيداد وتوباجو',
    "TD" =>'تشاد',
    "CL" =>'تشيلي',
    "TZ" =>'تنزانيا',
    "TG" =>'توجو',
    "TV" =>'توفالو',
    "TK" =>'توكيلاو',
    "TO" =>'تونجا',
    "TN" =>'تونس',
    "TP" =>'تيمور الشرقية (تيمور الشرقية)',
    "JM" =>'جامايكا',
    "GM" =>'جامبيا',
    "GI" =>'جبل طارق',
    "GL" =>'جرينلاند',
    "AN" =>'جزر الأنتيل الهولندية',
    "PN" =>'جزر البتكارين',
    "BS" =>'جزر البهاما',
    "VG" =>'جزر العذراء البريطانية',
    "VI" =>'جزر العذراء، الولايات المتحدة',
    "KM" =>'جزر القمر',
    "CC" =>'جزر الكوكوس (كيلين)',
    "MV" =>'جزر المالديف',
    "TC" =>'جزر تركس وكايكوس',
    "AS" =>'جزر ساموا الأمريكية',
    "SB" =>'جزر سولومون',
    "FO" =>'جزر فايرو',
    "UM" =>'جزر فرعية تابعة للولايات المتحدة',
    "FK" =>'جزر فوكلاند (أيزلاس مالفيناس)',
    "FJ" =>'جزر فيجي',
    "KY" =>'جزر كايمان',
    "CK" =>'جزر كوك',
    "MH" =>'جزر مارشال',
    "MP" =>'جزر ماريانا الشمالية',
    "CX" =>'جزيرة الكريسماس',
    "BV" =>'جزيرة بوفيه',
    "IM" =>'جزيرة مان',
    "NF" =>'جزيرة نورفوك',
    "HM" =>'جزيرة هيرد وجزر ماكدونالد',
    "CF" =>'جمهورية أفريقيا الوسطى',
    "CZ" =>'جمهورية التشيك',
    "DO" =>'جمهورية الدومينيكان',
    "ZA" =>'جنوب أفريقيا',
    "GT" =>'جواتيمالا',
    "GP" =>'جواديلوب',
    "GU" =>'جوام',
    "GE" =>'جورجيا',
    "GS" =>'جورجيا الجنوبية وجزر ساندويتش الجنوبية',
    "GY" =>'جيانا',
    "GF" =>'جيانا الفرنسية',
    "DJ" =>'جيبوتي',
    "JE" =>'جيرسي',
    "GG" =>'جيرنزي',
    "VA" =>'دولة الفاتيكان',
    "DM" =>'دومينيكا',
    "RW" =>'رواندا',
    "RU" =>'روسيا',
    "RO" =>'رومانيا',
    "RE" =>'ريونيون',
    "ZM" =>'زامبيا',
    "ZW" =>'زيمبابوي',
    "WS" =>'ساموا',
    "SM" =>'سان مارينو',
    "PM" =>'سانت بيير وميكولون',
    "VC" =>'سانت فينسنت وجرينادينز',
    "KN" =>'سانت كيتس ونيفيس',
    "LC" =>'سانت لوشيا',
    "SH" =>'سانت هيلينا',
    "ST" =>'ساوتوماي وبرينسيبا',
    "SJ" =>'سفالبارد وجان ماين',
    "SK" =>'سلوفاكيا',
    "SI" =>'سلوفينيا',
    "SG" =>'سنغافورة',
    "SZ" =>'سوازيلاند',
    "SY" =>'سوريا',
    "SR" =>'سورينام',
    "CH" =>'سويسرا',
    "SL" =>'سيراليون',
    "LK" =>'سيريلانكا',
    "SC" =>'سيشل',
    "RS" =>'صربيا',
    "TJ" =>'طاجيكستان',
    "OM" =>'عمان',
    "GH" =>'غانا',
    "GD" =>'غرينادا',
    "GN" =>'غينيا',
    "GQ" =>'غينيا الاستوائية',
    "GW" =>'غينيا بيساو',
    "VU" =>'فانواتو',
    "FR" =>'فرنسا',
    "VE" =>'فنزويلا',
    "FI" =>'فنلندا',
    "VN" =>'فيتنام',
    "CY" =>'قبرص',
    "QA" =>'قطر',
    "KG" =>'قيرقيزستان',
    "KZ" =>'كازاخستان',
    "NC" =>'كاليدونيا الجديدة',
    "KH" =>'كامبوديا',
    "HR" =>'كرواتيا',
    "CA" =>'كندا',
    "CU" =>'كوبا',
    "CI" =>'كوت ديفوار (ساحل العاج)',
    "KR" =>'كوريا',
    "KP" =>'كوريا الشمالية',
    "CR" =>'كوستاريكا',
    "CO" =>'كولومبيا',
    "KI" =>'كيريباتي',
    "KE" =>'كينيا',
    "LV" =>'لاتفيا',
    "LA" =>'لاوس',
    "LB" =>'لبنان',
    "LI" =>'لختنشتاين',
    "LU" =>'لوكسمبورج',
    "LY" =>'ليبيا',
    "LR" =>'ليبيريا',
    "LT" =>'ليتوانيا',
    "LS" =>'ليسوتو',
    "MQ" =>'مارتينيك',
    "MO" =>'ماكاو',
    "FM" =>'ماكرونيزيا',
    "MW" =>'مالاوي',
    "MT" =>'مالطا',
    "ML" =>'مالي',
    "MY" =>'ماليزيا',
    "YT" =>'مايوت',
    "MG" =>'مدغشقر',
    "EG" =>'مصر',
    "MK" =>'مقدونيا، جمهورية يوغوسلافيا السابقة',
    "BH" =>'مملكة البحرين',
    "MN" =>'منغوليا',
    "MR" =>'موريتانيا',
    "MU" =>'موريشيوس',
    "MZ" =>'موزمبيق',
    "MD" =>'مولدوفا',
    "MC" =>'موناكو',
    "MS" =>'مونتسيرات',
    "ME" =>'مونتينيغرو',
    "MM" =>'ميانمار',
    "NA" =>'ناميبيا',
    "NR" =>'ناورو',
    "NP" =>'نيبال',
    "NG" =>'نيجيريا',
    "NI" =>'نيكاراجوا',
    "NU" =>'نيوا',
    "NZ" =>'نيوزيلندا',
    "HT" =>'هايتي',
    "HN" =>'هندوراس',
    "NL" =>'هولندا',
    "HK" =>'هونغ كونغ',
    "WF" =>'واليس وفوتونا',
	"PS" => 'فلسطين'
];

	 $En_countries = array
(
	'AF' => 'Afghanistan',
	'AX' => 'Aland Islands',
	'AL' => 'Albania',
	'DZ' => 'Algeria',
	'AS' => 'American Samoa',
	'AD' => 'Andorra',
	'AO' => 'Angola',
	'AI' => 'Anguilla',
	'AQ' => 'Antarctica',
	'AG' => 'Antigua And Barbuda',
	'AR' => 'Argentina',
	'AM' => 'Armenia',
	'AW' => 'Aruba',
	'AU' => 'Australia',
	'AT' => 'Austria',
	'AZ' => 'Azerbaijan',
	'BS' => 'Bahamas',
	'BH' => 'Bahrain',
	'BD' => 'Bangladesh',
	'BB' => 'Barbados',
	'BY' => 'Belarus',
	'BE' => 'Belgium',
	'BZ' => 'Belize',
	'BJ' => 'Benin',
	'BM' => 'Bermuda',
	'BT' => 'Bhutan',
	'BO' => 'Bolivia',
	'BA' => 'Bosnia And Herzegovina',
	'BW' => 'Botswana',
	'BV' => 'Bouvet Island',
	'BR' => 'Brazil',
	'IO' => 'British Indian Ocean Territory',
	'BN' => 'Brunei Darussalam',
	'BG' => 'Bulgaria',
	'BF' => 'Burkina Faso',
	'BI' => 'Burundi',
	'KH' => 'Cambodia',
	'CM' => 'Cameroon',
	'CA' => 'Canada',
	'CV' => 'Cape Verde',
	'KY' => 'Cayman Islands',
	'CF' => 'Central African Republic',
	'TD' => 'Chad',
	'CL' => 'Chile',
	'CN' => 'China',
	'CX' => 'Christmas Island',
	'CC' => 'Cocos (Keeling) Islands',
	'CO' => 'Colombia',
	'KM' => 'Comoros',
	'CG' => 'Congo',
	'CD' => 'Congo, Democratic Republic',
	'CK' => 'Cook Islands',
	'CR' => 'Costa Rica',
	'CI' => 'Cote D\'Ivoire',
	'HR' => 'Croatia',
	'CU' => 'Cuba',
	'CY' => 'Cyprus',
	'CZ' => 'Czech Republic',
	'DK' => 'Denmark',
	'DJ' => 'Djibouti',
	'DM' => 'Dominica',
	'DO' => 'Dominican Republic',
	'EC' => 'Ecuador',
	'EG' => 'Egypt',
	'SV' => 'El Salvador',
	'GQ' => 'Equatorial Guinea',
	'ER' => 'Eritrea',
	'EE' => 'Estonia',
	'ET' => 'Ethiopia',
	'FK' => 'Falkland Islands (Malvinas)',
	'FO' => 'Faroe Islands',
	'FJ' => 'Fiji',
	'FI' => 'Finland',
	'FR' => 'France',
	'GF' => 'French Guiana',
	'PF' => 'French Polynesia',
	'TF' => 'French Southern Territories',
	'GA' => 'Gabon',
	'GM' => 'Gambia',
	'GE' => 'Georgia',
	'DE' => 'Germany',
	'GH' => 'Ghana',
	'GI' => 'Gibraltar',
	'GR' => 'Greece',
	'GL' => 'Greenland',
	'GD' => 'Grenada',
	'GP' => 'Guadeloupe',
	'GU' => 'Guam',
	'GT' => 'Guatemala',
	'GG' => 'Guernsey',
	'GN' => 'Guinea',
	'GW' => 'Guinea-Bissau',
	'GY' => 'Guyana',
	'HT' => 'Haiti',
	'HM' => 'Heard Island & Mcdonald Islands',
	'VA' => 'Holy See (Vatican City State)',
	'HN' => 'Honduras',
	'HK' => 'Hong Kong',
	'HU' => 'Hungary',
	'IS' => 'Iceland',
	'IN' => 'India',
	'ID' => 'Indonesia',
	'IR' => 'Iran, Islamic Republic Of',
	'IQ' => 'Iraq',
	'IE' => 'Ireland',
	'IM' => 'Isle Of Man',
	'IT' => 'Italy',
	'JM' => 'Jamaica',
	'JP' => 'Japan',
	'JE' => 'Jersey',
	'JO' => 'Jordan',
	'KZ' => 'Kazakhstan',
	'KE' => 'Kenya',
	'KI' => 'Kiribati',
	'KR' => 'Korea',
	'KW' => 'Kuwait',
	'KG' => 'Kyrgyzstan',
	'LA' => 'Lao People\'s Democratic Republic',
	'LV' => 'Latvia',
	'LB' => 'Lebanon',
	'LS' => 'Lesotho',
	'LR' => 'Liberia',
	'LY' => 'Libyan Arab Jamahiriya',
	'LI' => 'Liechtenstein',
	'LT' => 'Lithuania',
	'LU' => 'Luxembourg',
	'MO' => 'Macao',
	'MK' => 'Macedonia',
	'MG' => 'Madagascar',
	'MW' => 'Malawi',
	'MY' => 'Malaysia',
	'MV' => 'Maldives',
	'ML' => 'Mali',
	'MT' => 'Malta',
	'MH' => 'Marshall Islands',
	'MQ' => 'Martinique',
	'MR' => 'Mauritania',
	'MU' => 'Mauritius',
	'YT' => 'Mayotte',
	'MX' => 'Mexico',
	'FM' => 'Micronesia, Federated States Of',
	'MD' => 'Moldova',
	'MC' => 'Monaco',
	'MN' => 'Mongolia',
	'ME' => 'Montenegro',
	'MS' => 'Montserrat',
	'MA' => 'Morocco',
	'MZ' => 'Mozambique',
	'MM' => 'Myanmar',
	'NA' => 'Namibia',
	'NR' => 'Nauru',
	'NP' => 'Nepal',
	'NL' => 'Netherlands',
	'AN' => 'Netherlands Antilles',
	'NC' => 'New Caledonia',
	'NZ' => 'New Zealand',
	'NI' => 'Nicaragua',
	'NE' => 'Niger',
	'NG' => 'Nigeria',
	'NU' => 'Niue',
	'NF' => 'Norfolk Island',
	'MP' => 'Northern Mariana Islands',
	'NO' => 'Norway',
	'OM' => 'Oman',
	'PK' => 'Pakistan',
	'PW' => 'Palau',
	'PS' => 'Palestine',
	'PA' => 'Panama',
	'PG' => 'Papua New Guinea',
	'PY' => 'Paraguay',
	'PE' => 'Peru',
	'PH' => 'Philippines',
	'PN' => 'Pitcairn',
	'PL' => 'Poland',
	'PT' => 'Portugal',
	'PR' => 'Puerto Rico',
	'QA' => 'Qatar',
	'RE' => 'Reunion',
	'RO' => 'Romania',
	'RU' => 'Russian Federation',
	'RW' => 'Rwanda',
	'BL' => 'Saint Barthelemy',
	'SH' => 'Saint Helena',
	'KN' => 'Saint Kitts And Nevis',
	'LC' => 'Saint Lucia',
	'MF' => 'Saint Martin',
	'PM' => 'Saint Pierre And Miquelon',
	'VC' => 'Saint Vincent And Grenadines',
	'WS' => 'Samoa',
	'SM' => 'San Marino',
	'ST' => 'Sao Tome And Principe',
	'SA' => 'Saudi Arabia',
	'SN' => 'Senegal',
	'RS' => 'Serbia',
	'SC' => 'Seychelles',
	'SL' => 'Sierra Leone',
	'SG' => 'Singapore',
	'SK' => 'Slovakia',
	'SI' => 'Slovenia',
	'SB' => 'Solomon Islands',
	'SO' => 'Somalia',
	'ZA' => 'South Africa',
	'GS' => 'South Georgia And Sandwich Isl.',
	'ES' => 'Spain',
	'LK' => 'Sri Lanka',
	'SD' => 'Sudan',
	'SR' => 'Suriname',
	'SJ' => 'Svalbard And Jan Mayen',
	'SZ' => 'Swaziland',
	'SE' => 'Sweden',
	'CH' => 'Switzerland',
	'SY' => 'Syrian Arab Republic',
	'TW' => 'Taiwan',
	'TJ' => 'Tajikistan',
	'TZ' => 'Tanzania',
	'TH' => 'Thailand',
	'TL' => 'Timor-Leste',
	'TG' => 'Togo',
	'TK' => 'Tokelau',
	'TO' => 'Tonga',
	'TT' => 'Trinidad And Tobago',
	'TN' => 'Tunisia',
	'TR' => 'Turkey',
	'TM' => 'Turkmenistan',
	'TC' => 'Turks And Caicos Islands',
	'TV' => 'Tuvalu',
	'UG' => 'Uganda',
	'UA' => 'Ukraine',
	'AE' => 'United Arab Emirates',
	'GB' => 'United Kingdom',
	'US' => 'United States',
	'UM' => 'United States Outlying Islands',
	'UY' => 'Uruguay',
	'UZ' => 'Uzbekistan',
	'VU' => 'Vanuatu',
	'VE' => 'Venezuela',
	'VN' => 'Viet Nam',
	'VG' => 'Virgin Islands, British',
	'VI' => 'Virgin Islands, U.S.',
	'WF' => 'Wallis And Futuna',
	'EH' => 'Western Sahara',
	'YE' => 'Yemen',
	'ZM' => 'Zambia',
	'ZW' => 'Zimbabwe',
);
	
 $country_code = strtoupper($country_code);
 $country = '';
	if (get_bloginfo("language") == "ar" || get_bloginfo("language")=="AR"){
		if(isset($Ar_countries[$country_code])){
			return $Ar_countries[$country_code];
		}
		
	}
	elseif (isset($En_countries[$country_code])){
			return $En_countries[$country_code];
	}
 	if( $country == '') $country = $country_code;
 
	
return $country;
} 