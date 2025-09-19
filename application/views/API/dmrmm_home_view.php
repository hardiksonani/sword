<!DOCTYPE html>
<!-- saved from url=(0056)<?php echo base_url();?>API/dmrmm_home -->
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
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

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
        <?php include("elements/v_aside_api.php"); ?>
        <!-- -->


         <?php include("elements/v_header_api.php"); ?>




        <button id="bb" style="display:none;"></button>
    </section>
    



<script src="<?php echo base_url();?>vfiles/loaderdemo.js.download"></script>

<link href="<?php echo base_url();?>vfiles/bootstrap-combobox.css" rel="stylesheet">
<link href="<?php echo base_url();?>vfiles/sp.css" rel="stylesheet">
<link href="<?php echo base_url();?>vfiles/bootstrap-colorpicker.css" rel="stylesheet">
<link href="<?php echo base_url();?>vfiles/select2.min.css" rel="stylesheet">
<script src="<?php echo base_url();?>vfiles/select2.full.min.js.download"></script>
<style>
    .transaction ul li.transaction-left, .transaction ul li.transaction-right {
        height: 28px;
    }
    .loader::after {
        border-color: var(--main-bg-lcolor) !important;
        border-top-color: transparent !important;
    }
    .aadharpaysup{animation: blinks 2s linear infinite;font-size: 8px;top: -10px;left: -12px;}
    @keyframes blinks{
        0%{color: #000;}
        50%{color: green;}
        100%{color: red;}
        }

    @media screen and (max-width:1366px){
        .newpagecustom.newpagecustomertyui ul li span.aeps-aadharclassdiv{left: -11px !important;}
        
    }

    

</style>
<section class="newpagecustom newpagecustomertyui">
    <div id="full" class="col-md-4 tabspage">
        <ul class="tabsmy" id="tabsmyss">
            <li class="tab-link-new fullbodydycolorbg current" data-tab="tab-1" onclick="DMT()"><strong class="img-none" style="display:none;"><img style="height: 65px;" src="<?php echo base_url();?>vfiles/transfer.svg"></strong><img class="hover-display-none" src="<?php echo base_url();?>vfiles/transfer-money.png"><span>DMT</span></li>
            <li class="tab-link-new fullbodydycolorbg" data-tab="tab-2" onclick="AEPS()"><strong class="img-none" style="display:none;"><img src="<?php echo base_url();?>vfiles/aeps1.png"></strong><img class="hover-display-none" src="<?php echo base_url();?>vfiles/aespicon.png"><span class="aeps-aadharclassdiv" style="padding-left: 0;position: relative;left: -5px;">AEPS&nbsp;/&nbsp;Aadhar<sup class="aadharpaysup">pay</sup></span></li>
            <li class="tab-link-new fullbodydycolorbg" data-tab="tab-3" onclick="PANCARD()"><strong class="img-none" style="display:none;"><img src="<?php echo base_url();?>vfiles/pancarde1.png"></strong><img class="hover-display-none" src="<?php echo base_url();?>vfiles/pancardicon.png"><span>Pancard</span></li>
            <li class="tab-link-new fullbodydycolorbg" data-tab="tab-4" onclick="MPOS()"><strong class="img-none" style="display: none; "><img src="<?php echo base_url();?>vfiles/mpos1.png"></strong><img class="hover-display-none" src="<?php echo base_url();?>vfiles/mposicon.png"><span>M-POS</span></li>
        </ul>
        <div id="tab-1" class="tab-content current">
            <div id="reload">
<style>

    .loader {
        position: fixed;
        top: -90px;
        left: 0;
        background-color: rgba(255,255,255,0.7);
        z-index: 999999999999;
        display: none;
        height: 100vw;
        width: 100vw;
    }

    @-webkit-keyframes spin {
        from {
            -webkit-transform: rotate(0deg);
        }

        to {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .loader::after {
        content: '';
        display: block;
        position: absolute;
        left: 48%;
        top: 25%;
        width: 100px;
        height: 100px;
        border-style: solid;
        border-color: black;
        border-top-color: transparent;
        border-width: 4px;
        border-radius: 50%;
        -webkit-animation: spin .8s linear infinite;
        animation: spin .8s linear infinite;
    }
    #addaccount-add123_again {
        float: right;
        font-size: 9px;
        color: var(--main-bg-lcolor);
        font-weight: 600;
        padding: 0px 11px;
        margin-top: 4px;
        border: 1px solid #ddd;
        margin-right: 8px;
    }
    #addaccount-add123_again  label{font-weight:400;margin:0px;}
</style>

<!--------------------First Page--------------------------->
<div id="Firstpage">
    <fieldset>
        <legend class="bodycolormy">Enter Your Remitter Number</legend>
        <div class="col-md-12 remitter_button button-responshivecce">
            <input id="senderno" maxlength="10" name="senderno" onkeypress="return isNumber(event)" placeholder="Enter 10 Digit Number" required="required" type="text" value="">
            <button type="button" id="btnsenddd" name="btnsenddd" onclick="senderdetails(&#39;new&#39;)" class="button-money">Next<i class="fa fa-angle-right" style="top:1px; font-size:19px;float:right;right:15px;"></i></button>
            <span id="errorsenderno" style="color:red;"></span>
        </div>

    </fieldset>

    <div class="money_tab-height">
        <p class="body-border-bottom">Important Notes</p>
        <p class="note-content"><strong>.</strong>Money can be sent to the customer's bank account through IMPS, NEFT and UPI.</p>
        <p class="note-content">
            <strong>.</strong>For any reason, money entered in the wrong account will neither be returned nor transferred to another account. Please check the account number before transferring money.
        </p>
        <p class="note-content"><strong>.</strong>If any transaction is pending, it will become clear on the transaction date + two banking days.</p>
        <p class="note-content"><strong>.</strong>To prove the transaction to be true, you will also have to enter the sender's Aadhaar or PAN card number. Otherwise your Aadhaar number will automatically entered with the transaction.</p>
        <span id="sendererrorshow" style="color:red"></span>
    </div>
</div>
<!------------------------------------------------------------->
<!-----------------New Sender Register------------------------->
<div id="NewSenderregister" class="container-fluid otp_page" style="display:none;">
    <div class="fullwidthaccount fullwidthaccount-top fullwidthaccount-top-respons">
        <div class="col-md-12 amount amount_strong allredyshow">
            <strong style="width:110px;">Remitter Number</strong>
            <span id="newsender"></span>
        </div>
        <div class="col-md-12 amount amount_strong" style="background:#fff;">
            <strong style="">Remitter Name</strong>
            <input id="sendername" type="text" placeholder="Remitter Name" onkeypress="return /[a-z]/i.test(event.key)">
        </div>
        <div class="col-md-12 amount amount_strong" id="amount_strong-change">

            <span id="sendererror" style="color:red;"></span>
        </div>
    </div>
    <div class="container-fluid transaction-button" id="next_page">
        <button id="addaccount-back" style="background:#a39f9e;" onclick="DMT()">Back</button>
        <button id="addaccount-add" class="fullbodydycolorbg addaccount-add-loderss" onclick="newsendernumber()" data-loading-text="&lt;i class=&#39;fa fa-circle-o-notch fa-spin&#39;&gt;&lt;/i&gt;">Next <i class="fa fa-angle-right otp_icon"></i></button>
    </div>
</div>
<!------------------------------------------------------------->
<!-------------------Otp Verify-------------------------------->
<div id="otpshow" class="container-fluid otp_page_second" style="display:none;">
    <div class="fullwidthaccount fullwidthaccount-top">
        <div class="col-md-12 amount amount_strong">
            <strong style="width:auto;">Remitter Number</strong>
            <span id="otpsenderno"></span>
        </div>
        <div class="col-md-12 amount amount_strong">
            <strong style="">Remitter Name</strong>
            <span id="otpsendername"></span>
        </div>
        <div class="col-md-12 amount amount_strong">
            <strong style="">Enter OTP</strong>
            <input id="otpinsert" type="text" placeholder="OTP Sended To Remitter Number">
        </div>
        <div class="col-md-12 amount amount_strong amount-changesse">
            <span id="otperror" style="color:red;"></span>
            <span id="otpbenid" style="display:none;"></span>
        </div>
    </div>
    <div class="container-fluid transaction-button" id="next_page">
        <button id="addaccount-back" style="background:#a39f9e;" onclick="Resend()">Resend OTP</button>
        <button onclick="verifyotp()" id="addaccount-add" class="fullbodydycolorbg addaccount-add-loderss" data-loading-text="&lt;i class=&#39;fa fa-circle-o-notch fa-spin&#39;&gt;&lt;/i&gt;">Next <i class="fa fa-angle-right otp_icon"></i></button>
    </div>
</div>
<!------------------------------------------------------------->
<!---------------------Ben List-------------------------------->
<div id="remlist" class="remlish-responshives" style="display:none">

    <div class="col-md-12 number-login">
        <div class="col-md-5 userName"><span class="hi">Hi , </span> <span id="username"></span></div>
        <div class="col-md-5 changesenderclass">
            <input id="changesender" type="text" style="width:120px;" readonly="" placeholder="Sender Number" onkeypress="return isNumber(event)">
            <i class="fa fa-exchange" onclick="change()" title="Change Sender Number"></i>
        </div>
        <div class="col-md-2 add_account add_account-responshive">
            <a onclick="addnewaccount()" style="cursor:pointer;"><strong>+</strong><span>ADD</span>NEW ACCOUNT</a>
        </div>
    </div>
    <div class="col-md-12 radiobuttonimps radiobuttonimps-responshive">
        <form id="myForm">
            <label class="container">
                <input type="radio" name="bendetails" id="impsbutton" value="IMPS" checked=""><p>IMPS</p>
                <span class="checkmark"></span>
            </label>
            <label class="container">
                <input type="radio" name="bendetails" id="neftbutton" value="NEFT"><p>NEFT</p>
                <span class="checkmark"></span>
            </label>
            <label class="container container-last">
                <input type="radio" name="bendetails" id="upibutton" value="UPI"><p>UPI</p>
                <span class="checkmark"></span>
            </label>
        </form>
    </div>
    <div id="neftimps" class="col-md-12 tabledateall tabledateall-responshive">
        <span id="dellist" style="color:red"></span>
        <table id="benlistttable" class="table-content">
        </table>
    </div>
</div>
<!------------------------------------------------------------->
<!-------------------DMT Transfer------------------>
<div id="dmttransfer" class="dmttransfer-responshivee" style="display:none;">
    <div class="col-md-12 accountholderde">
        <div class="fullwidthaccount">

            <div class="codepenss body-border-bottom">
                <div class="col-md-4 account-holder account-holder1" id="account-holdername">
                    <p class="bodycolormy">Mode</p>
                    <strong id="paymentmodetransfer"></strong>
                </div>

                <div class="col-md-4 account-holder account-holder2" id="account-holdernamefirst">
                    <p class="bodycolormy">Bank Name</p>
                    <strong id="banknametransfer"></strong>
                    <span style="display:none;" id="bencodetransfer"></span>
                </div>
            </div>



            <div class="col-md-12 amount amount_strong transperentss"><strong style="">A/C Number</strong> <span id="accountnotransfer"></span></div>
            <div class="col-md-4 account-holder account-holder2 amount amount_strong">
                <p class="bodycolormy">Bank IFSC</p>
                <strong id="bankifsccodetransfer" style="padding-left:8px !important;"></strong>
            </div>
            <div class="col-md-12 amount amount_strong transperentss"><strong style="">A/C Name</strong><span id="Nametransfer"></span></div>
            <div class="col-md-12 amount"><strong>amount<span class="spanstar" style="color:red">*</span></strong><input id="amounttransfer" type="text" placeholder="Enter Amount" onkeypress="return isNumber(event)"></div>
            <div class="col-md-12 amount"><strong>service fee<span class="spanstar" style="color:red;left: 77px;">*</span></strong><input id="markuptransfer" type="text" placeholder="Enter Markup" value="0" onkeypress="return isNumber(event)"></div>
            <div class="col-md-12 amount radiobuttonimps">
                <strong>Id Proof<span class="spanstar" style="color:red;left:55px;">*</span></strong>
                <div id="dividproof">
                    <label class="container" style="width:auto;">
                        <input type="radio" name="idproof" value="aadhar"><p>AADHAR</p>
                        <span class="checkmark"></span>
                    </label>
                    <label class="container" style="width:auto;">
                        <input type="radio" name="idproof" value="pan"><p>PAN</p>
                        <span class="checkmark"></span>
                    </label>
                    <label class="container container-last" style="width:auto;">
                        <input type="radio" name="idproof" value="none"><p>NONE</p>
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-12 amount" id="idproofshow" style="display:none;"><strong><span id="idproofname" style="text-transform:capitalize;"></span><span class="spanstar" style="color:red;left: 59px;top: -3px;">*</span></strong><input id="idproofid" type="text" placeholder="Enter ID Proof"></div>
            <div class="col-md-12 amount"><strong>DMT PIN<span class="spanstar" style="color:red;left: 60px;">*</span></strong><input id="DMTPIN" type="password" placeholder="Enter Dmt Pin" autocomplete="new-password"></div>
            <div class="col-md-12 amount" id="amount-change"><span id="dmterrorcode" style="color:red;"></span> </div>
        </div>
        <div class="col-md-12 cancelbutton">
            <div class="cancelbuttonright">
                <a href="<?php echo base_url();?>API/dmrmm_home#" class="cancel" onclick="back()">BACK</a>
                <a href="javascript:void(0);" class="cancel cancel-button impsbutton1 fullbodydycolorbg" id="cancelloder" name="cancel-loder" onclick="TransferDMT()">NEXT<i class="fa fa-angle-right"></i></a>
            </div>
        </div>
    </div>
</div>
<!------------------------------------------------------------->
<!-------------------DMT Transfer Confirm------------------>
<div id="dmtconfirm" style="display:none;" class="col-md-12 accountholderde accountholderde-responshive">
    <div class="col-md-12 next-page">
        <div class="button-classadd body-border-bottom">
            <div class="button-one">
                <button><span class="bodycolormy">Confirm <br>detail</span></button>
            </div>
            <div class="button-imps">
                <div class="col-md-12 amount amount_strong"><strong style="">Bank&nbsp;IFS&nbsp;Code</strong><span id="ifscconfirm"></span></div>
                <div class="col-md-12 amount amount_strong"><strong style="width: 51%;">Payment mode</strong><span id="modeconfirm"></span></div>
            </div>
        </div>
        <div class="fullwidthaccount fullwidthaccount-top">
            <div class="col-md-12 amount amount_strong"><strong style="">A/C Number</strong><span id="accountconfirm"></span></div>
            <div class="col-md-12 amount amount_strong"><strong style="">A/C Name</strong><span id="nameconfirm"></span></div>
            <div class="col-md-12 amount amount_strong"><strong style="">Bank Name</strong><span id="banknameconfirm"></span></div>

            <div class="col-md-12 amount"><strong>Net amount</strong><span id="amountconfirm"></span></div>
            <div class="col-md-12 amount"><strong>service fee</strong><span id="servicefeeconfirm"></span></div>
            <div class="col-md-12 amount"><strong>Id Proof Type</strong><span id="idprooftype"></span></div>
            <div class="col-md-12 amount"><strong style="width:108px;">Id Proof Number</strong><span id="idproofnumber"></span></div>
            
            <div class="col-md-12 amount transfererroreee"><span id="transfererror" style="color:red;"></span></div>
        </div>
        <div class="col-md-12 cancelbutton">
            <div class="cancelbuttonright">
                <a href="<?php echo base_url();?>API/dmrmm_home#" class="cancel" onclick="confirmback()">BACK</a>
                <a href="javascript:void(0);" id="fpay" class="cancel cancel-button impsbutton1 fullbodydycolorbg confirmbuttontext" onclick="finalpay()">Confirm Payment<i class="fa fa-angle-right"></i></a>
            </div>
        </div>
    </div>
</div>
<!------------------------------------------------------------->
<!-------------------DMT Transfer Final------------------>
<div id="dmttransferfinal" style="display:none" class="col-md-12 accountholderde accountholderde-new-responshive">
    <div class="col-md-12 Confirm-Payment">
        <div class="container-fluid">
            <div class="col-md-6 successful">
                <p id="transresp"></p>
                <strong>
                    <img src="<?php echo base_url();?>vfiles/india(2).svg"><span class="transform-re" id="responseamount">  </span>
                    <i id="success" class="fa fa-check fullbodydycolorbg" style="background:green;"></i>
                    <i id="failed" class="fa fa-times fullbodydycolorbg" style="background:red;"></i>
                </strong>


                <span id="responseorderid"></span>
            </div>
            <div class="col-md-6 successful-logo">
                <img id="logo" src="<?php echo base_url();?>API/dmrmm_home">
            </div>
        </div>
        <div class="container-fluid transaction">
            <p>transaction details</p>
            <ul class="transaction-detail">
                <li class="transaction-left"><span>retailer firm</span></li>
                <li class="transaction-right"><span id="responsefirmname"></span></li>
                <li class="transaction-left"><span>Payment mode</span></li>
                <li class="transaction-right"><span id="responsemode"></span></li>
                <li class="transaction-left"><span>amount</span></li>
                <li class="transaction-right"><span id="responseamountnew"></span></li>
                <li class="transaction-left"><span>service Fee</span></li>
                <li class="transaction-right"><span id="servicefee"></span></li>
                <li class="transaction-left"><span>tax</span></li>
                <li class="transaction-right"><span id="responsetax"></span></li>
                <li class="transaction-left"><span>total amount</span></li>
                <li class="transaction-right"><span id="responsetotal"></span></li>
                <li class="transaction-left" style="width:16%;"><span>Bank&nbsp;RRN</span></li>
                <li class="transaction-right" style="width:84%;float:right;"><span id="responsebankrrn"></span></li>
                <li class="transaction-left"><span>Account Number</span></li>
                <li class="transaction-right"><span id="responseaccount"></span></li>
                <li class="transaction-left"><span>IFS Code</span></li>
                <li class="transaction-right"><span id="responseifsccode"></span></li>
            </ul>
            <div class="container-fluid transaction-button">
                <div style="float:left">

                </div>
                <button id="transaction-more" class="fullbodydycolorbg" onclick="back()" style="height: 30px;margin-top: 1px;margin-right: 10px;">more pay</button>
                <button id="transaction-back" onclick="DMT()">Close</button>


                <div style="float:right;" id="successdata">
                    <button id="transaction-print" onclick="printmoney()">print</button>
                    <button id="transaction-mail" onclick="email()" style="background:#a39f9e;">email</button>
                    <button id="transaction-more" class="fullbodydycolorbg" onclick="back()">more pay</button>
                </div>

            </div>
            <div class="container-fluid transaction-button">
                <span id="sendemailmsg" style="color:red"></span>
            </div>
        </div>
    </div>
</div>
<!------------------------------------------------------------->
<!-------------------DMT Transfer Add New Ben------------------>
<div id="register_new_ben" style="display:none;" class="col-md-12 accountholderde">
    <div id="addnewaccount" class="container-fluid add_account_page add_account_page-responshive" style="margin-top:0;">
        <div class="col-md-12 imps_second body-border-bottom">
            <div class="col-md-12 radiobuttonimps" style="margin-top:0;">
                <form id="frmadd">
                    <label class="container">
                        <input type="radio" name="addnewradio" id="impsbutton" value="IMPS" checked=""><p>IMPS / NEFT</p>
                        <span class="checkmark"></span>
                    </label>

                    <label class="container container-last">
                        <input type="radio" name="addnewradio" id="upibutton" value="UPI"><p>UPI</p>
                        <span class="checkmark"></span>
                    </label>
                </form>
            </div>
        </div>
        <div id="impsaddnew">

            <div class="full-add-account">
                <div class="col-md-12 amount amount_strong">
                    <strong style="">A/C Number</strong>
                    <input id="accountno" type="text" placeholder="Account Number">
                    <span style="color:red;left:82px;">*</span>
                </div>
                <div class="add-select-bank">
                    <div class="col-md-12 amount amount_strong">
                        <strong style="">Bank Name</strong>
                        <select id="banknm" name="banknm" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">

                        </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 250px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-banknm-container"><span class="select2-selection__rendered" id="select2-banknm-container"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        
                        <span style="color:red;left: 76px;">*</span>
                    </div>

                </div>
                <div class="col-md-12 amount amount_strong">
                    <strong style="">IFSC Code</strong>
                    <button class="click-change"><img src="<?php echo base_url();?>vfiles/refresh.svg"></button>
                    <input id="ifsccode" type="text" class="click-change-block" placeholder="Enter IFS Code">
                    <span style="color:red; padding-left:4px;">*</span>
                </div>
                <div class="col-md-12 amount amount_strong">
                    <strong style="">A/C Holder</strong>
                    <input id="benname" class="bennameCHange bennameCHangeqwety" type="text" placeholder="Beneficiary Name">
                    <span style="color:red;padding-left:8px;">*</span>
                    <button id="addaccount-add123" class="fullbodydycolorbg verify-account" onclick="Accountverify()">A/c verify</button>
                    <button id="addaccount-add123_again" class="verify-account" style="display:none;" onclick="Accountverifyagain()">Missmatch !<br><label>Try Again</label></button>
                </div>
                <div class="col-md-12 amount amount_strong" id="verifyimpserrorsesw">
                    <span id="verifyimpserror" style="color:red"></span>
                </div>
            </div>

            <div class="container-fluid transaction-button">
                <button id="addaccount-back" style="background:#a39f9e;" onclick="back()">Back</button>
                <button id="addaccount-addasssss" class="fullbodydycolorbg addaccount-addMy" onclick="Registerben()"><i style="float: left;margin-top: 4px;display: block;position: relative;left: -4px;"></i><span>Add Account</span></button>


            </div>
        </div>

        <div class="container-fluid transaction-button">
            <span id="benerror" style="color:red;"></span>
        </div>

    </div>
</div>
<!------------------------------------------------------------->
<!-------------------UPI Transfer Add New Ben------------------>
<div id="benadd" style="display:none;" class="col-md-12 accountholderde">
    <div class="container-fluid add_account_page">
        <div class="full-add-account click-upi">
            <div class="col-md-12 amount amount_strong"><strong style="">UPI ID</strong><input type="text"></div>
            <div class="add-select-bank">
                <div class="col-md-12 amount amount_strong">
                    <strong style="">Bank Name</strong>
                    <i class="fa fa-angle-down"></i>    <select class="select-bank-name select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                        <option>SELECT BANK NAME</option>
                        <option>HDFC BANK</option>
                        <option>STATE BANK of india</option>
                        <option>HDFC BANK</option>
                    </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 60px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-fosa-container"><span class="select2-selection__rendered" id="select2-fosa-container" title="SELECT BANK NAME">SELECT BANK NAME</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>

            </div>

            <div class="col-md-12 amount amount_strong"><strong style="">A/C Holder</strong><span>baldew</span></div>
        </div>
        <div class="container-fluid transaction-button" id="click-upi-id">
            <button id="addaccount-back" style="background:#a39f9e;">Back</button>
            <button id="addaccount-add" class="fullbodydycolorbg">Add UPI ID</button>


        </div>
    </div>
</div>
<!------------------------------------------------------------->


<div class="loader loaderpancard"></div>



<script>
    function senderdetails(change) {
        $('#addaccount-add123_again').hide();
        $('#addaccount-add123').show();

        $('#btnsenddd ,#cancelloder ,.confirmbuttontext').html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        $('#verifyimpserror').text("");
        $('#idproofshow').hide();
        $("input[name=idproof]").prop("checked", false);
      //
        $('#fpay').show();
        $('#dmterrorcode').text("");
        $('#dmttransfer').hide();
        $('#impsaddnew').show();
         $('#dmttransferfinal').hide();
        $('#register_new_ben').hide();
        $('#NewSenderregister').hide();
        $('#otpshow').hide();
        $('#otpbenid').text("");
        $('#sendererror').text("");
        $('#paymentmodetransfer').text("");
        $('#bankifsccodetransfer').text("");
        $('#accountnotransfer').text("");
        $('#Nametransfer').text("");
        $('#amounttransfer').val("");
        $('#markuptransfer').val("");
        $('#DMTPIN').val("");
        $('#banknametransfer').val("");
        $('#bencodetransfer').val("");
        $('#sendererrorshow').text("");
        var len = "";
        var senderno = "";
        if (change == "new") {
            senderno = $('#senderno').val();
            len=senderno.length;
            if (senderno.length == 10) {

                //$('#Firstpage').hide();

                $('#changesender').val(senderno);
            }
        }
        else {
            senderno = $('#changesender').val();
            len = senderno.length;
            if (len == 10) {
                $('#senderno').val(senderno);
                $("#changesender").attr("readonly", true);
            }
        }
        if (len == 10) {
              $('#errorsenderno').text("");
            $("#benlistttable tr").remove();
            $.ajax({
                url: '/API/dmrmm_home/Senderdetails',
                data: { senderno: senderno },
                cache: false,
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#btnsenddd ,#cancelloder').html("Next");

                    $('#Firstpage').hide();
                    var output = JSON.parse(data);
                    var statuscode = output.statuscode;
                    if (statuscode == "TXN") {
                        $('#remlist').show();
                        var name = output.data.remitter.name;
                        $('#username').text(name);
                        var i;
                        for (i = 0; i < output.data.beneficiary.length; i++) {
                            var id = output.data.beneficiary[i].id;
                            var name = output.data.beneficiary[i].name;
                            var account = output.data.beneficiary[i].account;
                            var bank = output.data.beneficiary[i].bank;
                            var ifsc = output.data.beneficiary[i].ifsc;
                            $('#benlistttable').append('<tr id=' + id + '><td><span style="display:none;">' + id + '</span><p style="display:none;">BANK:' + bank + '</p><strong>' + name + '</strong><br /><span>A/C: ' + account + '</span><br /><span>IFSC: ' + ifsc + '</span></td><td><div class="Transferdata"><a href="#" class="addtabledata" onclick=fundtransfer(this)></a><button id="btn' + id + '"  class="addtabledatade click-displays" onclick=deleteshow("' + id + '")><i class="fa fa-trash"></i></button><a href="javascript:void(0);" id="aa' + id + '" class="addtabledatade click-delete" onclick=deleteben("' + id + '")>sure <Strong>?</Strong></a> </div></td></tr>');
                        }
                    }
                    else if (statuscode == "RNF") {
                        $('#sendername').val("");
                        $('#remlist').hide();
                        $('#newsender').text(senderno);
                        $('#Firstpage').hide();
                        $('#register_new_ben').hide();
                        $('#NewSenderregister').show();
                    }
                    else {
                        var msg = output.status;

                        $('#Firstpage').show()
                        $('#sendererrorshow').text(msg);
                    }

                }
            });
        }
        else {
            $('#btnsenddd ,#cancelloder').html("Next");


              $('#errorsenderno').text("Enter Mobile Number");
        }
        $("#impsbutton").click();
    }
</script>
<script>
    $("#senderno").keyup(function () {
        if (this.value.length == 10) {

            senderdetails('new');
        }
    });
    $("#changesender").keyup(function () {
        if (this.value.length == 10) {
            senderdetails('change');
        }
    });
</script>
<script>
    function change() {
        $("#changesender").attr("readonly", false);
    }
</script>
<script>
    function addnewaccount() {

        $('#remlist').hide();
        $('#register_new_ben').show();
        $('#accountno').val("");
        $('#ifsccode').val("");
        $('#benname').val("");
        bindDropdownbanklist();
    }
</script>
<script>
    $("#banknm").change(function () {
        var select = $(this).val();
        $('#ifsccode').val(select)
    });
</script>
<script>
    function Registerben() {
        $('#addaccount-add123').show();
        $('#addaccount-add123_again').hide();
        $('#addaccount-addasssss').html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        $('#benerror').text("");
        $('#sendererror').text("");
        var senderno = $('#changesender').val();
        var account = $('#accountno').val();
        var ifsccode = $('#ifsccode').val();
        var originalifsccode = $('#banknm').val();
        var benname = $('#benname').val();
           if (senderno != "" && account != "" && ifsccode != "" && originalifsccode != "" && benname!="") {
               $.ajax({
                   url: '/API/dmrmm_home/Register_ben',
                   data: { senderno: senderno, account: account, ifsccode: ifsccode, originalifsccode: originalifsccode, benname: benname },
                   cache: false,
                   type: "POST",
                   success: function (data) {
                     
                       $('#addaccount-addasssss').html('Add Account')
                      
                       var sts = data.statuscode;
                       var msg = data.status;
                       if (sts == "TXN") 
                       {
                           senderdetails("change");
                       }
                       else {
                           $('#benerror').text(msg);
                       }
                   }
               });
           }

    }
</script>

<script>
    function newsendernumber() {
        var senderno = $('#changesender').val();
        var name = $('#sendername').val();
        $('#sendererror').text("");
        $('#otpsenderno').text("");
        $('#otpsendername').text("");
        $.ajax({
            url: '/API/dmrmm_home/Register_sender',
            data: { senderno: senderno, name: name },
            cache: false,
            type: "POST",
            success: function (data) {
                var sts = data.statuscode;
                var msg = data.status;

                if (sts == "TXN") {
                  var benid = data.data.remitter.id;
                    $('#remlist').hide();
                    $('#Firstpage').hide();
                    $('#register_new_ben').hide();
                    $('#NewSenderregister').hide();
                    $('#otpsenderno').text(senderno);
                    $('#otpsendername').text(name);
                    $('#otpbenid').text(benid);
                    $('#otpshow').show();
                }
                else {
                    msg = "⚠  " + msg;
                      $('#sendererror').text(msg);
                }
            }
        });
    }
</script>
<script>
    function Resend() {
      var senderno = $('#changesender').val();
        var name = $('#sendername').val();
        $('#otpinsert').val("");
           $.ajax({
            url: '/API/dmrmm_home/Register_sender',
            data: { senderno: senderno, name: name },
            cache: false,
            type: "POST",
            success: function (data) {
                var sts = data.statuscode;
                var msg = data.status;
                if (sts == "TXN") {
                    var benid = data.data.remitter.id;
                      $('#otpbenid').text(benid);
                      $('#otperror').text("Resend OTP");
                }
                else {
                      $('#sendererror').text(msg);
                }
            }
        });
    }
</script>
<script>
    function verifyotp() {
        var senderno = $('#changesender').val();
        var otp = $('#otpinsert').val();
        var benid = $('#otpbenid').text();
        $.ajax({
            url: '/API/dmrmm_home/Otp_verify_sender',
            data: { senderno: senderno, otp: otp,benid:benid },
            cache: false,
            type: "POST",
            success: function (data) {
                var sts = data.statuscode;
                var msg = data.status;
                if (sts == "TXN") {
                    senderdetails('change');
                }
                else {
                    msg = "⚠  " + msg;

                    $('#otperror').text(msg);
                }
            }
        });
    }
</script>
<script>  
    function DMT() {      
       // $('#banknm').val(null).trigger("change");       
        //$('select').val('').trigger('change');
        //$('select').val('data', null);
        //$('select').val('val', null);
        $('#addaccount-add123').show();
        $('#addaccount-add123_again').hide();
        $('#senderno').val("");
        $('#Firstpage').show();
        $('#NewSenderregister').hide();
        $('#otpshow').hide();
        $('#remlist').hide();
        $('#dmttransfer').hide();
        $('#dmtconfirm').hide();
        $('#dmttransferfinal').hide();
        $('#register_new_ben').hide();

        $('#benadd').hide();
         $.ajax({
            url: '/API/dmrmm_home/DMTreportnew',
            cache: false,
                 type: "GET",
                 cache: false,
               dataType:"html",
            success: function (data) {
                 $('#reportallinone').html(data);
            }
        })
    }
</script>
<script type="text/javascript">

    function bindDropdownbanklist() {
   
        var banknm = $("#banknm");
        banknm.empty().append('<option selected="selected" value="0" disabled = "disabled">Loading.....</option>');
        $.ajax({
            type: "POST",
            url: "/API/Dmrmm_home/BindBankDdllist",
            data: '{}',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (response) {
                debugger;
                banknm.empty().append('<option selected="selected" value="">Please select</option>');
                $.each(response.data, function () {
                    banknm.append($("<option></option>").val(this['Value']).html(this['Text']));
                });
            },
            failure: function (response) {
                alert(response.responseText);
            },
            error: function (response) {
                alert(response.responseText);
            }
        });
    };
</script>




<script>
    $(document).ready(function () {
        $('#myForm input').on('change', function () {
            var radiobutton = $('input[name=bendetails]:checked', '#myForm').val();
            if (radiobutton == "UPI") {
                $('#neftimps').hide();
                $('#remlist').show();
                $('#Firstpage').hide();
                $('#NewSenderregister').hide();
                $('#otpshow').hide();
                $('#dmttransfer').hide();
                $('#dmtconfirm').hide();
                $('#dmttransferfinal').hide();
                $('#register_new_ben').hide();
                $('#benadd').hide();
            }
            else {
                $('#neftimps').show();
                $('#remlist').show();
                $('#Firstpage').hide();
                $('#NewSenderregister').hide();
                $('#otpshow').hide();
                $('#dmttransfer').hide();
                $('#dmtconfirm').hide();
                $('#dmttransferfinal').hide();
                $('#register_new_ben').hide();
                $('#benadd').hide();
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#frmadd input').on('change', function () {
            var radiobutton = $('input[name=addnewradio]:checked', '#frmadd').val();
            if (radiobutton == "IMPS") {
                $('#impsaddnew').show();
            }
            else {
                $('#impsaddnew').hide();
            }
        });
    });
</script>
<script>
    function deleteben (idno)
    {
        var senderno = $('#changesender').val();
        $.ajax({
            url: '/API/dmrmm_home/Delete_ben',
            data: { benid: idno, senderno: senderno},
            cache: false,
            type: "POST",
            success: function (data) {
                var sts = data.statuscode;
                var msg = data.status;
                if (sts == "TXN") {
                    $('#otpShow').css('display', 'block');
                    $('#otpSubmit').css('display', 'block');
                    $('#OTPMSG').text(msg);
                    
                    //senderdetails('change');
                }
                else {
                    $('#dellist').text(msg);
                }
            }
        })
    }
</script>
<script>
    function back() {
        senderdetails('change');
    }
</script>
<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
<script>
    function Accountverify() {

        var senderno = $('#changesender').val();
        var account = $('#accountno').val();
        var benIFSC = $('#ifsccode').val();
        var banknm = $("#banknm option:selected").text();
        if (senderno != "" && account != "" && benIFSC != "" && banknm != "") {
            $.ajax({
                url: '/API/dmrmm_home/Verify_account',
                data: { NUMBER: senderno, account: account, benIFSC: benIFSC, bankname: banknm },
                cache: false,
                type: "POST",
                    beforeSend: function() {
                      $('.loader').show();
                     },
                success: function (data) {
                    var sts = data.statuscode;
                    var msg = data.status;
                    if (sts == "TXN") {
                        var loclchk = data.Local;
                        if (loclchk = "Local") {
                            $('#addaccount-add123').hide();
                            $('#addaccount-add123_again').show();
                        }
                        var benname = data.data.benename;
                        $('#benname').val(benname);
                        $('#verifyimpserror').text("✅ Account Has Been Verified");
                    }
                   else if (sts == "Pending") {
                       // var benname = data.data.benename;
                      //  $('#benname').val(benname);
                        $('#verifyimpserror').text(msg);
                    }
                    else {
                        msg = "⚠  " + msg;
                        $('#verifyimpserror').text(msg);
                    }
                    $('#addaccount-add123').text('A/c verify')
                },
                complete: function () {
                    $("#remainretailer").load(location.href + " #remainretailer");
                      $('.loader').hide();
                              $.ajax({
            url: '/API/dmrmm_home/DMTreportnew',
            cache: false,
                 type: "GET",
                 cache: false,
               dataType:"html",
            success: function (data) {
                 $('#reportallinone').html(data);
            }
        })
                },
                error: function () {
                    $("#remainretailer").load(location.href + " #remainretailer");
                    $('.loader').hide();
                }
            });

        }
        else {
            msg = "⚠  All fields are required";
            $('#verifyimpserror').text(msg);
        }
    }
</script>
<script>
    function Accountverifyagain() {
        $('#addaccount-add123').show();
        $('#addaccount-add123_again').hide();
        var senderno = $('#changesender').val();
        var account = $('#accountno').val();
        var benIFSC = $('#ifsccode').val();
        var banknm = $("#banknm option:selected").text();
        if (senderno != "" && account != "" && benIFSC != "" && banknm != "") {
            $.ajax({
                url: '/API/dmrmm_home/Verify_account_again',
                data: { NUMBER: senderno, account: account, benIFSC: benIFSC, bankname: banknm },
                cache: false,
                type: "POST",
                    beforeSend: function() {
                      $('.loader').show();
                     },
                success: function (data) {
                    var sts = data.statuscode;
                    var msg = data.status;
                    if (sts == "TXN") {
                        var benname = data.data.benename;
                        $('#benname').val(benname);
                        $('#verifyimpserror').text("✅ Account Has Been Verified");
                    }
                   else if (sts == "Pending") {
                       // var benname = data.data.benename;
                      //  $('#benname').val(benname);
                        $('#verifyimpserror').text(msg);
                    }
                    else {
                        msg = "⚠  " + msg;
                        $('#verifyimpserror').text(msg);
                    }
                    $('#addaccount-add123').text('A/c verify')
                },
                complete: function () {
                    $("#remainretailer").load(location.href + " #remainretailer");
                      $('.loader').hide();
                              $.ajax({
            url: '/API/dmrmm_home/DMTreportnew',
            cache: false,
                 type: "GET",
                 cache: false,
               dataType:"html",
            success: function (data) {
                 $('#reportallinone').html(data);
            }
        })
                },
                error: function () {
                    $("#remainretailer").load(location.href + " #remainretailer");
                    $('.loader').hide();
                }
            });

        }
        else {
            msg = "⚠  All fields are required";
            $('#verifyimpserror').text(msg);
        }
    }
</script>
<script>
    function fundtransfer(e) {

        var type = $('input[name=bendetails]:checked', '#myForm').val();
        var str = $(e).closest('td').prev('td').html();
        var bencode = str.substring(str.lastIndexOf("<span style='display:none;'>") + 29, str.lastIndexOf("</span><p"));
        var bankname = str.substring(str.lastIndexOf(">BANK:") + 6, str.lastIndexOf("</p><strong>"));

        var Name = str.substring(str.lastIndexOf("<strong>") + 8, str.lastIndexOf("</strong>"));
        var Account = str.substring(str.lastIndexOf("A/C:") + 4, str.lastIndexOf("</span><br>"));
        var ifsccode = str.substring(str.lastIndexOf("IFSC:") + 5, str.lastIndexOf("</span>"));
        $('#markuptransfer').val("0");
        $('#paymentmodetransfer').text(type);
        $('#bankifsccodetransfer').text(ifsccode);
        $('#accountnotransfer').text(Account);
        $('#Nametransfer').text(Name);
        $('#banknametransfer').text(bankname);
        $('#bencodetransfer').text(bencode);
        $('#dmttransfer').show();
        $('#remlist').hide();
    }
</script>
<script>
    function TransferDMT() {
        $('#idprooftype').text("");
         $('#idproofnumber').text("");

        var senderno = $('#changesender').val();
        var paymode = $('#paymentmodetransfer').text();
        var bankifsccode = $('#bankifsccodetransfer').text();
        var accountno = $('#accountnotransfer').text();
        var name = $('#Nametransfer').text();
        var amount = $('#amounttransfer').val();
        var markup = $('#markuptransfer').val();
        var Dmtpin = $('#DMTPIN').val();
        var bankname = $('#banknametransfer').text();
        var idproff = $('input[name=idproof]:checked', '#dividproof').val();
        var idproffid = $('#idproofid').val();
        if (amount != "" && markup != "" && Dmtpin != "" && idproff != undefined) {
            var resp = "OK";
            if (idproff != "none") {

                if (idproffid == "") {
                    msg = "⚠  Enter ID PROOF";
                    resp = "NOTOK";
                }
                else {
                    if (idproff == "aadhar") {
                        var chk = validate(idproffid);
                        if (chk == false) {
                            msg = "⚠  Enter Valid AADHAR";
                            resp = "NOTOK";
                        }
                    }
                    else {
                        var regex = /([A-Z]){5}([0-9]){4}([A-Z]){1}$/;
                        if (regex.test(idproffid.toUpperCase())) {

                            resp = "OK";
                        }
                        else {
                            msg = "⚠  NOT VALID PAN CARD";

                            resp = "NOTOK";
                        }
                    }
                }
            }
            if (resp == "OK") {
                $.ajax({
                    url: '/API/dmrmm_home/Imps_check_transfer',
                    data: { dmtpin: Dmtpin, account: accountno, amount: amount },
                    cache: false,
                    type: "POST",
                    success: function (data) {
                        var sts = data.status;
                        var msg = data.Details;
                        if (sts == "Success") {
                            $('#accountconfirm').text(accountno);
                            $('#nameconfirm').text(name);
                            $('#ifscconfirm').text(bankifsccode);
                            $('#modeconfirm').text(paymode);
                            $('#amountconfirm').text(amount);
                            $('#servicefeeconfirm').text(markup);
                            $('#banknameconfirm').text(bankname);
                            $('#idprooftype').text(idproff);
                            $('#idproofnumber').text(idproffid);

                            $('#dmtconfirm').show();
                            $('#dmttransfer').hide();
                        }
                        else {
                            msg = "⚠  " + msg;
                            $('#dmterrorcode').text(msg);
                        }
                    }
                });
            }
            else {
                $('#dmterrorcode').text(msg);
            }
        }
        else {
            if (amount == "") {
                 msg = "⚠  Enter Amount";
            }
            else if (markup == "") {
                  msg = "⚠  Enter Service Fee";
            }
            else if (Dmtpin=="") {
                 msg = "⚠  Enter DMT PIN";
            }
             else if (idproff==undefined) {
                      msg = "⚠  Select ID PROOF";
            }
                $('#dmterrorcode').text(msg);
         }
    }
</script>
<script>
    function confirmback() {
        $('#fpay').show();
        $('#dmterrorcode').text("");
        $('#accountconfirm').text("");
        $('#nameconfirm').text("");
        $('#ifscconfirm').text("");
        $('#modeconfirm').text("");
        $('#amountconfirm').text("");
        $('#servicefeeconfirm').text("");
        $('#transfererror').text("");
        $('#banknameconfirm').text("");
        $('#dmttransfer').show();
        $('#dmtconfirm').hide();
    }
</script>
<script>

    function finalpay() {
        var senderno = $('#changesender').val();
        var paymode = $('#paymentmodetransfer').text();
        var bankifsccode = $('#bankifsccodetransfer').text();
        var accountno = $('#accountnotransfer').text();
        var name = $('#Nametransfer').text();
        var amount = $('#amounttransfer').val();
        var markup = $('#markuptransfer').val();
        var Dmtpin = $('#DMTPIN').val();
        var bankname = $('#banknametransfer').text();
        var bencode = $('#bencodetransfer').text();
        var idprooftype= $('#idprooftype').text();
        var idproofnumber= $('#idproofnumber').text();

        accountno = accountno.trim();
               bankifsccode = bankifsccode.trim();
        $('#amounttransfer').val("");
        $('#DMTPIN').val("");
        $('#fpay').hide();
        if (amount != "" && Dmtpin != "") {
            $.ajax({
                url: '/API/dmrmm_home/imps_transfer',
                data: { NUMBER: senderno, type: paymode, account: accountno, ifsc: bankifsccode, dmtpin: Dmtpin, amount: amount, bankname: bankname, benCode: bencode, servicefee: markup,idprooftype:idprooftype,idproofnumber:idproofnumber },
                cache: false,
                type: "POST",
                  beforeSend: function() {
                      $('.loader').show();
                     },
                  success: function (data) {
                    var sts = data.status;
                    var msg = data.Details;
                    var orderid = data.orderid;
                    var logo = data.logo;
                    var firmname = data.firmname;
                    var servicefee = data.servicefee;
                    var tax = data.tax;
                      var total = data.total;
                      var remremain = data.remainretailer;
                     $("#remainretailer").text(remremain);
                    if (sts == "Success" || sts == "Pending") {
                        $('#successdata').show();
                        var bankrrn = data.data[0].bankrefid;
                        //var benname = data.data.benename;
                        $('#transresp').text("transaction " + sts);
                        $('#benname').val("");
                        $('#verifyimpserror').text(msg);
                        $('#responseamount').text(amount);
                        $('#responseorderid').text(orderid);
                        $("#logo").attr("src", "../.." + logo);
                        $('#responsefirmname').text(firmname);
                        $('#responsemode').text(paymode);
                        $('#responseamountnew').text(amount);
                        $('#servicefee').text(servicefee);
                        $('#responsetax').text(tax);
                        $('#responsetotal').text(total);
                        $('#responsebankrrn').text(bankrrn);
                        $('#responseaccount').text(accountno);
                        $('#responseifsccode').text(bankifsccode);
                        $('#success').show();
                        $('#failed').hide();
                        $('#dmttransferfinal').show();
                        $('#dmtconfirm').hide();
                    }
                    else {
                        //var bankrrn = data.data.bankrefid;
                        // var benname = data.data.benename;
                        $('#successdata').hide();
                        $('#transresp').text("transaction Failed");
                        $('#benname').val("");
                        $('#verifyimpserror').text(msg);
                        $('#responseamount').text(amount);
                        $('#responseorderid').text(orderid);
                        $("#logo").attr("src", "../.." + logo);
                        $('#responsefirmname').text(firmname);
                        $('#responsemode').text(paymode);
                        $('#responseamountnew').text(amount);
                        $('#servicefee').text(servicefee);
                        $('#responsetax').text(tax);
                        $('#responsetotal').text(total);
                        $('#responsebankrrn').text(msg);
                        $('#responseaccount').text(accountno);
                        $('#responseifsccode').text(bankifsccode);

                        $('#success').hide();
                        $('#failed').show();
                        $('#dmttransferfinal').show();

                        $('#dmtconfirm').hide();

                        //$('#transfererror').text(msg);
                    }
                },
                complete: function () {
                    $("#remainretailer").load(location.href + " #remainretailer");
                    $('.loader').hide();
                      $.ajax({
            url: '/API/dmrmm_home/DMTreportnew',
            cache: false,
                 type: "GET",
                 cache: false,
               dataType:"html",
            success: function (data) {
                 $('#reportallinone').html(data);
            }
        })
                },
                error: function () {
                    $("#remainretailer").load(location.href + " #remainretailer");
                    $('.loader').hide();
                }
            })

        }
        else {
            msg = "⚠  Go To Back ,Fill The Data Again.";
            $('#transfererror').text(msg);
        }
    }
</script>
<script>
    function printmoney() {
        var orderid = $('#responseorderid').text();
        var url = "/API/dmrmm_home/Print_Imps_Pdf?orderid=" + orderid;
         window.open(url,"_blank")
    }
</script>
<script>
    function email() {
        var orderid = $('#responseorderid').text();
        $.ajax({
            url: '/API/dmrmm_home/imps_email',
            data: { orderid: orderid },
            cache: false,
            type: "POST",
            success: function (data) {
                $('#sendemailmsg').text("Email Send SuccessFully");
            }
        });
    }
</script>
<script>
    $(document).ready(function () {
        $(document).ajaxSend(function () {
            $('#btnsenddd ,#cancelloder ,#confirm-button ,.confirmbuttontext').html("<i class='fa fa-circle-o-notch fa-spin'></i>");

            //$('.verify-account').html("<i class='fa fa-circle-o-notch fa-spin'></i>");

            $("#load").css("display", "block");
        });
        $(document).ajaxComplete(function () {
            $('#btnsenddd ,#cancelloder').html("Next");
            $('.confirmbuttontext').html("Confirm Payment");


            //$('.verify-account').html("verify Account");


            $('#transaction-more').html("More Pay");

            $("#load").css("display", "none");
        });
    });
</script>




<script>

    $("#click-display_none").click(function () {
        $(".click-displays").hide();
        $(".click-displays").next(".click-delete").show();

    });




</script>


<script>
    function deleteshow(id) {
        var idbtn = "btn" + id;
        var abtn = "aa" + id;
        $('#' + abtn).show();
        $('#' + idbtn).hide();

    }
</script>

<script>
    $(document).ready(function () {
        $(".confirmbuttontext").click(function () {
            $(".confirmbuttontext").addClass("loderfullwidth");

        });
    });
</script>


<script>
    $(document).ready(function () {
        $('#dividproof input').on('change', function () {
            var radiobutton = $('input[name=idproof]:checked', '#dividproof').val();
            if (radiobutton == "aadhar" || radiobutton == "pan") {
                $('#idproofshow').show();
                if (radiobutton == "aadhar") {
                    $('#idproofname').text("AADHAR");
                    $('#idproofid').val("");
                    $('#idproofid').attr("placeholder", "Enter Aadhar");
                    $('#idproofid').attr("type", "number");
                }
                else {
                    $('#idproofname').text("Pan Card");
                    $('#idproofid').val("");
                    $('#idproofid').attr("placeholder", "Enter Pan Card");
                    $('#idproofid').attr("type", "text");
                }
            }
            else {
                $('#idproofshow').hide();
                $('#idproofid').val("");
            }
        });
    });
</script>

<script>
    // multiplication table
    const d = [
        [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
        [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],
        [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],
        [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],
        [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],
        [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],
        [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],
        [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],
        [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],
        [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]
    ]

    // permutation table
    const p = [
        [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
        [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],
        [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],
        [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],
        [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],
        [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],
        [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],
        [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]
    ]

    // validates Aadhar number received as string
    function validate(aadharNumber) {
        let c = 0
        let invertedArray = aadharNumber.split('').map(Number).reverse()

        invertedArray.forEach((val, i) => {
            c = d[c][p[(i % 8)][val]]
        })

        return (c === 0)
    }
</script>

<script>
    $('.addaccount-add-loderss').on('click', function () {
        var $this = $(this);
        $this.button('loading');
        setTimeout(function () {
            $this.button('reset');
        }, 200);
    });


</script>


            </div>
        </div>
        <div id="tab-2" class="tab-content tab-content2" style="padding: 25px 10px;">
            <style>
    .loader {
        position: fixed;
        top: -90px;
        left: 0;
        background-color: rgba(255,255,255,0.7);
        z-index: 999999999999;
        display: none;
        border-radius: 0%;
        height: 100vw;
        width: 100vw;
    }

    .minitransaction tr td {
        padding: 10px !important;
    }

    .select2-container--open .select2-dropdown--below {
        width: 314px !important;
    }

    .select2-results__option[aria-selected] {
        border-bottom: 1px dotted;
    }

    @-webkit-keyframes spin {
        from {
            -webkit-transform: rotate(0deg);
        }

        to {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .loader::before {
        content: '';
        display: none;
        position: absolute;
        left: 48%;
        top: 25%;
        width: 100px;
        height: 100px;
        border-style: solid;
        border-color: transparent;
        border-top-color: transparent;
        border-width: 4px;
        border-radius: 0%;
        -webkit-animation: spin .8s linear infinite;
        animation: spin .8s linear infinite;
    }

    .loader::after {
        content: '';
        display: block;
        position: absolute;
        left: 48%;
        top: 25%;
        width: 100px;
        height: 100px;
        border-style: solid;
        border-color: black;
        border-top-color: transparent;
        border-width: 4px;
        border-radius: 0%;
        -webkit-animation: spin .8s linear infinite;
        animation: spin .8s linear infinite;
    }
    .radiobuttonimps.radiobuttonimps-addnew-aadh label {float: left;margin: 0 !important;font-size: 13px;height: 34px;padding-top: 7px;padding-left: 22px;}
    .radiobuttonimps.radiobuttonimps-addnew-aadh .aadharnewpayclass{animation: blinks 2s linear infinite;left: -16px;top: -10px;font-size: 8px;}
    .select2-container--open .select2-dropdown--below {
    width: 314px !important;
}

    @media screen and (max-width:1366px) {
        .radiobuttonimps.radiobuttonimps-addnew-aadh label.col-md-4.container{width:22% !important;left:0;}
        .radiobuttonimps.radiobuttonimps-addnew-aadh label.col-md-4.container:first-child {
            width: 31% !important;
        }

        .radiobuttonimps.radiobuttonimps-addnew-aadh label.col-md-4.container:last-child {
            width: 25% !important;float:left !important;
        }
    }
    @media screen and (max-width:1300px){
        .radiobuttonimps.radiobuttonimps-addnew-aadh label.col-md-4.container:nth-child(3) {
            width: 21% !important;
        }

        .radiobuttonimps.radiobuttonimps-addnew-aadh label.col-md-4.container:first-child {
            width: 32% !important;
        }
    }
    @media screen and (max-width:420px) {
        .radiobuttonimps.radiobuttonimps-addnew-aadh label.col-md-4.container, .radiobuttonimps.radiobuttonimps-addnew-aadh label.col-md-4.container:first-child, .radiobuttonimps.radiobuttonimps-addnew-aadh label.col-md-4.container:nth-child(3), .radiobuttonimps.radiobuttonimps-addnew-aadh label.col-md-4.container:last-child {
            width: 50% !important;
            float: left;
        }
        .newpagecustom.newpagecustomertyui .tabspage ul li span{font-size:10px;}
    }


</style>
<!--AEPS ID NOT-->
<div class="container-fluid aeps">
    
    <div id="driverdetails" class="container-fluid driver-page driverdetails-responshiveclass">
        <div class="col-md-12 driver-logo aeps-responsive">
            <ul>
                <li>
                    <div class="mantra-width"><a href="<?php echo base_url();?>API/dmrmm_home#"><img src="<?php echo base_url();?>vfiles/logosite.png"></a></div>
                    <div class="mantra-width mantra-width-img-one">
                 
                        <a href="https://rdtest.aadhaardevice.com/" class="backbg backbg1" target="_blank">RD Service </a>
                        <a href="http://maharshimulti.co.in/Morphotestpage/MantraMFS100.zip" class="backbg"><i class="fa fa-download"></i> Driver</a>
                    </div>
                </li>
                <li>
                    <div class="mantra-width mantra-width-img"><a href="<?php echo base_url();?>API/dmrmm_home#"><img src="<?php echo base_url();?>vfiles/startek-logo.png"></a></div>
                    <div class="mantra-width mantra-width-img-one">
                        
                        <a href="http://acpl.in.net/fm220_entry/RD_Service_Call_HTTP.aspx" class="backbg backbg1" target="_blank">RD Service</a>
                        <a href="http://maharshimulti.co.in/Morphotestpage/StartekFM220.zip" class="backbg"><i class="fa fa-download"></i>  Driver</a>
                    </div>
                </li>
                <li>
                    <div class="mantra-width mantra-width-img"><a href="<?php echo base_url();?>API/dmrmm_home#" style="font-size: 24px;
line-height: 19px;
color: blue;margin-bottom: 3px;">Morpho</a></div>
                    <div class="mantra-width mantra-width-img-one">
                        
                        <a href="http://maharshimulti.co.in/Morphotestpage/MorphoRDServiceTestPage.html" class="backbg backbg1" target="_blank">RD Service</a>
                        <a href="http://maharshimulti.co.in/Morphotestpage/Morpho_2.0.1.15.zip" class="backbg"><i class="fa fa-download"></i>  Driver</a>
                    </div>
                </li>
               
            </ul>
        </div>

    </div>
    <div class="col-md-12 gotoscan-changecss" id="gotoscan">
        <button onclick="gotoscan()" class="display-nonescanp" id="scanrecoveer"><strong>GO</strong> To Scan</button>
    </div>
</div>
<!--Driver Page-->

<!--Driver Page-->
<div id="notfound" style="display:none;">

    <div class="container-fluid hedn" style="text-align: center;">
        <span class="cross" style="margin-top: 20px;margin-bottom: 20px;">

            <img src="<?php echo base_url();?>vfiles/identity.svg" style="width: 100px;">
        </span>
        <span class="bodycolormy" style="margin-top: 20px;margin-bottom: 20px;font-size: 26px;border-bottom: 1px dashed;display: inline-block;padding: 0px;">AEPS Service Not Active</span>
        <p style="margin-bottom: 20px;text-align: justify;font-size: 18px;">Your service is currently down, if you want to keep the service running smoothly, you will have to pay the service fee, which you see below and you can purchase the service by clicking the button.</p>
        <button class="fullbodydycolorbg" type="submit" onclick="SendOTP()" id="submitMobile" style="color: #fff;border: 0px;margin-top: 10px;padding: 7px 15px;font-size: 18px;">Active Now</button>
    </div>
    <div>
        <span id="errormessgeshow" style="color:red;"></span>
    </div>
    <div class="sho" style="display: none;text-align: center;">
        <span style="font-size: 22px;border-bottom: 1px solid;display: inline-block;padding: 0px;padding-bottom: 5px;margin-bottom: 10px;">One Time Password</span>
        <input id="otpShow" placeholder="Insert OTP" style="display:none;margin: 0px auto;width: 100%;margin-top: 15px;font-size: 16px;" autocomplete="off">

        <label id="OTPMSG" style="margin-top: 5px;text-align: left;display: block;padding-left: 6px;"></label>
        <button class="fullbodydycolorbg" type="submit" onclick="otpverify()" id="otpSubmit" style="display:none;color: #fff;border: 0px;padding: 7px 22px;font-size: 16px;margin-top: 20px;float: right;">Submit</button>
        <button type="button" onclick="backshow()" style="color: #fff;border: 0px;background: #a4a0a0 !important;margin-right: 8px;padding: 7px 22px;font-size: 16px;margin-top: 20px;float: right;">Back</button>
    </div>
</div>
<div id="firstpurAEPS" class="col-md-12 remitter_button" style="display:none;text-align: center;">
    <img src="<?php echo base_url();?>vfiles/forbidden.svg" style="width: 90px;margin-top: 10px;display: block;margin: 0px auto;">
    <span class="bodycolormy" style="margin-top: 20px;margin-bottom: 20px;font-size: 26px;">AEPS Service Expired !</span>
    <p style="margin-bottom: 20px;text-align: justify;font-size: 18px;">Your service is currently down, if you want to keep the service running smoothly, you will have to pay the service fee, which you see below and you can purchase the service by clicking the button.</p>
    <button class="btn btn-default fullbodydycolorbg" onclick="PurchaseAEPS(&#39;AEPS&#39;)" style="color: #fff;font-size: 18px;margin-top: 10px;padding: 6px 11px;">Purchase Service</button>
</div>
<div id="secpurAEPS" class="col-md-12 remitter_button" style="display:none;text-align: center;">
    <span style="font-size: 24px;border-bottom: 1px solid #ccc;margin-top: 15px;padding-bottom: 10px;margin-bottom: 10px;">Payment Details</span>
    <div class="lavbrd" style="border-bottom: 1px solid #ccc;float: left;width: 100%;padding-bottom: 10px;">
        <label style="float: left;margin-bottom: 0px;font-size: 18px;">Mode </label>
        <label id="PaymentTypeaeps" style="float: right;margin-bottom: 0px;font-size: 18px;"></label>
    </div>
    <br>
    <div class="lavbrd" style="border-bottom: 1px solid #ccc;float: left;width: 100%;padding-bottom: 12px;margin-top: 10px;">
        <label style="float: left;margin-bottom: 0px;font-size: 18px;">Amount </label>
        <label id="Priceaeps" style="float: right;margin-bottom: 0px;font-size: 18px;"></label>
    </div>
    <br>
    <button class="btn btn-default fullbodydycolorbg" onclick="FinalPurchaseAEPS(&#39;AEPS&#39;)" style="color: #fff; float: right; font-size: 18px; padding: 7px 22px; margin-top: 30px;">Pay Now</button>
    <button class="btn btn-default" onclick="AEPS()" style="        color: #fff;
        background: #a4a0a0 !important;
        font-size: 18px;
        float: right;
        margin-right: 8px;
        padding: 7px 22px;
        margin-top: 30px;">
        Back
    </button>

    <br>
    <label id="errmsgaeps" style="color:red;"></label>
</div>

<label id="KYCNotComp"></label>
<!--AEPS ID NOT-->
<div id="Devicerror" style="display:none;">
    <div class="container-fluid aepsid-login">
        <div class="col-md-12 aeps-start">
            <div class="col-md-12 aeps_id">
                <div class="scannot-found">
                    <img src="<?php echo base_url();?>vfiles/scanner.svg">
                </div>
                <div class="scannot-font-size">
                    <span id="deviceerror1" style="    color: red;
        border-bottom: 2px solid #ff0048;
        display: inline-block;
        padding-bottom: 2px;
        font-size: 16px;
        font-weight: 700;
" class="body-border-bottom"></span>
                    <span id="deviceerror2" style="color:red;"></span>

                    <span id="deviceerror3" style="color:red;"></span>
                    <span id="deviceerror4" style="color:red;"></span>
                    <span id="deviceerror5" style="color:red;"></span>
                    <span id="deviceerror6" style="color:red;"></span>
                    <span id="deviceerror7" style="color:red;"></span>
                    <span id="deviceerror8" style="color:red;"></span>
                    <span id="deviceerror9" style="color:red;"></span>
                    <a href="<?php echo base_url();?>API/dmrmm_home#scanrecoveer" id="againscanclick" onclick="gotoscan()">Scan&nbsp;Again</a>
                </div>

            </div>
        </div>
    </div>
</div>

<div id="AEPSFOUND" class="aepsfound-responshivecs" style="display:none;">

    <!--AEPS ID Login-->
    <!--Cash Details-->
    <div class="col-md-12 radiobuttonimps radiobuttonimps-addnew-aadh" id="radiobuttonimps-cash" style="margin-top:-15px;">
        <form class="radiobutton-bottom">

            <label class="col-md-4 container" style="width:31%;">
                <input type="radio" name="radio" id="radio1" checked="checked" value="transfer"><p>Cash&nbsp;Withdrawal</p>
                <span class="checkmark"></span>
            </label>
            <label class="col-md-4 container" style="width:22%;margin-left:5px;">
                <input type="radio" name="radio" id="radio3" value="ministatement"><p>Statement</p>
                <span class="checkmark"></span>
            </label>
            <label class="col-md-4 container" style="width:22%;">
                <input type="radio" name="radio" id="radio2" value="balance"><p>Balance</p>
                <span class="checkmark"></span>
            </label>
            <label class="col-md-4 container" style="width:25%;">
                <input type="radio" name="radio" id="radio4" value="aadharpay"><p>Aadhar&nbsp;Pay<sup class="aadharnewpayclass">New</sup></p>
                <span class="checkmark"></span>
            </label>

        </form>
    </div>

    <div class="with-click-block">

        <div class="cash-add">
            <div class="container-fluid otp_page">
                <div class="fullwidthaccount fullwidthaccount-top addnewnamecss">
                    <div class="col-md-12 amount amount_strong">
                        <strong class="changere11" style="">Bank Name</strong>

                        <select id="banklistshow" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">
                        </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 230px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-banklistshow-container"><span class="select2-selection__rendered" id="select2-banklistshow-container"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        
                    </div>
                    <div class="col-md-12 amount amount_strong">
                        <strong class="changere" style="">Device Info</strong>
                        <input type="text" id="txtdevice" placeholder="Enter Aadhaar Number" readonly=""><input type="text" id="devicesrno" placeholder="Device Sr No." readonly="">
                    </div>
                    <div class="col-md-12 amount amount_strong">
                        <strong class="changere2" style="">User&nbsp;Mobile</strong>
                        <input type="text" id="txtphone" placeholder="Enter Phone Number" onkeypress="return isNumber(event)">
                    </div>
                    <div class="col-md-12 amount amount_strong">
                        <strong class="changere1" style="">User&nbsp;Aadhaar</strong>
                        <input type="text" id="txtaadhar" placeholder="Enter Aadhaar Number" onkeypress="return isNumber(event)">
                    </div>


                    <div class="col-md-12 amount amount_strong">
                        <strong class="changere2" style="">User&nbsp;Name</strong>
                        <input type="text" id="txtusernm" placeholder="Enter Consumer Name">
                    </div>

                    <div id="transferfnd" class="col-md-12 amount amount_strong">
                        <strong class="changere3" style=""> Withdraw Rs.</strong>
                        <input type="text" id="txtamt" placeholder="Enter Your Amount" onkeypress="return isNumber(event)">
                    </div>
                    <div id="transferser" class="col-md-12 amount amount_strong">
                        <strong class="changere4" style=""> service Fee  </strong>
                        <input type="text" id="txtfee" value="0" placeholder="Enter Your Service Fee" onkeypress="return isNumber(event)">
                    </div>

                    <input type="hidden" id="cap">

                    <div class="col-md-12 amount amount_strong" id="aepserrow-show">
                        <span id="txterrortransfer" style="color:red;"></span>
                    </div>
                </div>
                <div class="container-fluid transaction-button" id="next_page">
                    <button id="addaccount-back" style="background:#a39f9e;" onclick="Reset()">Reset</button>
                    <button id="addaccount-back" class="agsc" style="background:#a39f9e;" onclick="scanagain()" data-loading-text="&lt;i class=&#39;fa fa-spinner fa-spin&#39;&gt;&lt;/i&gt;">Scan Again</button>
                    <button id="nextfund" class="fullbodydycolorbg addaccount-add-scan-img" onclick="Nextransfer()">
                        Confirm &amp; Withdraw
                        <i class="fa fa-angle-right otp_icon"></i>
                    </button>
                    <button id="addaccount-balance" style="display:none;" class="fullbodydycolorbg addaccount-add-scan-img" onclick="Getbalance()">
                        Get Balance
                        <i class="fa fa-angle-right otp_icon"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="scanshowfund" class="cash-add cash-add-active scanshowfund-responshivecl" style="display:none;">
    <div class="container-fluid otp_page">
        <div class="fullwidthaccount fullwidthaccount-top">
            <div class="col-md-12 amount amount_strong"><strong style="">Bank Name</strong><span id="spanbank"></span></div>
            <div class="col-md-12 amount amount_strong"><strong style="">Aadhaar Number</strong><span id="spanaadhar"></span></div>
            <div class="col-md-12 amount amount_strong"><strong style="">Register Mobile</strong><span id="spanmobile"></span></div>
            <div class="col-md-12 amount amount_strong"><strong style="">Withdraw Amount</strong><span id="spanamount"></span></div>
            <div class="col-md-12 amount amount_strong">
                <span id="scanerror" style="color: red;"></span>
            </div>
        </div>
        <div id="scanimage" class="scan-img scan-img-responshivewer">
            <div class="img-scan-border">
                <img class="body-border-bottom-top" src="<?php echo base_url();?>vfiles/portrait_mode_scanning.gif">

            </div>
            <span id="response1" style="color: green "></span>
            <span id="response2" style="color: green "></span>
        </div>
        <div class="container-fluid transaction-button" id="next_page">
            <button style="background: #a39f9e;">Back</button>
            <button id="payaeps" class="fullbodydycolorbg addaccount-add-scan-img" style="        display: none;
">
                Pay <i class="fa fa-angle-right otp_icon"></i>
            </button>
        </div>
    </div>
</div>

<!--Cash Details-->
<!--Scan-->
<!--Scan-->
<!--Blance-->
<div class="col-md-12 Confirm-Payment" id="getbalanceview" style="display:none;">
    <div class="container-fluid">
        <div class="col-md-6 successful">
            <p>transaction successful</p>

            <span id="rrnchk"></span>
        </div>
        <div class="col-md-6 successful-logo">
            <img id="logochkaeps" src="<?php echo base_url();?>API/dmrmm_home">
        </div>
    </div>
    <div class="container-fluid transaction">
        <p>AEPS Get Balance details</p>
        <ul class="transaction-detail">
            <li class="transaction-left"><span>retailer firm</span></li>
            <li class="transaction-right"><span id="remfirmaeps"></span></li>

            <li class="transaction-left"><span>Aadhaar Number</span></li>
            <li class="transaction-right"><span id="aepsaadhar"></span></li>

            <li class="transaction-left"><span>Register Mobile</span></li>
            <li class="transaction-right"><span id="aepsmobile"></span></li>

            <li class="transaction-left"><span>AEPS mode</span></li>
            <li class="transaction-right"><span>Balance</span></li>

            <li class="transaction-left"><span>A/C Remain</span></li>
            <li class="transaction-right"><span id="aepsremain"></span></li>
        </ul>

    </div>
    <div class="container-fluid transaction-button" id="next_page">
        <button id="addaccount-back" style="background:#a39f9e;" onclick="AEPS()">back</button>
        <button id="addaccount-back" style="background:#a39f9e;" onclick="print(&#39;balance&#39;)">print</button>
    </div>
</div>

<div class="col-md-12 Confirm-Payment" id="ministat" style="display:none; padding-bottom:20px;">
    <div class="container-fluid">
        <div class="col-md-6 headd" style="padding: 0px;">
            <p id="txtbankstate"></p>
            <p id="txtbankaadhar"></p>
        </div>
        <div class="col-md-6 headd" style="padding: 0px;text-align: right;">
            <p id="txtfrmstate"></p>
            <p id="txtfrmdate"></p>
        </div>

    </div>
    <div class="container-fluid minitransaction">
        <table class="table-bordered" style="width: 100%;margin-bottom: 10px;">
            <thead>
                <tr>
                    <th>T&nbsp;-&nbsp;Date</th>
                    <th>Open&nbsp;₹</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Close&nbsp;₹</th>
                </tr>
            </thead>
            <tbody id="statementtbody">
            </tbody>
        </table>

    </div>
    <div class="container-fluid">
        <div id="serfeeshow" class="col-md-12 headdown" style="padding: 0px;border: 1px solid #dddddd;">
            <span style="padding: 15px 5px;display: inline-block;">Service&nbsp;Fee</span>
            <span id="txtfeeservice" style="padding: 15px 5px;display: inline-block;float: right;"></span>
        </div>
        <div class="col-md-12 headsig" style="text-align: right;padding: 0px;">
            <span style="padding: 10px;">Sig.</span>

        </div>

    </div>
    <div class="container-fluid transaction-button" id="next_page">
        <button id="addaccount-back" style="background:#a39f9e;" onclick="AEPS()">back</button>
        <button id="addaccount-back" style="background:#a39f9e;" onclick="print(&#39;statement&#39;)">print</button>
    </div>
</div>
<!--Blance-->
<!--Confirm Payment-->
<div class="col-md-12 Confirm-Payment" id="aeps-Confirm-Payment" style="display:none;">
    <div class="container-fluid">
        <div class="col-md-6 successful">
            <p>transaction successful</p>
            <strong><img src="<?php echo base_url();?>vfiles/india(2).svg"><span class="transform-re" id="amountaepssuccess"> </span><i class="fa fa-check fullbodydycolorbg"></i></strong>
            <span id="rrnaepssuccess"></span>
        </div>
        <div class="col-md-6 successful-logo">

            <img id="logochkaepssuccess" src="<?php echo base_url();?>API/dmrmm_home">

        </div>
    </div>
    <div class="container-fluid transaction">
        <p>AEPS transaction details</p>
        <ul class="transaction-detail">
            <li class="transaction-left"><span>retailer firm</span></li>
            <li class="transaction-right"><span id="aepssuccessfirm"></span></li>

            <li class="transaction-left"><span>Aadhaar Number</span></li>
            <li class="transaction-right"><span id="aepssuucessaadhar"></span></li>

            <li class="transaction-left"><span>Register Mobile</span></li>
            <li class="transaction-right"><span id="aepssuccessmobile"></span></li>

            <li class="transaction-left"><span>AEPS mode</span></li>
            <li class="transaction-right"><span>Cash</span></li>

            <li class="transaction-left"><span>A/C Remain</span></li>
            <li class="transaction-right"><span id="aepssuccessremain"></span></li>

            <li class="transaction-left"><span>Withdraw Amount </span></li>
            <li class="transaction-right"><span id="aepssuccessamt"></span></li>

            <li class="transaction-left"><span>service Fee</span></li>
            <li class="transaction-right"><span id="aepssuccessfee"></span></li>

            <li class="transaction-left"><span>tax</span></li>
            <li class="transaction-right"><span id="aepssuccesstax"></span></li>

            <li class="transaction-left"><span>Paid amount</span></li>
            <li class="transaction-right"><span id="paidamt"></span></li>

        </ul>


    </div>
    <div class="container-fluid transaction-button" id="next_page">
        <button id="addaccount-back" style="background:#a39f9e;" onclick="AEPS()">back</button>
        <button id="addaccount-back" style="background:#a39f9e;" onclick="print(&#39;transfer&#39;)">print</button>
    </div>
</div>
<div id="loadaeps" style="display: none">
    <img class="body-border-bottom-top" src="<?php echo base_url();?>vfiles/portrait_mode_scanning.gif" style="height:150px;">
</div>
<div class="loader"></div>
<script src="<?php echo base_url();?>vfiles/AEPS_NEW.js.download"></script>

<script>

    function scanagain() {
         $.ajax({
            url: '/API/Recharge_home/chk1',
            cache: false,
            type: "GET",
            beforeSend: function() {
                  $(".loader").show();
             },
            success: function (data) {

            }, error: function (data) {
                scanfing();
                $(".loader").hide();
            }
        })
    }
</script>
<script>
    function gotoscan() {

        $('#deviceerror1').text("");
        $('#deviceerror2').text("");
        $('#deviceerror3').text("");
        $('#deviceerror4').text("");
        $('#deviceerror5').text("");
        $('#deviceerror6').text("");
        $('#deviceerror7').text("");


        $('#driverdetails').hide();
        $('#devicesrno').val("");
        $('#txtaadhar').val("");
        $('#txtphone').val("");
        $('#cap').val("");
        $('#devicesrno').val("");
        $('#txtamt').val("");
                $('#txtfee').val("0");
                $("#radio1").click();
                 $('#getbalanceview').hide();
                 $('#aeps-Confirm-Payment').hide();
                $('#AEPSFOUND').hide();
                $('#nextfund').show();
                $('#addaccount-balance').hide();
                $('#scanshowfund').hide();
                $("#Devicerror").hide();
        $("#transferfnd").show();
         $("#transferser").show();
        $.ajax({
            url: '/API/Recharge_home/chk1',
            cache: false,
            type: "GET",
            beforeSend: function() {
                  $("#loadaeps").show();
             },
            success: function (data) {

            }, error: function (data) {
                scanfing();
            }
        })
    }
</script>
<script>
    function PurchaseAEPS(e) {
        $.ajax({
            url: '/API/Recharge_home/ServiceCharge',
            data: { Service: e },
            cache: false,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#PaymentTypeaeps').text(data.PaymentType);
                $('#Priceaeps').text(data.Price);
                $('#firstpurAEPS').hide();
                $('#secpurAEPS').show();
            }
        });
    }
    function FinalPurchaseAEPS(e) {
         $.ajax({
            url: '/API/Recharge_home/ServicePurchase',
            data: { Service: e },
            cache: false,
            type: "POST",
             dataType: 'json',
            beforeSend: function() {
                      $('.loader').show();
                     },
             success: function (data) {
                 $('.loader').hide();
                 if (data.Status == "Success") {
                     AEPS();
                 }
                 else {
                            $('#errmsgaeps').text(data.Message);
                 }

            }
        });
    }
</script>
<script>
    function backshow() {
        $('.sho').hide();
        $('.hedn').show();
    }
</script>
<script>
    function AEPS() {
        $('#txtusernm').val();

        $('#firstpurAEPS').hide();
         $('#secpurAEPS').hide();
            $('.sho').hide();
        $('#ministat').hide();
        $('.display-nonescanp').show();
        $("#banklistshow").empty();
      
        $('#devicesrno').val("");
        $('#txtaadhar').val("");
        $('#txtphone').val("");
        $('#cap').val("");
        $('#devicesrno').val("");
        $('#txtamt').val("");
                $('#txtfee').val("0");
                $("#radio1").click();
                 $('#getbalanceview').hide();
                 $('#aeps-Confirm-Payment').hide();
                $('#AEPSFOUND').hide();
                $('#nextfund').show();
                $('#addaccount-balance').hide();
                $('#scanshowfund').hide();
                $("#Devicerror").hide();
            $("#transferfnd").show();
              $("#transferser").show();
        $.ajax({
            url: '/API/Recharge_home/AEPS',
            cache: false,
            type: "GET",
            //beforeSend: function() {
            //      $("#loadaeps").show();
            // },
            success: function (data) {
              var output = JSON.parse(data);
              var status = output.status;

                if (status == "OK") {
                    var list = JSON.parse(output.banklist);
                    var sts = list.status;
                    if (sts == true) {
                        var count = list.data.length;
                        var i;
                        var ddlCustomers = $("#banklistshow");
                         ddlCustomers.append(
                                  $('<option></option>').val("").html("Select Bank")
                                  );
                        for (i = 1; i < count; i++)
                        {
                         ddlCustomers.append(
                                  $('<option></option>').val(list.data[i].iinno).html(list.data[i].bankName)
                                  );
                        }
                    }
                    var aepsid = output.aepsid;
                    $('#errormessgeshow').text("");
                    $('#AEPSID').text(aepsid);
                    $('#notfound').hide();
                    $('#gotoscan').show();
                   //scanfing();



                }
                else if (status == "NOTOK")
                {
                    var msg = output.msg;
                     if (msg == "Firstlly Purchase this Service." ||msg  =="AEPS Service is Expired.") {
                        $('#firstpurAEPS').show();
                    }
                    else {
                          $('#KYCNotComp').text(msg);
                    }

                    $("#loadaeps").hide();

                    $('#notfound').hide();
                    $('#gotoscan').hide();
                    $('#AEPSID').text("");
                    $('#AEPSFOUND').hide();

                }
                else {
                    var msg = output.msg;
                    $("#loadaeps").hide();
                    $('#errormessgeshow').text(msg);
                    $('#notfound').show();
                    $('#gotoscan').hide();
                    $('#AEPSID').text("");
                    $('#AEPSFOUND').hide();
                }
            },
            complete: function () {
                $("#remainretailer").load(location.href + " #remainretailer");
                onloaddata();
               $("#loadaeps").hide();
            },
            error: function () {
                $("#remainretailer").load(location.href + " #remainretailer");
               $("#loadaeps").hide();
               }

        })
                 $.ajax({
            url: '/API/Recharge_home/AEPSreportnew',
            cache: false,
                 type: "GET",
                 cache: false,
               dataType:"html",
              success: function (data) {
                 $('#reportallinone').html(data);
            }
        })
        }

        function onloaddata() {
             $.ajax({
            url: '/API/Recharge_home/AEPSreportnew',
            cache: false,
                 type: "GET",
                 cache: false,
               dataType:"html",
            success: function (data) {
                 $('#reportallinone').html(data);
            }
        })


        }
</script>

<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>


<script>
    $('input[type=radio][name=radio]').change(function () {
        if (this.value == 'ministatement') {
            $('#txterrortransfer').text("");
            $("#transferfnd").hide();
            $("#transferser").show();
            $('#nextfund').hide();
            $('#addaccount-balance').html('Get Statement >');
            $('#addaccount-balance').show();
            $("#transferser").hide();
            $('#serfeeshow').hide();
        }
        if (this.value == 'balance') {
            $('#txterrortransfer').text("");
            $("#transferfnd").hide();
            $("#transferser").hide();
            $('#nextfund').hide();
            $('#addaccount-balance').html('Get Balance >');
            $('#addaccount-balance').show();
            $('#serfeeshow').hide();

        }
        else if (this.value == 'transfer') {
            $('#txterrortransfer').text("");
            $('#nextfund').show();
            $("#transferfnd").show();
            $("#transferser").show();
            $('#addaccount-balance').hide();
            $('#serfeeshow').show();

        }
           else if (this.value == 'aadharpay') {
            $('#txterrortransfer').text("");
            $('#nextfund').show();
            $("#transferfnd").show();
            $("#transferser").show();
            $('#addaccount-balance').hide();
            $('#serfeeshow').show();
        }
    });
</script>
<script>
    function Nextransfer() {
        var myRadio = $("input[name=radio]");
        var checkedValue = myRadio.filter(":checked").val();
        var type = "CW";
        if (checkedValue == "aadharpay") {
            type = "M";
        }
        $("#txterrortransfer").text("");
        var txtaadhar = $('#txtaadhar').val();
        var txtphone=$('#txtphone').val();
        var bankname = $("#banklistshow").find("option:selected").text();
        var iin = $('#banklistshow').val();
        var cap = $('#cap').val();
        
        var remark = "";
        var txtamt = $('#txtamt').val();
        var servicefee =  $('#txtfee').val();
        var devicesrno = $('#devicesrno').val();
        var usernm = $('#txtusernm').val();

        if (txtaadhar != "" && txtphone != "" && cap != "" && devicesrno != "" && txtamt != "" && bankname!="Select Bank") {
            var chk = validate(txtaadhar);
            if (chk == true) {
                $.ajax({
                    url: '/API/Recharge_home/AEPS',
                    cache: false,
                    data: { mobile: txtphone, uid: txtaadhar, bank: bankname, iin: iin, cap: cap, type: type, amount: txtamt, remark: remark, DeviceSrNo: devicesrno, servicefee: servicefee, usernm: usernm },
                    type: "POST",
                    beforeSend: function () {
                        $('.loader').show();
                    },
                    success: function (data) {
                        var sts = data.Status;

                        if (sts == "Failed") {
                            var msg = data.Message;

                            $('#cap').val("");
                            $('#devicesrno').val("");
                            $("#txterrortransfer").text(msg);
                            $('#cap').val("");
                            $('#devicesrno').val("");
                            $('#nextfund').html('Confirm & Withdraw')
                        }
                        else {

                            var userinfo = data.userinfo;
                            var taxenable = userinfo.taxenable;
                            var paid = 0; var tax = 0;
                            if (taxenable == "N") {
                                paid = parseFloat(txtamt) - parseFloat(servicefee);
                            }
                            else {
                                tax = (parseFloat(servicefee) * 18) / 100;
                                paid = parseFloat(txtamt) - parseFloat(servicefee) - parseFloat(tax);
                            }

                            $('#aeps-Confirm-Payment').show();
                            $('#AEPSFOUND').hide();
                            $('#cap').val("");
                            $('#devicesrno').val("");
                            $('#amountaepssuccess').text(txtamt);
                            var rrnno = "RRN - " + data.Message.BankRrn;
                            $('#rrnaepssuccess').text(rrnno);
                            $("#logochkaepssuccess").attr("src", "../.." + userinfo.logo);
                            $('#aepssuccessfirm').text(userinfo.firmname);
                            $('#aepssuucessaadhar').text(txtaadhar);
                            $('#aepssuccessmobile').text(txtphone);
                            $('#aepssuccessremain').text(data.Message.BalanceAmount);
                            $('#aepssuccessamt').text(txtamt);
                            $('#aepssuccessfee').text(servicefee);
                            $('#aepssuccesstax').text(tax);
                            $('#paidamt').text(paid);
                        }
                    },
                    complete: function () {
                        $("#remainretailer").load(location.href + " #remainretailer");
                        $('.loader').hide();
                           onloaddata();
                    },
                    error: function () {
                        $("#remainretailer").load(location.href + " #remainretailer");
                        $('.loader').hide();
                    }
                })

            }
            else {
                $('#txterrortransfer').text("⚠ Enter Valid AADHAR");
            }
        }
        else {
            if (cap == "") {
                $('#txterrortransfer').text("⚠ Scan Again");
            }
            else {
                $('#txterrortransfer').text("⚠ All Field Are Mandatory");
            }
        }
    }
</script>
<script>
    function Getbalance() {

        var val = $('input[name="radio"]:checked').val();

        $("#txterrortransfer").text("");
        var txtaadhar = $('#txtaadhar').val();
        var txtphone=$('#txtphone').val();
        var bankname = $("#banklistshow").find("option:selected").text();
        var iin = $('#banklistshow').val();
        var cap = $('#cap').val();
        var txtfee = $('#txtfee').val();
        var usernm = $('#txtusernm').val();
        var type = "";
        if (val == "balance") {
               type = "BE";
        }
        else {
               type = "SAP";
        }

        var remark = "";
        var txtamt = 0;
        var devicesrno = $('#devicesrno').val();

        if (txtaadhar != "" && txtphone != "" && cap != "" && devicesrno != "" && bankname!="Select Bank") {
            var chk = validate(txtaadhar);
            if (chk == true) {
                var validnumber = txtphone.length;
                if (validnumber == 10) {
                    $.ajax({
                        url: '/API/Recharge_home/AEPS',
                        cache: false,
                        data: { mobile: txtphone, uid: txtaadhar, bank: bankname, iin: iin, cap: cap, type: type, amount: txtamt, remark: remark, DeviceSrNo: devicesrno, servicefee: txtfee, usernm: usernm },
                        type: "POST",
                        beforeSend: function () {
                            $('.loader').show();
                        },
                        success: function (data) {

                            var sts = data.Status;


                            if (sts == "Failed") {
                                var msg = data.Message;
                                $('#cap').val("");
                                $('#devicesrno').val("");
                                $("#txterrortransfer").text(msg);
                            }
                            else {
                                if (type == "SAP") {
                                    var msg1111 = data.Message;

                                    var ouut = JSON.parse(msg1111);
                                    var mini_statement = ouut.miniStatementStructureModel;

                                    var len = mini_statement.length;
            
                                    var openbal = ouut.balanceAmount;
                                    var closebal = ouut.balanceAmount;
                                    for (i = 0; i < len; i++) {
                                        var date = mini_statement[i].date;
                                        var txnType = mini_statement[i].txnType;
                                        var amount = mini_statement[i].amount;
                                        if (txnType == "Cr") {
                                            openbal = parseFloat(closebal) - parseFloat(amount);
                                        }
                                        else {
                                            openbal = parseFloat(closebal) + parseFloat(amount);
                                        }

                                        var markup = "<tr><td>" + date + "</td><td>" + openbal.toFixed(2) + "</td><td>" + txnType + "</td><td>" + amount + "</td><td>" + closebal.toFixed(2) + "</td></tr>";

                                        $("#statementtbody").append(markup);

                                        closebal = openbal;
                                    }
                                      $('#cap').val("");
                                    $('#devicesrno').val("");
                                      var userinfo = data.userinfo;
                                       $('#txtfeeservice').text("₹ "+txtfee);
                                        $('#txtbankstate').text(bankname);
                                        $('#txtbankaadhar').text(txtaadhar);
                                    $('#txtfrmstate').text(userinfo.firmname);
                                   var today = new Date();
                    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                                        $('#txtfrmdate').text(date);
                                    $('#ministat').show();
                                    $('#AEPSFOUND').hide();
                                }
                                else {
                                    var userinfo = data.userinfo;
                                    $('#cap').val("");
                                    $('#devicesrno').val("");
                                    var rrnno = "RRN - " + data.Message.BankRrn;
                                    $('#rrnchk').text(rrnno);
                                    $('#aepsaadhar').text(txtaadhar);
                                    $('#aepsmobile').text(txtphone);
                                    $("#logochkaeps").attr("src", "../.." + userinfo.logo);
                                    $('#remfirmaeps').text(userinfo.firmname);
                                    $('#aepsremain').text(data.Message.BalanceAmount);
                                    $('#getbalanceview').show();
                                    $('#AEPSFOUND').hide();
                                }
                            }
                        },
                        complete: function () {
                            $("#remainretailer").load(location.href + " #remainretailer");
                            $('.loader').hide();
                        },
                        error: function () {
                            $("#remainretailer").load(location.href + " #remainretailer");
                           $('.loader').hide();
                        }
                    })
                }
                else {
                    $('#txterrortransfer').text("Enter Valid Phone Number");
                }
            }
            else {
                 $('#txterrortransfer').text("Enter Valid AADHAR");
            }
        }
        else {
             if (cap.length == "") {
                   $('#txterrortransfer').text("Scan Again");
            }
            else {
                $('#txterrortransfer').text("All Field Are Mandatory");
            }
        }
    }
</script>
<script>
    function Reset() {
        $('#txtaadhar').val("");
        $('#txtphone').val("");
        //$('#banklistshow').val("");
        $('#txtaadhar').val("");
        $('#txtamt').val("");
        $('#txtfee').val("");
        $('#txterrortransfer').text("");
    }
</script>

<script>
    function print(e) {
        if (e == "balance") {
            var rrnno = $('#rrnchk').text();
            var firmname = $('#remfirmaeps').text();
            var aadhar = $('#aepsaadhar').text();
            var mobile = $('#aepsmobile').text();
            var remain = $('#aepsremain').text();
            var url = "/API/Recharge_home/Print_aeps_balance_Pdf?rrnno=" + rrnno + "&firmname=" + firmname + "&aadhar=" + aadhar + "&mobile=" + mobile + "&remain=" + remain;
            window.open(url, "_blank")
        }
        else if (e == "statement")
        {
             var txtbankstate = $('#txtbankstate').text();
            var txtfrmstate = $('#txtfrmstate').text();
            var txtbankaadhar = $('#txtbankaadhar').text();
            var txtfrmdate = $('#txtfrmdate').text();
            var txtfeeservice = $('#txtfeeservice').text();
            var statementtbody = $("#statementtbody").html();
            var sttt= JSON.stringify(statementtbody)
            var url = "/API/Recharge_home/Print_aeps_ministatement_Pdf?txtbankstate=" + txtbankstate + "&txtfrmstate=" + txtfrmstate + "&txtbankaadhar=" + txtbankaadhar + "&txtfrmdate=" + txtfrmdate + "&txtfeeservice=" + txtfeeservice+"&statementtbody="+sttt;
            window.open(url, "_blank")
        }
        else if (e=="transfer") {
            var rrnno = $('#rrnaepssuccess').text();
            var firmname = $('#aepssuccessfirm').text();
            var aadhar = $('#aepssuucessaadhar').text();
            var mobile = $('#aepssuccessmobile').text();
            var remain = $('#aepssuccessremain').text();
            var aepssuccessamt = $('#aepssuccessamt').text();
            var aepssuccessfee = $('#aepssuccessfee').text();
            var aepssuccesstax = $('#aepssuccesstax').text();
            var paidamt = $('#paidamt').text();
            var url = "/API/Recharge_home/Print_aeps_transfer_Pdf?rrnno=" + rrnno + "&firmname=" + firmname + "&aadhar=" + aadhar + "&mobile=" + mobile + "&remain=" + remain+"&amount="+aepssuccessamt+"&servicefee="+aepssuccessfee+"&tax="+aepssuccesstax+"&paidamount="+paidamt;
            window.open(url, "_blank")
        }
        else if (e=="aadharpay") {
            var rrnno = $('#rrnaepssuccess').text();
            var firmname = $('#aepssuccessfirm').text();
            var aadhar = $('#aepssuucessaadhar').text();
            var mobile = $('#aepssuccessmobile').text();
            var remain = $('#aepssuccessremain').text();
            var aepssuccessamt = $('#aepssuccessamt').text();
            var aepssuccessfee = $('#aepssuccessfee').text();
            var aepssuccesstax = $('#aepssuccesstax').text();
            var paidamt = $('#paidamt').text();
            var url = "/API/Recharge_home/Print_aeps_transfer_Pdf?rrnno=" + rrnno + "&firmname=" + firmname + "&aadhar=" + aadhar + "&mobile=" + mobile + "&remain=" + remain+"&amount="+aepssuccessamt+"&servicefee="+aepssuccessfee+"&tax="+aepssuccesstax+"&paidamount="+paidamt;
            window.open(url, "_blank")
        }
    }
</script>
<script>
    // multiplication table
    const d = [
        [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
        [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],
        [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],
        [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],
        [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],
        [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],
        [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],
        [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],
        [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],
        [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]
    ]

    // permutation table
    const p = [
        [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
        [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],
        [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],
        [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],
        [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],
        [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],
        [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],
        [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]
    ]

    // validates Aadhar number received as string
    function validate(aadharNumber) {
        let c = 0
        let invertedArray = aadharNumber.split('').map(Number).reverse()

        invertedArray.forEach((val, i) => {
            c = d[c][p[(i % 8)][val]]
        })

        return (c === 0)
    }
</script>
<script>
    function drivershow() {
       
        $('#getbalanceview').hide();
        $('#aeps-Confirm-Payment').hide();
        $('#AEPSFOUND').hide();
        $('#nextfund').show();
        $('#addaccount-balance').hide();
        $('#scanshowfund').hide();
        $("#Devicerror").hide();
        $("#transferfnd").show();
        $("#transferser").show();
    }
</script>

<script>
    $(document).ready(function () {
        $('.display-nonescanp').click(function () {

            $(this).css('display', 'none')
        });




    });
</script>

<!-------Retailer Outlet-------->
<script>
    function SendOTP() {
        $('.loader').show();
        var url = '/API/Recharge_home/RetailerOutletRegister'
        $.ajax({
            url: url,
            cache: false,
            type: "POST",
            success: function (data) {
                $('.loader').hide();
                var stscode = data.Status;
                var msg = data.Message;
                if (stscode == "TXN") {

                    $('#otpShow').css('display', 'block');
                    $('#otpSubmit').css('display', 'block');
                    $('#OTPMSG').text(msg);
                }
                else {
                    //swal("Oops!!", msg, "error");
                    $('#OTPMSG').text(msg);
                }
            }
        })
    }
</script>

<script>
    function otpverify() {
        $('.loader').show();
        var otp = $('#otpShow').val();
        var url = '/API/Recharge_home/EnterOtp'
        $.ajax({
            url: url,
            data: { otp:otp },
            cache: false,
            type: "POST",
            success: function (data) {
                $('.loader').hide();
                var stscode = data.Status;
                var msg = data.Message;
                if (stscode == "TXN") {

                      //swal("Success!!", "AEPS Active DONE", "success");
                    location.reload();
                    $('#OTPMSG').text(msg).css('color','green');
                }
                else {
                    $('#OTPMSG').text(msg).css('color','red');
                    //swal("Oops!!", msg, "error");
                }
            }
        })
    }
</script>

<script>
    $(document).ready(function () {
        $("#submitMobile").click(function () {
            $(".hedn").hide();
        });
        $("#submitMobile").click(function () {
            $(".sho").show();
        });
    });
</script>
<script>
    $("#txtphone").keyup(function () {
        if (this.value.length == 10) {
            var mobile = $('#txtphone').val();
              var url = '/API/Recharge_home/AEPSNAMEFIND'
            $.ajax({
                url: url,
                data: { mobile: mobile },
                cache: false,
                type: "POST",
                success: function (data) {
                    $('#txtusernm').val(data);
                }
            })
        }
    });
</script>
        </div>
        <div id="tab-3" class="tab-content tab-3 pancardpageheight-tab">
            <style>

    .loader {
        position: fixed;
        top: -90px;
        left: 0;
        background-color: rgba(255,255,255,0.7);
        z-index: 999999999999;
        display: none;
        height: 100vw;
        width: 100vw;
    }

    @-webkit-keyframes spin {
        from {
            -webkit-transform: rotate(0deg);
        }

        to {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .loader::after {
        content: '';
        display: block;
        position: absolute;
        left: 48%;
        top: 25%;
        width: 100px;
        height: 100px;
        border-style: solid;
        border-color: black;
        border-top-color: transparent;
        border-width: 4px;
        border-radius: 50%;
        -webkit-animation: spin .8s linear infinite;
        animation: spin .8s linear infinite;
    }
</style>

<div class="loader loaderpancard"></div>
<div id="failedpancard" style="display:none;">
    <div class="start-tab-3 responsiveclassfirst">
        <div class="container-fluid aeps">
            <div class="col-md-12 aeps-start">
                <div class="col-md-10 aeps_id fgdfgdfg">
                    <div class="col-md-12 amount amount_strong"><strong class="satedivwidth" style="">PSA ID</strong><span>Unregistered User (KYC DUE)</span></div>
                </div>
                <div class="col-md-2 aeps_button">
                    <a href="http://www.psaonline.utiitsl.com/psaonline/" target="_blank">
                        <button class="uti-img"><img src="<?php echo base_url();?>vfiles/uti-logo.png"><span><strong>U T I</strong><span class="pn-log">Login</span></span></button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <span id="failedmessageshow" style="color:red"></span>

</div>
<div id="firstpur1" class="col-md-12 remitter_button" style="display:none;text-align: center;">
    <img src="<?php echo base_url();?>vfiles/forbidden.svg" style="width: 90px;display: block;margin: 0px auto;">
    <span class="bodycolormy" style="margin-top: 20px;margin-bottom: 20px;font-size: 26px;">PANCARD Service Expired !</span>
    <p style="margin-bottom: 20px;text-align: justify;">Your service is currently down, if you want to keep the service running smoothly, you will have to pay the service fee, which you see below and you can purchase the service by clicking the button.</p>
    <button class="btn btn-default fullbodydycolorbg" onclick="PurchasePAN(&#39;PANCARD&#39;)" style="color: #fff;">Purchase Service</button>
</div>
<div id="secpur1" class="col-md-12 remitter_button remitter_buttonewq" style="display:none;text-align: center;">
    <span style="margin-top:0;">Payment Details</span>
    <div class="lavbrd">
        <label>Mode</label>
        <label class="rightlable" id="PaymentType1"></label>
    </div>
    <div class="lavbrd">
        <label>Amount</label>
        <label class="rightlable" id="Price1"></label>
    </div>
    <div class="coldebuttonnew">
        <button class="bacbuttonrrt" onclick="PANCARD()">Back</button>
        <button class="btn btn-default fullbodydycolorbg" onclick="FinalPurchasePAN(&#39;PANCARD&#39;)" style="color: #fff;">Pay Now</button>
    </div>
    <br>
    <label id="errmsgpan" style="color:red;"></label>
</div>

    <div id="notkyc" style="display:none;">
        <div class="start-tab-3">
            <div class="container-fluid aeps">
                <div class="col-md-12 aeps-start">
                    <div class="col-md-10 aeps_id fdgfgfgfga">
                        <div class="col-md-12 amount amount_strong"><strong style="">PSA ID</strong><span>Unregistered User (KYC DUE)</span></div>
                    </div>
                    <div class="col-md-2 aeps_button">
                        <a href="http://www.psaonline.utiitsl.com/psaonline/" target="_blank">
                            <button class="uti-img"><img src="<?php echo base_url();?>vfiles/uti-logo.png"><span><strong>U T I</strong><span class="pn-log">Login</span></span></button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="avtar">
            <img src="<?php echo base_url();?>vfiles/avatar.svg">
            <h2>KYC DUE !</h2>
            <p>please firstly complete your profile details and wait for KYC approval. othewise call to customer care.</p>
            <span id="kycerrormsg"></span>
        </div>
    </div>

    <div class="start-tab-3">

        <div class="container-fluid aeps">
            <div class="col-md-12 aeps-start">
                <div id="unregister" style="display:none;">

                    <div class="col-md-10 aeps_id fdgfgfgfga">
                        <div class="col-md-12 amount amount_strong"><strong style="">PSA ID</strong><span>Unregistered User</span></div>
                    </div>
                    <div class="col-md-2 aeps_button">
                        <a href="http://www.psaonline.utiitsl.com/psaonline/" target="_blank">
                            <button class="uti-img">
                                <img src="<?php echo base_url();?>vfiles/uti-logo.png"><span>
                                    <strong>U T I</strong>
                                    <span class="pn-log">  Login</span>
                                </span>
                            </button>
                        </a>
                    </div>
                    <div class="education-img">
                        <img src="<?php echo base_url();?>vfiles/education.svg">
                        <p>You are Not Registered with Pancard Service.</p>
                        <button class="fullbodydycolorbg" onclick="registeruti()">Click to Register at UTI</button>
                    </div>
                </div>

                <!--UTI FORM-->
                <div id="resgisterform" class="uti-form" style="display:none;">
                    <p class="body-border-bottom">Registeration Form</p>
                    <form>
                        <ul>
                            <li>
                                <span>name</span>
                                <input id="txtpanname" name="txtpanname" readonly="" type="text" placeholder="enter your name">
                            </li>
                            <li>
                                <span>firm name</span>
                                <input id="txtfirmnmpan" name="txtfirmnmpan" readonly="" type="text" placeholder="Firm Name">
                            </li>
                            <li>
                                <span>register email ID</span>
                                <input id="txtemailpan" name="txtemailpan" readonly="" type="email" placeholder="enter your email" style="text-transform:inherit;">
                            </li>
                            <li class="two-colam">
                                <div class="span-input">
                                    <span>Mobile number</span>
                                    <input id="panphone" name="panphone" readonly="" type="text" placeholder="number">
                                </div>
                                <div class="span-input">
                                    <span>date of birthday</span>
                                    <input id="dobpan" name="dobpan" readonly="" type="text" placeholder="Date of birthday">
                                </div>

                            </li>
                            <li class="two-colam">
                                <div class="span-input">
                                    <span>pancard number</span>
                                    <input id="panpancard" name="panpancard" readonly="" type="text" placeholder="Enter Pancard Number">
                                </div>
                                <div class="span-input">
                                    <span>aadharcard number</span>
                                    <input id="aadharpan" name="aadharpan" readonly="" type="text" placeholder="Enter Aadharcard Number">
                                </div>
                            </li>

                            
                            <li>
                                <span>address</span>
                                <textarea id="txtaddresspan" name="txtaddresspan" readonly="" placeholder="Enter Address"></textarea>
                            </li>

                            <li class="pinCode">
                                <span>pin code</span>
                                <input id="pinpan" name="pinpan" readonly="" type="text" placeholder="Enter Pin Code">
                            </li>


                        </ul>
                        <div class="container-fluid transaction-button transaction-button-reshponshive">
                            <button type="button" id="transaction-back" onclick="PANCARD()">Back</button>
                            <button type="button" id="transaction-more" style="display:block;" onclick="Register()" class="fullbodydycolorbg">Register Form</button>
                       
                        </div>
                        <span id="registererror" style="color:red;"></span>
                    </form>
                </div>

                <!--register now page-->
                <div id="pendingsts" class="register-page register-responshiveclass" style="display:none;">
                    <div class="container-fluid aeps">
                        <div class="col-md-12 aeps-start">
                            <div class="col-md-10 aeps_id fdgfgfgfga">
                                <div class="col-md-12 amount amount_strong"><strong style="">PSA ID</strong><span>User Registration pending</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="avtar avtar-first avtar-first-responshive">
                        <img src="<?php echo base_url();?>vfiles/duration.svg">
                        <h2>Approval pending</h2>
                        <p>Your PAN Card Service Registration pending for Approval</p>
                    </div>
                    <div class="container-fluid transaction-button transaction-responshive">
                        
                        
                        <button class="fullbodydycolorbg" onclick="checkstatus()">Check Live Status</button>
                    </div>
                    <div>
                        <label id="pendingstserror" style="color:red;"></label>
                    </div>
                </div>
                <!--register now page-->
                <!--Update Page-->
                <div id="purchase" class="update-page" style="display:none;">
                    <div class="container-fluid aeps">
                        <div class="col-md-12 aeps-start">
                            <div class="col-md-10 aeps_id fdgfgfgfga">
                                <div class="col-md-12 amount amount_strong"><strong style="">PSA ID</strong><span id="psaidregister"></span></div>
                            </div>
                            <div class="col-md-12 right-right">
                                <button>right</button>
                            </div>
                            <div class="col-md-2 aeps_button">
                                <a href="http://www.psaonline.utiitsl.com/psaonline/" target="_blank">
                                    <button class="uti-img"><img src="<?php echo base_url();?>vfiles/uti-logo.png"><span><strong>U T I</strong><span class="pn-log">Login</span></span></button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="Important-Step">
                        <p>Your PSA Service is Active. Enjoy with PSA services.</p>
                        <p>After buying tokens, visit the UTI website.</p>
                        <p>PAN card application will be filled on UTI portal.</p>
                    </div>
                    <div class="container-fluid transaction-button">
                        <button class="fullbodydycolorbg update-page1">Buy Physical Token</button>
                        
                    </div>
                    <div class="custome-none-class1">
                        <div class="button-plush button-plush-top">
                            <span>none</span>
                            <div class="Physical-Token"><p><img src="<?php echo base_url();?>vfiles/shopping-basket.svg"> Physical Token</p></div>
                            <div class="container button_plush1">
                                <div class="button-container button-container-custome">
                                    <button class="cart-qty-minus" type="button" value="-"><i class="fa fa-minus"></i></button>
                                    <input id="Physicaltokenvalue" type="text" name="qty" class="qty" maxlength="12" value="0">
                                    <button class="cart-qty-plus" type="button" value="+"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>

                        </div>
                        <div class="container-fluid transaction-button transaction-button-auto">
                            <button style="background-color:#a39f9e">reset</button>
                            <button class="fullbodydycolorbg" onclick="purchase()">Purchase Physical Token</button>



                        </div>
                    </div>

                    
                    <div>
                        <span id="buttokenerror" style="color:red;"></span>
                    </div>
                </div>
                <!--Update Page-->
                <!--UTI FORM-->
            </div>
        </div>
    </div>

    <!---------------Final Payment-------------------------->
    <div class="col-md-12 Confirm-Payment" id="pan-Confirm-Payment" style="display:none;">
        <div class="container-fluid">
            <div class="col-md-6 successful">
                <p>transaction successful</p>
                <strong><img src="<?php echo base_url();?>vfiles/india(2).svg"><span class="transform-re"> - 30000</span><i class="fa fa-check fullbodydycolorbg"></i></strong>
                <span>RRN : 003419773790</span>
            </div>
            <div class="col-md-6 successful-logo"><a href="<?php echo base_url();?>API/dmrmm_home#">logo</a></div>
        </div>
        <div class="container-fluid transaction">
            <p>AEPS transaction details</p>
            <ul class="transaction-detail">
                <li class="transaction-left"><span>retailer firm</span></li>
                <li class="transaction-right"><span>instamoney</span></li>

                <li class="transaction-left"><span>Aadhaar Number</span></li>
                <li class="transaction-right"><span>852096374145698</span></li>

                <li class="transaction-left"><span>Register Mobile</span></li>
                <li class="transaction-right"><span>7665848573</span></li>



                <li class="transaction-left"><span>AEPS mode</span></li>
                <li class="transaction-right"><span>Cash</span></li>

                <li class="transaction-left"><span>A/C Remain</span></li>
                <li class="transaction-right"><span>2000</span></li>

                <li class="transaction-left"><span>Withdraw Amount </span></li>
                <li class="transaction-right"><span>10000</span></li>

                <li class="transaction-left"><span>service Fee</span></li>
                <li class="transaction-right"><span>10</span></li>

                <li class="transaction-left"><span>tax</span></li>
                <li class="transaction-right"><span>0</span></li>

                <li class="transaction-left"><span>Paid amount</span></li>
                <li class="transaction-right"><span>9990</span></li>




            </ul>
            <div class="container-fluid transaction-button">
                <button>Close</button><button class="fullbodydycolorbg">more Withdraw</button>
                <button id="transaction-print">print</button><button id="transaction-mail" class="fullbodydycolorbg">email</button>

            </div>
        </div>
    </div>
    <!---------------Final Payment-------------------------->
    <script>
    function PurchasePAN(e) {
        $.ajax({
            url: '/API/Recharge_home/ServiceCharge',
            data: { Service: e },
            cache: false,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#PaymentType1').html(data.PaymentType);
                $('#Price1').html(data.Price);
                $('#firstpur1').hide();
                $('#secpur1').show();
            }
        });
    }
    function FinalPurchasePAN(e) {
         $.ajax({
            url: '/API/Recharge_home/ServicePurchase',
            data: { Service: e },
            cache: false,
            type: "POST",
             dataType: 'json',
            beforeSend: function() {
                      $('.loader').show();
                     },
             success: function (data) {
               
                 if (data.Status == "Success") {
                     PANCARD();
                 }
                 else {
                      $('#errmsgpan').text(data.Message);
                 }

             },
             complete: function () {
                 $('.loader').hide();
                 $("#remainretailer").load(location.href + " #remainretailer");
             },
             error: function () {
                 $("#remainretailer").load(location.href + " #remainretailer");
                 $('.loader').hide();
             }
        });
    }
    </script>
    <script>
    function PANCARD() {
            $('#firstpur1').hide();
            $('#secpur1').hide();
            $('#buttokenerror').text("");
            $('#transaction-more').show();
            $('#Update-more').hide();
            $('#failedpancard').hide();
            $('#notkyc').hide();
            $('#unregister').hide();
            $('#resgisterform').hide();
            $('#pendingsts').hide();
            $('#purchase').hide();
            $('#pan-Confirm-Payment').hide();
            $.ajax({
            url: '/API/PANCARD/Index',
            cache: false,
                type: "GET",
               beforeSend: function() {
                  $('.loader').show();
             },
            success: function (data) {
                var output = JSON.parse(data);
                $('.loader').hide();
                var status = output.status;
                var message = output.msg;
                if (status == "NOTRegistered") {
                    $('#unregister').show();
                }
                else if (status == "PENDING") {
                    $('#pendingsts').show();
                }
                else if (status == "NOTKYC") {
                    $('#notkyc').show();
                    $('#kycerrormsg').text(message);
                }
                else if (status=="Registered")
                {
                    $('#purchase').show();
                    $('#psaidregister').text(message);
                }
                else {
                    $('#failedpancard').show();

                    if (message == "Firstlly Purchase this Service." || message  =="AEPS Service is Expired.") {
                         $('#firstpur1').show();
                    }
                    else {
                        $('#failedmessageshow').text(message);
                    }
                }
            }
            })

             $.ajax({
            url: '/API/Recharge_home/PANCARDreportnew',
            cache: false,
                 type: "GET",
                 cache: false,
               dataType:"html",
            success: function (data) {
                 $('#reportallinone').html(data);
            }
        })
    }
    </script>
    <script>
    function registeruti() {
          $.ajax({
            url: '/API/PANCARD/Userinfo',
            cache: false,
              type: "GET",
                beforeSend: function() {
                  $('.loader').show();
             },
              success: function (data) {
                  $('.loader').hide();
                  $('#txtpanname').val(data[0].RetailerName);
                  $('#txtfirmnmpan').val(data[0].Frm_Name);
                  $('#txtemailpan').val(data[0].Email);
                  $('#panphone').val(data[0].Mobile);
                  $('#dobpan').val(data[0].dateofbirth);
                  $('#panpancard').val(data[0].PanCard);
                  $('#aadharpan').val(data[0].AadharCard);
                  //$('#statepan').val(data[0].State);
                  //$('#ditrictpan').val(data[0].District);
                  $('#txtaddresspan').val(data[0].Address);
                  $('#pinpan').val(data[0].Pincode);

                   $('#resgisterform').show();
                   $('#unregister').hide();
            }
        })

    }
    </script>
    <script>
    function Register() {
        
        var txtpanname = $("#txtpanname").val();
        var txtfirmnmpan = $("#txtfirmnmpan").val();
        var txtemailpan = $("#txtemailpan").val();
        var panphone = $("#panphone").val();
        var dobpan = $("#dobpan").val();
       var panpancard = $("#panpancard").val();
        var aadharpan = $("#aadharpan").val();
        var txtaddresspan = $("#txtaddresspan").val();
        var pinpan = $("#pinpan").val();
        $.ajax({
            url: '/API/PANCARD/RegisterPSA',
            cache: false,
            data: {txtpanname:txtpanname,txtfirmnmpan:txtfirmnmpan,txtemailpan:txtemailpan,panphone:panphone,dobpan:dobpan,panpancard:panpancard,aadharpan:aadharpan,txtaddresspan:txtaddresspan,pinpan:pinpan},
            type: "POST",
              beforeSend: function() {
                  $('.loader').show();
             },
            success: function (data) {
                $('.loader').hide();
                var output = JSON.parse(data);
                if (output.Status == "Failed") {
                    $('#registererror').text(output.Message);
                }
                else {
                    PANCARD();
                }
            }
        })
    }
    </script>
    <script>
    function checkstatus() {
     $.ajax({
            url: '/API/PANCARD/CheckStatus',
            cache: false,
         type: "POST",
              beforeSend: function() {
                  $('.loader').show();
             },
         success: function (data) {
             $('.loader').hide();
                var output = JSON.parse(data);
                if (output.Status == "Success") {
                   PANCARD();
                }
                else {
                    $('#pendingstserror').text(output.Message)
                }
            }
        })
    }
    </script>
    <script>
    function updatepsasts() {

         $.ajax({
            url: '/API/PANCARD/Userinfo',
            cache: false,
             type: "GET",
                 beforeSend: function() {
                  $('.loader').show();
             },
             success: function (data) {
                   $('.loader').hide();
                  $('#txtpanname').val(data[0].RetailerName);
                  $('#txtpanname').attr("Readonly", false);
                  $('#txtfirmnmpan').val(data[0].Frm_Name);
                  $('#txtfirmnmpan').attr("Readonly", false);
                  $('#txtemailpan').val(data[0].Email);
                  $('#panphone').val(data[0].Mobile);
                  $('#dobpan').val(data[0].dateofbirth);
                  $('#panpancard').val(data[0].PanCard);
                  $('#panpancard').attr("Readonly", false);
                  $('#aadharpan').val(data[0].AadharCard);
                  $('#aadharpan').attr("Readonly", false);
                  //$('#statepan').val(data[0].State);
                  //$('#ditrictpan').val(data[0].District);
                  $('#txtaddresspan').val(data[0].Address);
                  $('#txtaddresspan').attr("Readonly", false);
                  $('#pinpan').val(data[0].Pincode);
                  $('#pinpan').attr("Readonly", false);
                  $("#transaction-more").hide();
                  $('#Update-more').show();
                  $('#resgisterform').show();
                  $('#pendingstserror').text("");
                  $('#pendingsts').hide();
            }
        })
    }

    </script>
    <script>
    function UpdatePSA() {
        $('#registererror').text("");
        var txtpanname = $("#txtpanname").val();
        var txtfirmnmpan = $("#txtfirmnmpan").val();
        var panpancard = $("#panpancard").val();
        var aadharpan = $("#aadharpan").val();
        var txtaddresspan = $("#txtaddresspan").val();
        var pinpan = $("#pinpan").val();

        if (txtpanname != "" && txtfirmnmpan != "" && panpancard != "" && aadharpan != "" && txtaddresspan != "" && pinpan != "") {
            var validaadhar = validate(aadharpan);
            if (validaadhar == true) {
                var regex = /([A-Z]){5}([0-9]){4}([A-Z]){1}$/;
                if (regex.test(panpancard.toUpperCase())) {
                    var CheckZipCode = /(^\d{6}$)/;
                    if (CheckZipCode.test(pinpan)) {
                       $.ajax({
                               url: '/API/PANCARD/UpdatePSA',
                               cache: false,
                               data: {txtpanname:txtpanname,txtfirmnmpan:txtfirmnmpan,panpancard:panpancard,aadharpan:aadharpan,txtaddresspan:txtaddresspan,pinpan:pinpan},
                           type: "POST",
                                beforeSend: function() {
                  $('.loader').show();
             },
                           success: function (data) {
                               $('.loader').hide();
                                       var output = JSON.parse(data);
                                       if (output.Status == "Failed") {
                                           $('#registererror').text(output.Message);
                                       }
                                       else {
                                              PANCARD();
                                       }
                                   }
                              })
                    }
                    else {
                        $('#registererror').text("Enter Valid Pin Code");
                    }
                }
                else {
                      $('#registererror').text("Enter Valid Pan Card");
                }
            }
            else {
                 $('#registererror').text("Enter Valid aadhar");
            }
        }
        else {
            $('#registererror').text("All Filed Are Required");
        }
    }
    </script>

    <script>
        // multiplication table
        const d = [
            [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],
            [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],
            [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],
            [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],
            [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],
            [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],
            [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],
            [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],
            [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]
        ]

        // permutation table
        const p = [
            [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],
            [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],
            [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],
            [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],
            [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],
            [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],
            [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]
        ]

        // validates Aadhar number received as string
        function validate(aadharNumber) {
            let c = 0
            let invertedArray = aadharNumber.split('').map(Number).reverse()

            invertedArray.forEach((val, i) => {
                c = d[c][p[(i % 8)][val]]
            })

            return (c === 0)
        }
    </script>

    <script>
    function purchase() {
        var dig = "0";
        var phy = $('#Physicaltokenvalue').val();
        if (dig > 0 || phy > 0) {
            $.ajax({
                url: '/API/PANCARD/buyUTIToken',
                cache: false,
                data: { digitalCount: dig, physicalCount: phy },
                type: "POST",
                  beforeSend: function() {
                  $('.loader').show();
             },
                success: function (data) {

                    var output = JSON.parse(data);
                    if (output.RESULT == 0) {
                        document.getElementById("buttokenerror").style.color = "green";
                        $('#buttokenerror').text("Pan Card Purchase Successfully");
                    }
                    else {
                        $('#buttokenerror').text(output.ADDINFO);
                    }
                },
               complete: function () {

                   $('.loader').hide();
                    $.ajax({
            url: '/API/Recharge_home/PANCARDreportnew',
            cache: false,
                 type: "GET",
                 cache: false,
               dataType:"html",
            success: function (data) {
                 $('#reportallinone').html(data);
            }
        })
            }
            })

        }
        else {
               $('#buttokenerror').text("Select Any digital token or Physical token");
        }
    }
    </script>
    
        </div>
        <div id="tab-4" class="tab-content">
            <style>

    .loader {
        position: fixed;
        top: -90px;
        left: 0;
        background-color: rgba(255,255,255,0.7);
        z-index: 999999999999;
        display: none;
        height: 100vw;
        width: 100vw;
    }

    @-webkit-keyframes spin {
        from {
            -webkit-transform: rotate(0deg);
        }

        to {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .loader::after {
        content: '';
        display: block;
        position: absolute;
        left: 48%;
        top: 25%;
        width: 100px;
        height: 100px;
        border-style: solid;
        border-color: black;
        border-top-color: transparent;
        border-width: 4px;
        border-radius: 50%;
        -webkit-animation: spin .8s linear infinite;
        animation: spin .8s linear infinite;
    }
</style>
<div class="loader loaderpancard"></div>
<div id="MPOSFAILED" style="display:none;">
    <div class="container-fluid aeps">
        <div class="col-md-12 aeps-start mpos-contents">
            <div class="col-md-10 aeps_id">
                <div class="col-md-12 amount amount_strong"><strong class="etrtfdf" style="">M-POS Device ID</strong><span>Unregistered User (KYC DUE)</span></div>
            </div>

        </div>
    </div>
    <div>
        <span id="errormposid"></span>
    </div>
</div>
<div id="firstpur2" class="col-md-12 remitter_button" style="display:none;text-align: center;">
    <img src="<?php echo base_url();?>vfiles/forbidden.svg" style="width: 90px;display: block;margin: 0px auto;">
    <span class="bodycolormy" style="margin-top: 20px;margin-bottom: 20px;font-size: 26px;">M-POS Service Expired !</span>
    <p style="margin-bottom: 20px;text-align: justify;">Your service is currently down, if you want to keep the service running smoothly, you will have to pay the service fee, which you see below and you can purchase the service by clicking the button.</p>
    <button class="btn btn-default fullbodydycolorbg" onclick="Purchase(&#39;MPOSH&#39;)" style="color: #fff;">Purchase Service</button>
</div>
<div id="secpur2" class="col-md-12 remitter_button remitter_buttonewq" style="display:none;text-align: center;">
    <span style="font-size: 24px;border-bottom: 1px solid #ccc;margin-top: 15px;padding-bottom: 10px;margin-bottom: 10px;">Payment Details</span>
    <div class="lavbrd">
        <label>PaymentType</label>
        <label class="rightlable" id="PaymentType2"></label>
    </div>
    <div class="lavbrd">
        <label>Price</label>
        <label class="rightlable" id="Price2"></label>
    </div>
    <div class="coldebuttonnew">
        <button class="bacbuttonrrt" onclick="MPOS()">Back</button>
        <button class="btn btn-default fullbodydycolorbg" onclick="FinalPurchase(&#39;MPOSH&#39;)" style="color: #fff;">Pay Now</button>
    </div>
        <br>
        <label id="errmsgmposh" style="color:red;"></label>
    </div>

    <div id="KYCMPOS" style="display:none;" class="start-mpos">
        <div class="start-tab-3">

            <div class="container-fluid aeps">
                <div class="col-md-12 aeps-start mpos-contents">
                    <div class="col-md-10 aeps_id">
                        <div class="col-md-12 amount amount_strong"><strong class="etrtfdf" style="">M-POS Device ID</strong><span>Unregistered User (KYC DUE)</span></div>
                    </div>

                </div>
            </div>


        </div>

        <div class="avtar">
            <img src="<?php echo base_url();?>vfiles/avatar.svg">
            <h2>KYC DUE !</h2>
            <p>please firstly complete your profile details and wait for KYC approval. othewise call to customer care.</p>

        </div>
    </div>
    <!--M-POS Regester Page-->

    <div class="mpos-regester">
        <div class="container-fluid aeps">
            <div id="Unregistermpos" class="col-md-12 aeps-start mpos-contents Unregistermpos-responshive" style="display:none;">
                <div class="col-md-10 aeps_id">
                    <div class="col-md-12 amount amount_strong"><strong style="width:auto !important;">M-POS Device ID</strong><span>Unregistered User</span></div>
                </div>


                <div class="education-img">
                    <img src="<?php echo base_url();?>vfiles/education.svg">
                    <p>You are Not Registered with M-POS Service.</p>
                    <div class="mpos-button-right">
                        <button type="button">Purchase Device</button>
                        <button><img src="<?php echo base_url();?>vfiles/download-color.svg">Download format</button>


                    </div>
                </div>
            </div>
            <!--Purchase Page-->
            <div id="purchasempos" style="display:none;">
                <div class="container-fluid aeps" id="Purchaseid">
                    <div class="col-md-12 aeps-start mpos-contents">
                        <div class="col-md-10 aeps_id">
                            <div class="col-md-12 amount amount_strong"><strong style="">M-POS Device ID</strong><span id="mposdeviceid"></span></div>
                        </div>
                    </div>
                </div>

                <div class="purchage-page">
                    <img src="<?php echo base_url();?>vfiles/m-poss.png">
                </div>
                <div class="price-last">
                    <div class="container-fluid aeps">
                        <div class="col-md-12 aeps-start">
                            <div class="col-md-10 aeps_id">
                                <div class="col-md-12 amount amount_strong"><span>M-POS price 4000</span></div>
                            </div>

                        </div>
                        <!--Purchase Page-->

                    </div>
                </div>

                <!--M-POS Regester Page-->
            </div>
        </div>


    </div>

    <script>
    function Purchase(e) {
        $.ajax({
            url: '/API/Recharge_home/ServiceCharge',
            data: { Service: e },
            cache: false,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#PaymentType2').html(data.PaymentType);
                $('#Price2').html(data.Price);
                $('#firstpur2').hide();
                $('#secpur2').show();
            }
        });
    }
    function FinalPurchase(e) {
         $.ajax({
            url: '/API/Recharge_home/ServicePurchase',
            data: { Service: e },
            cache: false,
            type: "POST",
             dataType: 'json',
            beforeSend: function() {
                      $('.loader').show();
                     },
             success: function (data) {
                 $('.loader').hide();
                 if (data.Status == "Success") {
                     MPOS();
                 }
                 else {
                            $('#errmsgmposh').text(data.Message);
                 }

            }
        });
    }
    </script>

    <script>
    function MPOS() {
         $('#firstpur2').hide();
         $('#secpur2').hide();

        $('#KYCMPOS').hide();
        $('#Unregistermpos').hide();
        $('#purchasempos').hide();
               $('#MPOSFAILED').hide();
           $('#errormposid').text("");
        $.ajax({
            url: '/API/Recharge_home/MPOSservice',
            cache: false,
            type: "GET",
             beforeSend: function() {
                  $('.loader').show();
             },
            success: function (data) {
                $('.loader').hide();
                var output = JSON.parse(data);

                if (output.status == "NOTKYC") {
                    $('#KYCMPOS').show();
                }
                else if (output.status == "UNREGISTER") {
                      $('#Unregistermpos').show();
                }
                else if (output.status == "FAILED") {
                    $('#MPOSFAILED').show();
                    if (output.msg == "Firstlly Purchase this Service."|| output.msg  =="AEPS Service is Expired.") {
                             $('#firstpur2').show();
                    }
                    else {
                          $('#errormposid').text(output.msg);
                    }
                }
                else {
                    $('#purchasempos').show();
                    $('#mposdeviceid').text(output.msg);
                }
            }
        })
            $.ajax({
            url: '/API/Recharge_home/MPOSreportnew',
            cache: false,
                 type: "GET",
                 cache: false,
               dataType:"html",
              success: function (data) {
                 $('#reportallinone').html(data);
            }
        })
    }
    </script>

        </div>
    </div>
    <!--Change-New-->
    <div class="col-md-8 money-transform-content money-transform-responshive">
        <div id="reportallinone">
            
<style>
    #example tbody tr td{padding:10px;}
</style>
<div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid">
        <thead>
            <tr role="row"><th style="width: 186px;" class="sorting_disabled" rowspan="1" colspan="1">Beneficiary&nbsp;Account</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 102px;">Amount</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 284px;">Beneficiary&nbsp;Bank&nbsp;Name</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 69px;">Time</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 129px;">Bank&nbsp;RRN</th></tr>
        </thead>
            <tbody>
            <tr class="odd"><td valign="top" colspan="5" class="dataTables_empty">No data available in table</td></tr></tbody>
</table></div></div><div class="row"><div class="col-sm-5"></div><div class="col-sm-7"></div></div></div>
<script>
    $(document).ready(function () {
        $('#example').dataTable({
            "searching": false,
            "bPaginate": false,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true
        });
    });
</script>


<div class="modal mastetr222Modal in" id="aepstableclickpop" tabindex="-1" role="dialog" style="display: none;">
    
    <div class="col-md-4 new-prent-page" id="aepspopshow">
        <div class="body-border-bottom" style="margin-bottom: 20px;">
            <button type="button" class="btn waves-effect" data-dismiss="modal">
                <i class="fa fa-times fulltextbodycolor fullbodydycolorbg" aria-hidden="true"></i>
            </button>
        </div>
        <div class="col-md-12 Confirm-Payment">
            
            <div class="container-fluid">
                <div class="col-md-6 successful">
                    <p>Transaction Successful</p>
                    <span> </span>
                </div>
               
            </div>
            <div class="container-fluid transaction" style="width:100%;">
                <p style="color:white;">transaction details</p>
                <ul class="transaction-detail" style="width:100%;">
                    <li class="transaction-left"><span>Retailer Firm</span></li>
                    <li class="transaction-right" style="float:right;"><span></span></li>
                    <li class="transaction-left"><span>Aadhaar Number</span></li>
                    <li class="transaction-right" style="float:right;"><span></span></li>
                    <li class="transaction-left"><span>Register Mobile</span></li>
                    <li class="transaction-right" style="float:right;"><span></span></li>
                    <li class="transaction-left"><span>AEPS Mode</span></li>
                    <li class="transaction-right" style="float:right;"><span>BALANCE</span></li>
                    <li class="transaction-left"><span>A/C Remain</span></li>
                    <li class="transaction-right" style="float:right;"><span></span></li>
                </ul>

            </div>
        </div>
    </div>
    </div>
    




<div class="modal mastetr222Modal in" id="aepstableclickpopee" tabindex="-1" role="dialog" style="display: none;">

    <div class="col-md-4 new-prent-page" id="aepspopshowe">
        <div class="body-border-bottom" style="margin-bottom: 20px;">
            <button type="button" class="btn waves-effect" data-dismiss="modal">
                <i class="fa fa-times fulltextbodycolor fullbodydycolorbg" aria-hidden="true"></i>
            </button>
        </div>
        <div class="col-md-12 Confirm-Payment">

            <div class="container-fluid">
                <div class="col-md-6 successful">
                    <p>Transaction Successful</p>
                    <span> </span>
                </div>

            </div>
            <div class="container-fluid transaction" style="width:100%;">
                <p style="color:white;">transaction details</p>
                <ul class="transaction-detail" style="width:100%;">
                    <li class="transaction-left"><span>Retailer Firm</span></li>
                    <li class="transaction-right" style="float:right;"><span></span></li>
                    <li class="transaction-left"><span>Aadhaar Number</span></li>
                    <li class="transaction-right" style="float:right;"><span></span></li>
                    <li class="transaction-left"><span>Register Mobile</span></li>
                    <li class="transaction-right" style="float:right;"><span></span></li>
                    <li class="transaction-left"><span>AEPS Mode</span></li>
                    <li class="transaction-right" style="float:right;"><span>BALANCE</span></li>
                    <li class="transaction-left"><span>A/C Remain</span></li>
                    <li class="transaction-right" style="float:right;"><span></span></li>
                </ul>

            </div>
        </div>
    </div>
</div>
        </div>

    </div>
</section>
<script>
    $('ul.tabsmy li').click(function () {
        var tab_id = $(this).attr('data-tab');

        $('ul.tabsmy li').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#" + tab_id).addClass('current');
    });
</script>
<script>
    $(document).ready(function () {
        $("button.driver-buttons ,.update-page2").click(function () {
            $("button.driver-buttons ,.update-page2").addClass("update-page3");

        });
    });
</script>
<script>
    $(".update-page1").click(function () {
        $(".update-page2").removeClass("update-page3");
    });
</script>
<script>
    $(".update-page1").click(function () {
        $('#digitaltokenvalue').val(0);
        $('#buttokenerror').text("");
        $(".update-page1").addClass("update-page5");
    });
</script>
<script>
    $(".update-page2").click(function () {
        $('#Physicaltokenvalue').val(0);
        $('#buttokenerror').text("");
        $(".update-page5").removeClass("update-page5");
    });
</script>
<script>
    $(document).ready(function () {
        $("button.driver-buttons ,.update-page2").click(function () {
            $(".update-page1").addClass("update-page4");

        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#impsbutton ,.addaccount-add-scan-img').click(function () {
            $('.impsbutton ,.impsstrong ,.scan-img').css('display', 'block')
            $('.upibutton').css('display', 'none')
            $('.neftbutton').css('display', 'none')
            $('.neftstrong ,.upistrong').css('display', 'none')

        });
        $('#neftbutton ,.driver-buttons').click(function () {
            $('.impsbutton').css('display', 'none')
            $('.neftbutton ,.neftstrong ,.container-fluid.driver-page').css('display', 'block')
            $('.upibutton').css('display', 'none')
            $('.impsstrong ,.upistrong').css('display', 'none')
        });
        $('#neftbutton').click(function () {
            $('.impsbutton').css('display', 'none')

        });

        $('.addaccount-add-scan-img ,.introbutton').click(function () {
            $('.scan-img ,#aeps_id1').css('display', 'block')
            $('.container-fluid.driver-page').css('display', 'none')

        });

        $('#cash-withdrawal').click(function () {
            $('.blance-block ,.scan-img').css('display', 'none')
            $('.with-click-block').css('display', 'block')
        });

        $('#upibutton ,#get-account-balance').click(function () {
            $('.neftbutton ,.with-click-block ,.scan-img ,.driver-page').css('display', 'none')
            $('.impsbutton').css('display', 'none')
            $('.upibutton ,.upistrong ,.blance-block').css('display', 'block')
            $('.impsstrong ,.neftstrong').css('display', 'none')
        });
        $('.click-change ,.back-main-page ,.update-page1 ,.update-page4').click(function () {
            $('.click-change-remove ,.container-fluid.driver-page ,.button-plush.button-plush-top.button-plush-top-right').css('display', 'none')
            $('.click-change-block ,.button-plush-top').css('display', 'block')
        });



    });
</script>
<script>
    $(document).ready(function () {
        $('.update-page1').click(function () {

            $('.custome-none-class1').css('display', 'block')
            $('#button-top-none').css('display', 'none')
        });
        $('.update-page2').click(function () {
            $('.custome-none-class1').css('display', 'none')
            $('.custome-none-class').css('display', 'block')
        });



    });
</script>
<script>

    var incrementPlus;
    var incrementMinus;

    var buttonPlus = $(".cart-qty-plus");
    var buttonMinus = $(".cart-qty-minus");

    var incrementPlus = buttonPlus.click(function () {
        var $n = $(this)
            .parent(".button-container")
            .parent(".container")
            .find(".qty");
        $n.val(Number($n.val()) + 1);
    });

    var incrementMinus = buttonMinus.click(function () {
        var $n = $(this)
            .parent(".button-container")
            .parent(".container")
            .find(".qty");
        var amount = Number($n.val());
        if (amount > 0) {
            $n.val(amount - 1);
        }
    });


</script>
<script>


    // Initialize select2

    $('select').select2();


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
        var url = '/API/Recharge_home/Complaint';
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
                url: "/API/Recharge_home/Chkbalance",
                dataType: 'html',
            cache: false,
            async: false,
            success: function (data) {
                var x = JSON.parse(data);
                var newRow =

 "<tr>" +
"<td><a href='/API/Recharge_home/Show_Credit_report_by_admin',style='text-decoration:none;cursor:pointer;'><p>My Credit From Admin</p></a></td>" +
"<td><p style='text-align:center;'>" + x.admincreditbal + "</p></td>" + "</tr>" +
"<tr>"+
 "<tr>" +
"<td><a href='/API/Recharge_home/Show_Credit_report_by_dealer',style='text-decoration:none;cursor:pointer;'><p>My Credit From Distributor</p></a></td>" +
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
                url:'/API/Recharge_home/Totalbaltransfer',
                dataType:'html',
                cache:false,
                async:false,
                success: function(data)
                {
                       var x = JSON.parse(data);
                       var newRow =

    "<tr>" +
   "<td><a href='/API/Recharge_home/Retailer_to_retailer',style='text-decoration:none;cursor:pointer;'><p>Total&nbsp;Transfer&nbsp;Retailer&nbsp;to&nbsp;Retailer</p></a></td>" +
   "<td><p style='text-align:center;'>" + x.retailertoretailer + "</p></td>" + "</tr>" +
    "<tr>" +
    "<tr>" +
   "<td><a href='/API/Recharge_home/ReceiveFund_by_admin',style='text-decoration:none;cursor:pointer;'><p>Received&nbsp;From&nbsp;Admin</p></a></td>" +
   "<td><p style='text-align:center;'>" + x.admintoretailer + "</p></td>" + "</tr>" +
    "<tr>" +
    "<tr>" +
   "<td><a href='/API/Recharge_home/ReceiveFund_by_dealer',style='text-decoration:none;cursor:pointer;'><p>Received&nbsp;From&nbsp;Distributor</p></a></td>" +
   "<td><p style='text-align:center;'>" + x.dealertoretailer + "</p></td>" + "</tr>" +
    "<tr>";

   $('#showtransferbalancetableid').append(newRow);
            }
            });
        }
</script>










</body></html>