<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

//$userID=$_POST['userID'];

$selectreg=$db->getAllRegionName();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | DataTables</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">

            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">


                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-10">
                                        </div>

                                        <div class="pull-right col-2">

                                            <button type="button" class="btn btn-success btn-flat" data-toggle="modal"
                                                data-target="#modal-defaulttts">
                                                <i class="fa fa-plus-square fa-fw"></i>Add New</button>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">

                                    <table id="example1" class="table table-bordered table-striped">

                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Council Name</th>
                                                <th>Region Name</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                    $i=1;
                    $sel=$db->getListofDistrictRegion(); 
                    while($row=$sel->fetch())
                    {
										 $disid=$row['District_Id'];
										?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo strtoupper($row['DistrictName']); ?></td>
                                                <td><?php echo strtoupper($row['RegName']); ?></td>
                                                <td align="left">
                                                    <a href="#editDistrict" class="btn btn-primary btn-xs"
                                                        data-toggle="modal" data-id="<?php echo $disid; ?>"
                                                        id="geteditDistrict"><i class="fa fa-edit"></i>Edit</a>
                                                </td>

                                                <td align="left"> <a href="#deleteDistrict"
                                                        class="btn  btn-danger btn-xs" data-toggle="modal"
                                                        data-id="<?php echo $disid; ?>" id="getdeleteDistrict"><i
                                                            class="fa fa-trash"></i>Delete</a>
                                                </td>

                                            </tr>
                                            <?php $i++;} ?>
                                        </tbody>
                                    </table>



                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../plugins/jquery-validation/additional-methods.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    $(function() {
        //$.validator.setDefaults({
        //submitHandler: function () {
        // alert( "Form successful submitted!" );
        //}
        //});
        $('#quickForm').validate({
            rules: {
                email: {
                    required: true

                },
                password: {
                    required: true

                },
                terms: {
                    required: true
                },
            },
            messages: {
                email: {
                    required: "Please enter a email address"
                },
                password: {
                    required: "Please provide a password"

                },
                terms: "Please accept our terms"
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
    </script>

    <div class="modal fade" id="modal-defaulttts">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ongeza Wilaya</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- form start -->
                    <form id="quickForm" method="post" action="../includes/process.php">
                        <div class="card-body">


                            <!--District Name-->
                            <div class="item form-group">
                                <label class="control-label col-md-12">District Name<span
                                        class="required">*</span></label>
                                <div class="col-md-12">
                                    <input id="disName" class="form-control col-md-12" name="disName" required
                                        type="text">
                                    </select>
                                </div>
                            </div>


                            <!--Region-->
                            <div class="form-group">
                                <label class="control-label col-md-12">Region<span class="required">*</span></label>
                                <div class="col-md-12">
                                    <select id="gender" class="form-control col-md-12" name="region"
                                        required="required">
                                        <option value="">--Select--</option>
                                        <?php
	  while($row=$selectreg->fetch())
{
?>
                                        <option value="<?php echo $row['Reg_Id']; ?>"><?php echo $row['RegName']; ?>
                                        </option>
                                        <?php
	}
  ?>
                                    </select>
                                </div>
                            </div>



                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="submit" id="send" class="btn btn-success" name="addDistrict"
                                        value="Submit" />
                                    <input type="reset" class="btn btn-default" value="Clear" />
                                    <input type="hidden" name="userID" value="<?php echo $userID; ?>" />

                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->


                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</body>

</html>