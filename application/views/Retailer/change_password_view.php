<!DOCTYPE html>
<!-- saved from url=(0055)http://maharshimulti.co.in/RETAILER/Home/ChangePassword -->
<html class="chrome"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $this->white->getName(); ?></title>
    <!-- Favicon-->

    <link rel="icon" href="http://maharshimulti.co.in/Outside_favicon/63969ec4-c079-4d05-8558-b0f34337ac9b_MF.png" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="<?php echo base_url();?>vfiles/css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>vfiles/icon" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>vfiles/font-awesome.min.css">
    <!-- Wait Me Css -->
    <link href="<?php echo base_url();?>vfiles/waitMe.css" rel="stylesheet">
    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url();?>vfiles/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>vfiles/bootstrap-select.css" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="<?php echo base_url();?>vfiles/waves.css" rel="stylesheet">
    <!-- Animation Css -->
    <link href="<?php echo base_url();?>vfiles/animate.css" rel="stylesheet">
    <!-- Morris Chart Css-->
    <link href="<?php echo base_url();?>vfiles/morris.css" rel="stylesheet">
    <!-- Custom Css -->
    <link href="<?php echo base_url();?>vfiles/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>vfiles/icofont.css" rel="stylesheet">

    <link href="<?php echo base_url();?>vfiles/globalallcss.css" rel="stylesheet">
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url();?>vfiles/all-themes.css" rel="stylesheet">
    <link href="<?php echo base_url();?>vfiles/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>vfiles/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <link href="<?php echo base_url();?>vfiles/sweetalert.css" rel="stylesheet">
    <link href="<?php echo base_url();?>vfiles/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>vfiles/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>vfiles/daterangepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>vfiles/StyleSheet.css" rel="stylesheet">

    <script src="<?php echo base_url();?>vfiles/jquery-1.10.2.min.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/jquery.validate.min.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/jquery.validate.unobtrusive.min.js.download"></script>
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
</head>

<body class="theme layoutt-retailer" style="overflow-x: hidden;">

    <section class="layoutt">

        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <center><img src="<?php echo base_url();?>vfiles/serachimg.gif" class="img-responsive" style="height:200px;width:200px;"></center>

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
        <?php include("elements/v_aside.php"); ?>
        <!-- -->


         <?php include("elements/v_header.php"); ?>



        
    </section>
    



<style>
    .field-validation-error {
        color: red;
    }

    .required:after {
        color: red;
        content: " *";
    }
</style>
<section class="content content-changepassword-responshive" style="margin:90px 0px 0px 0px; overflow-x:hidden; ">
    <div class="container-fluid">
        <!--Change Login Password -->
        <div class="row clearfix changepas-clearfix">
            <div class="col-md-12" style="padding-left: 10px;">
                <div class="card password-card">
                    <div class="change-passwordheding">
                        <p style="font-size:21px;"><i class="fa fa-lock"></i>&nbsp;Login&nbsp;Password</p>
                    </div>
                    <div class="row">
                        <div class="col-md-5 password-first">
                            <div class="body">
                                <div class="password-content" style="padding-top:13px;border:1px solid #dddddd;border-radius:0px;">
                                    <center><p class="restpinclass" style="margin-top:-24px;font-weight:bold;padding:0px 16px 1px 16px;background:linear-gradient(#ffffff 0%, #ffffff 100%);position:absolute;right:43%;border-radius:1px;">Important</p></center>
                                    <p style="line-height:32px;padding-left:10px;">1.Password must be Required one Special character</p>
                                    <p style="line-height:32px;padding-left:10px;">2.Password must be Required one Digit Number</p>
                                    <p style="line-height:32px;padding-left:10px;">3.Password must be Required one Lowercase character</p>
                                    <p style="line-height:32px;padding-left:10px;">4.Password must be Required one Uppercase character</p>
                                    <p style="line-height:32px;padding-left:10px;">4.Password must be Required one alphabet character</p>
                                    <p style="line-height:32px;padding-left:10px;">5.Password must be Required Minimum Length Six character</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="body classbodysecond" style="margin-bottom:11px;">
                            	<?php include("elements/messagebox.php") ?>
                                <div class="password-content" style="padding-top:13px;border:1px solid #dddddd;border-radius:5px;padding-bottom:3px;">
                                    <center><p class="restpinclass" style="margin-top:-24px;font-weight:bold;padding:0px 16px 1px 16px;background:linear-gradient(#ffffff 0%, #ffffff 100%);position:absolute;right:35%;border-radius:1px;">Change&nbsp;Login&nbsp;Password</p></center>
<form action="<?php echo base_url()."Retailer/change_password"; ?>" class="form-horizontal" method="post" role="form" novalidate="novalidate"><input name="__RequestVerificationToken" type="hidden" value="1iyTymoK1AnXybkoinN4ye4HFkMXb6AZrY-emBIfkHHerCJviNoR8KR3DpdRtpXKw-f_FxLkBP71ymi4rIsodCJ_lkDfIi2RPiLHbxWns1TfzKyOIa2hAXm_iVuzIfILTdPI-WXLj9FKv0lSjEi0Ag2">                                        <div class="body" style="margin-top:20px;">
                                            
                                            <div class="row clearfix">
                                                <div class="col-md-4">
                                                    <label class="required">Old Password</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <p style="font-size:10px;margin-top:-16px;"><span class="field-validation-valid text-danger" data-valmsg-for="Item1.OldPassword" data-valmsg-replace="true"></span></p>
                                                    <div class="form-group" style="margin-bottom:0px;margin-top:-8px;">
                                                        <div class="" style="border:1px solid #dddddd;">
                                                            <input class="form-control" data-val="true" data-val-required="The Current password field is required." id="Item1_OldPassword" name="Item1.OldPassword" required="" type="password">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-4">
                                                    <label class="required">New Password</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <p style="font-size:10px;margin-top:-21px;"><span class="field-validation-valid text-danger" data-valmsg-for="Item1.NewPassword" data-valmsg-replace="true"></span></p>
                                                    <div class="form-group" style="margin-bottom:0px;margin-top:-8px;">
                                                        <div class="" style="border:1px solid #dddddd;">
                                                            <input class="form-control" data-val="true" data-val-length="The New password must be at least 6 characters long." data-val-length-max="100" data-val-length-min="6" data-val-required="The New password field is required." id="Item1_NewPassword" name="Item1.NewPassword" required="" type="password">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-4">
                                                    <label class="required">Confirm Password</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <p style="font-size:10px;margin-top:-16px;"><span class="field-validation-valid text-danger" data-valmsg-for="Item1.ConfirmPassword" data-valmsg-replace="true"></span></p>
                                                    <div class="form-group" style="margin-bottom:0px;margin-top:-8px;">
                                                        <div class="" style="border:1px solid #dddddd;">
                                                            <input class="form-control" data-val="true" data-val-equalto="The new password and confirmation password do not match." data-val-equalto-other="*.NewPassword" id="Item1_ConfirmPassword" name="Item1.ConfirmPassword" required="" type="password">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div class="form-group" style="margin-bottom:0px;margin-top:-20px;">
                                                        <div class="" style="float:right;">
                                                            <button type="submit" class="btn  m-t-15 waves-effect" style="border:1px solid #c7c2c2;background:#dedddd;">Change Password</button>
                                                            <button type="reset" class="btn  m-t-15 waves-effect" style="margin-top:15px;border:1px solid #c7c2c2;background:#dedddd;">Reset</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Change Transaction IMPS AND Reset-->
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card" style="margin-top:-11px;">
                    <div class="change-passwordheding change-passwordhedingrwet">
                        <p style="font-size:21px;"><i class="fa fa-lock"></i>&nbsp;Transaction&nbsp;Pin</p>
                    </div>
                    
                        <div class="row">
                        <div class="col-md-5 resetimps-emai">
                            <div class="body bodyclassfirst">
                                <div class="password-content password-contentswer fullbodydycolorbg" style="min-height: 264px;padding-top:13px;border:1px solid #dddddd;border-radius:5px;">
                                    <center><p class="restpinclass restpinclass-class" style="margin-top:-24px;font-weight:bold;padding:0px 16px 1px 16px;background:linear-gradient(#ffffff 0%, #ffffff 100%);position:absolute;right:38%;border-radius:1px;">Reset&nbsp;IMPS&nbsp;Pin</p></center>
<form action="<?php echo base_url()."Retailer/change_txnpassword"; ?>" id="resttarnspass" method="post">                                        <div class="body" style="margin-top:20px;">
                                            <div class="row clearfix">
                                                
                                                    
                                                
                                                <div class="col-md-12 txtemailret txtemaisup">

                                                    <div class="form-group classemailre" style="margin-bottom:0px;margin-top:-8px;">
                                                        <label class="required">Register&nbsp;Email&nbsp;Id<sup>*</sup></label>
                                                        <div class="" style="border:1px solid #dddddd;">
                                                            <input type="text" id="txtemail" name="txtemail" class="form-control" placeholder="Enter Registered Email" required="">
                                                        </div>
                                                        <div class="errorswer" style="height:22px;"> <p class="showclickerror" style="display:none;color:#fff;">Please Enter Register Email-Id</p></div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12 password-click">
                                                    <div class="form-group" style="margin-bottom:0px;margin-top:0px;">
                                                        <center>
                                                            <div class="">
                                                                
                                                                <button type="button" id="clickemebutton" class="btn  btn-circle-lg waves-effect waves-circle waves-float" style="width:111px;height:111px;background-color:whitesmoke;" onclick="confrim()">
                                                                    <p style="font-size:18px;text-align:center;color:red;">Click&nbsp;Me</p>
                                                                </button>
                                                            </div>
                                                        </center>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
</form>                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="body classbodysecond" style="margin-bottom:11px;">
                                <div class="password-content" style="padding-top:13px;border:1px solid #dddddd;border-radius:5px;">
                                    <center><p class="restpinclass" style="margin-top:-24px;font-weight:bold;padding:0px 16px 1px 16px;background:linear-gradient(#ffffff 0%, #ffffff 100%);position:absolute;right:39%;border-radius:1px;">Change&nbsp;IMPS &nbsp;Pin</p></center>
<form action="<?php echo base_url()."Retailer/change_password"; ?>" method="post" novalidate="novalidate">                                        
	<div class="body" style="margin-top:20px;">
                                            
                                            <div class="row clearfix">
                                                <div class="col-md-4">
                                                    <label class="required">Enter Old Pin</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <p style="font-size:10px;margin-top:-16px;"><span class="field-validation-valid text-danger" data-valmsg-for="Item2.OldPin" data-valmsg-replace="true"></span></p>
                                                    <div class="form-group" style="margin-bottom:0px;margin-top:-8px;">
                                                        <div class="" style="border:1px solid #dddddd;">
                                                            <input class="form-control" data-val="true" data-val-required="The Current password field is required." id="Item2_OldPin" name="Item2.OldPin" required="" type="password">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-4">
                                                    <label class="required">Enter New Pin</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <p class="seconderrowet" style="font-size:10px;margin-top:-21px;"><span class="field-validation-valid text-danger" data-valmsg-for="Item2.NewPin" data-valmsg-replace="true"></span></p>
                                                    <div class="form-group" style="margin-bottom:0px;margin-top:-8px;">
                                                        <div class="" style="border:1px solid #dddddd;">
                                                            <input class="form-control" data-val="true" data-val-required="The New Pin field is required." id="Item2_NewPin" maxlength="8" name="Item2.NewPin" required="" type="password">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-4">
                                                    <label class="required">Enter Confirm Pin</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <p class="seconderrowet" style="font-size:10px;margin-top:-16px;"><span class="field-validation-valid text-danger" data-valmsg-for="Item2.ConfirmPin" data-valmsg-replace="true"></span></p>
                                                    <div class="form-group" style="margin-bottom:0px;margin-top:-8px;">
                                                        <div class="" style="border:1px solid #dddddd;">
                                                            <input class="form-control" data-val="true" data-val-equalto="The new Pin and confirmation Pin do not match." data-val-equalto-other="*.NewPin" id="Item2_ConfirmPin" maxlength="8" name="Item2.ConfirmPin" required="" type="password">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div class="form-group" style="margin-bottom:0px;margin-top:-20px;">
                                                        <div class="" style="float:right;">
                                                            <button type="submit" class="btn  m-t-15 waves-effect" style="border:1px solid #c7c2c2;background:#dedddd;">Change Pin</button>
                                                            <button type="reset" class="btn  m-t-15 waves-effect" style="margin-top:15px;border:1px solid #c7c2c2;background:#dedddd;">Reset</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
</section>
<script src="<?php echo base_url();?>vfiles/jquery.min.js.download"></script>
<script src="<?php echo base_url();?>vfiles/jquery-1.10.2.min.js.download"></script>
<script src="<?php echo base_url();?>vfiles/sweetalert-dev.js.download"></script>
<link href="<?php echo base_url();?>vfiles/sweetalert(1).css" rel="stylesheet">
<script>
    $(document).ready(function()
    {
        var succ ='';
        var error = '';
        if(succ !="")
        {
            swal("Change Password!", succ, "success");
        }
        if(error !="")
        {
            swal("Wrong!", error, "success");
        }
          var messages = '';
            if(messages !="" && messages !=null) {
                swal("Error!", messages, "error");
            }
    })
</script>
<!-- Reset IMPS PIN-->
<script>
    function confrim()
    {
        var txtmail = $("#txtemail").val();
        if (txtmail != "")
        {
            swal({
                title: "Are you sure?",
                text: "You want to reset your IMPS Pin",
                //text: kk,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Reset IMPS Pin!",
                closeOnConfirm: false
            },
     function (isConfirm) {
         if (isConfirm) {
             $("#resttarnspass").submit();
             return true;
         }
         else {
             return false;
         }
     });
        }
        else
        {
            //swal("Oops!", "Please Enter Register Email-Id", "error");
            $(".showclickerror").css("display", "block")
            return false;
        }

    }
</script>






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
    <script>
        $(function () {
            var current = location.pathname;
            var chk = 0;
            $('#leftulbar li a').each(function () {
                var $this = $(this);
                // if the current path is like this link, make it active
                if ($this.attr('href').indexOf(current) !== -1) {
                    //alert("djdjdj")
                    $(this).closest("li").addClass("active");
                    if (chk == 5) {
                        return false;
                    }
                    chk++;
                }
            })
        })
    </script>


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
    <script src="<?php echo base_url();?>vfiles/pdfmake.min.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/vfs_fonts.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/buttons.html5.min.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/buttons.print.min.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/jquery-datatable.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/bootstrap-material-datetimepicker.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/sweetalert.min.js.download"></script>
    <link href="<?php echo base_url();?>vfiles/datatable.css" rel="stylesheet">

    <script src="<?php echo base_url();?>vfiles/basic-form-elements.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/bootstrap-datepicker.min.js.download"></script>
    <script src="<?php echo base_url();?>vfiles/bootstrap-datetimepicker.min.js.download"></script>









<!--Redirect to Index view with javascript-->


<script>
    function gocomplaint()
    {
        var url = '/RETAILER/Home/Complaint';
        window.location.href = url;
    }
</script>
<!-- Push Nitification using SignalR-->
<script src="<?php echo base_url();?>vfiles/jquery.signalR-2.4.0.min.js.download"></script>
<script src="<?php echo base_url();?>vfiles/hubs"></script>
<script type="text/javascript">

    window.onload = function () {
        //alert("chal gaya kya???");

        var hub = $.connection.notificationHub;
        //alert("notificationHub");
        //Client Call
        hub.client.broadcaastNotif = function (totalNotif) {
            //alert("broadcaastNotif");
            console.log("Notif Data: " + totalNotif);
            console.log("total items : " + totalNotif.length)
            if (totalNotif.length > 0) {
                $.each(totalNotif, function (i, obj) {
                    console.log("i : " + i);
                    console.log("Title : " + obj.Title);
                    console.log("Details : " + obj.Details);
                    console.log("DetailsURL : " + obj.DetailsURL);
                    //setNotification(obj.Title, obj.Details, obj.DetailsURL);
                    customnotify(obj.Title, obj.Details, obj.DetailsURL, obj.Id);
                });

            }
        };
        //$.connection.hub.start().done(function () { });
        $.connection.hub.start()
            .done(function () {
                console.log("Hub Connected!");

                //Server Call
                hub.server.getNotification();

            })
            .fail(function () {
                console.log("Could not Connect!");
            });
    };
</script>


<script> 
    function SetAsReaded(idn,url)
    {
        //alert("sjbskjdfbaaaaaaaaaaaaasjkdfb");
       // alert('maharshimulti.co.in');
        var urlSiteName = 'master.maharshimulti.co.in';
        var setObj = { Id : idn};
        var Url = "https://www." + urlSiteName +"/api/Notification/UpdateReadProperty";
        //alert(Url);
        $.ajax({
            type: "POST",
            //url: "/api/Values/SendNotification",
            url: Url,
            data: JSON.stringify(setObj),
            contentType: 'application/json; charset=utf-8',
            success: function (data) {
                //reset field
                //$("#myMessage").val("");
            },
            error: function (xhr,err) {
                console.log("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
                console.log("responseText: " + xhr.responseText);
            }
        });
        //window.open(url,"_blank");
    }
</script>


<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        if (Notification.permission !== "granted") {
            Notification.requestPermission();
        }
    });
    function customnotify(title, desc, url, id) {
        if (Notification.permission !== "granted") {
           // alert("permission=granted");
            Notification.requestPermission();
        }
        else {
            //alert('');
            var notification = new Notification(title, {
                icon: '',
                body: desc,
            });

            /* Remove the notification from Notification Center when clicked.*/
            notification.onclick = function () {
                //alert("Click");
                SetAsReaded(id, url);
                notification.close();
            };


            ///* Callback function when the notification is closed. */
            notification.onclose = function () {
                SetAsReaded(id, url);
                notification.close();
                console.log('Notification closed');
            };
        }


    }
</script>

<!-- Push Nitification using SignalR END-->
<!--  Get Total  My Credit Balance-->
<script>
        function showoutstandingbal()
        {
            $("#showoutstandingbalance").empty();
            $.ajax({
                type: 'Post',
                url: "/RETAILER/Home/Chkbalance",
                dataType: 'html',
            cache: false,
            async: false,
            success: function (data) {
                var x = JSON.parse(data);
                var newRow =

 "<tr>" +
"<td><a href='/RETAILER/Home/Show_Credit_report_by_admin',style='text-decoration:none;cursor:pointer;'><p>My Credit From Admin</p></a></td>" +
"<td><p style='text-align:center;'>" + x.admincreditbal + "</p></td>" + "</tr>" +
"<tr>"+
 "<tr>" +
"<td><a href='/RETAILER/Home/Show_Credit_report_by_dealer',style='text-decoration:none;cursor:pointer;'><p>My Credit From Distributor</p></a></td>" +
"<td><p style='text-align:center;'>" + x.dealercreditbal + "</p></td>" + "</tr>" +
"<tr>";
  $('#showoutstandingbalance').append(newRow);
            }
        });
        }
</script>

<!--Transfer Total Balance Retailer To Retailer and Recived Balannce from Dealer and admin-->
<script>
        function showtransferbal()
        {
            $("#showtransferbalancetableid").empty();
            $.ajax({
                type: 'POST',
                url:'/RETAILER/Home/Totalbaltransfer',
                dataType:'html',
                cache:false,
                async:false,
                success: function(data)
                {
                       var x = JSON.parse(data);
                       var newRow =

    "<tr>" +
   "<td><a href='/RETAILER/Home/Retailer_to_retailer',style='text-decoration:none;cursor:pointer;'><p>Total&nbsp;Transfer&nbsp;Retailer&nbsp;to&nbsp;Retailer</p></a></td>" +
   "<td><p style='text-align:center;'>" + x.retailertoretailer + "</p></td>" + "</tr>" +
    "<tr>" +
    "<tr>" +
   "<td><a href='/RETAILER/Home/ReceiveFund_by_admin',style='text-decoration:none;cursor:pointer;'><p>Received&nbsp;From&nbsp;Admin</p></a></td>" +
   "<td><p style='text-align:center;'>" + x.admintoretailer + "</p></td>" + "</tr>" +
    "<tr>" +
    "<tr>" +
   "<td><a href='/RETAILER/Home/ReceiveFund_by_dealer',style='text-decoration:none;cursor:pointer;'><p>Received&nbsp;From&nbsp;Distributor</p></a></td>" +
   "<td><p style='text-align:center;'>" + x.dealertoretailer + "</p></td>" + "</tr>" +
    "<tr>";

   $('#showtransferbalancetableid').append(newRow);
            }
            });
        }
</script>










</body></html>