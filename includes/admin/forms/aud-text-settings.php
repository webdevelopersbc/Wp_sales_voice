<?php
settings_errors();

$count = $countText =  2;
$audios = get_option('audio_f');
$btn_audios = get_option('button_type');
$second_play = get_option('second_play');
$shortcodes =  (get_option('short_dis')) ? get_option('short_dis') : array();

$display1 = $display2 = "style='display:none;'";
if(!empty($shortcodes)) {
	$display1 = "style='display:block;'";
	$count = sizeof($shortcodes) + 1;
}


$texts = get_option('text_conv');
$text_btn = get_option('text_btn_type');
$shortcodesText =  (get_option('short_dis_text')) ? get_option('short_dis_text') : array();
if(!empty($shortcodesText)) {
	$display2 = "style='display:block;'";
	$countText = sizeof($shortcodesText) + 1;
}
?>
<div class="wrap">
	<h2>Audio Text Settings</h2>
	<div class="meta-box-sortables ui-sortable aud-text-wrap">
		<div class="postbox" id="p1">
			<div class="container">
				<form action="options.php" name="audio-form" method="post" id="audio-form" enctype="multipart/form-data">

				    <?php 
				    settings_fields( 'audio-options-group' );
				    do_settings_sections( 'audio-options-group' ); ?>
			     	<table class="form-table">
				        <tr valign="top">
					        <th scope="row">Audio File*</th>
					        <th scope="row" style="width: 15%;">Button Type*</th>
					        <th scope="row" style="width: 10%;">Seconds*</th>
					        <th scope="row" >Action</th>
					        <th scope="row">Shortcode</th>
				   		</tr>
				   		<?php if(!empty($shortcodes)) {
				   			foreach ($shortcodes as $key2 => $value) { 
				   				
				   				$key = $key2 + 1;

				   				?>
				   				<tr data-id="<?php echo $key;?>">
						       		<td>
						       			<input type="file" id="audio-file" accept=".mp3,.m4a,.ogg,.wav" data-id="<?php echo $key;?>" name="audio_f[]" >
						       			<span><?php echo $audios[0]; ?></span>
						       		</td>
						       		<td>
						       			<select name="button_type[]" class="button-type" data-id="<?php echo $key;?>">

						       				<option value="red" <?php if($btn_audios[$key2] == 'red') { echo "selected"; } ?>>Red</option>
		       								<option value="black" <?php if($btn_audios[$key2] == 'black') { echo "selected"; } ?>>Black</option>
		       								<option value="blue" <?php if($btn_audios[$key2] == 'blue') { echo "selected"; } ?>>Blue</option>
						       			</select>
						       		</td>
						       		<td>
						       			<input type="number" min="1"  data-id="<?php echo $key;?>" name="second_play[]" value="<?php echo $second_play[$key2]; ?>">
						       		</td>				       		
						       		<td>
						       			<button type="button" class="gen-short button"  data-id="<?php echo $key;?>" id="gen-short" value="save_audio">Generate Shortcode</button>
						       			
						       		</td>
						       		<td data-id="<?php echo $key;?>" class="short-code">
						       			<input type="text" name="short_dis[]" id="short_dis<?php echo $key;?>" value='<?php echo $value;?>' readonly data-id="<?php echo $key;?>">
						       			<?php if($key > 1) { ?>
						       				<button type="button" data-id="<?php echo $key;?>" title="Remove" value="remove" class="remove_row btn button btn-close">X</button>
						       			<?php } ?>
						       			<button type="button" data-toggle="tooltip" data-placement="bottom" title="Copied" class="button copy-short" data-id="<?php echo $key;?>">Copy</button>
						       			
						       		</td>
						       	</tr>
						       	
				   			<?php }
				   		} else { ?>
				       	<tr data-id="1">
				       		<td>
				       			<input type="file" id="audio-file" accept=".mp3,.m4a,.ogg,.wav" data-id="1" name="audio_f[]" >
				       		</td>
				       		<td>
				       			<select name="button_type[]" class="button-type" data-id="1">
				       				<option value="red">Red</option>
				       				<option value="black">Black</option>
				       				<option value="blue">Blue</option>
				       			</select>
				       		</td>
				       		<td>
				       			<input type="number" min="1"  data-id="1" name="second_play[]">
				       		</td>				       		
				       		<td>
				       			<button type="button" class="gen-short button"  data-id="1" id="gen-short" value="save_audio">Generate Shortcode</button>
				       			
				       		</td>
				       		<td data-id="1" class="short-code">
				       			<input type="text" name="short_dis[]" id="short_dis1" value="" readonly data-id="1">
				       			<button type="button" title="Remove" value="remove" class="remove_row btn button btn-close" style="display:none;">X</button>
				       			<button type="button" data-toggle="tooltip" data-placement="bottom" title="Copied" class="button copy-short"  data-id="1">Copy</button>
				       			
				       		</td>
				       	</tr>
				       <?php } ?>
				       	<tr class="new-row"></tr>
				       	<tr>
				       		<td colspan="4">
				       			<button class="button button-primary" type="submit">Save Changes</button>				       		
				       		</td>
				       		<td>
				       			<button class="button add-more" type="button" id="add-more-aud" <?php echo $display1; ?> >Add More</button>
				       		</td>
				       	</tr>
				    </table>
				</form>
				<input type="hidden" value="<?php echo $count; ?>" id="aud-count" />
			</div>
		</div>
		<div class="postbox" id="p2">
			 <div class="container">
				<form action="options.php" method="post" name="text-form" id="text-form">

				    <?php 
				    settings_fields( 'text-options-group' );
				    do_settings_sections( 'text-options-group' ); ?>
				    <table class="form-table">
					        <tr valign="top">
						        <th scope="row">Text*</th>
						        <th scope="row">Button Type*</th>
						        <th scope="row">Shortcode</th>
						        <th scope="row">Action</th>
					   		</tr>
					   		<?php if(!empty($shortcodesText)) {
				   			foreach ($shortcodesText as $key2 => $value) { 
				   				$key = $key2 + 1;
				   				?>
					       	<tr data-id="<?php echo $key;?>">
					       		<td>
					       			<textarea name="text_conv[]" data-id="<?php echo $key;?>" rows="5" cols="50" maxlength="100"><?php echo $texts[$key2]; ?></textarea>
					       		</td>
					       		<td>
					       			<select name="text_btn_type[]" class="button-text" data-id="<?php echo $key;?>">
					       				<option value="red" <?php if($text_btn[$key2] == 'red') { echo "selected"; } ?>>Red</option>
		       							<option value="black" <?php if($text_btn[$key2] == 'black') { echo "selected"; } ?>>Black</option>
		       							<option value="blue" <?php if($text_btn[$key2] == 'blue') { echo "selected"; } ?>>Blue</option>
				       				</select>
					       		</td>		       		
					       		<td>
					       			<button type="button" class="gen-short-text button"  data-id="<?php echo $key;?>" id="gen-short-text" value="save_text">Generate Shortcode</button>
					       			

					       		</td>
					       		<td data-id="1" class="short-code">
					       			<input type="text" name="short_dis_text[]" id="short_text<?php echo $key;?>" value='<?php echo $value;?>' readonly data-id="<?php echo $key;?>">
					       			<?php if($key > 1) { ?>
				       					<button type="button" data-id="<?php echo $key;?>" title="Remove" value="remove" class="remove_row btn button btn-close">X</button>
				       				<?php } ?>
					       			<button type="button" data-toggle="tooltip" data-placement="bottom" title="Copied" class="button copy-short-text" data-id="<?php echo $key;?>">Copy</button>
					       			
					       		</td>
					       	</tr>
					       <?php } 
					   } else { ?>
					       	<tr data-id="1">
					       		<td>
					       			<textarea name="text_conv[]" data-id="1" rows="5" cols="50" maxlength="100"></textarea>
					       		</td>
					       		<td>
					       			<select name="text_btn_type[]" class="button-text" data-id="1">
					       				<option value="red">Red</option>
		       							<option value="black">Black</option>
		       							<option value="blue">Blue</option>
				       				</select>
					       		</td>		       		
					       		<td>
					       			<button type="button" class="gen-short-text button"  data-id="1" id="gen-short-text" value="save_text">Generate Shortcode</button>
					       			

					       		</td>
					       		<td data-id="1" class="short-code-text">
					       			<input type="text" name="short_dis_text[]" id="short_text1" value="" readonly data-id="1">
					       			<button type="button" title="Remove" value="remove" class="remove_row btn button btn-close" style="display:none;">X</button>
					       			<button type="button" data-toggle="tooltip" data-placement="bottom" title="Copied" class="button copy-short-text" data-id="1">Copy</button>
					       			
					       		</td>
					       	</tr>
					       <?php } ?>
					       	<tr class="new-row-text"></tr>
					       	<tr>
					       		<td colspan="3">
					       			<button class="button button-primary" type="submit">Save Changes</button>				       		
					       		</td>
					       		<td>
					       			<button class="button add-more" type="button" id="add-more-text" <?php echo $display2; ?>>Add More</button>
					       		</td>
				       	</tr>
					   </table>
				</form>
				<input type="hidden" value="<?php echo $countText; ?>" id="text-count" />
			</div>
		</div>
</div>