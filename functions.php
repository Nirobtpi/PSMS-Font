<?php 
require_once("config.php");

function getValue($value){
    if(isset($_POST[$value])){
        echo $_POST[$value];
    }
}

// get row count 

function RowcountValue($tbl,$col, $val){
    global $conn;

    $stm=$conn->prepare("SELECT $col FROM $tbl WHERE $col=?");
    $stm->execute(array($val));
    $res=$stm->rowCount();

    return $res;
}

// get student data 

function Student($tbl,$col,$id){
    global $conn;
    $stm=$conn->prepare("SELECT $col FROM $tbl WHERE id=?");
    $stm->execute(array($id));
    $res=$stm->fetch(PDO::FETCH_ASSOC);

    return $res[0][$col];
}

?>