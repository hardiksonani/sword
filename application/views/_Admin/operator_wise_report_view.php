<!DOCTYPE html>
<html lang="en">
  <head>
    

    <title>Operator Wise Report</title>

    
     
    
	<?php include("elements/linksheader.php"); ?>
    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
     <script>
	 	
$(document).ready(function(){
document.getElementById("ddlapi").value = '<?php echo $ddlapi; ?>';
 $(function() {
            $( "#txtFromDate" ).datepicker({dateFormat:'yy-mm-dd'});
            $( "#txtToDate" ).datepicker({dateFormat:'yy-mm-dd'});
         });
});
	
	
	function startexoprt()
{
		$('.DialogMask').show();
		document.getElementById('trmob').style.display = 'table-row';
	
		var from = document.getElementById("txtFromDate").value;
		var to = document.getElementById("txtToDate").value;
		var ddlapi = document.getElementById("ddlapi").value;
	$.ajax({
			url:'<?php echo base_url()."_Admin/operatorwisereport/dataexport"?>?from='+from+'&to='+to+'&ddlapi='+ddlapi,
			type:'post',
			cache:false,
			success:function(html)
			{
				document.getElementById('trmob').style.display = 'none';
				$('.DialogMask').hide();
				window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
    			
			}
			});
}
	
	</script>
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
    <!--    ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all-->
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
* {
  box-sizing: border-box;
}

body {
  font: 16px serif;  
}

/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
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
          <a class="breadcrumb-item" href="#">REPORTS</a>
          <span class="breadcrumb-item active">OPERATOR WISE REPORT</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="br-pagetitle">
        <div>
          <h4>OPERATOR WISE REPORT</h4>
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
                  <form action="<?php echo base_url()."_Admin/operatorwisereport" ?>" method="post" name="frmSearch" id="frmSearch">
                           <input type="hidden" id="hidID" name="hidID">
                                    <table cellspacing="10" cellpadding="3">
                                    <tr>
                                    <td style="padding-right:10px;">
                                    <button class="btn btn-success btn-sm" type="button" style="font-size:24px;border-radius: 10px;background-color:#ff0066">FROM DATE</button><br>
                                    <br>
                                            <input class="autocomplete" value="<?php echo $from; ?>" id="txtFromDate" name="txtFromDate" type="text" style="width:150px;cursor:pointer" readonly >
                                        </td>
                                    	<td style="padding-right:10px;">
                                      <button class="btn btn-success btn-sm" type="button" style="font-size:24px;border-radius: 10px;background-color:#7300e6">TO DATE</button><br>
                                    <br>
                                            <input class="autocomplete" id="txtToDate" value="<?php echo $to; ?>" name="txtToDate" type="text" style="width:120px;cursor:pointer" readonly>
                                        </td>
                                        <td style="padding-right:10px;">
                                        <button class="btn btn-success btn-sm" type="button" style="font-size:24px;border-radius: 10px;background-color:#e64100;width:200px">API</button><br>
                                        <br>
                                        	 
                                           <select id="ddlapi" name="ddlapi" class="autocomplete" style="width:200px;height:43px;border: 2px solid black">
                                                <option value="0">ALL</option>
                                                <?php echo $this->Api_model->getApiListForDropdownList_whereapi_id_not_equelto(1,2,3);  ?>
                                            </select>
                                        </td>
                                        
                                        
                                        
                                        <td valign="bottom">
                                        <input type="submit" id="btnSearch" name="btnSearch" value="Search" class="btn btn-primary">
                                        <input type="button" id="btnExport" name="btnExport" value="Export" class="btn btn-success" onClick="startexoprt()">
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
              <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h6 class="card-title tx-uppercase tx-12 mg-b-0">OPERATOR WISE REPORT</h6>
                <span class="tx-12 tx-uppercase"></span>
              </div><!-- card-header -->
              <div class="card-body">
               <?php if($result_recharge != false) {?>
                <table class="table table-bordered is-fullwidth" style="color:#000000;font-weight:normal;font-size:18px;overflow:hidden;border:2px solid;">
    
    <tr>  
    <tr style="background-color:#f01d75;font-size:16px;text-align=center;font-weight:bold;border:8px solid;"> 
    <th style="font-size:20px;color: white;font-family: times">Date</th>
    <th style="font-size:20px;color: white;font-family: times">Operator_name</th>
    <th style="font-size:20px;color: white;font-family: times">Success Count</th>
    <th style="font-size:20px;color: white;font-family: times">Success Recharge</th> 
    <th style="font-size:20px;color: white;font-family: times">Admin Comm</th>
    <th style="font-size:20px;color: white;font-family: times">MD Comm</th>
    <th style="font-size:20px;color: white;font-family: times">Dist Comm</th>
     <<th style="font-size:20px;color: white;font-family: times">Agent+Api Comm</th>
     <th style="font-size:20px;color: white;font-family: times">Admin Receive</th>
     </tr>
    </tr>
    <?php $totalsuccesscount= 0; $i = 0;$TotalRecharge=0;$TotalCommission=0;$TotalMDCommission=0;$TotalDistCommission=0;$TotalAdminComm=0;$AdminReceiveTotal=0; foreach($result_recharge->result() as $result) 	
	{
		
	 ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
            <td><?php echo $from."   To   ".$to; ?></td>
  <td ><?php echo $result->company_name; ?></td>
   <td ><?php echo $result->totalcount; ?></td>
 <td ><?php echo $result->Total; ?></td>
 <td ><?php echo $result->AdminComm; ?></td>
  <td ><?php echo $result->MdComm; ?></td>
   <td ><?php echo $result->DComm; ?></td>
 <td ><?php echo $result->Commission; ?></td>
 <td ><?php
 $AdmiRecive = ($result->AdminComm)-($result->MdComm  + $result->DComm + $result->Commission);
  echo $AdmiRecive; ?></td>
 </tr>
		<?php 	
		
		$TotalCommission += $result->Commission;
		$TotalAdminComm += $result->AdminComm;
		$TotalMDCommission += $result->MdComm;
		$TotalDistCommission += $result->DComm;
		$TotalRecharge += $result->Total;
		 $totalsuccesscount += $result->totalcount;
		 $AdminReceiveTotal += $AdmiRecive;
		$i++;} ?>
        <tr style="background-color:#804000;font-size:22px;font-weight:bold;color:#FFFFFF;">
        <td></td>
         <td></td>
        <td><b>Total : &nbsp;&nbsp;&nbsp; <?php echo $totalsuccesscount;?></b></td>
        <td><?php echo $TotalRecharge; ?></td>
         <td><?php echo $TotalAdminComm; ?></td>
         <td><?php echo $TotalMDCommission; ?></td>
          <td><?php echo $TotalDistCommission; ?></td>
        <td><?php echo $TotalCommission; ?></td>
        <td><?php echo $AdminReceiveTotal; ?></td>
        </tr>
        
		</table>
<?php } ?> 
              </div><!-- card-body -->
            </div>
        </div>
        </div>
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
