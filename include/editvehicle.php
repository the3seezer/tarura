<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$disid=$_POST['ras_id'];
$selectreg=$db->selectvehiclebyid($disid);
while($row = $selectreg->fetch()){
$location=$row['location'];
$regn=$row['regn'];
$mobile=$row['mobile'];
$date=$row['date'];
$nida=$row['nida'];
$id=$row['id'];

}


?>

<form action="../include/process.php" method="post" class="form-horizontal form-label-left">


    <!--Region Name-->
    <div class="item form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="location">Location<span
                class="required">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input id="location" class="form-control col-md-7 col-xs-12" name="location"
                value="<?php echo $location; ?>" required="required" type="text">
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="regn">RegNo<span
                class="required">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input id="regn" class="form-control col-md-7 col-xs-12" name="regn" value="<?php echo $regn; ?>"
                required="required" type="text">
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="mobile">Mobile No<ospan class="required">*
            </ospan>
        </label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input id="mobile" class="form-control col-md-7 col-xs-12" name="mobile" value="<?php echo $mobile; ?>"
                required="required" type="text">
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="date">Date<span
                class="required">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input id="date" class="form-control col-md-7 col-xs-12" name="date" value="<?php echo $date; ?>"
                required="required" type="date">
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="nida">Nida<span
                class="required">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input id="nida" class="form-control col-md-7 col-xs-12" name="nida" value="<?php echo $nida; ?>"
                required="required" type="text">
        </div>
    </div>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-12 col-md-offset-12">
            <input type="submit" id="send" class="btn btn-success" name="editvehicle" value="Save">
            <input type="reset" class="btn btn-default" value="Clear">
            <input type="hidden" name="disid" value="<?php echo $disid; ?>">
        </div>
    </div>
</form>