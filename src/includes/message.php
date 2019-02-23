    <div class="form-group">
        <div class="col-sm-6 col-sm-offset-3 ">
            <?php
           // print_r($_SESSION);
            if (isset($_SESSION['error']) && (isset($_SESSION['message']) && !empty($_SESSION['message']))) {
                if ($_SESSION['error'] == 0) {
                ?> 
                    <div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?php echo $_SESSION['message']; ?></span></div>
                <?php 
                } else {
                ?>
                <div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?php echo $_SESSION['message']; ?></span></div>
                <?php
                }
                unset($_SESSION['error']);
                unset($_SESSION['message']);
            }
            ?>  
        </div>
         <div class="clear"></div>
    </div>