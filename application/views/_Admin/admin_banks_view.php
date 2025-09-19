<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Admin Banks</title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="../css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
	 
	  
	.divsmcontainer {
    padding: 10px;
    background-color: #f44336;
    color: white;
    opacity: 1;
    transition: opacity 0.6s;
    margin-bottom: 5px;
}  
	  
.alert {
    padding: 20px;
    background-color: #f44336;
    color: white;
    opacity: 1;
    transition: opacity 0.6s;
    margin-bottom: 15px;
}
.message
{
	padding: 20px;
    background-color: #f44336;
    color: white;
    opacity: 1;
    transition: opacity 0.6s;
    margin-bottom: 15px;
}
.alert.success {background-color: #4CAF50;}
.alert.info {background-color: #2196F3;}
.alert.warning {background-color: #ff9800;}
.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}
.closebtn:hover {
    color: black;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 2px;
    /*line-height: 1.42857143;*/
    vertical-align: top;
    /*border-top: 1px solid #ddd;*/
    border-left: 1px solid #ddd;
	border-right: 1px solid #ddd;
    border-top: 1px solid #ddd;
	border-bottom:: 1px solid #ddd;
	overflow:hidden;
}
</style>
</head>
<body class="fix-header card-no-border logo-center">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!--<div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>-->
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include("files/header.php"); ?>
        
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php include("files/sidebar.php"); ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h5 class="text-themecolor m-b-0 m-t-0">Admin Banks</h5>
                    </div>
                    
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                 <script language="javascript">
							$("#bootbox-regular").on(ace.click_event, function() {
									bootbox.prompt("What is your name?", function(result) {
										if (result === null) {
											
										} else {
											
										}
									});
								});
							</script>	
                <div class="row">
                    
                    <!-- column -->
                  
                    <div class="col-12">
                        
                        <div class="card">
                            <div class="card-body">
                                
                                <div style="float:right">

								<a href="#modal-form" role="button" class="blue btn btn-primary" data-toggle="modal" onClick="addform()"> <i class="ace-icon fa fa-plus bigger-120"></i>Add New Bank </a>
								<script language="javascript">
									function addform()
									{
										document.getElementById("HIDACTION").value = "INSERT";
									}
								</script>
								
								
<!-------------------------------------- INSERT EDIT MODEL START ----------------------->								
							
							</div>
                                <div class="table-responsive">
                                   	<table class="table table-striped" style="color:#000000;font-weight:normal;font-family:sans-serif;font-size:14px;overflow:hidden">
											<thead>
												<tr>
													
													<th class="detail-col">Sr.</th>
													<th>Account Name</th><th>Bank Name</th><th>Account Number</th><th>IFSC</th><th>Branch</th><th>DateTime</th>
													<th></th>
												</tr>
											</thead>

											<tbody><?php $i=1;foreach($data->result() as $row)
										{ ?><tr>
													<td><a href="#"><?php echo $i; ?></a></td>
													<td>
    													<?php echo $row->account_name; ?>
    													<input type="hidden" id="hidaccount_name<?php echo $row->Id; ?>" value="<?php echo $row->account_name; ?>">
													</td>
													<td><?php echo $row->bank_name; ?>
														<input type="hidden" id="hidbank_id<?php echo $row->Id; ?>" value="<?php echo $row->bank_id; ?>">
													</td>
													
													
													<td><?php echo $row->account_number; ?>
														<input type="hidden" id="hidaccount_number<?php echo $row->Id; ?>" value="<?php echo $row->account_number; ?>">
													</td>
													
													<td><?php echo $row->ifsc; ?>
														<input type="hidden" id="hidifsc<?php echo $row->Id; ?>" value="<?php echo $row->ifsc; ?>">
													</td>
													
													<td><?php echo $row->branch; ?>
														<input type="hidden" id="hidbranch<?php echo $row->Id; ?>" value="<?php echo $row->branch; ?>">
													</td>
													
													
													
													<td class="hidden-480"><?php echo $row->add_date; ?></td>
													
													<td>
														<div class="hidden-sm hidden-xs btn-group">
															<button class="btn btn-xs btn-success">
																<i class="ace-icon fa fa-check bigger-120"></i>															</button>

															<button class="btn btn-xs btn-info" onClick="editform(<?php echo $row->Id; ?>)" href="#modal-form" data-toggle="modal">
																<i class="ace-icon fa fa-pencil bigger-120"></i>Edit															</button>
																<script language="javascript">
																function editform(id)
																{
																    
																	document.getElementById("hidPrimaryId").value =  id;
																	document.getElementById("HIDACTION").value =  "UPDATE";
																	
																	document.getElementById("account_name").value =  document.getElementById("hidaccount_name"+id).value;
																	document.getElementById("ddlbank").value =  document.getElementById("hidbank_id"+id).value;
																	document.getElementById("account_number").value =  document.getElementById("hidaccount_number"+id).value;
																	document.getElementById("ifsc").value =  document.getElementById("hidifsc"+id).value;
																	document.getElementById("branch").value =  document.getElementById("hidbranch"+id).value;
																}
																</script>

															<button class="btn btn-xs btn-danger" onClick="deletitem(<?php echo $row->Id; ?>)" href="#modal-formdelete" data-toggle="modal">
																<i class="ace-icon fa fa-trash-o bigger-120"></i>Delete															</button>
																<script language="javascript">
																function deletitem(id)
																{
																	document.getElementById("hidPrimaryId").value =  id;
																	document.getElementById("HIDACTION").value =  "DELETE";
																}
																</script>

															<button class="btn btn-xs btn-warning">
																<i class="ace-icon fa fa-flag bigger-120"></i>															</button>
														</div>
													</td>
												</tr><?php $i++;} ?>

												

											</tbody>
										</table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                	<!-------------------------------------- INSERT EDIT MODEL START ----------------------->								
								<div id="modal-form" class="modal" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="blue bigger">Please fill the following form fields</h4>
											</div>

											<div class="modal-body">
												<div class="row">
													
													<div class="col-xs-12 col-sm-7">
													<form id="frmPopup" method="post" action="">
													<input type="hidden" id="hidPrimaryId" name="hidPrimaryId">
													
																<input type="hidden" id="HIDACTION" name="HIDACTION" value="INSERT">
																<div class="form-group">
																<label for="form-field-select-3" style="color:#000000"><b>Bank Name</b></label>
																<div>
																	<select name="ddlbank" id="ddlbank" class="form-control"  style="color:#000">
																	<option value="0">Select</option>
																	<?php 
																	$bankresult  = $this->db->query("select bank_name,bank_id from tblbank order by bank_name");
																	foreach($bankresult->result() as $bank)
																	{
																	?>
																	<option value="<?php echo $bank->bank_id; ?>"><?php echo $bank->bank_name; ?></option>
																	<?php } ?>
																</select>
																</div>
															</div>
															<div class="space-4"></div>
															
															<div class="form-group">
																<label for="form-field-select-3" style="color:#000000"><b>Account Name</b></label>
																<div>
																	<input type="text" name="account_name" id="account_name" class="form-control" style="color:#000">
																</div>
															</div>
															<div class="space-4"></div>
															
															
															<div class="form-group">
																<label for="form-field-select-3" style="color:#000000"><b>Account Number</b></label>
																<div>
																	<input type="text" name="account_number" id="account_number" class="form-control" style="color:#000">
																</div>
															</div>
															<div class="space-4"></div>
															
															<div class="form-group">
																<label for="form-field-select-3" style="color:#000000"><b>IFSC</b></label>
																<div>
																	<input type="text" name="ifsc" id="ifsc" class="form-control" style="color:#000">
																</div>
															</div>
															<div class="space-4"></div>
															
															<div class="form-group">
																<label for="form-field-select-3" style="color:#000000"><b>Branch</b></label>
																<div>
																	<input type="text" name="branch" id="branch" class="form-control" style="color:#000">
																</div>
															</div>
															<div class="space-4"></div>
															
															
														</form>
													</div>
												</div>
											</div>

											<div class="modal-footer">
												<button class="btn btn-sm" data-dismiss="modal">
													<i class="ace-icon fa fa-times"></i>
													Cancel
												</button>

												<button id="btnPopupSave" class="btn btn-sm btn-primary" onClick="validateandsubmit()">
													<i class="ace-icon fa fa-check"></i>
													Save
												</button>
												<script language="javascript">
												function validateandsubmit()
												{
													document.getElementById("frmPopup").submit();
												}
												</script>
											</div>
										</div>
									</div>
								</div>
							</div>
<!----------xxxxxxxxxxxxxxxxxxx INSERT EDIT MODEL END   xxxxxxxxxxxxxxxxxx------------>	


<!-------------------------------------- DELETE MODEL START ----------------------->								
								<div id="modal-formdelete" class="modal" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="blue bigger">Are You Soure Want To Delete <span id="spanDeletePopupName"></span></h4>
											</div>
											<div class="modal-footer">
												<button class="btn btn-sm" data-dismiss="modal">
													<i class="ace-icon fa fa-times"></i>
													Cancel
												</button>

												<button id="btnPopupSave" class="btn btn-sm btn-primary" onClick="deletesubmit()">
													<i class="ace-icon fa fa-check"></i>
													Yes
												</button>
												<script language="javascript">
													function deletesubmit()
													{
														document.getElementById("HIDACTION").value="DELETE";
														document.getElementById("frmPopup").submit();
													}
												</script>
											</div>
										</div>
									</div>
								</div>
							</div>
<!----------xxxxxxxxxxxxxxxxxxx INSERT EDIT MODEL END   xxxxxxxxxxxxxxxxxx------------>		
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <?php include("files/rightbar.php"); ?>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © 2019 TULSYANRECHARGE.COM
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/plugins/popper/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="../js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="../js/custom.min.js"></script>
    <!-- jQuery peity -->
    <script src="../assets/plugins/peity/jquery.peity.min.js"></script>
    <script src="../assets/plugins/peity/jquery.peity.init.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>