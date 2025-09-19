<!DOCTYPE html>
<!-- saved from url=(0040)<?php echo base_url(); ?>/Distributor/Home -->
<html class="chrome"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
    $user_id = $this->Common_methods->decrypt($this->input->get("id"));
    $result_user = $this->db->query("
        select 
            a.user_id,
            a.parentid,
            a.businessname,
            a.mobile_no,
            a.usertype_name,
            a.username,
            a.state_id,a.city_id,
            b.postal_address,
            b.pincode,
            b.aadhar_number,
            b.pan_no,
            b.gst_no,
            b.landline,
            b.emailid,
            b.contact_person,
            b.birthdate,
            a.scheme_id
            from tblusers a
            left join tblusers_info b on a.user_id = b.user_id
            where a.user_id=? and a.parentid  = ?",array($user_id,$this->session->userdata("DistId")));    
    
 ?>


    
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $this->white->getName(); ?></title>
    <!-- Favicon-->

    <link rel="icon" href="<?php echo base_url()."fevicon.png"; ?>" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="<?php echo base_url(); ?>vfiles/css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>vfiles/icon" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>vfiles/font-awesome.min.css">
    <!-- Wait Me Css -->
    <link href="<?php echo base_url(); ?>vfiles/waitMe.css" rel="stylesheet">
    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url(); ?>vfiles/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vfiles/bootstrap-select.css" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="<?php echo base_url(); ?>vfiles/waves.css" rel="stylesheet">
    <!-- Animation Css -->
    <link href="<?php echo base_url(); ?>vfiles/animate.css" rel="stylesheet">
    <!-- Morris Chart Css-->
    <link href="<?php echo base_url(); ?>vfiles/morris.css" rel="stylesheet">
    <!-- Custom Css -->
    <link href="<?php echo base_url(); ?>vfiles/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vfiles/icofont.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>vfiles/globalallcss.css" rel="stylesheet">
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url(); ?>vfiles/all-themes.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vfiles/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vfiles/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vfiles/sweetalert.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vfiles/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vfiles/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vfiles/daterangepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vfiles/StyleSheet.css" rel="stylesheet">

    <script src="<?php echo base_url(); ?>vfiles/jquery-1.10.2.min.js.download"></script>
    <script src="<?php echo base_url(); ?>vfiles/jquery.validate.min.js.download"></script>
    <script src="<?php echo base_url(); ?>vfiles/jquery.validate.unobtrusive.min.js.download"></script>
    










    <link rel="icon" href="/Outside_favicon/63969ec4-c079-4d05-8558-b0f34337ac9b_MF.png" type="image/x-icon" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Wait Me Css -->
    <link href="<?php echo base_url(); ?>vfiles/waitMe.css" rel="stylesheet" />
    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url(); ?>vfiles/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vfiles/bootstrap-select.css" rel="stylesheet" />
    <!-- Waves Effect Css -->
    <link href="<?php echo base_url(); ?>vfiles/waves.css" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="<?php echo base_url(); ?>vfiles/animate.css" rel="stylesheet" />
    <!-- Morris Chart Css-->
    <link href="<?php echo base_url(); ?>vfiles/morris.css" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="<?php echo base_url(); ?>vfiles/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vfiles/icofont.css" rel="stylesheet" />

    <link href="<?php echo base_url(); ?>vfiles/globalallcss.css" rel="stylesheet" />
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url(); ?>vfiles/all-themes.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>vfiles/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vfiles/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>vfiles/sweetalert.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>vfiles/bootstrap-datepicker3.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>vfiles/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>vfiles/daterangepicker.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>vfiles/StyleSheet.css" rel="stylesheet" />

    <script src="<?php echo base_url(); ?>vfiles/jquery-1.10.2.min.js"></script>
    <script src="<?php echo base_url(); ?>vfiles/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>vfiles/jquery.validate.unobtrusive.min.js"></script>
    <style>
        .navbar .navbar-toggle:before {
            content: '\E8D5';
            font-family: 'Material Icons';
            font-size: 26px;
        }

        .navbar .navbar-toggle:before {
            content: '\E8D5';
            font-family: 'Material Icons';
            font-size: 26px;
        }
           .for-blink1{color:#fff;
		animation: blink 2s linear infinite;display: initial;
        }
        @keyframes blink{
        0%{color: #fff;}
        50%{color: Yellow;}
        100%{color: red;}
        }
    </style>



 <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script>
        
$(document).ready(function(){
 $(function() {
           $( "#txtBDate" ).datepicker({dateFormat:'yy-mm-dd',changeMonth: true, changeYear: true,yearRange: "-100:+0" });
           
         });
});

</script>


<script type="text/javascript" language="javascript">                   
        function getCityName(urlToSend)
    {
        if(document.getElementById('ddlState').selectedIndex != 0)
        {
            document.getElementById('hidStateCode').value = $("#ddlState")[0].options[document.getElementById('ddlState').selectedIndex].getAttribute('code');                  
        $.ajax({
  type: "GET",
  url: urlToSend+""+document.getElementById('ddlState').value,
  success: function(html){
    $("#ddlCity").html(html);
  }
});
        }
    }

function getCityNameOnLoad(urlToSend)
    {
        if(document.getElementById('ddlState').selectedIndex != 0)
        {
                                
        $.ajax({
  type: "GET",
  url: urlToSend+""+document.getElementById('ddlState').value,
  success: function(html){
    $("#ddlCity").html(html);
    document.getElementById('ddlCity').value = document.getElementById('hidCityID').value;      
  }
});
        }
    }
$(document).ready(function(){
    //global vars
    var form = $("#frmdistributer_form1");
    var dname = $("#txtDistname");var postaladdr = $("#txtPostalAddr");
    var pin = $("#txtPin");var mobileno = $("#txtMobNo");var emailid = $("#txtEmail");
   
    //On Submitting
    form.submit(function(){
        if(validateDname() & validateAddress() & validatePin() & validateMobileno() & validateEmail())
            {               
            return true;
            }
        else
            return false;
    });
    //validation functions  
    function validateDname(){
        if(dname.val() == ""){
            dname.addClass("error");return false;
        }
        else{
            dname.removeClass("error");return true;
        }       
    }   
    function validateAddress(){
        if(postaladdr.val() == ""){
            postaladdr.addClass("error");return false;
        }
        else{
            postaladdr.removeClass("error");return true;
        }       
    }
    function validatePin(){
        if(pin.val() == ""){
            pin.addClass("error");
            return false;
        }
        else{
            pin.removeClass("error");
            return true;
        }
        
    }
    function validateMobileno(){
        if(mobileno.val().length < 10){
            mobileno.addClass("error");return false;
        }
        else{
            mobileno.removeClass("error");return true;
        }
    }
    function validateEmail(){
        var a = $("#txtEmail").val();
        var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
        if(filter.test(a)){
            emailid.removeClass("error");
            return true;
        }
        else{
            emailid.addClass("error");          
            return false;
        }
    }
    function validateScheme(){
        if(ddlsch[0].selectedIndex == 0){
            ddlsch.addClass("error");           
            return false;
        }
        else{
            ddlsch.removeClass("error");        
            return true;
        }
    }
    setTimeout(function(){$('div.message').fadeOut(1000);}, 10000);
    
    
});
    function ChangeAmount()
    {
        
    }   
    function setLoadValues()
    {
        document.getElementById('ddlparent').value = <?php echo $result_user->row(0)->parentid; ?>; 
        document.getElementById('ddlSchDesc').value = document.getElementById('hidScheme').value;       
        document.getElementById('ddlState').value = document.getElementById('hidStateID').value;
        getCityNameOnLoad('<?php echo base_url()."Distributor/city/getCity/"; ?>');
                    
    }   
</script>



</head>

<body class="theme layoutt-retailer" style="overflow-x: hidden;">

    <section class="layoutt">

        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <center><img src="<?php echo base_url(); ?>vfiles/serachimg.gif" class="img-responsive" style="height:200px;width:200px;"></center>

            </div>
        </div>


        <!-- #END# Page Loader -->
        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>
        <!-- #END# Overlay For Sidebars -->
        <!-- Search Bar -->
        <div class="search-bar">
            <div class="search-icon">
                <i class="material-icons">search</i>
            </div>
            <input type="text" placeholder="START TYPING...">
            <div class="close-search">
                <i class="material-icons">close</i>
            </div>
        </div>
        <!-- #END# Search Bar -->
        <!-- Top Bar -->

        <!-- -->
        <?php include("elements/v_aside_dist.php"); ?>
        <!-- -->


         <?php include("elements/v_header_dist.php"); ?>










        <!-- Left Sidebar -->


        <button id="bb" style="display:none;"></button>
    </section>
    




<style>
    .ribbon {
        position: absolute;
        right: -2px;
        top: -2px;
        z-index: 1;
        overflow: hidden;
        width: 75px;
        height: 75px;
    }

        .ribbon span {
            font-size: 11px;
            color: #fff;
            text-align: center;
            font-weight: bold;
            line-height: 20px;
            transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            width: 100px;
            box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
            position: absolute;
            top: 19px;
            right: -21px;
            background: linear-gradient(#c5c5c5 0%, #868686 100%);
        }

    .list-group-item {
        border: none;
    }
    .my-dashboard .card ul li.active a{
       background: linear-gradient(to right ,var(--main-bg-lcolor),var(--main-bg-rcolor)) !important;

    }
        .my-dashboard .card ul li.active a i, .my-dashboard .card ul li.active a span {
            color: #fff !important;
        }
    .my-dashboard .card ul li a:hover {
        background: linear-gradient(to right ,var(--main-bg-lcolor),var(--main-bg-rcolor)) !important;
    }

    .field-validation-error {
        color: red;
    }

    .required:after {
        color: red;
        content: " *";
    }
    .table tbody tr td, .table tbody tr th {
        padding: 7px;
    }
    .first-ani{ position: relative;
  animation: mymove 15s infinite;}
    .second-ani{position: relative;
  animation: mymove1 15s infinite;}
    .first-ani label{background:green;color:#fff;padding: 0px 25px;
margin-right: 10px;
border-radius: 3px;}
    .second-ani label{background:#ff6c00;color:#fff;padding: 0px 15px;
margin-right: 10px;
border-radius: 3px;}



    /*@keyframes mymove {
        from {
            bottom: -30px;
        }

        to {
            bottom: 100px;
        }
    }
    @keyframes mymove1 {
        from {
            bottom: -100px;
        }

        to {
            bottom: 100px;
        }
    }*/
    
    .new.newaddclass.slideCol {
     
        overflow: hidden;
    }
        .new.newaddclass.slideCol p {
            margin: 0px !important;
        }
    .new.newaddclass.slideCol .scroller {
        height: 43px;
        line-height: 70pt;
        overflow: hidden;
    }

</style>
<link href="<?php echo base_url();?>vfiles/effectivemodalpopup.css" rel="stylesheet">
<link href="<?php echo base_url();?>vfiles/StyleSheet.css" rel="stylesheet">

<style>
    .datepicker-orient-bottom {
        top: 173px !important;
    }
</style>
<section class="content" style="margin:90px 0px 0px 0px;">
    <div class="container-fluid retailer-page fundtranfer rechargefirstclass fundtranfer-responshive">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card" style="margin-top:2px;float: left;width: 100%;">




                  <form method="post" action="<?php echo base_url()."Distributor/agent_edit?crypt=".$this->Common_methods->encrypt("MyData");?>" name="frmdistributer_form1" id="frmdistributer_form1" autocomplete="off">
<input type="hidden" name="hiduserid" value="<?php echo $result_user->row(0)->user_id; ?>">
<table class="table">

<tr>
    <td><h5>Retailer Name :</h5></td>
    <td><b><?php echo $result_user->row(0)->businessname; ?></b></td>
    <td><h5>Mobile No :</h5></td>
    <td><b><?php echo $result_user->row(0)->mobile_no; ?></b></td>
</tr>
<tr>
    <td><h5>Retailer Name :</h5></td>
    <td><b><?php echo $result_user->row(0)->businessname; ?></b></td>
    <td><h5>Mobile No :</h5></td>
    <td><b><?php echo $result_user->row(0)->mobile_no; ?></b></td>
</tr>
<tr>
<td><h5>Postal Address :</h5><textarea style="width:300px;" placeholder="Enter Postal Address" id="txtPostalAddr" name="txtPostalAddr" class="form-control-sm" ><?php echo $result_user->row(0)->postal_address; ?></textarea>
</td>
<td><h5>Pin Code :</h5><input type="text" style="width:300px;" class="form-control-sm" id="txtPin" onKeyPress="return isNumeric(event);" name="txtPin" maxlength="8" placehoder="Enter Pin Code." value="<?php echo $result_user->row(0)->pincode; ?>"/>
</td>
</tr>

<tr>
<td><h5>Mobile No :</h5><input style="width:300px;" type="text" class="form-control-sm" onKeyPress="return isNumeric(event);" placeholder="Enter Mobile No.<br />e.g. 9898980000" id="txtMobNo" name="txtMobNo" maxlength="10"  value="<?php echo $result_user->row(0)->mobile_no; ?>"/>
</td>
<td><h5>Email :</h5><input type="text" style="width:300px;" class="form-control-sm" id="txtEmail" placeholder="Enter Email ID.<br />e.g some@gmail.com" name="txtEmail"  maxlength="150" value="<?php echo $result_user->row(0)->emailid; ?>"/></td>
</tr>
<tr>
<td><h5>Pan No :</h5><input type="text" style="width:300px;" class="form-control-sm" name="txtpanNo" id="txtpanNo" value="<?php echo $result_user->row(0)->pan_no; ?>"/></td>
<td><h5>Contact Person :</h5><input style="width:300px;" type="text" class="form-control-sm" id="txtConPer" placeholder="Enter Contact No." name="txtConPer"  maxlength="150" value="<?php echo $result_user->row(0)->contact_person; ?>"/>
</td>
</tr>
<tr>
<td><h5>Aadhar No :</h5><input type="text" style="width:300px;" class="form-control-sm" name="txtAadhar" id="txtAadhar" value="<?php echo $result_user->row(0)->aadhar_number; ?>"/></td>
<td><h5>GST Number :</h5><input style="width:300px;" type="text" class="form-control-sm" id="txtgst" placeholder="Enter GST Number." name="txtgst"  maxlength="150" value="<?php echo $result_user->row(0)->gst_no; ?>"/>
</td>
</tr>
<tr>
<td><h5>Birth Date :</h5><input type="text" style="width:300px;" class="form-control-sm" name="txtBDate" id="txtBDate" value="<?php echo $result_user->row(0)->birthdate; ?>"/></td>
<td>
</td>
</tr>
</table>
<table cellpadding="5" cellspacing="0" bordercolor="#f5f5f5" width="80%" border="0">

  <tr>
    <td>

</td>
 <td><input type="submit" style="width:140px" class="btn btn-success" id="btnSubmit" name="btnSubmit" value="Update Details"/>
      <input type="reset" class="btn btn-default" id="bttnCancel" name="bttnCancel" value="Cancel"/></td>
  </tr>
  
  
 
  
</table>
</form>


                </div>
            </div>
        </div>











        <!--------------- summary start --------------------------------->







        <!--------------- summary end ------------------------------->













        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="body change-iconrech-report change-iconrech-responshive" style="padding:12px;padding-left: 0;padding-right: 0;padding-top: 15px;">
                        <div class="table-responsive recharge-responsive" style="position:inherit;margin-top:-10px;">

                             <form method="post" action="<?php echo base_url()."Distributor/agent_edit/commission?crypt=".$this->Common_methods->encrypt("MyData");?>" name="frmdistributer_form2" id="frmdistributer_form2" autocomplete="off">
                                <input type="hidden" name="hiduserid" value="<?php echo $result_user->row(0)->user_id; ?>">
<table class="table table-striped" style="color:#000000;font-weight:normal;font-family:sans-serif;font-size:14px;overflow:hidden" >
    <tr>
        <th>Sr.</th>
        <th>Operator Name</th>
        <th>Commission</th>
        <th></th>
    </tr>            
            
<?php
    $commission_info = $this->db->query("
            select
            a.company_id,
            a.company_name,
            b.commission
            from tblcompany a 
            left join tbluser_commission b on a.company_id = b.company_id and b.user_id = ?
            where a.service_id = 1 or a.service_id = 2 or a.service_id = 3
            order by a.service_id,a.company_name
    ",array($user_id));
    $i = 1;
    $str_company_id = "";
    foreach($commission_info->result() as $cmp)
    {
        $str_company_id.=$cmp->company_id.",";
    ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $cmp->company_name; ?></td>
            <td>
                <input type="text" id="txtCommissino<?php echo $cmp->company_id; ?>" class="form-control" style="color:#000000;font-weight:bold;width:120px;" value="<?php echo $cmp->commission; ?>">
                
            </td>
            <td ><input type="button" id="btn-change" value="Submit" class="btn btn-primary btn-sm" onClick="changeCommission(<?php echo $cmp->company_id; ?>)"></td>
        </tr>
    <?php 
        $i++;
    }

?>
<tr>
    <td></td>
 
    <td colspan=3 align="center">
        <input type="button" id="btnAll" class="btn btn-success btn-lg" value="Submit All" onClick="changeall()">
    </td>
</tr>
</table> 
<input type="hidden" id="hidcompany_ids" value="<?php echo $str_company_id; ?>">

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>













  <script language="javascript">
function changeall()
{
    var ids = document.getElementById("hidcompany_ids").value;
    var struserarr = ids.split(",");
    for(i=0;i<struserarr.length;i++)
    {
        var id = struserarr[i];
        changeCommission(id);
    }
}
function changeCommission(id)
{
  

    var company_id = id;
    var commission = document.getElementById("txtCommissino"+id).value;
    var user_id = <?php echo $user_id; ?>;
    if(commission <= 5)
    {
      
        $.ajax({
          type: "POST",
          url:'<?php echo base_url();?>Distributor/agent_edit/change_commission?company_id='+company_id+'&commission='+commission,
          cache:false,
          data:{'company_id':company_id,'user_id':user_id,'commission':commission},
          beforeSend: function() 
          {
            $('#myOverlay').show();
            $('#loadingGIF').show();
          },
          success: function(html)
          {
            //alert(html);
          },
          complete:function()
          {
                $('#myOverlay').hide();
                $('#loadingGIF').hide();
                //$('#myLoader').hide();
          }
        });
    }
  
    
}
</script> 













<script language="javascript">
  function getuserbalance()
{
        var struser = document.getElementById("hidusers").value;
        var struserarr = struser.split("#");
        for(i=0;i<struserarr.length;i++)
        {
            var id = struserarr[i];
            if(id > 0)
            {
            $.ajax({
            url:document.getElementById("hidbaseurl").value+'/getbalance?id='+id,
            method:'POST',
            cache:false,
            success:function(html)
            {   
                var strbalarid = html.split("#");
                //alert(html + "0 = "+strbalarid[0]+"  1 = "+strbalarid[1]);
                document.getElementById("spanbalance"+strbalarid[0]).innerHTML = strbalarid[1];
                document.getElementById("spanbalance2"+strbalarid[0]).innerHTML = strbalarid[2];
                
                
            }
            
            });
            }
            
        }
        
    }
    $(document).ready(function()
    {
        getuserbalance();
        
    }); 
</script>
        <input type="hidden" id="hidbaseurl" value="<?php echo base_url()."Distributor/agent_list"; ?>">
  <input type="hidden" id="hidusers" value="<?php echo  $struser; ?>">








































        <div class="row clearfix" style="display:none;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">

                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <span>SUCCESS : </span>


                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <span>FAILED : </span>


                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <span>PENDING : </span>


                        </div>
                    </div>


<!-- Flight Markup popup -->

<script src="<?php echo base_url();?>vfiles/jquery.min.js.download"></script>
<script src="<?php echo base_url();?>vfiles/sweetalert-dev.js.download"></script>
<link href="<?php echo base_url();?>vfiles/sweetalert(1).css" rel="stylesheet">

<!--Today Business-->


    <!-- Jquery Core Js -->
    <script src="<?php echo base_url();?>vfiles/jquery.min.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/datatablejquery.js.download"></script>
    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url();?>vfiles/bootstrap.js.download"></script>
    <!-- Autosize Plugin Js -->
    <script src="<?php echo base_url();?>vfiles/autosize.js.download"></script>
    <!-- Select Plugin Js -->
    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo base_url();?>vfiles/jquery.slimscroll.js.download"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url();?>vfiles/waves.js.download"></script>
    <!-- Jquery CountTo Plugin Js -->
    <script src="<?php echo base_url();?>vfiles/jquery.countTo.js.download"></script>
    <!-- Morris Plugin Js -->
    <script src="<?php echo base_url();?>vfiles/raphael.min.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/morris.js.download"></script>
    <!-- ChartJs -->
    <!-- Flot Charts Plugin Js -->
    <script src="<?php echo base_url();?>vfiles/jquery.flot.js.download"></script>
    

    <!-- Sparkline Chart Plugin Js -->
    <!-- Custom Js -->
    <script src="<?php echo base_url();?>vfiles/admin.js.download"></script>
    
    <!-- Demo Js -->
    <script src="<?php echo base_url();?>vfiles/demo.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/moment.min.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/daterangepicker.js.download"></script>
    <!--data table -->
    <script src="<?php echo base_url();?>vfiles/jquery.dataTables.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/dataTables.bootstrap.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/dataTables.buttons.min.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/buttons.flash.min.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/jszip.min.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>vfiles/vfs_fonts.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/buttons.html5.min.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/buttons.print.min.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/jquery-datatable.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/bootstrap-material-datetimepicker.js"></script>
    <script src="<?php echo base_url();?>vfiles/sweetalert.min.js.download"></script>
    <link href="<?php echo base_url();?>vfiles/datatable.css" rel="stylesheet">

    <script src="<?php echo base_url();?>vfiles/basic-form-elements.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url();?>vfiles/bootstrap-datetimepicker.min.js"></script>






    <script>
    function confirm(e) {
        $('#disp-'+e).hide();
        $('#confirm-'+e).show();
        $('#close-'+e).show();
    }
    function cancel(e) {
          $('#disp-'+e).show();
        $('#confirm-'+e).hide();
        $('#close-'+e).hide();
    }
    function disputedata(e) {
         var txt_frm_date = $('#txt_frm_date').val();
         var txt_to_date = $('#txt_to_date').val();
         var ddl_status = $('#ddl_status').val();
         var Operator = $('#Operator').val();
        var txtmob = $('#txtmob').val();

             $.post("/Distributor/Home/dispute",
             {"id": e, "txtregion": ""},
                 function (data) {
                     $.post("/Distributor/Home/InfiniteScroll",
             { "pageindex": pageindex, "txt_frm_date": txt_frm_date, "txt_to_date": txt_to_date,"ddl_status":ddl_status,"Operator":Operator,"txtmob":txtmob },
                    function (data) {
                        $("#trow").html(data.HTMLString);
                    });
           });

    }
</script>
<script>
    $('select').select2();
</script>
<script>
    var txt_frm_date = $('#txt_frm_date').val();
    var txt_to_date = $('#txt_to_date').val();
    var ddl_status = $('#ddl_status').val();
    var Operator = $('#Operator').val();
    var txtmob = $('#txtmob').val();
        var pageindex = 2;
        var NoMoredata = false;
        var inProgress = false;
    $(window).scroll(function () {
            if ($(window).scrollTop() > Number($("#tbldata").height()) / 4 && !NoMoredata && !inProgress) {
                inProgress = true;
                $("#loadingdiv").show();
                $.post("/Distributor/Home/InfiniteScroll",
             { "pageindex": pageindex, "txt_frm_date": txt_frm_date, "txt_to_date": txt_to_date,"ddl_status":ddl_status,"Operator":Operator,"txtmob":txtmob },
                    function (data) {
                        pageindex = pageindex + 1;
                        NoMoredata = data.NoMoredata;
                        $("#trow").append(data.HTMLString);
                        $("#loadingdiv").hide();
                        inProgress = false;
                    });
            }
        });
</script>
<script type="text/javascript">
    function GotoPDFRecharge(e) {
                       // alert(e)
                       var idno = e.toString();
                       var url = '/Distributor/Home/RechargePDF?Idno=' + idno + '';
                       //window.location.href = url,;
                       window.open(url, '_blank');
                   }
</script>

<script>
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 45 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;
        return true;
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {

        $('.input-daterange').datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            autoclose: true,
            orientation: "bottom auto",

        });
        var val = 'post';
        if (val != "post") {
            $("#txt_frm_date").datepicker("setDate", new Date());
            $("#txt_to_date").datepicker("setDate", new Date());
        }

   });

</script>

<!--Dispute Id-->
<script>
    function findtotal() {
         var txt_frm_date = $('#txt_frm_date').val();
         var txt_to_date = $('#txt_to_date').val();
         var ddl_status = $('#ddl_status').val();
         var Operator = $('#Operator').val();
         var txtmob = $('#txtmob').val();
             $.post("/Distributor/Home/FindTotal",
             {"txt_frm_date": txt_frm_date, "txt_to_date": txt_to_date,"ddl_status":ddl_status,"Operator":Operator,"txtmob":txtmob},
                 function (data) {
                     $('#successtotal').text(data.success);
                     $('#Failedtotal').text(data.failed);
                       $('#Pendingtotal').text(data.pending);
                    });
    }
</script>

<!--Genertae Invoice-->
<script type="text/javascript">
    function GenrateInvoice(ultra_request_id, RechargeTo, OptName, amt, OptID, Date) {
       var url = '/Distributor/Home/GotoInvoicePDF1?Id=' + ultra_request_id + '&RechargeTo=' + RechargeTo + '&OptName=' + OptName + '&amt=' + amt + '&OptID=' + OptID + '&Date=' + Date + '';
            window.open(url, '_blank');
     }
</script>
<script>
    $("#btnExport").click(function(){
   var txt_frm_date = $('#txt_frm_date').val();
         var txt_to_date = $('#txt_to_date').val();
         var ddl_status = $('#ddl_status').val();
         var Operator = $('#Operator').val();
        var txtmob = $('#txtmob').val();
        var url = '/Distributor/Home/ExcelRechargereport?txt_frm_date=' + txt_frm_date + '&txt_to_date=' + txt_to_date + '&ddl_status=' + ddl_status + '&Operator=' + Operator + '&txtmob=' + txtmob;
        location.href = url;
});
</script>
<script>
    $("#btnPDF").click(function () {
     var txt_frm_date = $('#txt_frm_date').val();
         var txt_to_date = $('#txt_to_date').val();
         var ddl_status = $('#ddl_status').val();
         var Operator = $('#Operator').val();
        var txtmob = $('#txtmob').val();
        var url = '/Distributor/Home/PDFRechargereport?txt_frm_date=' + txt_frm_date + '&txt_to_date=' + txt_to_date + '&ddl_status=' + ddl_status + '&Operator=' + Operator + '&txtmob=' + txtmob;
        window.open(
url,
  '_blank' // <- This is what makes it open in a new window.
);
    });
</script>
<script>
    $(document).ready(function () {
        var current = location.pathname;
        $('.report-list-change li a').each(function () {
            var $this = $(this);
            if ($this.attr('href').indexOf(current) !== -1) {
                $this.addClass('active');


            }
        })
    });
</script>
<script>
    $(document).ready(function () {
        $("#pdfblock").click(function () {
            $(".pdfblocks").css("display", "block");

        });
    });
</script>
<script>
    $(document).ready(function () {
        $(".rechargefirst span.select2-selection").click(function () {
            $(".select2-dropdown").addClass('selectcutomere');
        });
    });
</script>

<script>
    $(document).ready(function () {
        $(".rechargesecond span.select2-selection").click(function () {
            $(".select2-dropdown").addClass('selectcutomeress');
        });
    });
</script>


<script>
    $(document).ready(function () {
        $(".rechargethrees input").click(function () {
            $(".datepicker").addClass('datepickerrecharge');
        });
    });
</script>

<script>
    $(document).ready(function () {
        $(".fundtranfer-responshive .rechargefirst .select2").click(function () {
            $(".select2-dropdown.select2-dropdown--below.selectcutomere").addClass('parepaidstatus');

        });
    });
</script>
<script>
    $(document).ready(function () {
        $(".fundtranfer-responshive .col-md-3.rechargesecond .select2").click(function () {
            $(".select2-dropdown.select2-dropdown--below.selectcutomeress").addClass('parepaidstatussecond');

        });
    });
</script>






</body></html>