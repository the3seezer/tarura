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
        <label class="control-label col-md-12 col-sm-12 col-xs-12">Location<span class="required">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input id="location" class="form-control col-md-12 col-xs-12 " name="location" require type="text">
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12">Vehicle Regno<span class="required">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input id="regn" class="form-control col-md-12 col-xs-12 " name="regn" require type="text">
        </div>
    </div>

    <div class="item form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12">MobileNo<span class="required">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input id="mobile" class="form-control col-md-12 col-xs-12 " name="mobile" require type="text">
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12">Date<span class="required">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input id="date" class="form-control col-md-12 col-xs-12 " name="date" require type="date">
        </div>
        <div class="item form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">Nida<span class="required">*</span></label>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <input id="nida" class="form-control col-md-12 col-xs-12 " name="nida" require type="text">
            </div>

        </div>
        <!-- <div id="byDistrictTypeContainer"></div>
        <div id="byJimboTypeContainer"></div> -->
        <!--District Name-->





        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                <input type="submit" id="send" class="btn btn-success" name="addvehicle" value="Submit" />
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