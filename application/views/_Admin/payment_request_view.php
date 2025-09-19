<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    

   <title>Payment Request</title>

    
     
    
	<?php include("elements/linksheader.php"); ?>
    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script>
	 	
$(document).ready(function(){
    document.getElementById("ddlbank").value = '<?php echo $ddlbank; ?>';
 $(function() {
            $( "#txtFrom" ).datepicker({dateFormat:'yy-mm-dd'});
            $( "#txtTo" ).datepicker({dateFormat:'yy-mm-dd'});
         });
});
	
	
	</script>
	<input type="hidden" id="hidurl" value="<?php echo base_url()."_Admin/payment_request/updaterequest"; ?>">
      <script language="javascript">
function validateform(id)
{
	var txtAmount = $('#txtAmount'+id);
	var txnPwd = $('#txnPwd'+id);
	var ddlstatus = $('#ddlstatus'+id);
	var txtAdminRemark = $('#txtAdminRemark'+id);
	var hidamount = $('#hidamount'+id);
	if(hidamount.val().trim() != txtAmount.val().trim())
	{
		alert("Confirm Amount Not Match With Amount");
		return false;
	}
	document.getElementById('divaltmsg').style.display = 'none';
	var hidrul = document.getElementById('hidurl').value;
	
	if(validatefield(txtAmount) & validatefield(txnPwd) & validatefield(ddlstatus) & validatefield(txtAdminRemark))
	{
		$('.DialogMask').show();
		document.getElementById('divaltmsg').style.display = 'none';
		document.getElementById('trmob').style.display = 'table-row';
		$.ajax( {
		  type: "POST",
		  url:hidrul+'?amount='+txtAmount.val()+'&txnPwd='+txnPwd.val()+'&ddlstatus='+ddlstatus.val()+'&txtAdminRemark='+txtAdminRemark.val()+'&hidid='+id+'&hidamount='+hidamount.val().trim(),
		  success: function( response) 
		  {
		      
		      if(response == "Fund Transfer Successfully")
		      {
		         $("#divaltmsg").addClass("alert-success");
		         document.getElementById("spanmsgtype").innerHTML = "Success";
		         
		      }
		      else
		      {
		          $("#divaltmsg").addClass("alert-danger");
		          document.getElementById("spanmsgtype").innerHTML = "Failed";
		      }
		  		document.getElementById('trmob').style.display = 'none';
				document.getElementById('trmobmsg').style.display = 'table-row';
				document.getElementById('divaltmsg').style.display = 'block';
				document.getElementById('spanmsg').innerHTML = response;
				$('.DialogMask').hide();
				window.location.reload();
      	  }
    } );
		
	}
	else
	{
		alert("Please Fill All The Fields");
	}
	
}
function validatefield(param)
{
	if(param.val() == "")
	{
		param.addClass("error");
		return false;
	}
	else
	{
		param.removeClass("error");
		return true;
	}
}
</script>
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
.Reject
{
	background-color:#D9D9EC;
}
.Approve
{
	background-color:#228B22;
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
h5 {
    color: black;
    font-family: times;
    font-weight: bold;
    font-size: 15px;
}
input {
  border: 1px solid ;
  background-color: #ffffff;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  background-color: #ffffff;
  width: 100%;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}

.autocomplete-items {
  position: absolute;
  border: 2px solid black;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
  width:100px;
  height:43px;
}


.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
th {
  font-size:20px;
  color: white;
  font-family: times;
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
          <a class="breadcrumb-item" href="#">Payment Request</a>
          <span class="breadcrumb-item active">Payment Request</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="br-pagetitle">
        <div>
          <h4>Payment Request</h4>
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
                  <form action="<?php echo base_url()."_Admin/payment_request?crypt=".$this->Common_methods->encrypt("MyData"); ?>" method="post" name="frmCallAction" id="frmCallAction">
                           <input type="hidden" id="hidID" name="hidID">
                                    <table cellspacing="10" cellpadding="3">
                                    <tr>
                                    <td style="padding-right:10px;">
                                    <button class="btn btn-primary btn-sm" type="button" style="font-size:24px;border-radius: 10px;width:180px;">&nbsp;From Date</button><br><br>
                                            <input class="autocomplete" value="<?php echo $from; ?>" id="txtFrom" name="txtFrom" type="text" style="width:180px;" placeholder="Select Date">
                                        </td>
                                    	<td style="padding-right:10px;">
                                      <button class="btn btn-primary btn-sm" type="button" style="font-size:24px;border-radius: 10px;width:180px;background-color: #4CAF50;">&nbsp;TO Date</button><br><br>
                                            <input class="autocomplete" id="txtTo" value="<?php echo $to; ?>" name="txtTo" type="text" style="width:180px;" placeholder="Select Date">
                                        </td>
                                        <td style="padding-right:10px;">
                                        <button class="btn btn-primary btn-sm" type="button" style="font-size:24px;width:180px;border-radius:10px;background-color: #824caf;">&nbsp;BANK</button><br><br>
                                            <select id="ddlbank" name="ddlbank" style="width:180px;height:45px;border: 2px solid black" class="autocomplete">
                                                <option value="ALL">ALL</option>
                                                <option value="SBI">SBI</option>
                                                <option value="ICICI">ICICI</option>
                                                <option value="AXIS">AXIS</option>
                                                <option value="BOI">BOI</option>
                                                <option value="UNION">UNION</option>
                                                
                                            </select>
                                        </td>
                                        <td valign="bottom">
                                        <input type="submit" id="btnSearch" name="btnSearch" value="Search" class="btn btn-primary">
                                        
                                        </td>
                                    </tr>
                                    </table>
                                        
                                       
                                       
                                    </form>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-4 -->
        </div>
      <div class="row row-sm mg-t-20">
          <div class="col-sm-12 col-lg-12">
         	<div class="card shadow-base bd-0">
              
              <div class="card-body">
                 <table>
                    <tr id="trmob" style="display:none">
    	<td align="center" colspan="2" >
            <img src="<?php echo base_url()."ajax-loader_bert.gif"; ?>"/>
        </td>
        
    </tr><tr id="trmobmsg" style="display:none">
    	<td align="center" colspan="2">
        	<span id="mobmsg" class="mobmsg"></span>
        </td>
        
    </tr></table>
            		<div id="divaltmsg" class="alert alert-dismissable" style="display:none">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4>	<i class="icon fa fa-check"></i> <span id="spanmsgtype"></span></h4>
                   <span id="spanmsg"></span>
                  </div>
                  			
              </div><!-- card-body -->
            </div>
            
        </div>
        </div>
      	<div class="row row-sm mg-t-20">
          <div class="col-sm-12 col-lg-12">
         	<div class="card shadow-base bd-0">
              <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h6 class="card-title tx-uppercase tx-12 mg-b-0">PAYMENT REQUEST LIST</h6>
                <span class="tx-12 tx-uppercase"></span>
              </div><!-- card-header -->
              <div class="card-body">
                 <?php if($result_mdealer != false){ ?>
 
                  <table class="table table-striped tx-uppercase" style="color:#000000;font-weight:normal;font-family:times;font-size:15px;overflow:hidden">
    <tr>
    <tr style="background-color:#f01d75;font-size:16px;text-align=center;font-weight:bold">
		<th style="font-size:20px;color: white;font-family: times"></th>
		<th style="font-size:20px;color: white;font-family: times">Payment<br> Date</th>
		<th style="font-size:20px;color: white;font-family: times">Id</th>
		<th style="font-size:20px;color: white;font-family: times">Agent<br> Name</th>
		<th style="font-size:20px;color: white;font-family: times">Wallet<br> Type</th>
		
		<th style="font-size:20px;color: white;font-family: times">Ref.Id/<br> Branch</th>
		<th style="font-size:20px;color: white;font-family: times">Amount</th>
		
		<th style="font-size:20px;color: white;font-family: times">Conf.Amount</th>
		<th style="font-size:20px;color: white;font-family: times">Txn.Pwd</th>
		<th style="font-size:20px;color: white;font-family: times">Status</th>
		<th style="font-size:20px;color: white;font-family: times">Admin<br> Remark</th>
		<th style="font-size:20px;color: white;font-family: times">Action</th>
    </tr>
    </tr>
    </thead>
      <?php 
	if($result_mdealer->num_rows() > 0){
   
   	$i = 0;foreach($result_mdealer->result() as $result) 	{
	
	  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
				 <td><a href="<?php echo base_url().$result->image_url; ?>" target="_blank"><img style="width:80px;height:40px;" src="<?php echo base_url().$result->image_url; ?>" alt=""></a></td>
             <td><?php echo $result->add_date; ?></td>
             <td ><?php echo $result->Id; ?></td>
             <td ><?php echo $result->businessname." [ ".$result->username." ] <br>".$result->usertype_name; ?></td>
             <td><?php echo $result->wallet_type; ?><br><?php echo $result->payment_type; ?></td>
             
             <td ><?php echo $result->transaction_id; ?><br>Remark : <?php echo $result->remark; ?></td>
             <td>
				 <?php echo $result->amount; ?>
            	<input type="hidden" id="hidamount<?php echo $result->Id; ?>" name="hidamount<?php echo $result->Id; ?>" value="<?php echo $result->amount; ?>">
			 </td>
             
             <td>
			 <input type="text" id="txtAmount<?php echo $result->Id; ?>" name="txtAmount<?php echo $result->Id; ?>" class="form-control-sm" style="width:80px" placeholder="Confirm Amount">
	</td>
     <td>
			 <input type="text" id="txnPwd<?php echo $result->Id; ?>" name="txnPwd<?php echo $result->Id; ?>" class="form-control-sm" style="width:80px" placeholder="Transaction Password">
	</td>
              <td>
			  <select id="ddlstatus<?php echo $result->Id; ?>" name="ddlstatus" class="form-control-sm" style="width:80px;">
              <option value="">Select</option>
              <option value="Approve">Approve</option>
              <option value="Reject">Reject</option>
              </select>
			  </td>
             <td>
			 <input type="text" id="txtAdminRemark<?php echo $result->Id; ?>" name="txtAdminRemark<?php echo $result->Id; ?>" class="form-control-sm" style="width:120px" placeholder="Admin Remark">
	</td>
     <td>
     <input type="button" id="btnSubmit" name="btnSubmit" class="btn btn-primary" value="Submit" onClick="validateform('<?php echo $result->Id; ?>')">
     </td>        
             
  
 </tr>
		<?php 	
		$i++;}  ?>
      <?php } else{?>
       <tr>
       <td colspan="13">
       <div class='message'> No Records Found</div>
       </td>
       </tr>
      <?php } ?>
		</table>
   
<?php } ?>
              </div><!-- card-body -->
            </div>
             <?php  echo $pagination; ?> 
        </div>
        </div>
        
        
        
      </div><!-- br-pagebody -->
      <script language="javascript">
	function changestatus(val1,id)
	{
		
				$.ajax({
				url:'<?php echo base_url()."_Admin/account_report/setvalues?"; ?>Id='+id+'&field=payment_type&val='+val1,
				cache:false,
				method:'POST',
				success:function(html)
				{
					if(html == "cash")
					{
						var str = '<a  href="javascript:void(0)" onClick="changestatus(\'credit\',\''+id+'\')">'+html+'</a>  	';
						document.getElementById("ptype"+id).innerHTML = str;		
					}
					else
					{
						var str = '<a  href="javascript:void(0)" onClick="changestatus(\'cash\',\''+id+'\')">'+html+'</a>  	';
						document.getElementById("ptype"+id).innerHTML = str;		
					}
					
				}
				}); 
			
		
	}
</script>
<form id="frmexport" name="frmexport" action="<?php echo base_url()."_Admin/account_report/dataexport" ?>" method="get">
                                    <input type="hidden" id="hidfrm" name="from">
                                    <input type="hidden" id="hidto" name="to">
                                    <input type="hidden" id="hiddb" name="db">
                                    
                                    </form>
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
