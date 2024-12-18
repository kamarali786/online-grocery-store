<?php
 include_once("includes/config.php");
if(! function_exists('setting')){
    function setting($key,$default=null){
        global $conn;
        $sql="select * from settings where setting_name='".$key."'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        if($row){
            return $row['setting_value'];
        }
        return $default;
    }
}
?>