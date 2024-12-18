<?php
if (!empty($error)) {
?>
    <div class="alert alert-danger alert-dismissible">
        
        <div class="text-danger"><?php echo $error; ?>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php }

if (!empty($success)) {
    ?>
        <div class="alert alert-success alert-dismissible">
            <div class="text-success"><?php echo $success; ?>
    
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
<?php }

if (!empty($warning)) {
    ?>
        <div class="alert alert-warning alert-dismissible">
            <div class="text-warning"><?php echo $warning; ?>
    
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
<?php }