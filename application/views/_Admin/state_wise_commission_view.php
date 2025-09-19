<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    

    <title>Statewise Commission</title>

    
     
    
	<?php include("elements/linksheader.php"); ?>
    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
   <script language="javascript">
	  	function getData()
		{
		if(document.getElementById("ddlgroup").value != 0)
		{
				$.ajax({
				url:'<?php echo base_url(); ?>_Admin/state_wise_commission/getresult?groupid='+document.getElementById("ddlgroup").value+'&user='+document.getElementById('ddluser').value,
				method:'POST',
				cache:false,
				success:function(msg)
				{
					document.getElementById("ajxdata").style.display = "block";
					document.getElementById("ajaxload").style.display = "none";
					document.getElementById("ajxdata").innerHTML = msg;
				}
			
			
			});
		}
		else
		{
			document.getElementById("ajxdata").innerHTML = "";
		}
		}
		
		function changeall()
        {
            var ids = document.getElementById("hidcircle_ids").value;
           
            var struserarr = ids.split(",");
            for(i=0;i<struserarr.length;i++)
        	{
        		var id = struserarr[i];
        		changecommission(id);
        	}
        }
		function changecommission(id)
		{
		var com = document.getElementById("txtComm"+id).value;
		var comtype = document.getElementById("ddlcommission_type"+id).value;
		
		document.getElementById("ajaxprocess").style.display = "block";
		
		
			
			
		document.getElementById("modelmp_failure_msg_BDEL").innerHTML ="";
		document.getElementById("modelmp_success_msg_BDEL").innerHTML ="";
		document.getElementById("responsespansuccess_BDEL").style.display = "none";
		document.getElementById("responsespanfailure_BDEL").style.display = "none";	
			
		if(com.length >= 1 || comAmt.length >= 1)
		{
		
		$.ajax({
  url: '<?php echo base_url(); ?>_Admin/state_wise_commission/changecommission?company_id='+document.getElementById("cid").value+'&com='+com+'&circle_id='+id+'&mincom=0&maxcom=0&comtype='+comtype+'&user='+document.getElementById("uid").value,
  type: 'POST',
  success:function(html)
  {
  	document.getElementById("ajaxprocess").style.display = "none";
  	getData();
	  
	  
	  
	if(html == "OK")
	{
		document.getElementById("modelmp_success_msg_BDEL").innerHTML ="Commission Updated Successfully";
		document.getElementById("responsespansuccess_BDEL").style.display = "block";
		$('#myMessgeModal').modal({show:true});
	}
	else
	{
		document.getElementById("modelmp_failure_msg_BDEL").innerHTML =html;
		document.getElementById("responsespanfailure_BDEL").style.display = "block";
		$('#myMessgeModal').modal({show:true});
	}
  },
  complate:function(msg)
  {
  	document.getElementById("ajaxprocess").style.display = "none";
  	getData();
  }
});
        }
		}
	  </script>
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
          <span class="breadcrumb-item active">Statewise Commission Settings</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="br-pagetitle">
        <div>
          <h4>Statewise Commission Setting</h4>
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
			                  <td align="left">
			                  	<h5>Select Operator</h5>
			                  <select id="ddlgroup" name="ddlgroup"  style="font-size:20px;width:200px;height:40px;">
			                   <option value="0">Select</option>
			                  <?php
			                  	$group_rslt = $this->db->query("select company_id,company_name from tblcompany where service_id = 1 order by company_name");
			                  	foreach($group_rslt->result() as $row)
			                  	{
			                   ?>
			                   <option value="<?php echo $row->company_id; ?>"><?php echo $row->company_name; ?></option>
			                   <?php } ?>
			                  </select>
			                  <script language="javascript">
			                  	document.getElementById('ddlgroup').value = '12';
			                  </script>
			                  </td>


							<td align="left">
								<h5>Select User</h5>
			                  <select id="ddluser" name="ddluser" onchange="getData()"  style="font-size:20px;width:200px;height:40px;">
			                   <option value="0">Select</option>
			                  <?php
			                  	$user_rslt = $this->db->query("select user_id,businessname from tblusers where usertype_name = 'APIUSER' order by businessname");
			                  	foreach($user_rslt->result() as $urow)
			                  	{
			                   ?>
			                   <option value="<?php echo $urow->user_id; ?>"><?php echo $urow->businessname; ?></option>
			                   <?php } ?>
			                  </select>
			                  </td>
	                  	</tr>
	                  	<tr>
			                  
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
      
      	<div class="row row-sm mg-t-20">
          <div class="col-sm-12 col-lg-12">
         	<div class="card shadow-base bd-0">
              <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h6 class="card-title tx-uppercase tx-12 mg-b-0">Circle List</h6>
                <span class="tx-12 tx-uppercase"></span>
              </div><!-- card-header -->
              <div class="card-body">
                <div id="ajxdata"></div>
                                <div id="ajaxload" style="display:none;">
                                	<img src="<?php echo base_url()."ajax-loader.gif"?>">
                                </div>
              </div><!-- card-body -->
            </div>
            
        </div>
        </div>
      </div><!-- br-pagebody -->
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
