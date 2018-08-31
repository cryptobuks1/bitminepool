    <div class="form-group">
        <div class="col-sm-12 ">
            <?php
            if (isset($_SESSION['error']) && (isset($_SESSION['message']) && !empty($_SESSION['message']))) {
                if ($error == 0) {
                ?> 
                    <div class="alert alert-success"><?php echo $_SESSION['message']; ?></div>
                <?php 
                } else {
                ?>
                <div class="alert alert-danger"><?php echo $_SESSION['message']; ?></div>
                <?php
                }
                unset($_SESSION['error']);
                unset($_SESSION['message']);
            }
            ?>  
        </div>
         <div class="clear"></div>
    </div>