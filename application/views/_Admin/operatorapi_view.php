<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    

    <title>API PRIORITY</title>

    
     
    
	<?php include("elements/linksheader.php"); ?>
     <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
function SetEdit(value)
	{
		document.getElementById('txtAPIName').value=document.getElementById("name_"+value).innerHTML;
		document.getElementById('txtUserName').value=document.getElementById("uname_"+value).innerHTML;		
		document.getElementById('txtPassword').value=document.getElementById("pwd_"+value).innerHTML;
		document.getElementById('txtIp').value=document.getElementById("ipaddr_"+value).innerHTML;
		document.getElementById('ddlhttpmethod').value=document.getElementById("method_"+value).innerHTML;
		document.getElementById('txtparameters').value=document.getElementById("params_"+value).innerHTML;
		document.getElementById('ddlstatus').value=document.getElementById("hidstatus_"+value).value;
		
		
		document.getElementById('txtToken').value=document.getElementById("token_"+value).innerHTML;
		
		
		
		
		
		document.getElementById('btnSubmit').value='Update';
		document.getElementById('hidID').value = value;
		//document.getElementById('myLabel').innerHTML = "Edit API";
	}
</script>
<script>
	
$(document).ready(function(){
document.getElementById("ddlcompany").value = '<?php echo $company_id; ?>';
});
	
	
	</script>
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
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
}
</style>
    <style>
	.error
	{
  		background-color: #ffdddd;
	}
	</style>
    <style>
.error
{
	background-color:#D9D9EC;
}
div.DialogMask
{
    padding: 10px;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 50;
    background-color: #606060;
    filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=50);
    -moz-opacity: .5;
    opacity: .5;
}
#myOverlay{position:absolute;height:100%;width:100%;}
#myOverlay{background:black;opacity:.7;z-index:2;display:none;}
#loadingGIF{position:absolute;top:40%;left:45%;z-index:3;display:none;}
</style>
<style>
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
	padding-top:2px;
	padding-bottom:2px;
	padding-left:4px;
	padding-right:4px;
    /*line-height: 1.42857143;*/
	
    vertical-align: middle;
    border-top: 1px solid #ddd;
}
	</style>
  </head> 

  <body>
<div class="DialogMask" style="display:none"></div>
   <div id="myOverlay"></div>
<div id="loadingGIF"><img style="width:100px;" src="<?PHP echo base_url(); ?>Loading.gif" /></div>
    <!-- ########## START: LEFT PANEL ########## -->
    
    <?php include("elements/sidebar.php"); ?><!-- br-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("elements/header.php"); ?><!-- br-header -->
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    <?php include("elements/rightbar.php"); ?><!-- br-sideright -->
    <!-- ########## END: RIGHT PANEL ########## --->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="<?php echo base_url()."_Admin/dashboard"; ?>">Dashboard</a>
          <a class="breadcrumb-item" href="#">API</a>
          <span class="breadcrumb-item active">API PRIORITY</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="br-pagetitle">
        <div>
          <h4>API PRIORITY</h4>
        </div>
      </div><!-- d-flex -->

      <div class="br-pagebody">
      	<div class="row row-sm mg-t-20">
          <div class="col-sm-6 col-lg-12">
            <div class="card shadow-base bd-0">
              <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h6 class="card-title tx-uppercase tx-12 mg-b-0">Search Filters</h6>
                <span class="tx-12 tx-uppercase"></span>
              </div><!-- card-header -->
              <div class="card-body">
                  <div id="ajaxprocess" style="display:none">
                  <img src="<?php echo base_url(); ?>ajax-loader_bert.gif">
                  </div>
                 <form action="<?php echo base_url()."_Admin/operatorapi?crypt=".$this->Common_methods->encrypt("MyData"); ?>" method="post" name="frmCallAction" id="frmCallAction">                            
                                    <table cellspacing="10" cellpadding="3">                                     
                                    <tr>
                                    <td> <h5>Select Operator</h5>  </td>                                     
                                    	<td style="padding-right:10px;">                                         	 
                                       
                                        <select id="ddlcompany" name="ddlcompany" class="form-control-sm">
                                        	<option value="0"></option>
                                            <?php
												$rsltcompany = $this->db->query("select a.company_id,a.company_name from tblcompany a where a.service_id = 1 or a.service_id = 2 or a.service_id = 3");
												foreach($rsltcompany->result() as $rw)
												{?>
												<option value="<?php echo $rw->company_id; ?>"><?php echo $rw->company_name; ?></option>
												<?php }
											 ?>
                                        </select>
                                        </td>                                     	
                                        
                                        <td valign="bottom">                                         
                                        <input type="button" id="btnSubmit" name="btnSearch" value="Search" class="btn btn-primary btn-sm" onClick="getapilist()">                                                                                 
                                        </td>                                     
                                      </tr>                                     
                                     </table>                                                                                                                                                              
                                     </form>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-4 -->
        </div>
      <?php 
						$apiddl= $this->Api_model->getApiListForDropdownList();
						
					 ?>
      	<div class="row row-sm mg-t-20">
          <div class="col-sm-12 col-lg-12">
         	<div class="card shadow-base bd-0">
              <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h6 class="card-title tx-uppercase tx-12 mg-b-0">Operator List</h6>
                <span class="tx-12 tx-uppercase"></span>
              </div><!-- card-header -->
              <div class="card-body">
                <div id="activeapilist"></div>
              </div><!-- card-body -->
              <div class="card-body">
                <div id="deactiveapilist"></div>
              </div><!-- card-body -->
            </div>
            
        </div>
        </div>
      </div><!-- br-pagebody -->
      
      
       <script language="javascript">
       
        function getapilist()
        {
            document.getElementById("activeapilist").innerHTML = "";
			document.getElementById("deactiveapilist").innerHTML = "";
            $('#myOverlay').show();
    		$('#loadingGIF').show();
					
					$.ajax({
						url:document.getElementById("hidgetapilisturl").value,
						cache:false,
						data:{ "company_id":document.getElementById("ddlcompany").value} ,
						method:'POST',
						type:'POST',
						success:function(htmldata)
						{
							var resparray = htmldata.split("^-^");
							document.getElementById("activeapilist").innerHTML = resparray[0];
							document.getElementById("deactiveapilist").innerHTML = resparray[1];
							
						},
						error:function()
						{
							//document.getElementById("modalmptitle").innerHTML  = "Verification Request Failed";
							//document.getElementById("responsespanfailure").style.display = 'block'
							//document.getElementById("modelmp_failure_msg").innerHTML = "Internal Server Error. Please try Later..";
						},
						complete:function()
						{
							 $('#myOverlay').hide();
							$('#loadingGIF').hide();
							
						}
						});
        }
       
       
       
       
			function updateoperatorapi(id)
			{
				
					 $('#myOverlay').show();
    				$('#loadingGIF').show();
					
					
					
					if(document.getElementById("md_checkbox_"+id).checked)
					{
						var status = "1";
					}
					else
					{
						var status = "0";
					}
					var multi = "no";
					var reroot = "no";
					var series = "no";
					
				
				
					
					
					var ddlrerootapi = 0;
					
					
					var amtrange = 0;
					$.ajax({
						url:document.getElementById("hidbregvalurl").value,
						cache:false,
						data:{ "company_id":document.getElementById("hidcompany_id"+id).value , "api_id" :id,"status":status,"failurelimit":document.getElementById("txtFailureLimit"+id).value,"pendinglimit":document.getElementById("txtPendingLimit"+id).value,"priority":document.getElementById("txtPriority"+id).value,"multi":multi,"reroot":reroot,"reroot_api_id":ddlrerootapi,"series":series,"amtrange":amtrange} ,
						method:'POST',
						type:'POST',
						success:function(data)
						{
							
							document.getElementById("totalpending_"+id).innerHTML = data;
							
						},
						error:function()
						{
							//document.getElementById("modalmptitle").innerHTML  = "Verification Request Failed";
							//document.getElementById("responsespanfailure").style.display = 'block'
							//document.getElementById("modelmp_failure_msg").innerHTML = "Internal Server Error. Please try Later..";
						},
						complete:function()
						{
							 $('#myOverlay').hide();
							$('#loadingGIF').hide();
							getapilist();
						}
						});
				
			}
			function updateoperatorapi2(id)
			{
				
					 $('#myOverlay').show();
    				$('#loadingGIF').show();
					
					
					
				
				
					if(document.getElementById("md_checkbox_series_"+id).checked)
					{
						var series = "yes";
					}
					else
					{
						var series = "no";
					}
				
				
					
					
				
					$.ajax({
						url:document.getElementById("hidapienabledisable").value,
						cache:false,
						data:{ "company_id":document.getElementById("hidcompany_id"+id).value , "api_id" :id,"series":series} ,
						method:'POST',
						type:'POST',
						success:function(data)
						{
							
							//document.getElementById("totalpending_"+id).innerHTML = data;
							
						},
						error:function()
						{
							//document.getElementById("modalmptitle").innerHTML  = "Verification Request Failed";
							//document.getElementById("responsespanfailure").style.display = 'block'
							//document.getElementById("modelmp_failure_msg").innerHTML = "Internal Server Error. Please try Later..";
						},
						complete:function()
						{
							 $('#myOverlay').hide();
							$('#loadingGIF').hide();
						//	document.getElementById("frmCallAction").submit();
						}
						});
				
			}
		</script>
   <input type="hidden" id="hidbregvalurl" value="<?php echo base_url()."_Admin/operatorapi"; ?>">
    <input type="hidden" id="hidapienabledisable" value="<?php echo base_url()."_Admin/operatorapi/apienabledisable"; ?>">
    <input type="hidden" id="hidgetapilisturl" value="<?php echo base_url()."_Admin/operatorapi/getapilist"; ?>">
   
      
      <div class="modal fade" id="myMessgeModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
         <!-- <button type="button" class="close" data-dismiss="modal">&times;</button>-->
          <h4 class="modal-title" id="modalmptitle_BDEL">Response Message</h4>
          
        </div>
        <div class="modal-body">
        
          <div id="responsespansuccess_BDEL" style="display:none">
          		<div class="divsmcontainer success">
                  <strong id="modelmp_success_msg_BDEL"></strong>
                </div>
          </div>
          <div id="responsespanfailure_BDEL" style="display:none">
          		<div class="divsmcontainer success">
                  <strong id="modelmp_failure_msg_BDEL"></strong>
                </div>
          </div>
          
        </div>
        <div class="modal-footer">
         <span id="spanbtnclode"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button></span>
        </div>
      </div>
    </div>
  </div>          
      <?php include("elements/footer.php"); ?>
    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <script src="<?php echo base_url();?>lib/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>lib/jquery-ui/ui/widgets/datepicker.js"></script>
    <script src="<?php echo base_url();?>lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url();?>lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url();?>lib/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url();?>lib/peity/jquery.peity.min.js"></script>
    <script src="<?php echo base_url();?>lib/highlightjs/highlight.pack.min.js"></script>

    <script src="<?php echo base_url();?>js/bracket.js"></script>
  </body>
</html>
