<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Admin Class
 *
 * Manage Admin Panel Class
 *
 * @package Audio Text Convert
 * @since 1.0
 */

class Aud_txt_Admin {

	public $scripts;

	//class constructor
	function __construct() {

	
	}

	/**
	 * Create menu page
	 *
	 * Adding required menu pages and submenu pages
	 * to manage the plugin functionality
	 * 
	 * @package Audio Text Convert
	 * @since 1.0
	 */

	public function aud_txt_add_menu_page() {

		$aud_txt_post_push_notification = add_menu_page( __( 'Audio Text Convert', 'aud_txt' ), __( 'Audio Text Convert', 'aud_txt' ), 'manage_options', 'audio-text', array( $this, 'aud_txt_settings') );

	}

	/**
	 * Audio text Setting Page structure in admin
	 *
	 * @package Audio Text Convert
	 * @since 1.0
	 */

	public function aud_txt_settings() {
		include_once( AUD_TXT_ADMIN_DIR . '/forms/aud-text-settings.php' );
	}

	/**
	 * Save shortcode settings in options
	 *
	 * @package Audio Text Convert
	 * @since 1.0
	 */

	public function aud_txt_option_settings () {

		register_setting( 'audio-options-group', 'audio_f', array($this , 'audio_file_save' ) );

		register_setting( 'audio-options-group', 'button_type');

		register_setting( 'audio-options-group', 'second_play');

		register_setting( 'audio-options-group', 'short_dis', array($this , 'short_dis_validate' ) );

		register_setting( 'text-options-group', 'text_conv');

		register_setting( 'text-options-group', 'text_btn_type');

		register_setting( 'text-options-group', 'short_dis_text', array($this , 'short_dis_text_validate' ) );
	}

	/**
	 * Audio shortcode validation
	 *
	 * @package Audio Text Convert
	 * @since 1.0
	 */

	public function short_dis_validate($input) {

		$input = array_filter($input);
		if(empty($input)) {
			$valid = false;
			add_settings_error( 'audio-text', 'invalid_short_dis','Audio Short Code is required.', 'error' );
		}
		return $input;
	}

	function audio_file_save($option)
	{
		$option = array();
		if(!empty($_FILES["audio_f"]['name']))
	    {
	        foreach ($_FILES["audio_f"]['name'] as $file) {
	        	$option[] = $file;
	        }
	    }
	    return $option;
	}

	/**
	 * Text shortcode validation
	 *
	 * @package Audio Text Convert
	 * @since 1.0
	 */

	public function short_dis_text_validate($input) {
		
		$input = array_filter($input);    
		if(empty($input)) {
			$valid = false;
			add_settings_error( 'audio-text', 'invalid_short_dis_text','Text Short Code is required.', 'error' );
		}
		return $input;
	}

	/**
	 * Audio More Section Ajax
	 *
	 * @package Audio Text Convert
	 * @since 1.0
	 */

	public function aud_txt_more_audio_section () {
		$coutid = $_POST['count'];
		$html = '';
		$html = '<tr data-id="'.$coutid.'">
		       		<td>
		       			<input type="file" data-id="'.$coutid.'" accept=".mp3,.m4a,.ogg,.wav" name="audio_f[]" />
		       		</td>
		       		<td>
		       			<select name="button_type[]" class="button-type" data-id="'.$coutid.'">
		       				<option value="red">Red</option>
		       				<option value="black">Black</option>
		       				<option value="blue">Blue</option>
		       			</select>
		       		</td>
		       		<td>
		       			<input type="number" name="second_play[]" data-id="'.$coutid.'">
		       		</td>		       		
		       		<td>
		       			<button type="button" class="gen-short button" data-id="'.$coutid.'" value="save_audio">Generate Shortcode</button>
		       			
		       		</td>
		       		<td  data-id="'.$coutid.'" class="short-code">
		       			<input type="text" name="short_dis[]" id="short_dis'.$coutid.'" value="" readonly  data-id="'.$coutid.'">
		       			<button type="button" data-id="'.$coutid.'" title="Remove" value="remove" class="remove_row btn button btn-close">X</button>
		       			<button type="button" data-toggle="tooltip" data-placement="bottom" title="Copied" class="button copy-short" data-id="'.$coutid.'">Copy</button>
		       			
		       		</td>
		       	</tr>';

		wp_send_json_success($html);
		die();
	}


	/**
	 * Text More Section Ajax
	 *
	 * @package Audio Text Convert
	 * @since 1.0
	 */

	public function text_load_more_section() {
		$coutid = $_POST['count'];
		$html = '<tr data-id="'.$coutid.'">
		       		<td>
		       			<textarea name="text_conv[]" data-id="'.$coutid.'" rows="5" cols="50" maxlength="100"></textarea>
		       		</td>
		       		<td>
		       			<select name="text_btn_type[]" class="button-text" data-id="'.$coutid.'">
		       				<option value="red">Red</option>
		       				<option value="black">Black</option>
		       				<option value="blue">Blue</option>
	       				</select>
		       		</td>		       		
		       		<td>
		       			<button type="button" class="gen-short-text button"  data-id="'.$coutid.'" id="gen-short-text" value="save_text">Generate Shortcode</button>
		       			
		       		</td>
		       		<td data-id="'.$coutid.'" class="short-code">
		       			<input type="text" name="short_dis_text[]" id="short_text'.$coutid.'" value="" readonly data-id="'.$coutid.'">
		       			<button type="button" data-id="'.$coutid.'" title="Remove" value="remove" class="remove_row btn button btn-close">X</button>
		       			<button type="button" data-toggle="tooltip" data-placement="bottom" title="Copied" class="button copy-short-text" data-id="'.$coutid.'">Copy</button>
		       			
		       		</td>
		       	</tr>';
		wp_send_json_success($html);
		die();
	}
	

	/**
	 * Audio Shorcode generate
	 *
	 * @package Audio Text Convert
	 * @since 1.0
	 */

	public function aud_txt_generate_code () {

		$button_color = $_POST['btn_val'];
		$seconds = $_POST['num_val'];

		if(empty($seconds)) {

			$result['status']='error';
			$result['msg']= esc_html__('Please enter seconds to play','ibid');
			echo json_encode($result);
			exit;
		}

		if(empty($button_color)) {

			$result['status']='error';
			$result['msg']= esc_html__('Please select button color','ibid');
			echo json_encode($result);
			exit;
		}
			
		if( isset( $_FILES['theFile']['size'] ) && $_FILES['theFile']['size'] > 0 ){
			$audFiletemp	    = $_FILES['theFile']['tmp_name'];
			$audFileName	    = basename($_FILES['theFile']['name']);
			$audFileExt    	= end(explode('.', $audFileName));
			$filename 		= "audio-demo.".$audFileExt;
			$random  		= rand ( 1000 , 9999 );	
		   	$aud_dir 		= trailingslashit(wp_upload_dir()['basedir'] )."audio-text/";
		   	$randm_dir 		= $aud_dir.$random."/";
		   	$uploads_dir 	= $randm_dir.$filename;		   	

			if(!is_dir($aud_dir)) {
				wp_mkdir_p( $aud_dir );
				if(!is_dir($randm_dir)) {
					wp_mkdir_p( $randm_dir );
					if (false == @move_uploaded_file( $audFiletemp, $uploads_dir  ) ) {
						
						$result['status']='error';
						$result['msg']= esc_html__('Something goes wrong please try again','ibid');
					} else {
						
						$this->audio_cut_seconds($uploads_dir, $seconds);
						$audio_id = $random;
						$shortcode = '[audio_play id="'.$audio_id.'" audio="'.$filename.'" color="'.$button_color.'" seconds="'.$seconds.'"]';
						$result['status'] = 'success';
						$result['html'] = $shortcode ;
						
					}
				}else{
					$result['status']='error';
					$result['msg']= esc_html__('Something goes wrong please try again','ibid');
				}
			}else {
				if(!is_dir($randm_dir)) {
					wp_mkdir_p( $randm_dir );
					if (false == @move_uploaded_file( $audFiletemp, $uploads_dir  ) ) {		

						$result['status']='error';
						$result['msg']= esc_html__('Something goes wrong please try again','ibid');
					} else {
						
						$this->audio_cut_seconds($uploads_dir, $seconds);

						$audio_id = $random;
						$shortcode = '[audio_play id="'.$audio_id.'" audio="'.$filename.'" color="'.$button_color.'" seconds="'.$seconds.'"]';
						$result['status'] = 'success';
						$result['html'] = $shortcode ;
					}
				} else{
					$result['status']='error';
					$result['msg']= esc_html__('Something goes wrong please try again','ibid');
				}
			}
			
		} else {
			$result['status']='error';
			$result['msg']= esc_html__('Please Select Audio file','ibid');
		}
		
		echo json_encode($result);
		exit;
    
	}

	/**
	 * Text Shorcode generate
	 *
	 * @package Audio Text Convert
	 * @since 1.0
	 */
	public function text_generate_code () {

		$button_color = $_POST['btn_val'];
		$text_val = stripslashes($_POST['text_val']);

		if(empty($button_color)) {

			$result['status']='error';
			$result['msg']= esc_html__('Please select button color','ibid');
			echo json_encode($result);
			exit;
		}
			
		if( isset($text_val) && !empty(trim($text_val)) ){
			$audFileName	    = 'speech.txt';
			$audFileNm    	= current(explode('.', $audFileName));
			$random  = rand ( 1000 , 9999 );	
		   	$aud_dir 		= trailingslashit(wp_upload_dir()['basedir'] )."audio-text/";
		   	$randm_dir 		= $aud_dir.$random."/";
		   	$uploads_dir 	= $randm_dir.$audFileName;

			if(!is_dir($aud_dir)) {
				wp_mkdir_p( $aud_dir );
				if(!is_dir($randm_dir)) {
					wp_mkdir_p( $randm_dir );
					$file = fopen($uploads_dir, "w");
				    if(fwrite($file, $text_val)) {
				    	$text_id = $random;
						$shortcode = '[text_audio id="'.$text_id.'" color="'.$button_color.'"]';
						$result['status'] = 'success';
						$result['html'] = $shortcode ;

				    } else{
				    	$result['status']='error';
						$result['msg']= esc_html__('Something goes wrong please try again','ibid');
				    }
			    	fclose($file);
				}else{
					$result['status']='error';
					$result['msg']= esc_html__('Something goes wrong please try again','ibid');
				}
			}else {
				if(!is_dir($randm_dir)) {
					wp_mkdir_p( $randm_dir );
					$file = fopen($uploads_dir, "w");
				    if(fwrite($file, $text_val)) {
				    	$text_id = $random;
						$shortcode = '[text_audio id="'.$text_id.'" color="'.$button_color.'"]';
						$result['status'] = 'success';
						$result['html'] = $shortcode ;

				    } else{
				    	$result['status']='error';
						$result['msg']= esc_html__('Something goes wrong please try again','ibid');
				    }
			    	fclose($file);
				} else{
					$result['status']='error';
					$result['msg']= esc_html__('Something goes wrong please try again','ibid');
				}
			}
			
		} else {
			$result['status']='error';
			$result['msg']= esc_html__('Please enter Text for shortcode','ibid');
		}
		
		echo json_encode($result);
		exit;
    
	}

	/**
	 * Cut the audio to the seconds
	 * 
	 */
	public function audio_cut_seconds($uploads_dir, $seconds) {
		$path = $uploads_dir;
		$mp3 = new PHPMP3($path);
		$mp3_1 = $mp3->extract(0,$seconds);
		$mp3_1->save($uploads_dir);
	}
	
	
	/**
	 * Adding Hooks
	 *
	 * @package Audio Text Convert
	 * @since 1.0
	 */
	function add_hooks(){

		// Plugin Menu
		add_action( 'admin_menu', array( $this, 'aud_txt_add_menu_page' ) );

		// Option Settings
		add_action( 'admin_init', array( $this, 'aud_txt_option_settings') );

		//Generate Audio Shortcode		
		add_action( 'wp_ajax_generate_code', array( $this, 'aud_txt_generate_code'));
		add_action( 'wp_ajax_nopriv_generate_code', array( $this, 'aud_txt_generate_code'));

		//Generate Text Shortcode		
		add_action( 'wp_ajax_text_generate_code', array( $this, 'text_generate_code'));
		add_action( 'wp_ajax_nopriv_text_generate_code', array( $this, 'text_generate_code'));

		// Load more audio		
		add_action( 'wp_ajax_aud_txt_more', array( $this, 'aud_txt_more_audio_section'));
		add_action( 'wp_ajax_nopriv_aud_txt_more', array( $this, 'aud_txt_more_audio_section'));

		//More audio		
		add_action( 'wp_ajax_text_load_more', array( $this, 'text_load_more_section'));
		add_action( 'wp_ajax_nopriv_text_load_more', array( $this, 'text_load_more_section'));

	}
}
?>