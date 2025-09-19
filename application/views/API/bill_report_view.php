<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    

    <title>RETAILER::BILL PAYMENT REPORT</title>
	<?php include("elements/linksheader.php"); ?>
    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script>
	 	
$(document).ready(function(){
 $(function() {
            $( "#txtFrom" ).datepicker({dateFormat:'yy-mm-dd'});
            $( "#txtTo" ).datepicker({dateFormat:'yy-mm-dd'});
         });
});
	
	  
	  </script>
      <style>
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
</style>
  </head> 

  <body>
<div class="DialogMask" style="display:none"></div>
   <div id="myOverlay"></div>
<div id="loadingGIF"><img style="width:100px;" src="<?PHP echo base_url(); ?>Loading.gif" /></div>
    <!-- ########## START: LEFT PANEL ########## -->
    
    <?php include("elements/agentsidebar.php"); ?><!-- br-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("elements/agentheader.php"); ?><!-- br-header -->
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    <?php include("elements/rightbar.php"); ?><!-- br-sideright -->
    <!-- ########## END: RIGHT PANEL ########## --->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="<?php echo base_url()."API/Dashboard"; ?>">Dashboard</a>
          <a class="breadcrumb-item" href="#">DMT</a>
          <span class="breadcrumb-item active">BILL PAYMENT REPORT</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="br-pagetitle">
        <div>
          <h4>BILL PAYMENT REPORT</h4>
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
                 <form action="<?php echo base_url()."API/bill_report?crypt=".$this->Common_methods->encrypt("MyData"); ?>" method="post" name="frmReport" id="frmReport">
            <table class="table table-bordered">
            <tr>
            	<td>
                	<label>From Date :</label>
                    <input type="text" name="txtFrom" id="txtFrom" value="<?php echo $from; ?>" class="form-control datepicker" title="Select From Date." maxlength="10" />
                </td>
                <td>
                	<label>To Date :</label>
                    <input type="text" name="txtTo" id="txtTo" class="form-control datepicker" value="<?php echo $to; ?>" title="Select From To." maxlength="10" />
                </td>
                
                <td style="padding-top:30px;">
                	<label></label>
                  <input type="submit" name="btnSearch" id="btnSearch" value="Search" class="btn btn-success" title="Click to search." />
                </td>
            </tr>
            </table>

</form>
							<form id="frmexport" name="frmexport" action="<?php echo base_url()."API/bill_report/dataexport" ?>" method="get">
                                    <input type="hidden" id="hidfrm" name="from">
                                    <input type="hidden" id="hidto" name="to">
                                    <input type="hidden" id="hiddb" name="db">
                                    
                                    </form>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-4 -->
        </div>
      
      	<div class="row row-sm mg-t-20">
          <div class="col-sm-12 col-lg-12">
         	<div class="card shadow-base bd-0">
              <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h6 class="card-title tx-uppercase tx-12 mg-b-0">BILL REPORT</h6>
                <span class="tx-12 tx-uppercase"></span>
              </div><!-- card-header -->
              <div class="card-body">
                 <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	if(isset($result_all))
	{
		if($result_all->num_rows() > 0)
		{
	?>
    
    <div id="all_transaction">
<table class="table table-bordered table-striped" style="color:#00000E">
              <thead class="thead-colored thead-primary" >
    <tr>
    <th>Sr No</th>
   <th>ID</th>
   <th>DateTime</th>
    <th>Agent</th> 
 
   <th>Operator</th>
    <th>ServiceNo</th>
		<th>Bill Amount</th>
    <th>Cust.Name</th>        
    <th>Cust.Mobile</th>
         
    <th>Status</th>        
    <th>OprId</th> 
	<th></th> 
    
	        
    </tr>
     </thead>
    <?php	$total_amount=0;$total_commission=0;$i = 0;foreach($result_all->result() as $result) 	{  ?>
			<tr id="<?php echo "Print_".$i ?>" class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td><?php echo ($i + 1); ?></td>
  <td><?php echo "<span id='db_ssid".$i."'>".$result->Id."</span>"; ?></td> 
  <td><?php echo date_format(date_create($result->add_date),'d-m-Y h:i:s A'); ?></td>
 <td><?php echo "<span id='db_date".$i."'>".$result->businessname."</span>"; ?></td>
  
 <td><?php echo "<span id='db_company".$i."'>".$result->company_name."</span>"; ?></td> 
 <td><?php echo "<span id='db_mobile".$i."'>".$result->service_no."</span>"; ?></td> 
				<td><?php echo "<span id='db_mobile".$i."'>".$result->bill_amount."</span>"; ?></td> 
 <td><?php echo "<span id='db_mobile".$i."'>".$result->customer_name."</span>"; ?></td>
 <td><?php echo "<span id='db_amount".$i."'>".$result->customer_mobile."</span>"; ?></td>
 
 
 <td>
 <?php if($result->status == "Pending"){echo "<span id='db_status".$i."' class='label label-primary'>".$result->status."</span>";} ?>
  <?php if($result->status == "Success"){echo "<span id='db_status".$i."' class='label label-success'>".$result->status."</span>";} ?>
  <?php if($result->status == "Failure"){echo "<span id='db_status".$i."' class='label label-warning'>".$result->status."</span>";} ?>
  </td>
<td><?php echo "<span id='db_amount".$i."'>".$result->opr_id."</span>"; ?></td>
				
<td>
    <?php if($result->status == "Pending" or $result->status == "Success") { ?>
    <a href="<?php echo base_url()."API/print_bill_online_copy?idstr=".$this->Common_methods->encrypt($result->Id)."&idstr2=".$this->Common_methods->encrypt($result->user_id); ?>" target="_blank">Print</a>
    <?php } ?>
</td>	

 </tr>
		<?php
		if($result->status == "Success"){
		$total_amount= $total_amount + $result->bill_amount;}
		$i++;} ?>
		
         <tr class="ColHeader">
    <th></th>
    <th></th>

     
 
   
       <th></th>
    
    <th colspan=3>Successfull Transaction :</th>        
   <th><?php echo $total_amount; ?></th>        
         <th></th>  
			 <th></th>
	<th></th>          
	<th></th>
    
     
	            
    </tr>        
		</table>
        </div>
       <?php
		}
	   else{?>
		   <div class='message'>Record Not Found.</div>
		   <?php }
	   
	   }?> 
              </div><!-- card-body -->
            </div>
        </div>
        </div>
         <form action="<?php echo base_url()."_Admin/bill_report?crypt=".$this->Common_methods->encrypt("MyData"); ?>" method="post" name="frmCallAction" id="frmCallAction">
<input type="hidden" id="hidstatus" name="hidstatus" />
<input type="hidden" id="hidid" name="hidid" />
<input type="hidden" id="hidOprId" name="hidOprId" />
<input type="hidden" id="hidaction" name="hidaction" value="Set" />
<input type="hidden" id="hidTxnPwd" name="hidTxnPwd">
 </form>
      </div><!-- br-pagebody -->
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
