<?php 
require_once("config.php");

function getValue($value){
    if(isset($_POST[$value])){
        echo $_POST[$value];
    }
}

function RowcountValue($tbl,$col, $val){
    global $conn;

    $stm=$conn->prepare("SELECT $col FROM $tbl WHERE $col=?");
    $stm->execute(array($val));
    $res=$stm->rowCount();

    return $res;
}

?>