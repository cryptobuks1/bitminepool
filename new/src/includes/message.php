    <div class="form-group">
        <div class="col-sm-12 ">
            <?php
            echo $error.''.$message;
            if (isset($error) && isset($message)) {
                if ($error == 0) {
                ?> 
                    <div class="alert alert-success"><?php echo $message; ?></div>
                <?php 
                } else {
                ?>
                <div class="alert alert-danger"><?php echo $message; ?></div>
                <?php
                }
                unset($error);
                unset($message);
            }
            ?>  
        </div>
         <div class="clear"></div>
    </div>