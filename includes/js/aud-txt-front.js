jQuery(document).ready(function($) {
   
    $('.pause-aud').hide();
    $('.pause-text').hide();

    /* Audio Play */
    $('.play-aud').click(function() {

        $('audio').each(function(){
            this.pause(); // Stop playing
            this.currentTime = 0; // Reset time
        }); 

        $('.pause-aud').hide();
        $('.play-aud').show();
        $('.pause-text').hide();
        $('.play-text').show();

        var audiofile = $(this).data("src");
        var audio_id = $(this).data("id");
        var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', audiofile);
        audioElement.setAttribute('class', "audio-short");
        audioElement.setAttribute('id', "audio-"+audio_id);         
        audioElement.addEventListener('ended', function() {
            audioElement.pause();
            $('#pause-'+audio_id).hide();
        $('#play-'+audio_id).show();
        }, false);

        $("#audio-set-"+audio_id).html(audioElement);
        $('#play-'+audio_id).hide();
        audioElement.play();
        $('#pause-'+audio_id).show();
    });

    /* Audio Pause */
    $('.pause-aud').click(function () {
        var audio_id = $(this).data("id");
        var audioElement = document.getElementById("audio-"+audio_id);
        audioElement.pause();
        $("#audio-set-"+audio_id).html('');
        $('#pause-'+audio_id).hide();
        $('#play-'+audio_id).show();
    });


    /* Text Audio Play */
    $('.play-text').click(function() {

        $('.pause-aud').hide();
        $('.play-aud').show();

        $('audio').each(function(){
            this.pause(); // Stop playing
            this.currentTime = 0; // Reset time
        }); 

        $('.pause-text').hide();
        $('.play-text').show();

        var audiofile = $(this).data("src");
        var audio_id = $(this).data("id");
        var audioElement = document.getElementById('text-audio-'+audio_id);
        audioElement.addEventListener('ended', function() {
            audioElement.pause();
            $('#pause-text-'+audio_id).hide();
            $('#play-text-'+audio_id).show();
        }, false);

        $('#play-text-'+audio_id).hide();
        audioElement.play();
        $('#pause-text-'+audio_id).show();
    });

    /* Text Audio Pause */
    $('.pause-text').click(function () {
        var audio_id = $(this).data("id");
        var audioElement = document.getElementById("text-audio-"+audio_id);
        audioElement.pause();
        $('#pause-text-'+audio_id).hide();
        $('#play-text-'+audio_id).show();
    });

    $(".text-convert-modal .close").click(function () {

        $('audio').each(function(){
            this.pause(); // Stop playing
            this.currentTime = 0; // Reset time
        }); 

        $('.pause-text').hide();
        $('.play-text').show();
        

    });

    
   
});