<?php 

function getValue($value){
    if(isset($_POST[$value])){
        echo $_POST[$value];
    }
}

?>