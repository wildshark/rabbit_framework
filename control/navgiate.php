<?php
$page = false;
$sector = false;
$token = BNK;
if(!isset($_GET['main'])){   
    header("location: ?user=zero");
}else{
    $page = $_GET['main'];
    $sector = $_GET['ui'] ?? 0;
    setcookie("_page",$page);
    setcookie("_sector",$sector);
    $username = $_COOKIE['_user'];
}

switch($page){
    
    case"dashboard":
        $summary = $sbn->SusuModule("summary",false,BNK);
        $totalUser = isNull($summary['TotalUser']);
        $totalDeposit =isNull($summary['TotalDeposit']) ;
        $totalWithdraw = isNull($summary['TotalWithdraw']);
        $Balance = isNull($summary['Balance']);
        $datasheet = $sbn->SusuModule("currentTransaction",false,BNK);
        require("./frame/dashboard.php");
    break;

 
}


?>