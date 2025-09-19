<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    

    <title>Group Commission</title>

    
     
    
	<?php include("elements/linksheader.php"); ?>
    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
   <script language="javascript">
	  
	  </script>
	      <style>
	 .odd { 
        background-color: #FCF7F7;
      }
    .even {
        background-color: #E3DCDB;
    }
	
	 </style>
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
	 .odd { 
        background-color: #FCF7F7;
      }
    .even {
        background-color: #E3DCDB;
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
          <a class="breadcrumb-item" href="#">Settings</a>
          <span class="breadcrumb-item active">Group Commission Settings</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="br-pagetitle">
        <div>
          <h4>Commission Setting</h4>
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
                 <form method="post"  name="frmscheme_view" id="frmscheme_view" autocomplete="off">
<div class="breadcrumb" style="padding:20px;">
<table>
<tr>
<td>
<table cellpadding="3" cellspacing="3" border="0">
	<tr>
        <td align="right">
            <label for="txtGroupName" style="font-size:20px;"><span style="color:#F06">*</span>Group Name :</label></td><td align="left">
           <input type="text" name="txtGroupName" id="txtGroupName" class="form-control" value="<?php echo $group_info->row(0)->group_name; ?>">
            
        </td>
    </tr>
    
</table>
</td>
</tr>
</table>
</div>
<input type="hidden" id="hidID" name="hidID" />
</form>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-4 -->
        </div>
        
        
<?php
$slaboptions = $this->Commission->getCommissionSlab_dropdown_options();


$str_company_id = "";
foreach($service_array as $service_rw)
{

?>  
      	<div class="row row-sm mg-t-20">
          <div class="col-sm-12 col-lg-12">
         	<div class="card shadow-base bd-0">
              <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h6 class="card-title tx-uppercase tx-12 mg-b-0"><?php echo  $service_rw; ?></h6>
                <span class="tx-12 tx-uppercase"></span>
              </div><!-- card-header -->
              <div class="card-body">
                  <table  class="table table-bordered table-striped" style="color:#00000E">
                      <thead class="thead-colored thead-primary" >
                    <tr>
                        <th>Sr</th>
                        <th>Company Name</th>
                        <th>Operator Code</th>
                        <th>Commission</th>
                        <th>Is Percent</th>
                        <th></th>
                        <th>Slab</th>
                    </tr> 
                    </thead>
                  
                <?php 
                $i=1;
                    $dataarr = $data[$service_rw];
                    foreach( $dataarr as $opar)
                    {
                         $str_company_id.=$opar->company_id.",";
                    ?>
                       <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $opar->company_name; ?></td>
                            <td><?php echo $opar->mcode; ?></td>
                            <td>
                                <input type="text" id="txtComm<?php echo $opar->company_id; ?>" name="txtComm<?php echo $opar->company_id; ?>" value="<?php echo $opar->commission; ?>" class="form-control" style="width:120px">
                            </td>
                            <td>
                                <select  id="ddlcommtype<?php echo $opar->company_id; ?>" name="ddlcommtype<?php echo $opar->company_id; ?>" class="form-control" style="width:120px">
                                    <option value="PER">%</option>
                                    <option value="AMOUNT">AMOUNT</option>
                                </select>
                                <script language="javascript">document.getElementById("ddlcommtype"+<?php echo $opar->company_id; ?>).value = '<?php echo $opar->commission_type; ?>';</script>
                            </td>
                            <td>or</td>
                            <td>
                                <select  id="ddlslab<?php echo $opar->company_id; ?>" name="ddlslab<?php echo $opar->company_id; ?>" class="form-control" style="width:120px">
                                    <option value="0"></option>
                                    <?php echo $slaboptions; ?>
                                </select>
                                <script language="javascript">document.getElementById("ddlslab"+<?php echo $opar->company_id; ?>).value = '<?php echo $opar->commission_slab; ?>';</script>
                            </td>
                        </tr>
                       
                    <?php $i++;}
                
                ?>
                </table>
                
              </div><!-- card-body -->
            </div>
            
        </div>
        </div>
<?php } ?> 
<div>
    <input type="hidden" id="hidcompany_ids" value="<?php echo $str_company_id; ?>">
    <center>
        <input type="button" id="btnSubmitAll" name="btnSubmitAll" value="Update All" class="btn btn-primary btn-lg" onClick="changeCommission_all()">
        <img style="width:60px;display:none" id="imgloadingbtn" src="<?php echo base_url()."Loading.gif"; ?>" ></span>
        </center>   
    
    <script language="javascript">
function changealldata()
{
    //  $('#myOverlay').show();
    //  $('#myModal').modal({show:true});
    var ids = document.getElementById("hidcompany_ids").value;
    var struserarr = ids.split(",");
    for(i=0;i<struserarr.length;i++)
	{
	     document.getElementById("imgloadingbtn").style.display="block";
		var id = struserarr[i];
		changeCommission(id);
		 document.getElementById("imgloadingbtn").style.display="none";
	}
    //  $('#myModal').modal('hide');
    //  $('#myModal').hide();
}
function changeCommission(id)
{
  
	var company_id = id;
	var commission = document.getElementById("txtComm"+id).value;
	var commission_type = document.getElementById("ddlcommtype"+id).value;
	var commission_slab = document.getElementById("ddlslab"+id).value;
	var group_id ='<?php echo $group_info->row(0)->Id; ?>';
	if(commission <= 5)
	{
	  if(company_id > 0)
	  {
	      
		$.ajax({
          type: "POST",
          url:'<?php echo base_url();?>_Admin/commission_settings/ChangeCommission',
          cache:false,
          data:{'company_id':company_id,'group_id':group_id,'commission':commission,'commission_type':commission_type,'commission_slab':commission_slab},
          beforeSend: function() 
		  {
           
          },
          success: function(html)
          {
            
          },
          complete:function()
    	  {
    		  // document.getElementById("imgloadingbtn").style.display="none";
    			//$('#myLoader').hide();
    	  }
        });
	  }
    }
  
	
}
function changeCommission_all()
{
    var params = new Array()
   var ids = document.getElementById("hidcompany_ids").value;
   var struserarr = ids.split(",");
   for(i=0;i<struserarr.length;i++)
   {
       var jcompany_id = struserarr[i];
       if(jcompany_id > 0)
       {
           params[jcompany_id]= document.getElementById("txtComm"+jcompany_id).value+"@"+document.getElementById("ddlcommtype"+jcompany_id).value+"@"+document.getElementById("ddlslab"+jcompany_id).value;
       }
       
       
       
   }
   $.ajax({
          type: "POST",
          url:'<?php echo base_url();?>_Admin/commission_settings/ChangeCommission',
          cache:false,
          data:{'params':params,'group_id':'<?php echo $group_info->row(0)->Id; ?>'},
          beforeSend: function() 
		  {
		    document.getElementById("imgloadingbtn").style.display="block";
            $('#myModal').modal({show:true});
          },
          success: function(html)
          {
            console.log( html );
          },
          complete:function()
    	  {
    		document.getElementById("imgloadingbtn").style.display="none";
    		$('#myModal').modal('hide');
    		$('#myModal').hide();
    	  }
        });
  
	

	
	 
	  
	      
		
	  
    
  
	
}
</script>
    
</div>

      </div><!-- br-pagebody -->
      
      
      <div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog modal-sm">
					  <div class="modal-content">
						<div class="modal-header">
						 <!-- <button type="button" class="close" data-dismiss="modal">&times;</button>-->
						  <h4 class="modal-title" id="modaltitle">Please wait we process your data.</h4>

						</div>
						<div class="modal-body">
						<span id="spanloader">
						  <img style="width:120px" id="imgloading" src="<?php echo base_url()."Loading.gif"; ?>"></span>
						  <span id="responsespan" class="alert alert-primary"  style="font-weight: bold;display:none"></span>
						</div>
						<div class="modal-footer">
						 <span id="spanbtnclode" style="display:none"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button></span>
						</div>
					  </div>
					</div>
				</div>  
      
      
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
