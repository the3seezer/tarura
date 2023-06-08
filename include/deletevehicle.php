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
// $selectreg=$db->getAllRegionName();
?>

<form action="../include/process.php" method="post" class="form-horizontal form-label-left">


    <p>Do you want to delete this information?</p>
    </br>
    <div class="ln_solid">
    </div>
    <div class="form-group">
        <div class="col-md-12 col-md-offset-12">
            <input type="submit" id="send" class="btn btn-danger" name="deletevehicle" value="Delete" />
            <input type="hidden" name="vehicleid" value="<?php echo $disid; ?>" />

        </div>
    </div>
</form>