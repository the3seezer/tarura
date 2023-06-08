<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

 $disid=$_POST['ras_id'];
$selectreg=$db->selectbillbybid($disid);
$row = $selectreg->fetch();
// var_dump($row);
$veid=$row['veid'];
$amount=$row['amount'];
$penalty=$row['penalty'];
$status=$row['status'];
// $bid=$row['bid'];
// $id = $row['id'];

// $selectreg=$db->selectbill();

?>

<form action="../include/process.php" method="post " class="form-horizontal form-label-left">


    <!--Region Name-->
    <div class="item form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="veid">Vehicle Reg<span
                class="required">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input id="veid" class="form-control col-md-12 col-xs-12" name="veid" value="<?php echo $veid; ?>"
                required="required" type="option">
        </div>
    </div>

    </div>
    <div class="item form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="amount">Amount<span
                class="required">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input id="amount" class="form-control col-md-12 col-xs-12" name="amount" value="<?php echo $amount; ?>"
                required="required" type="text">
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="penalty">Penalty<span
                class="required">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input id="penalty" class="form-control col-md-12 col-xs-12" name="penalty" value="<?php echo $penalty; ?>"
                required="required" type="text">
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="status">Status<span
                class="required">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input id="status" class="form-control col-md-12 col-xs-12" name="status" value="<?php echo $status; ?>"
                required="required" type="option">
        </div>
    </div>
    <input type="hidden" name="bid" value="<?php echo $bid; ?>">
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-12 col-md-offset-12">
            <input type="submit" id="send" class="btn btn-success" name="editbill" value="Save">
            <input type="reset" class="btn btn-default" value="Clear">
            <input type="hidden" name="disid" value="<?php echo $disid; ?>">
        </div>
    </div>
</form>