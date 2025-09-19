<!DOCTYPE html>
<!-- saved from url=(0040)<?php echo base_url(); ?>/Distributor/Home -->
<html class="chrome"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    
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

<section class="content my-dashboard">
    <div class="container-fluid">

        <!--Holiday and News-->
        <div class="row">
        <div class="top-navmenup finaciall" style="display: none; ">
            <ul id="leftulbar" class="nav nav-tabs tab-nav-left nav1-tabs1" role="tablist" style="padding-top:5px;border-bottom:none;">
                <li id="dashboard" class="listtryp" role="presentation" style="padding:0px;">
                    <a href="<?php echo base_url(); ?>/Distributor/Home" aria-expanded="false" style="background:transparent; cursor:pointer;"><i class="fa fa-home" style="color:white;top:-3px;"></i></a>
                </li>
                <li id="recharge" class="listtryp" role="presentation" style="padding:0px;">
                    <a href="<?php echo base_url(); ?>/Distributor/Home/Index" id="recharge" aria-expanded="false" style="background:transparent;">RECHARGE &amp; BILL</a>
                </li>
                <li id="finanical" class="listtryp" role="presentation" style="padding:0px;">
                    <a href="<?php echo base_url(); ?>/Distributor/Home/Money_transfer1" aria-expanded="true" style="background:transparent;">FINANCIAL</a>
                </li>
                <li id="Gift" class="listtryp" role="presentation" style="padding:0px;">
                    <a href="<?php echo base_url(); ?>/Distributor/Home/Gift_Card" aria-expanded="true" style="background:transparent;">GIFT&nbsp;CARDS</a>
                </li>

                <li id="Dth" class="listtryp" role="presentation" style="padding:0px;">
                    <a href="<?php echo base_url(); ?>/Distributor/DthConnection/Index" aria-expanded="true" style="background:transparent;">NEW-DTH</a>
                </li>
                <li id="travel" class="listtryp" role="presentation" style="padding:0px;">
                    <a href="<?php echo base_url(); ?>/Distributor/Home/Travel" aria-expanded="true" style="background:transparent;">TRAVEL</a>
                </li>
                <li id="ecommerce" class="listtryp" role="presentation" style="padding:0px; margin-bottom:-27px;">
                    <a href="<?php echo base_url(); ?>/Distributor/ECommerce/Index" aria-expanded="true" style="background:transparent;">E-COMMERCE</a>
                </li>


            </ul>
        </div>
    </div>








<!-------------------------- alert bar on dashboard , messagebar on dashboard start ----->
    <div class="bal">
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="color-find color-finddasbord rowsate-responsive">
                            <div class="col-sm-12 col-xs-5 col-md-4 holiday-b holiday-classstart">
                                <div class="row">
                                    <div class="col-md-12 classstart-newcla newcla-total change-responsive" style="padding-left:0;">
                                     

                                            <center><p style="font-size:22px;margin-top:7px;text-align:center;color:#e0dddd;font-weight:700;">No Holiday !</p></center>
                                 
                                </div>



                            </div>
                        </div>
                            <div class="col-sm-12 col-md-8 col-xs-5 new newaddclass slideCol" style="height:auto;overflow:hidden;">
                                <div class="scroller">
                                    <div class="inner">

                                            <p class="first-ani" style="font-size:19px;color:#000;">
                                                <label><span>Great News</span></label>
                                                Welcome to <?php echo $this->white->getName(); ?>
                                            </p>
                                    

                                    </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<!-------------------------- alert bar on dashboard , messagebar on dashboard start ----->    
<!--end -->





    <!--Profile and Today Business and report-->
    <div class="bals">
    <div class="row clearfix">


        <!-- Profile -->
        <div class="col-xs-12 col-md-4 cart-p dasborddetail">
            <div class="dasborddetailback">
            <div class="card cart-pp">
                <div class="" style="padding-top:1px;display:none;">
                    <div class="ribbon"><span>RETAILER</span></div>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="adminprofile">
                            <div class="body" style="height:294px;margin-top:38px;">
                                <center>
                                    
                                    <div class="msg" style="padding-top:16px;">newrcname@gmail.com</div>

                                    <div class="msg" style="padding-top:16px;">RAVIKANT</div>
                                </center>

                                <center>
                                    <div class="row" style="margin-top:8%;">

                                        <div class="col-xs-6" style="margin-bottom:0px;">
                                            <a href="<?php echo base_url(); ?>/Distributor/Home/Profile" class="btn btn-default waves-effect" type="button" style="text-decoration:none;box-shadow:none; border:1px solid #dddddd;width:100%;margin-left:-10px;"><i class="fa fa-user-circle-o" style="top:1px;font-size:14px;"></i>&nbsp;My&nbsp;Profile</a>
                                        </div>

                                        <div class="col-xs-6" style="margin-bottom:0px;">
                                            <a href="<?php echo base_url(); ?>/Distributor/Home/ChangePassword" style="text-decoration:none;box-shadow:none; border:1px solid #dddddd;width:127%;margin-left:-27px;" class="btn btn-default waves-effect"><span style="font-size: 13px; top: -2px;"><i class="material-icons" style="font-size: 14px; top: 2px; left: -6px;">lock_outline</i>&nbsp;Manage Password</span></a>
                                        </div>
                                        
                                    </div>

                                </center>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="">
                <button id="accu">My Account</button>
            </div>
            <div class="row">
                <div class="col-md-3 full-icon">
                    <a href="<?php echo base_url(); ?>/Distributor/Accountreport">
                        <button type="button" class="btn btn-grey btn-circle-lg waves-effect waves-circle waves-float">
                            <center>
                                <img src="<?php echo base_url();?>vfiles/resume.svg" style="margin-left:3px;margin-bottom:5px;">
                            </center>
                        </button>
                    </a><br>
                    <p><a href="<?php echo base_url(); ?>/Distributor/Home/RetailerLedger" style="margin-left:0px;cursor:pointer;font-size:11px;font-weight:700;">Ledger</a></p>
                </div>
                <div class="col-md-3 full-icon">
                    <a href="<?php echo base_url(); ?>/Distributor/Daybook">
                        <button type="button" class="btn btn-grey btn-circle-lg waves-effect waves-circle waves-float">
                            <img src="<?php echo base_url();?>vfiles/123.svg" style="height: 24px; margin-bottom: 8px; width: 23px;">
                        </button>
                    </a><br>
                    <a href="<?php echo base_url(); ?>/Distributor/Daybook" style="margin-left:3px;cursor:pointer;font-size:11px;font-weight:700;">Day&nbsp;Book</a>
                </div>
                <div class="col-md-3 full-icon">
                    <a href="<?php echo base_url(); ?>/Distributor/Operatorwisereport">
                        <button type="button" class="btn btn-grey btn-circle-lg waves-effect waves-circle waves-float">
                            <img src="<?php echo base_url();?>vfiles/money-bag.svg" style="height:24px;margin-bottom:8px;width:23px;">
                        </button>
                    </a><br>
                    <a href="<?php echo base_url(); ?>/Distributor/Operatorwisereport" style="margin-left:4px;cursor:pointer;font-size:11px;font-weight:700;">My&nbsp;Earn</a>
                </div>

                <div class="col-md-3 full-icon">
                    <a href="<?php echo base_url(); ?>/Distributor/Home/Set_Referral">
                        <button type="button" class="btn btn-grey btn-circle-lg waves-effect waves-circle waves-float">
                            <img src="<?php echo base_url();?>vfiles/refer.svg" style="height:24px;margin-bottom:8px;width:23px;">
                        </button>
                    </a><br>
                    <a href="<?php echo base_url(); ?>/Distributor/Home#" style="margin-left:-2px;cursor:pointer;font-size:11px;font-weight:700;">Referral</a>
                </div>
                <div class="col-md-3 full-icon">
                    <a href="<?php echo base_url(); ?>/Distributor/Home/Service_Fee">
                        <button type="button" class="btn btn-grey btn-circle-lg waves-effect waves-circle waves-float">
                            <img src="<?php echo base_url();?>vfiles/support.svg" style="height:24px;margin-bottom:8px;width:23px;">
                        </button>
                    </a><br>
                    <a href="<?php echo base_url(); ?>/Distributor/Home#" style="margin-left:-2px;cursor:pointer;font-size:11px;font-weight:700;">Service&nbsp;Fee</a>
                </div>

                <div class="col-md-3 pay-o repoat-pp">

                    <a href="<?php echo base_url(); ?>/Distributor/Home/WebLogin">
                        <button type="button" class="btn btn-grey btn-circle-lg waves-effect waves-circle waves-float">
                            <center>
                                <img src="<?php echo base_url();?>vfiles/login.svg" style="height:29px;width:29px;">
                            </center>
                        </button>
                    </a>
                    <a href="<?php echo base_url(); ?>/Distributor/Home/WebLogin" style="margin-left:2px;cursor:pointer;font-size:11px;font-weight:700;">Login&nbsp;Info</a>

                </div>

                <div class="col-md-3 pay-o repoat-pp">

                    <a href="<?php echo base_url(); ?>/Distributor/Home/Bank_info">
                        <button type="button" class="btn btn-grey btn-circle-lg waves-effect waves-circle waves-float">
                            <center>
                                <img src="<?php echo base_url();?>vfiles/business-and-finance.svg" style="height:29px;width:29px;">
                            </center>
                        </button>
                    </a>
                    <a href="<?php echo base_url(); ?>/Distributor/Home#" style="margin-left:2px;cursor:pointer;font-size:11px;font-weight:700;">Bank&nbsp;&amp;&nbsp;Cash</a>

                </div>

                
                <div class="col-md-3 full-icon marketing-op">
                    <a href="<?php echo base_url(); ?>/Distributor/Home/WalletUnloadReport">
                        <button type="button" class="btn bg-grey btn-circle-lg waves-effect waves-circle waves-float" style="margin-left: 2px;">
                            <img src="<?php echo base_url();?>vfiles/affiliate-marketing.svg" style="height:23px;width:23px;">
                        </button>
                    </a><br>
                        <a href="<?php echo base_url(); ?>/Distributor/Home/WalletUnloadReport" style="margin-left:-3px;cursor:pointer;font-size:11px;font-weight:700;">Wallet&nbsp;Unload</a>
                </div>
                




                <button id="pay-a" style="display:none;">payouts&nbsp;&amp;&nbsp;setting</button>



                <div class="col-md-3 pay-o">

                    <a href="<?php echo base_url(); ?>/Distributor/mycommission">
                        <button type="button" class="btn bg-grey btn-circle-lg waves-effect waves-circle waves-float" style="margin-left:8px;">
                            <img src="<?php echo base_url();?>vfiles/monitoring.svg" style="height:23px;width:23px;margin-bottom:4px;">
                        </button>
                    </a>
                    <a href="<?php echo base_url(); ?>/Distributor/mycommission" style="margin-left:3px;cursor:pointer;font-size:11px;font-weight:700;">Operator&nbsp;Comm</a>

                </div>

                <div class="col-md-3 pay-o markup-po">

                    <a href="<?php echo base_url(); ?>/Distributor/Home/MarkupSetting">
                        <button type="button" class="btn btn-grey btn-circle-lg waves-effect waves-circle waves-float">
                            <img src="<?php echo base_url();?>vfiles/Markup.svg" style="height:23px;width:23px;">
                        </button>
                    </a>
                    <a href="<?php echo base_url(); ?>/Distributor/Home/MarkupSetting" style="display:block;width:100%;margin-left:-3px;cursor:pointer;font-size:11px;font-weight:700;">Markup&nbsp;Setting</a>

                </div>

                <div class="col-md-3 pay-o dispu">

                    <a href="<?php echo base_url(); ?>/Distributor/Home/DisputeReport">
                        <button type="button" class="btn btn-grey btn-circle-lg waves-effect waves-circle waves-float">
                            <center>
                                <img src="<?php echo base_url();?>vfiles/hammer.svg" style="height:23px;margin-left:-4px;width:23px;">
                            </center>
                        </button>
                    </a>
                    <a href="<?php echo base_url(); ?>/Distributor/Home/DisputeReport" style="margin-left:-8px;cursor:pointer;font-size:11px;font-weight:700;">Dispute&nbsp;List</a>

                </div>

                <div class="col-md-3 full-icon">

                    <div class="bubblep bubblepss" style="text-align:center;margin:0px auto;display:block;float:none;height:auto !important;">
                        <a href="<?php echo base_url(); ?>/Distributor/Home/Show_Credit_report_by_admin" class="btn btn-default btn-circle waves-effect waves-circle waves-float pull-right dropdown-toggle" role="button" aria-expanded="true" title="My Credit Balance " onclick="showoutstandingbal()">
                            <i class="material-icons" style="color:#000;font-size:35px;margin-top:1px;">bubble_chart</i>
                        </a>
                    </div><br>
                    <div class="my-cre"> <a href="<?php echo base_url(); ?>/Distributor/Home/Show_Credit_report_by_admin" style="font-size:11px;">My Credit</a></div>



                </div>
                <div class="col-md-3 full-icon">

                    <div class="bubblep bubblepss" style="text-align:center;margin:0px auto;display:block;float:none;height:auto !important;">
                        <a href="javascript:void(0);" class="btn btn-default btn-circle waves-effect waves-circle waves-float pull-right dropdown-toggle" role="button" aria-expanded="true" title="My Credit Balance " onclick="showoutstandingbal()">
                            <img src="<?php echo base_url();?>vfiles/Signup.svg" style="height:24px;margin-bottom:8px;width:23px;margin-left:2px;">
                        </a>
                    </div><br>
                    <div class="my-cre"> <a style="font-size:11px;">Invoice</a></div>



                </div>
                <div class="col-md-3 full-icon">
                    <a href="<?php echo base_url(); ?>/Distributor/Home/Gst_Invocing_Retailer_report">
                        <button type="button" class="btn btn-grey btn-circle-lg waves-effect waves-circle waves-float">
                            <img src="<?php echo base_url();?>vfiles/tax.svg" style="height:24px;margin-bottom:8px;width:23px;margin-left:2px;">
                        </button>
                    </a><br>
                    <a href="<?php echo base_url(); ?>/Distributor/Home/Gst_Invocing_Retailer_report" style="margin-left:-2px;cursor:pointer;font-size:11px;font-weight:700;">GST&nbsp;&amp;&nbsp;TDS</a>
                </div>

                

            <div class="col-md-3 full-icon">

                <div class="bubblep bubblepss" style="text-align:center;margin:0px auto;display:block;float:none;height:auto !important;">
                    <a href="javascript:void(0);" class="btn btn-default btn-circle waves-effect waves-circle waves-float pull-right dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true" title="My Credit Balance " onclick="showoutstandingbal()">
                        <img src="<?php echo base_url();?>vfiles/set-target.svg" style="height:24px;width:23px;margin-left:2px;margin-top:2px;">
                    </a>
                </div><br>
                <div class="my-cre"> <a style="font-size:11px;">certification</a></div>

                

            </div>
                



                
                
            </div>

        </div>
            </div>
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 show-to right-op hop-go dashboard-table dashboard-table-responshive">
            <div class="card" style="margin-top:-3px;">
                <div class="nav-tab" style="padding-top:1px;">
                    <!-- Nav tabs -->

                    <ul class="nav nav-tabs token-cpp li-responsivestart" role="tablist" style="padding-bottom:0px;">
                        <li role="presentation" class="active" style=" margin-left:0px;">
                            <a href="<?php echo base_url(); ?>/Distributor/Home#History" data-toggle="tab" aria-expanded="false" class="btn bg-grey waves-effect" onclick="Alltab()">
                                <i class="fa fa-newspaper-o" style="top:3px;color:black;font-size:16px;"></i><span style="color:black;top:2px;">Recent Transactions</span>
                            </a>
                        </li>
                        <li role="presentation" style="">
                            <a href="<?php echo base_url(); ?>/Distributor/Home#Todaybusiness" id="Today" data-toggle="tab" aria-expanded="false" class="btn bg-grey waves-effect" onclick="today(this)">
                                <i class="fa fa-calendar-check-o" style="top:3px;color:black;font-size:16px;"></i><span style="color:black;top:2px;">Today Business</span>
                            </a>
                        </li>
                        <li role="presentation" style="">
                            <a href="<?php echo base_url(); ?>/Distributor/Home#Todaybusiness" data-toggle="tab" id="Yesterday" aria-expanded="false" class="btn bg-grey waves-effect" onclick="today(this)" style="margin-right: 0px;">
                                <i class="fa fa-calendar-check-o" style="top:3px;color:black;font-size:16px;"></i><span style="color:black;top:2px;">Yesterday Business</span>
                            </a>
                        </li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content tabel-dashboard-responsive" style="padding: 0px;background: #eae9e9;margin-top: -2px;height: 570px;">
                        <div role="tabpanel" class="tab-pane fade in active" id="History">
                            <div class="" style="margin-bottom:-2px;" id="rch">
                                <div style="margin-top:1px;">
                                    <div class="row clearfix">
                                        <div class="col-md-12" style="display:none;">
                                            <div class="table-responsive" style="margin-top:-14px;">
                                                <table class="table" style="margin-left:1%;width:98%;">
                                                    <tbody><tr style="border-bottom:1px solid #eeeeee;">
                                                        <td>
                                                            <a href="<?php echo base_url(); ?>/Distributor/Home/RechargeReport" style="text-decoration:none;">
                                                                <center>
                                                                    <img class="img-responsive" src="<?php echo base_url();?>vfiles/recharge.svg" style="height:66px;">
                                                                    <p>Recharge&nbsp;&amp;&nbsp;Bill</p>
                                                                </center>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url(); ?>/Distributor/Home/Money_Transfer_Report" style="text-decoration:none;">
                                                                <center>
                                                                    <img class="img-responsive" src="<?php echo base_url();?>vfiles/dmt.svg" style="height:66px;">
                                                                    <p>Money&nbsp;Transfer</p>
                                                                </center>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url(); ?>/Distributor/Air/TicketReport" style="text-decoration:none;">
                                                                <center>
                                                                    <img class="img-responsive" src="<?php echo base_url();?>vfiles/airplane.svg" style="height:66px;">
                                                                    <p>Flight&nbsp;Booking</p>
                                                                </center>
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="<?php echo base_url(); ?>/Distributor/Bus/BusBookingReport" style="text-decoration:none;">
                                                                <center>
                                                                    <img class="img-responsive" src="<?php echo base_url();?>vfiles/bus.svg" style="height:66px;">
                                                                    <p>Bus&nbsp;Booking</p>
                                                                </center>
                                                            </a>
                                                        </td>

                                                    </tr>
                                                </tbody></table>
                                                <table class="table" style="margin-top:-21px;margin-left:1%;width:98%;">
                                                    <tbody><tr style="border-bottom:1px solid #eeeeee;">
                                                        <td>
                                                            <a href="<?php echo base_url(); ?>/Distributor/Home/AepsReport" style="text-decoration:none;">
                                                                <center>
                                                                    <img class="img-responsive" src="<?php echo base_url();?>vfiles/fingerprint.svg" style="height:66px;">
                                                                    <p>Aadhaar&nbsp;Pay</p>
                                                                </center>
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="<?php echo base_url(); ?>/Distributor/Home/Ecommerce_Report" style="text-decoration:none;">
                                                                <center>
                                                                    <img class="img-responsive" src="<?php echo base_url();?>vfiles/shopping-cart.svg" style="height:66px;">
                                                                    <p>E-commerce&nbsp;&nbsp;&nbsp;</p>
                                                                </center>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url(); ?>/Distributor/Home/m_Possreport" style="text-decoration:none;">
                                                                <center>
                                                                    <img class="img-responsive" src="<?php echo base_url();?>vfiles/mposs.svg" style="height:66px;">
                                                                    <p>&nbsp;&nbsp;&nbsp;&nbsp;M-Poss&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                                                </center>
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="<?php echo base_url(); ?>/Distributor/PANCARD/TokenPurchaseReport" style="text-decoration:none;">
                                                                <center>
                                                                    <img class="img-responsive" src="<?php echo base_url();?>vfiles/pan.svg" style="height:66px;">
                                                                    <p>Pancard</p>
                                                                </center>
                                                            </a>
                                                        </td>

                                                    </tr>
                                                </tbody></table>
                                                <table class="table" style="margin-top:-21px;margin-left:1%;width:98%;">
                                                    <tbody><tr style="border-bottom:1px solid #eeeeee;">
                                                        <td>
                                                            
                                                            <a href="<?php echo base_url(); ?>/Distributor/Home#" style="text-decoration:none;">
                                                                <center>
                                                                    <img class="img-responsive" src="<?php echo base_url();?>vfiles/indo nepal.svg" style="height:66px;">
                                                                    <p>&nbsp;Indo&nbsp;Nepal&nbsp;</p>
                                                                </center>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url(); ?>/Distributor/Hotel/HotelReport" style="text-decoration:none;">
                                                                <center>
                                                                    <img class="img-responsive" src="<?php echo base_url();?>vfiles/hotel.svg" style="height:66px;">
                                                                    <p>Hotel&nbsp;Report</p>
                                                                </center>
                                                            </a>
                                                        </td>


                                                        <td>
                                                            <a href="<?php echo base_url(); ?>/Distributor/DthConnection/DthBookingReport" style="text-decoration:none;">
                                                                <center>
                                                                    <img class="img-responsive" src="<?php echo base_url();?>vfiles/satellite-dish.svg" style="height:66px;">
                                                                    <p style="margin-left:-19px;">Dth&nbsp;Booking</p>
                                                                </center>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url(); ?>/Distributor/Home/Giftcard_Report" style="text-decoration:none;">
                                                                <center>
                                                                    <img class="img-responsive" src="<?php echo base_url();?>vfiles/greeting-card.svg" style="height:66px;">
                                                                    <p>Gift&nbsp;Card</p>
                                                                </center>
                                                            </a>
                                                        </td>

                                                    </tr>
                                                </tbody></table>

                                            </div>
                                        </div>
                                <div class="col-md-12">
                                    <div class="ri-hist-itemone" style="display: block;">

                                        <div class="row clearfix">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="table-responsive">

                                                    <table class="table table-bordered" style="width:100%;">
                                                        <thead>
                                                            <tr>
                                                                <th>Type</th>
                                                                <th>Transaction Description</th>
                                                                <th>Transaction Date</th>
                                                                <th>Cr/Dr</th>
                                                                <th>Updated Bal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           



                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div><!--.row-->
                                    </div>
                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane1 fade" id="Todaybusiness">
                            <div class="row">
                                <div class="col-md-5" style="display:none;">
                                    <div id="donut_chart" class="graph"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="body" style="padding: 0px;">
                                        <div class="table-responsive">
                                            <table class="table table-hover dashboard-task-infos table-bordered" style="text-align: center;margin-bottom: 0;">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center;">Symbol</th>
                                                        <th style="text-align: center;">Services</th>
                                                        <th style="text-align: center;">Success ₹</th>
                                                        <th style="text-align: center;">Ratio (%)</th>
                                                        <th style="text-align: center;">Count</th>

                                                        <th style="text-align: center;">My Earn</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tabletoday"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

            <!--Ledger and Day Book and GST TDS Report-->
            <div class="card" style="margin-top:-6px;display:none;">
                <div class="">
                    <div class="row icon--demos">
                       <div class="col-md-12 style=" display:none;"="">
    <div class="body" style="margin-top:-31px;">
        <div class="icon-button-demo">

            <div class="col-xs-4">
                 </div>

            <div class="col-xs-4">
                 </div>
            <div class="col-xs-4">
               </div>

                                </div> 
                            </div>
                            
                            </div>
                    </div>
                </div>

            </div>
            <!--End-->
        
        </div>
    </div>

        <!--Basic setting-->
        <div class="col-md-3 basic-op" style="display:">
            <div class="card" style="margin-top:-6px;">
                <div class="" style="padding-top:1px;">
           
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active pay-now" id="basicsetting">
                            <div class="body" style="height:332px;">
                                <div class="icon-button-demo">

                                    <div class="col-xs-4">
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/WalletToBankAmountTransfer">
                                            <button type="button" class="btn bg-grey btn-circle-lg waves-effect waves-circle waves-float" style="margin-left:2px;">
                                           <img src="<?php echo base_url();?>vfiles/affiliate-marketing.svg" style="height:26px;">
                                            </button>
                                        </a>
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/WalletToBankAmountTransfer" style="margin-left:-14px;cursor:pointer;font-size:11px;font-weight:700;">Unload&nbsp;Charge's</a>
                                    </div>

                                    <div class="col-xs-4">
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/Bank_info">
                                            <button type="button" class="btn btn-grey btn-circle-lg waves-effect waves-circle waves-float">
                                                <i class="fa fa-university" style="font-size:20px;color:black;"></i>
                                            </button>
                                        </a>
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/Bank_info" style="margin-left:0px;cursor:pointer;font-size:11px;font-weight:700;">Bank&nbsp;Info</a>
                                    </div>
                                    <div class="col-xs-4">
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/Operator_info">
                                            <button type="button" class="btn bg-grey btn-circle-lg waves-effect waves-circle waves-float" style="margin-left:8px;">
                                                <img src="<?php echo base_url();?>vfiles/monitoring.svg" style="height:27px;">
                                            </button>
                                        </a>
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/Operator_info" style="margin-left:3px;cursor:pointer;font-size:11px;font-weight:700;">Operator&nbsp;Comm</a>
                                    </div>

                                 
                                    <div class="col-xs-4">
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/MarkupSetting">
                                            <button type="button" class="btn btn-grey btn-circle-lg waves-effect waves-circle waves-float">
                                              <img src="<?php echo base_url();?>vfiles/Markup.svg" style="height:27px;">
                                            </button>
                                        </a>
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/MarkupSetting" style="margin-left:-9px;cursor:pointer;font-size:11px;font-weight:700;">Markup&nbsp;Setting</a>
                                    </div>
                                    <div class="col-xs-4">
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/WebLogin">
                                            <button type="button" class="btn btn-grey btn-circle-lg waves-effect waves-circle waves-float">
                                                <center>
                                                    <img src="<?php echo base_url();?>vfiles/login.svg">
                                                </center>
                                            </button>
                                        </a>
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/WebLogin" style="margin-left:2px;cursor:pointer;font-size:11px;font-weight:700;">Login&nbsp;Info</a>
                                    </div>
                                    <div class="col-xs-4">
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/GST_Report">
                                            <button type="button" class="btn btn-grey btn-circle-lg waves-effect waves-circle waves-float" style="margin-left:11px;">
                                          <img src="<?php echo base_url();?>vfiles/contract.svg" style="height:26px;">
                                            </button>
                                        </a>
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/GST_Report" style="margin-left:-2px;cursor:pointer;font-size:11px;font-weight:700;">Declaration&nbsp;Form</a>
                                    </div>

                                    <div class="col-xs-4">
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/DisputeReport">
                                            <button type="button" class="btn btn-grey btn-circle-lg waves-effect waves-circle waves-float">
                                                <center>
                                                    <img src="<?php echo base_url();?>vfiles/hammer.svg" style="height:30px;margin-left:-4px;">
                                                  </center>
                                            </button>
                                        </a>
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/DisputeReport" style="margin-left:-8px;cursor:pointer;font-size:11px;font-weight:700;">Dispute&nbsp;List</a>
                                    </div>
                                    <div class="col-xs-4">
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/Gst_Invocing_Retailer_report">
                                            <button type="button" class="btn btn-grey btn-circle-lg waves-effect waves-circle waves-float">
                                                <img src="<?php echo base_url();?>vfiles/tax.svg" style="height:24px;margin-bottom:10px;width:23px;margin-left:4px;">
                                            </button>
                                        </a>
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/Gst_Invocing_Retailer_report" style="margin-left:-6px;cursor:pointer;font-size:11px;font-weight:700;">GST&nbsp;&amp;&nbsp;TDS</a>
                                    </div>

                                    

                                    <div class="col-xs-4">
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/Help">
                                            <button type="button" class="btn btn-grey btn-circle-lg waves-effect waves-circle waves-float" style="margin-left:10px;">
                                                <img src="<?php echo base_url();?>vfiles/Help.svg">
                                            </button>
                                        </a>
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/Help" style="margin-left:25px;cursor:pointer;font-size:11px;font-weight:700;">Help</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                   
                    </div>
                </div>

            </div>
            <!--Ledger and Day Book and GST TDS Report-->
            <div class="card" style="margin-top:-6px;">
                <div class="" style="padding-top:29px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="body" style="margin-top:-31px;">
                                <div class="icon-button-demo">
                              <div class="col-xs-4">
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/Purchase_ORDER">
                                            <button type="button" class="btn btn-grey btn-circle-lg waves-effect waves-circle waves-float">
                                       <img src="<?php echo base_url();?>vfiles/purchase.svg" style="height:24px;margin-bottom:10px;width:23px;margin-left:4px;">
                                            </button>
                                        </a>
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/Purchase_ORDER" style="margin-left:-14px;cursor:pointer;font-size:11px;font-weight:700;">Purchase&nbsp;Req</a>
                                    </div>
                                
                                    <div class="col-xs-4">
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/Retailer_to_retailer">
                                            <button type="button" class="btn btn-grey btn-circle-lg waves-effect waves-circle waves-float">
                                                <center>
                                                    <i class="fa fa-exchange" style="width:23px;height:23px;display:inline-block"></i>
                                                       </center>
                                            </button>
                                        </a>
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/Retailer_to_retailer" style="margin-left:-9px;cursor:pointer;font-size:11px;font-weight:700;">R&nbsp;to&nbsp;R&nbsp;Transfer</a>
                                    </div>
                                    <div class="col-xs-4">
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/WalletUnloadReport">
                                            <button type="button" class="btn btn-grey btn-circle-lg waves-effect waves-circle waves-float" style="margin-left:7px;">
                                                <center>
                                                 <i class="fa fa-credit-card" style="font-size:20px;font-weight:700;color:black;"></i>
                                                                                                                                   
                                                </center>
                                            </button>
                                        </a>
                                        <a href="<?php echo base_url(); ?>/Distributor/Home/WalletUnloadReport" style="margin-left:-2px;cursor:pointer;font-size:11px;font-weight:700;">Unload&nbsp;Wallet</a>
                                    </div>


                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>
            <!--End-->

        </div>
        <!--Show Today and Yesterday Businees-->
        
        <!--End-->
        <!-- #END# Browser Usage -->
    </div>

    <!--end-->


       

</section>


<!-- Flight Markup popup -->

<script src="<?php echo base_url();?>vfiles/jquery.min.js.download"></script>
<script src="<?php echo base_url();?>vfiles/sweetalert-dev.js.download"></script>
<link href="<?php echo base_url();?>vfiles/sweetalert(1).css" rel="stylesheet">

<!--Today Business-->
<script>
    function Alltab()
        {
        document.getElementById("Todaybusiness").style.display = "none";
        document.getElementById("rch").style.marginBottom = "35px";
        }
</script>
<script>
    function today(a)
    {
        document.getElementById("Todaybusiness").style.display = "block";
        $("#tabletoday").empty();

        var x = a.id;
        //call ajax
        $.ajax({
            url: '/Distributor/Home/Show_Today_All_Recharge',
            type: 'POST',
            dataType: "html",
            data: { yesterday: x },
            success: function (data) {
                var  x = JSON.parse(data);

                var newRow =
            "<tr>" +
           " <td style='border-right:1px solid #eeeeee;'><p style='margin-bottom: 0px;'><img src='../../ashok-images/utilty.svg' style='width: 26px;' /></p></td>" +
                    "<td><p style='padding-top:3px;'>Prepaid & Utility</p></td>" +
                    "<td><p style='padding-top:3px;'> " + x.Recharge + "</p></td>" +
                    "<td><p style='padding-top:3px;'>0</p></td>" +
                    "<td><p style='padding-top:3px;'>0</p></td>" +
           
            "<td><p style='padding-top:3px;'> " + x.RechargeEran + "</p></td>" + "</tr>" +
           "<tr>" +
            "<td style='border-right:1px solid #eeeeee;'><p style='margin-bottom: 0px;'><img src='../../ashok-images/mnytrf.svg' style='width: 26px;' /></p></td>" +
                    "<td><p style='padding-top:3px;'>Money Transfar</p> </td>" +
                    "<td><p style='padding-top:3px;'>" + x.Moneytransfer + "</p></td>" +
                     "<td><p style='padding-top:3px;'>0</p></td>" +
                    "<td><p style='padding-top:3px;'>0</p></td>" +
           
            "<td><p style='padding-top:3px;'> " + x.DmtEarn + "</p></td>" + "</tr>" +
            "<tr>" +
            "<td style='border-right:1px solid #eeeeee;'><p style='margin-bottom: 0px;'><img src='../../ashok-images/aepsfngr.svg' style='width: 26px;' /></p></td>" +
                    "<td><p style='padding-top:3px;'>Aeps Services</p> </td>" +
                    "<td><p style='padding-top:3px;'>" + x.Aeps + "</p></td>" +
                     "<td><p style='padding-top:3px;'>0</p></td>" +
                    "<td><p style='padding-top:3px;'>0</p></td>" +
           
                    "<td><p style='padding-top:3px;'> " + x.AepsEarn + "</p></td>" + "</tr>" +
                    "<tr>" +
            "<td style='border-right:1px solid #eeeeee;'><p style='margin-bottom: 0px;'><img src='../../ashok-images/mpsatm.svg' style='width: 26px;' /></p></td>" +
                    "<td><p style='padding-top:3px;'>Mpose (Micro ATM)</p> </td>" +
                    "<td><p style='padding-top:3px;'>" + x.Aeps + "</p></td>" +
                     "<td><p style='padding-top:3px;'>0</p></td>" +
                    "<td><p style='padding-top:3px;'>0</p></td>" +
           
            "<td><p style='padding-top:3px;'> " + x.AepsEarn + "</p></td>" + "</tr>" +
            "<tr>" +
            "<td style='border-right:1px solid #eeeeee;'><p style='margin-bottom: 0px;'><img src='../../ashok-images/pncrd.svg' style='width: 26px;' /></p></td>" +
                    "<td><p style='padding-top:3px;'>Pancard</p> </td>" +
                    "<td><p style='padding-top:3px;'>" + x.Pancard + "</p></td>" +
                     "<td><p style='padding-top:3px;'>0</p></td>" +
                    "<td><p style='padding-top:3px;'>0</p></td>" +
           
            "<td><p style='padding-top:3px;'> " + x.PancardEarn + "</p></td>" + "</tr>" +
            "<tr>" +
            "<td style='border-right:1px solid #eeeeee;'><p style='margin-bottom: 0px;'><img src='../../ashok-images/flybok.svg' style='width: 26px;' /></p></td>" +
                    "<td><p style='padding-top:3px;'>Flight Booking</p> </td>" +
                    "<td><p style='padding-top:3px;'>" + 0.00 + "</p></td>" +
                     "<td><p style='padding-top:3px;'>0</p></td>" +
                    "<td><p style='padding-top:3px;'>0</p></td>" +
           
                    "<td><p style='padding-top:3px;'> " + 0.00 + "</p></td>" + "</tr>" +
                    "<tr>" +
            "<td style='border-right:1px solid #eeeeee;'><p style='margin-bottom: 0px;'><img src='../../ashok-images/busbok.svg' style='width: 26px;' /></p></td>" +
                    "<td><p style='padding-top:3px;'>Bus Booking</p> </td>" +
                    "<td><p style='padding-top:3px;'>" + 0.00 + "</p></td>" +
                     "<td><p style='padding-top:3px;'>0</p></td>" +
                    "<td><p style='padding-top:3px;'>0</p></td>" +
           
                    "<td><p style='padding-top:3px;'> " + 0.00 + "</p></td>" + "</tr>" +
                    "<tr>" +
            "<td style='border-right:1px solid #eeeeee;'><p style='margin-bottom: 0px;'><img src='../../ashok-images/hotelnnj.svg' style='width: 26px;' /></p></td>" +
                    "<td><p style='padding-top:3px;'>Hotel Booking</p> </td>" +
                    "<td><p style='padding-top:3px;'>" + 0.00 + "</p></td>" +
                     "<td><p style='padding-top:3px;'>0</p></td>" +
                    "<td><p style='padding-top:3px;'>0</p></td>" +
           
            "<td><p style='padding-top:3px;'> " + 0.00 + "</p></td>" + "</tr>" +
            "<tr>" +
            "<td style='border-right:1px solid #eeeeee;'><p style='margin-bottom: 0px;'><img src='../../ashok-images/giftcrd.svg' style='width: 26px;' /></p></td>" +
                    "<td><p style='padding-top:3px;'>Gift Cards </p></td>" +
                    "<td><p style='padding-top:3px;'>" + 0.00 + "</p></td>" +
                     "<td><p style='padding-top:3px;'>0</p></td>" +
                    "<td><p style='padding-top:3px;'>0</p></td>" +
           
            "<td><p style='padding-top:3px;'>" + 0.00 + "</p></td>" +
           "</tr>" +
            "<tr>" +
            "<td style='border-right:1px solid #eeeeee;'><p style='margin-bottom: 0px;'><img src='../../ashok-images/cartnu.svg' style='width: 26px;' /></p></td>" +
                    "<td><p style='padding-top:3px;'>E-Commerce</p> </td>" +
                    "<td><p style='padding-top:3px;'>" + 0.00 + "</p></td>" +
                     "<td><p style='padding-top:3px;'>0</p></td>" +
                    "<td><p style='padding-top:3px;'>0</p></td>" +
             
                "<td><p style='padding-top:3px;'>" + 0.00 + "</p></td>" +
             + "</tr>" +
             "<tr>" +
            "<td style='border-right:1px solid #eeeeee;'><p style='margin-bottom: 0px;'><img src='../../ashok-images/shieldni.svg' style='width: 26px;' /></p></td>" +
                    "<td><p style='padding-top:3px;'>Security Services </p></td>" +
                    "<td><p style='padding-top:3px;'>" + 0.00 + "</p></td>" +
                     "<td><p style='padding-top:3px;'>0</p></td>" +
                    "<td><p style='padding-top:3px;'>0</p></td>" +
           
            "<td><p style='padding-top:3px;'>" + 0.00 + "</p></td>" +
           "</tr>";
                    $('#tabletoday').append(newRow);
                    $("#donut_chart").empty();
                    var rechargebillamt = x.Recharge;
                    var moneytransferamt = x.Moneytransfer;
                    var aepstransferamount = x.Aeps;
                    var pancardamount = x.Pancard;
                    initDonutChart(rechargebillamt, moneytransferamt, aepstransferamount, pancardamount);


            },
            error: function (data) {

            }
        });
        return true;

     }
</script>
<!-- Doughnut Chart -->
<script type="text/javascript">
    function initDonutChart(rechargebill, moneytrasfer, aepstransferamount, pancardamount) {

         var rechargeandbill = rechargebill;
         var Financial = moneytrasfer;
         var Aeps = aepstransferamount;
         var Pancard = pancardamount;
         var Travel = 0.00
         var GiftCards = 0.00
         var ECommerce = 0.00
          var Dthbooking =0.00
          Morris.Donut({
            element: 'donut_chart',

            data: [
                {
                    label: 'Recharge & bill',
                    value: rechargeandbill,
                },
            {
                label: 'Financial',
                value: Financial
            },
             {
                 label: 'Aeps',
                 value: Aeps
             },
              {
                  label: 'Pancard',
                  value: Pancard
              },
            {
                label: 'Travels',
                value: Travel
            },
            {
                label: 'Gift Cards',
                value: GiftCards,
                },
             {
                 label: 'E-Commerce',
                 value: ECommerce
             },
            {
              label: 'Dth-Booking',
              value: Dthbooking
            }
            ],

            colors: [
                'rgb(233, 30, 99)',
                'rgb(0, 128, 255)',
                'rgb(255, 152, 0)',
                'rgb(0, 0, 0)',
                'rgb(76, 175, 80)',
                'rgb(255, 0, 0)',
                'rgb(128, 128, 128)',
               ' rgb(121, 85, 72)'],

            formatter: function (y) {
             return y
            }
         });

    }
</script>

<script>
    $(document).ready(function () {
        $("#remainretailer").load(location.href + "/getBalance");

        var errormsg = '';
        if (errormsg != "") {
            swal("Oops!", errormsg, "error");
        }
    });
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
        var url = '/Distributor/Home/Complaint';
        window.location.href = url;
    }
</script>
<!-- Push Nitification using SignalR-->
<script src="./vfiles/jquery.signalR-2.4.0.min.js.download"></script>
<script src="./vfiles/hubs"></script>
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
        var urlSiteName = 'maharshimulti.co.in';
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
                url: "/Distributor/Home/Chkbalance",
                dataType: 'html',
            cache: false,
            async: false,
            success: function (data) {
                var x = JSON.parse(data);
                var newRow =

 "<tr>" +
"<td><a href='/Distributor/Home/Show_Credit_report_by_admin',style='text-decoration:none;cursor:pointer;'><p>My Credit From Admin</p></a></td>" +
"<td><p style='text-align:center;'>" + x.admincreditbal + "</p></td>" + "</tr>" +
"<tr>"+
 "<tr>" +
"<td><a href='/Distributor/Home/Show_Credit_report_by_dealer',style='text-decoration:none;cursor:pointer;'><p>My Credit From Distributor</p></a></td>" +
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
                url:'/Distributor/Home/Totalbaltransfer',
                dataType:'html',
                cache:false,
                async:false,
                success: function(data)
                {
                       var x = JSON.parse(data);
                       var newRow =

    "<tr>" +
   "<td><a href='/Distributor/Home/Retailer_to_retailer',style='text-decoration:none;cursor:pointer;'><p>Total&nbsp;Transfer&nbsp;Retailer&nbsp;to&nbsp;Retailer</p></a></td>" +
   "<td><p style='text-align:center;'>" + x.retailertoretailer + "</p></td>" + "</tr>" +
    "<tr>" +
    "<tr>" +
   "<td><a href='/Distributor/Home/ReceiveFund_by_admin',style='text-decoration:none;cursor:pointer;'><p>Received&nbsp;From&nbsp;Admin</p></a></td>" +
   "<td><p style='text-align:center;'>" + x.admintoretailer + "</p></td>" + "</tr>" +
    "<tr>" +
    "<tr>" +
   "<td><a href='/Distributor/Home/ReceiveFund_by_dealer',style='text-decoration:none;cursor:pointer;'><p>Received&nbsp;From&nbsp;Distributor</p></a></td>" +
   "<td><p style='text-align:center;'>" + x.dealertoretailer + "</p></td>" + "</tr>" +
    "<tr>";

   $('#showtransferbalancetableid').append(newRow);
            }
            });
        }
</script>










</body></html>