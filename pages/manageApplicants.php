<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Manage Applicants</h1>
    </div>
</div>
<div class="row">


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    List of Applicants
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>DOB</th>
                                <th>View</th>
                                <th>Application<br/>Status</th>
                                <!--<th>Graduate<br/>Verification</th>-->
                                <!--<th>Reg Status</th>-->
                                <?= $_SESSION['permissions']['can_view_and_delete_applicants']=='YES' ? '<th>Delete</th>' : ''; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            $sel = $db->getAllApplicants();
                            while ($row = $sel->fetch()) {
                                $applicant_id = $row['id'];
                                $getAp = $db->getApplicationByAppId($applicant_id);
                                $getDocu = $db->getDocuments($applicant_id);
                                $getReg = $db->getRegistrationByAppId($applicant_id);
                                $getExp = $db->getExperienceByAppId($applicant_id);
                                $getProf = $db->getProfessionalByAppId($applicant_id);
                                $getBE = $db->getEducationByAppId($applicant_id);
                                $getG = $db->getGraduatesByAppId($applicant_id);

                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
                                    <td><?php echo $row['gender']; ?></td>
                                    <td><?php echo $row['dob']; ?></td>

                                    <td align="left">
                                        <a href="?pg=mngAppDetails&id=<?php echo $applicant_id; ?>"
                                           class="btn btn-info btn-xs" target=_blank><i class="fa fa-folder"></i> More
                                            Details</a>
                                    </td>


                                    <?php
                                    if ($getAp->rowCount() < 1) {
                                        ?>
                                        <td align="left">
                                            <a href="" class="btn btn-warning btn-xs">In progress</a>
                                        </td>
                                        <?php
                                    } else {
                                        ?>
                                        <td align="left">
                                            <a href="" class="btn btn-success btn-xs">Done</a>
                                        </td>
                                    <?php } ?>


                                    <!--											 --><?php
                                    //	                                         if($getG->rowCount()<1)
                                    //	                                         {
                                    //
                                    ?>
                                    <!--										     <td align="left">-->
                                    <!--											 <a href="#" class="btn btn-warning btn-xs">Not Verified</a>-->
                                    <!--										     </td>-->
                                    <!--										      --><?php
                                    //											 }
                                    //											 else
                                    //											 {
                                    //
                                    ?>
                                    <!--											 <td align="left">-->
                                    <!--											 <a href="#" class="btn btn-success btn-xs">Verified</a>-->
                                    <!--										     </td>-->
                                    <!--											 --><?php //}
                                    ?>
                                    <?php if($_SESSION['permissions']['can_view_and_delete_applicants']=='YES'){?>
                                    <td align="left"><a href="#deleteApplicant" class="btn btn-danger btn-xs"
                                                        data-toggle="modal" data-id="<?php echo $applicant_id; ?>"
                                                        id="getdeleteApp"><i class="fa fa-trash"></i>Delete</a>
                                    </td>
                                    <?php } ?>

                                </tr>
                                <?php $i++;
                            } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>


<!--DEFINING MODALS--->
<!--Module to Add New User -->
<div id="addUser" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New User:</h4>
            </div>
            <div class="modal-body">

                <div id="addUser-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to delete applicant-->
<div id="deleteApplicant" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Applicant</h4>
            </div>
            <div class="modal-body">

                <div id="deleteApplicant-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


          