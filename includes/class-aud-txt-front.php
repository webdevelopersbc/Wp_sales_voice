<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Admin Class
 *
 * Manage Front Panel Class
 *
 * @package Audio Text Convert
 * @since 1.0
 */

class Aud_txt_Front {

	public $scripts;

	//class constructor
	function __construct() {

	
	}

	/**
	 * Audio Shortcode structure
	 *
	 * @package Audio Text Convert
	 * @since 1.0
	 */
	public function audio_play_shortcode_display($atts) {
		$atts = shortcode_atts( array(
		    'id' => '',
		    'audio' => '',
		    'color' => 'red',
		    'seconds' => ''
		), $atts, 'audio_play' );

		$upload_dir = wp_upload_dir();
		$folder_id = $atts['id'];
		$file_name = $atts['audio'];
		$btn_color = $atts['color'];
		$seconds = $atts['seconds'];
		$file_path = $upload_dir['baseurl']."/audio-text/".$folder_id."/".$file_name;
		?>
		<div class="audio-short-wrap" id="audio-wrap-<?php echo $folder_id; ?>">
			<h4>Audio</h4>
			<p id="status"></p>
			<a href="javascript:void(0);" title="Play Audio" class="play-aud" data-src="<?php echo $file_path; ?>" id="play-<?php echo $folder_id; ?>" data-id="<?php echo $folder_id; ?>" ><img src="<?php echo AUD_TXT_INC_URL."/images/".$btn_color.".png"; ?>" /></a>
			<span id="audio-set-<?php echo $folder_id; ?>"></span>
			<a href="javascript:void(0);" title="Pause Audio" class="pause-aud" id="pause-<?php echo $folder_id; ?>" data-id="<?php echo $folder_id; ?>" ><img src="<?php echo AUD_TXT_INC_URL."/images/".$btn_color."-pause.png"; ?>" /></a>
			
		</div>
		<?php
	}

	/**
	 * Text Shortcode structure
	 *
	 * @package Audio Text Convert
	 * @since 1.0
	 */
	public function text_audio_shortcode_display($atts) {
		 $atts = shortcode_atts( array(
		        'id' => '',
		        'color' => 'red',
		    ), $atts, 'text_audio' );

		$upload_dir = wp_upload_dir();
		
		$folder_id = $atts['id'];
		$btn_color = $atts['color'];
		$file_path = $upload_dir['basedir']."/audio-text/".$folder_id."/speech.txt";
		$text_file = fopen($file_path, "r");
		$text = fread($text_file,filesize($file_path));
		fclose($text_file);
		$txt = htmlspecialchars($text);
	  	$txt = rawurlencode($txt);
		$audio = file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$txt.'&tl=en-IN');
		
		?>
		<div class="audio-short-wrap">
			<h4>Text To Speech</h4>
			<audio controls='controls' id='text-audio-<?php echo $folder_id; ?>' style="display:none;" autoplay><source src='data:audio/mpeg;base64, <?php echo base64_encode($audio); ?>'></audio>

			<a href="javascript:void(0);" title="Play Audio" class="play-text" data-id="<?php echo $folder_id; ?>"  data-toggle="modal" id="play-text-<?php echo $folder_id; ?>" data-target="#text-short<?php echo $folder_id; ?>" ><img src="<?php echo AUD_TXT_INC_URL."/images/".$btn_color.".png"; ?>" /></a>

			<a href="javascript:void(0);" title="Pause Audio" id="pause-text-<?php echo $folder_id; ?>" class="pause-text" data-id="<?php echo $folder_id; ?>"  data-toggle="modal" data-target="#text-short<?php echo $folder_id; ?>" ><img src="<?php echo AUD_TXT_INC_URL."/images/".$btn_color."-pause.png"; ?>" /></a>
			

			<!-- Modal -->
			<div class="modal fade text-convert-modal" id="text-short<?php echo $folder_id; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLongTitle<?php echo $folder_id; ?>" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="modalLongTitle<?php echo $folder_id; ?>">Text To Speech</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <p><?php echo $text; ?></p>
			      </div>
			      
			    </div>
			  </div>
			</div>
		</div>
	<?php }

	
	/**
	 * Adding Hooks
	 *
	 * @package Audio Text Convert
	 * @since 1.0
	 */
	function add_hooks(){

		// Audio Shortcode
		add_shortcode( 'audio_play', array($this, 'audio_play_shortcode_display'));

		// Text Shortcode
		add_shortcode( 'text_audio', array($this, 'text_audio_shortcode_display'));

	}
}
?>