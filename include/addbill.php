<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$userID=$_POST['userID'];

// $selectreg=$db->getAllRASName();
?>

<form action="../include/process.php" method="post" class="form-horizontal form-label-left">

    <!--District Name-->
    <div class="item form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12">Vehicle Reg<span class="required">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <select id="veid" class="form-control col-md-12 col-xs-12 " name="veid" require type="option">
                <option>----SELECT----</option>
                <?php
                    $sel = $db->selectvehicle();
                    while ($row=$sel->fetch()) {?>
                <option value="<?php echo $row['regn']; ?>">
                    <?php echo strtoupper($row['regn']); ?>
                </option>
                <?php 
                    }?>
            </select>
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12">Amount<span class="required">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input id="amount" class="form-control col-md-12 col-xs-12 " name="amount" require type="text">
        </div>
    </div>

    <div class="item form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12">Penalty<span class="required">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input id="penalty" class="form-control col-md-12 col-xs-12 " name="penalty" require type="text">
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12">Status<span class="required">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <select id="status" class="form-control col-md-12 col-xs-12 " name="status" require type="option" required>
                <option class="hidden">----select----</option>
                <option value="Paid">Paid</option>
                <option value="Un_paid">Un_paid</option>
            </select>
        </div>
    </div>
    <div class="ln_solid">
    </div>
    <div class="form-group">
        <div class="col-md-12 col-md-offset-12">
            <input type="submit" id="send" class="btn btn-success" name="addbill" value="Submit" />
            <input type="reset" class="btn btn-default" value="Clear" />
            <input type="hidden" name="userID" value="<?php echo $userID; ?>" />
        </div>
    </div>
</form>
<script src="js/jquery.min.js"></script>
<script>
$(document).ready(function() {

    $("select#region_id").change(function() {
        selectedRegionTypeName = $("#region_id option:selected").text();
        selectedRegionType = $(this).val();

        if (selectedRegionTypeName !== "All") {
            $("#byDistrictTypeContainer").show();
            let _url = "../lib/districtByReg3.php?id=" + selectedRegionType;
            $.ajax({
                url: _url,
                success: function(result) {
                    $("#byDistrictTypeContainer").html(result);
                }
            });


        } else {
            $("#byDistrictTypeContainer").hide();
        }


    });


    $("select#wilaya").change(function() {
        //alert('test');
        selectedRegionTypeName = $("#wilaya option:selected").text();
        selectedRegionType = $(this).val();

        if (selectedRegionTypeName !== "All") {
            $("#byJimboTypeContainer").show();
            let _url = "lib/jimboByReg.php?id=" + selectedRegionType;
            $.ajax({
                url: _url,
                success: function(result) {
                    $("#byJimboTypeContainer").html(result);
                }
            });


        } else {
            $("#byJimboTypeContainer").hide();
        }


    });
});
</script>