<?php
include('includes/constant.php');
?>
<b><span id="countdown-1">600 seconds</span></b>
<script type="text/javascript">
    // Initialize clock countdowns by using the total seconds in the elements tag
    secs       = parseInt(document.getElementById('countdown-1').innerHTML,10);
    setTimeout("countdown('countdown-1',"+secs+")", 1000);
    

    /**
     * Countdown function
     * Clock count downs to 0:00 then hides the element holding the clock
     * @param id Element ID of clock placeholder
     * @param timer Total seconds to display clock
     */
    function countdown(id, timer){
        timer--;
        minRemain  = Math.floor(timer / 60);
        secsRemain = new String(timer - (minRemain * 60));
        // Pad the string with leading 0 if less than 2 chars long
        if (secsRemain.length < 2) {
            secsRemain = '0' + secsRemain;
        }

        // String format the remaining time
        clock      = minRemain + ":" + secsRemain;
        document.getElementById(id).innerHTML = clock;
        if ( timer > 0 ) {
            // Time still remains, call this function again in 1 sec
            setTimeout("countdown('" + id + "'," + timer + ")", 1000);
        } else {
               window.location="<?php echo BASE_URL;?>bitcoin_system/production/login";
        }
    }
</script>
