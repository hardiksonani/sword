<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    

    <title>Purchase Report</title>

    
     
    
	<?php include("elements/linksheader.php"); ?>
    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script>
	 	
$(document).ready(function(){
	
	
 $(function() {
            $( "#txtPurchaseDate" ).datepicker({dateFormat:'yy-mm-dd'});
         });
});
	

	function startexoprt()
{
		$('.DialogMask').show();
		
		var from = document.getElementById("txtFromDate").value;
		var to = document.getElementById("txtToDate").value;
		var db = document.getElementById("ddldb").value;
		document.getElementById("hidfrm").value = from;
		document.getElementById("hidto").value = to;
		document.getElementById("hiddb").value = db;
		document.getElementById("frmexport").submit();
	$('.DialogMask').hide();
}
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


.modal-ku {
  width: 950px;
  margin: auto;
}
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
          <a class="breadcrumb-item" href="#">Reports</a>
          <span class="breadcrumb-item active">PURCHASE REPORT</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="br-pagetitle">
        <div>
          <h4>PURCHASE REPORT</h4>
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
                  <form action="<?php echo base_url()."_Admin/Purchase_report" ?>" method="post" name="frmCallAction" id="frmCallAction">
                           <input type="hidden" id="hidID" name="hidID">
                                    <table class="table is-fullwidth" style="color:#000000;font-weight:normal;font-size:20px;overflow:hidden;">
                                    <tr>
                                        <td style="padding-right:10px;">
                                        	 <label>Purchase Date</label>
                                            <input class="autocomplete"  id="txtPurchaseDate" name="txtPurchaseDate" type="text" style="width:120px;" placeholder="Select Date">
                                        </td>

                                        <td style="padding-right:10px;">
                                           <label>Select API</label>
                                            <select id="ddlapi" name="ddlapi" >
                                              <option value="0">Select</option>
                                              <?php
                                                $apirslt = $this->db->query("select Id,api_name from api_configuration where Id > 3 order by api_name");
                                                foreach($apirslt->result() as $rwapi)
                                                {?>
                                                  <option value="<?php echo $rwapi->Id; ?>">
                                                    <?php echo $rwapi->api_name; ?>
                                                  </option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    	
                                        
                                        <td >
                                        <input type="button" id="btnSubmit" name="btnSearch" value="Search" class="btn btn-primary" onclick="getPurchaseDate()">
                                   
                                        </td>
                                    </tr>
                                    </table>
                                    <input type="hidden" id="hidpurchasedataurl" value="<?php echo base_url();?>_Admin/Purchase_report/getDatea">
                                    <script type="text/javascript">
                                      function getPurchaseDate()
                                      {
                                        var pdate = document.getElementById("txtPurchaseDate").value;
                                        var api = document.getElementById("ddlapi").value;
                                        $.ajax({

                                          url:document.getElementById("hidpurchasedataurl").value,
                                          method:'POST',
                                          cache:false,
                                          data:{'pdate':pdate,'api':api},
                                          success:function(data)
                                          {
                                           // alert(data);
                                            var output = JSON.parse(data);

                                            var date = output.Date;
                                            var Opening = output.Opening;
                                            var Purchase = output.Purchase;
                                            var Recharge = output.Recharge;
                                            var Commission = output.Commission;
                                            var Clossing = output.Clossing;


                                            var NewPurchase = (+Clossing + +Recharge) - (+Opening + +Commission);
                                            document.getElementById("txtPurchase").value= NewPurchase;

                                            document.getElementById("span_date").innerHTML= date;
                                            document.getElementById("span_api").innerHTML= $("#ddlapi option:selected").html();
                                            document.getElementById("span_Opening").innerHTML= Opening;
                                            document.getElementById("span_Recharge").innerHTML= Recharge;
                                            document.getElementById("span_Commission").innerHTML= Commission;
                                            document.getElementById("span_Clossing").innerHTML= Clossing;


                                            document.getElementById("hidDate").value= date;
                                            document.getElementById("hidApiId").value= api;
                                            document.getElementById("hidApiName").value= $("#ddlapi option:selected").html();
                                            document.getElementById("hidOpening").value= Opening;
                                            document.getElementById("hidPurchase").value= Purchase;
                                            document.getElementById("hidRecharge").value= Recharge;
                                            document.getElementById("hidCommission").value= Commission;
                                            document.getElementById("hidClossing").value= Clossing;

                                            

                                           var diff = (+Opening + +NewPurchase  + +Commission) - (+Recharge);
                                           document.getElementById("span_Difference").innerHTML= diff;
                                           //
                                           
                                          },
                                          complete:function()
                                          {

                                          }


                                        });
                                      }



                                      function calculateDiff()
                                      {
                                            var Opening = document.getElementById("hidOpening").value;
                                            var Purchase = document.getElementById("txtPurchase").value;
                                            var Recharge = document.getElementById("hidRecharge").value;
                                            var Commission = document.getElementById("hidCommission").value;
                                            var Clossing = document.getElementById("hidClossing").value;

                                            //alert(Opening + "  "+Recharge+"   "+Commission);
                                            var diff = (+Opening + +Purchase  + +Commission) - (+Recharge);
                                           document.getElementById("span_Difference").innerHTML= diff;
                                      }
                                    </script>
                                        
                                       
                                       
                                    </form>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-4 -->
        </div>
      
      	<div class="row row-sm mg-t-20">
          <div class="col-sm-12 col-lg-12">
         	<div class="card shadow-base bd-0">
              <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h6 class="card-title tx-uppercase tx-12 mg-b-0">PURCHASE REPORT</h6>
                <span class="tx-12 tx-uppercase"></span>
              </div><!-- card-header -->
              <div class="card-body">


                <input type="hidden" id="hidDate">
                <input type="hidden" id="hidApiId">
                <input type="hidden" id="hidApiName">
                <input type="hidden" id="hidOpening">
                <input type="hidden" id="hidPurchase">
                <input type="hidden" id="hidRecharge">
                <input type="hidden" id="hidCommission">
                <input type="hidden" id="hidClossing">


              <table class="table table-bordered is-fullwidth" style="color:#000000;font-weight:normal;font-size:18px;overflow:hidden;border:2px solid;">
    
    <tr> 
    <tr style="background-color:#f01d75;font-size:16px;text-align=center;font-weight:bold;border:8px solid;"> 
    <th style="font-size:20px;color: white;font-family: times">Date</th>
    <th style="font-size:20px;color: white;font-family: times">Api</th>
    <th style="font-size:20px;color: white;font-family: times">Opening</th>
    <th style="font-size:20px;color: white;font-family: times">Purchase</th>
    <th style="font-size:20px;color: white;font-family: times">Recharge</th>
    <th style="font-size:20px;color: white;font-family: times">Commission</th>
    <th style="font-size:20px;color: white;font-family: times">Clossing</th>
    <th style="font-size:20px;color: white;font-family: times">Clossing By Calculation</th>
    
                   </tr>     
                </tr>
              </thead>
              <tbody>
             
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
          <td><span id="span_date"></span></td>
          <td><span id="span_api"></span></td>
          <td><span id="span_Opening"></span></td>
          <td><input id="txtPurchase" name="txtPurchase" onkeyup="calculateDiff()"></span></td>
          <td><span id="span_Recharge"></span></td>
          <td><span id="span_Commission"></span></td>
          <td><span id="span_Clossing"></span></td>
          <td><span id="span_Difference"></span></td>
 
      </tr>
		
              </tbody>
            </table>
              </div><!-- card-body -->
            </div>
            
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
