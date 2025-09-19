<!DOCTYPE html>
<!-- saved from url=(0054) -->
<html class="chrome"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $this->white->getName(); ?></title>
    <!-- Favicon-->

    <link rel="icon" href="<?php echo base_url(); ?>vfiles/63969ec4-c079-4d05-8558-b0f34337ac9b_MF.png" type="image/x-icon">
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
        <?php include("elements/v_aside_api.php"); ?>
        <!-- -->


         <?php include("elements/v_header_api.php"); ?>




        <!-- Left Sidebar -->


        <button id="bb" style="display:none;"></button>
    </section>
    



<section class="content operator-responsive" style="margin:90px 0px 0px 0px;">
    <div class="container-fluid">
        <div class="row clearfix operator-clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card navbar" style="position:initial;">
                    <div class="body Gift_Carddbody">
                        <div class="row">
                            <div class="col-md-12 giftcardcategory" style="margin-bottom:0px;">
                                <center>
                                    <ul id="leftulbar" class="nav nav-tabs tab-col-orange fullbodydycolorbg" role="tablist" style="background:#607D8B;border-bottom:none;">
                                        <li role="presentation" class="active" style="margin-left:22px;">
                                            <a href="#prepaidoperators" data-toggle="tab" aria-expanded="true">
                                                <img src="<?php echo base_url();?>vfiles/mobile-application.svg" style="height:45px; margin-top:-5px;">
                                                <br>
                                                <span id="alltab" style="padding-left:5px;">Prepaid &amp; Dth</span>
                                            </a>
                                        </li>
                                        <li role="presentation" class="" style="margin-left:36px;">
                                            <a href="#utilitisoperators" data-toggle="tab" aria-expanded="false">
                                                <img src="<?php echo base_url();?>vfiles/increase.svg" style="height:45px; margin-top:-5px;">
                                                <br><span>Utilities</span>
                                            </a>
                                        </li>
                                        <li role="presentation" class="" style="margin-left:19px;">
                                            <a href="#moneyoperator" data-toggle="tab" aria-expanded="false">
                                                <img src="<?php echo base_url();?>vfiles/transfer-money.png" style="height:45px; margin-top:-5px;">
                                                <br>
                                                <span style="padding-left:5px;">Money Transfer</span>
                                            </a>
                                        </li>
                                        <li role="presentation" class="" style="margin-left:26px;">
                                            <a href="#pancardoperator" data-toggle="tab" aria-expanded="false">
                                                <img src="<?php echo base_url();?>vfiles/pancardicon.png" style="height:45px; margin-top:-5px;">
                                                <br>
                                                <span style="padding-left:0px;">Pancard</span>
                                            </a>
                                        </li>
                                        <li role="presentation" class="" style="margin-left:8px;box-shadow:none;">
                                            <a href="#aepsoperator" data-toggle="tab" aria-expanded="false">
                                                <img src="<?php echo base_url();?>vfiles/aespicon.png" style="height:45px;margin-top:-5px;">
                                                <br><span style="margin-left:14px;">AEPS</span>
                                            </a>
                                        </li>
                                        <li role="presentation" class="" style="margin-left:19px;">
                                            <a href="#mposoperator" data-toggle="tab" aria-expanded="false">
                                                <img src="<?php echo base_url();?>vfiles/mposicon.png" style="height:45px; margin-top:-5px;">
                                                <br>
                                                <span style="padding-left:5px;">M-POS</span>
                                            </a>
                                        </li>


                                        <li role="presentation" class="" style="margin-left:19px;">
                                            <a href="#flightoperator" data-toggle="tab" aria-expanded="false">
                                                <img src="<?php echo base_url();?>vfiles/airplane.svg" style="height:45px; margin-top:-5px;">
                                                <br>
                                                <span style="padding-left:5px;">FLIGHT</span>
                                            </a>
                                        </li>

                                        <li role="presentation" class="" style="margin-left:10px;box-shadow:none;padding-bottom:2px;">
                                            <a href="#busoperator" data-toggle="tab" aria-expanded="false">
                                                <img src="<?php echo base_url();?>vfiles/bus (1).svg" style="height:38px;margin-top:2px;">
                                                <br>
                                                <span style="margin-left:-8px;">BUS</span>
                                            </a>
                                        </li>

                                        <li role="presentation" class="" style="margin-left:10px;box-shadow:none;padding-bottom:2px;">
                                            <a href="#hoteloperator" data-toggle="tab" aria-expanded="false">
                                                <img src="<?php echo base_url();?>vfiles/hotel(1).svg" style="height:38px;margin-top:2px;">
                                                <br>
                                                <span style="margin-left:-8px;">HOTEL</span>
                                            </a>
                                        </li>
                                        <li role="presentation" class="" style="margin-left:10px;box-shadow:none;padding-bottom:2px;">
                                            <a href="#giftcardoperator" data-toggle="tab" aria-expanded="false">
                                                <img src="<?php echo base_url();?>vfiles/business(1).png" style="height:38px;margin-top:2px;">
                                                <br>
                                                <span style="margin-left:-8px;">Giftcard</span>
                                            </a>
                                        </li>

                                        <li role="presentation" class="" style="margin-left:10px;box-shadow:none;padding-bottom:2px;">
                                            <a href="#insuranceoperator" data-toggle="tab" aria-expanded="false">
                                                <img src="<?php echo base_url();?>vfiles/computer.png" style="height:38px;margin-top:2px;">
                                                <br>
                                                <span style="margin-left:-8px;">Security</span>
                                            </a>
                                        </li>

                                    </ul>
                                </center>
                            </div>


                            <div class="tab-content tab-contentoperators">
                                <div role="tabpanel" class="tab-pane  prepaidoperators-respons active" id="prepaidoperators">
                                    <div class="col-md-12">

                                        <table class="table table-bordered table-striped table-hover">

                                            <thead style="background-color:whitesmoke;">
                                                <tr>
                                                    <th style="padding-left:0px; text-align:center">Operator&nbsp;Current&nbsp;Status</th>
                                                    
                                                    <th style="padding-left:0px; text-align:center">Operator&nbsp;Type</th>
                                                    <th style="padding-left:0px; text-align:center">Code</th>

                                                    <th style="padding-left:0px; text-align:center">Blocked&nbsp;Time</th>
                                                    <th style="padding-left:0px; text-align:center">Commission</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php

  $comm_mobdth = $this->db->query("
    select 
        a.company_name,
        a.mcode,
        s.service_name as service_type,
        IFNULL(b.commission,0) as commission,
        b.commission_type 
        from tblcompany a 
        left join tblservice s on a.service_id = s.service_id
        left join tbluser_commission b on a.company_id = b.company_id  and b.user_id=?
        where   (a.service_id = 1 or a.service_id = 2)  order by a.service_id,a.company_name",array($this->session->userdata("AgentId")));
  foreach($comm_mobdth->result() as $mobdth)
  {?>
                                                    <tr>
                                                        <td class="activeinactive">
                                                                <p class="" style="font-size:15px;"><span class="activeopertor">Active</span><?php echo $mobdth->company_name; ?></p>
                                                        </td>
                                                        
                                                        <td><?php echo $mobdth->service_type; ?></td>
                                                        <td><?php echo $mobdth->mcode; ?></td>

                                                        <td></td>
                                                        <td><?php echo $mobdth->commission; ?>&nbsp;(%)</td>
                                                    </tr>
  <?php }
 ?>

                                              
                                                   
                                            </tbody>
                                        </table>


                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane flash utilitisoperators-report" id="utilitisoperators">
                                    <div class="col-md-12">

                                        <table class="table table-bordered table-striped">

                                            <thead style="background-color:whitesmoke;">
                                                <tr>
                                                    <th style="padding-left:0px; text-align:center">Operator&nbsp;Current&nbsp;Status</th>

                                                    <th style="padding-left:0px; text-align:center">Operator&nbsp;Type</th>
                                                    <th style="padding-left:0px; text-align:center">Code</th>

                                                    <th style="padding-left:0px; text-align:center">Blocked&nbsp;Time</th>
                                                    <th style="padding-left:0px; text-align:center">Commission</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

  $comm_utility = $this->db->query("
    select 
        a.company_name,
        a.mcode,
        s.service_name as service_type,
        IFNULL(b.commission,0) as commission,
        b.commission_type 
        from tblcompany a 
        left join tblservice s on a.service_id = s.service_id
        left join tbluser_commission b on a.company_id = b.company_id  and b.user_id=?
        where   a.service_id > 2   order by a.service_id,a.company_name",array($this->session->userdata("AgentId")));
  foreach($comm_utility->result() as $utility)
  {?>

                                                  <tr>
                                                        <td class="activeinactive">
                                                                <p class="" style="font-size:15px;"><span class="activeopertor">Active</span> <?php echo $utility->company_name; ?></p>
                                                        </td>
                                                        <td><?php echo $utility->service_type; ?></td>
                                                        <td><?php echo $utility->mcode; ?></td>

                                                        <td></td>
                                                        <td>
                                                              <?php echo $utility->commission; ?> <span>(Rs.)</span>
                                                        </td>
                                                    </tr>


                                                  
  <?php }
 ?>









                                                   
                                                   
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane flash" id="moneyoperator">
                                    <div class="col-md-12">

                                        <table class="table table-bordered table-striped">

                                            <thead style="background-color:whitesmoke;">
                                                <tr>
                                                    <th>Minmum&nbsp;Amount&nbsp;(₹)</th>
                                                    <th>Maximum&nbsp;Amount&nbsp;(₹)</th>
                                                    <th>Transition&nbsp;Charges</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                        <tr>
                                                            <td>Account&nbsp;Verify&nbsp;Charge (₹)</td>
                                                            <td></td>
                                                            <td>4.00</td>

                                                        </tr>


                                                         <?php

                                    $groupinfo = $this->db->query("select * from mt3_group where Id = (select dmr_group from tblusers where user_id = ?)",array($this->session->userdata("AgentId")));
  if($groupinfo->num_rows() == 1)
  {
    
      $getrangededuction = $this->db->query("
      select 
      a.range_from,
       a.range_to,
       CASE charge_type
        WHEN 'PER' THEN '%'
        WHEN 'AMOUNT' THEN ''
        END charge_type,
      
        a.charge_amount as charge_value,
        'PER' as dist_charge_type,
        '0.20' as dist_charge_value,
        a.ccf,
        a.cashback,
        a.tds,
        a.ccf_type,
        a.cashback_type,
        a.tds_type
        from mt_commission_slabs a
        where
         a.group_id = ? order by a.range_from ",array($groupinfo->row(0)->Id));
     foreach($getrangededuction->result() as $rwdmtslab)
      {?>
                                                     <tr>
                                                            <td><?php echo $rwdmtslab->range_from; ?></td>
                                                            <td><?php echo $rwdmtslab->range_to; ?></td>
                                                            <td><?php echo $rwdmtslab->charge_value; ?>&nbsp;<?php echo $rwdmtslab->charge_type; ?></td>

                                                        </tr> 
    <?php  }
  }?>

                                                        
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane flash" id="pancardoperator">
                                    <div class="col-md-12">

                                        <table class="table table-bordered table-striped">

                                            <thead style="background-color:whitesmoke;">
                                                

                                            </thead>
                                            <tbody>
                                                        <tr class="tableactivebutton tableactivebuttoneqe pancardactivech">
                                                            <th class="phisicalborder" style="padding-left:0px;text-align:center">
                                                                Physical&nbsp;Token&nbsp;Price
                                                                    <button class="inactivebefore" style="color:red"><span class="firstcroswe"></span><span class="secondcroswe"></span>In-Active</button>
                                                            </th>
                                                            <th class="phisicalbordersecond" style="padding-left:0px;text-align:center">
                                                                Digital&nbsp;Token&nbsp;Price
                                                                    <button class="inactivebefore" style="color:red"><span class="firstcroswe"></span><span class="secondcroswe"></span>In-Active</button>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <td class="phisicalborder" style="text-align:center;">
                                                                ₹ 107.00
                                                            </td>
                                                            <td class="phisicalbordersecond" style="text-align:center;">
                                                                ₹ 107.00
                                                            </td>
                                                        </tr>
                                                        <tr>

                                                            <th class="phisicalborder" style="padding-left:0px;text-align:center">Commission</th>
                                                            <th class="phisicalbordersecond" style="padding-left:0px;text-align:center">Commission</th>
                                                        </tr>
                                                        <tr>
                                                            <td class="phisicalborder" style="text-align:center;border-bottom:1px solid #ddd;">₹ 0.00</td>

                                                            <td class="phisicalbordersecond" style="text-align:center;border-bottom:1px solid #ddd;">₹ 0.00</td>
                                                        </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane flash" id="aepsoperator">
                                    <div class="col-md-12">

                                        <table class="table table-bordered table-striped">

                                            <thead style="background-color:whitesmoke;">
                                                <tr>
                                                    <th>Min&nbsp;Amount&nbsp;(Comm&nbsp;0₹)</th>
                                                    <th>Commission&nbsp;(%)</th>
                                                    <th>Max&nbsp;Comm&nbsp;(₹)</th>
                                                    <th>Mini&nbsp;Statement&nbsp;Charge&nbsp;(₹)</th>
                                                    <th>Aadharpays&nbsp;Charge(%)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                        <tr>
                                                            <td> 500.00</td>
                                                            <td> 0.10</td>
                                                            <td> 6.00</td>
                                                            <td> 0.00</td>
                                                            <td> 0.00</td>
                                                        </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane flash" id="mposoperator">
                                    <div class="col-md-12 mposoperator-scroll">

                                        <table class="table table-bordered table-striped">
                                            <thead style="background-color:whitesmoke;">
                                                <tr>
                                                    <th>Micro&nbsp;ATM&nbsp;Min&nbsp;(0&nbsp;Comm)</th>
                                                    <th>Micro&nbsp;ATM&nbsp;(max)</th>
                                                    <th>Micro&nbsp;ATM&nbsp;(%)</th>
                                                    <th>S&nbsp;Debit&nbsp;2000</th>
                                                    <th>S&nbsp;Debit&nbsp;above&nbsp;2000</th>
                                                    <th>S&nbsp;Credit&nbsp;Normal</th>
                                                    <th>S&nbsp;Credit&nbsp;Grocery</th>
                                                    <th>S&nbsp;Credit&nbsp;EduIns</th>

                                                    <th>Credit_Type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                        <tr>

                                                            <td>0.00</td>
                                                            <td>0.00</td>
                                                            <td>0.00</td>
                                                            <td>0.00</td>
                                                            <td>0.00</td>
                                                            <td>0.00</td>
                                                            <td>0.00</td>
                                                            <td>0.00</td>

                                                            <td>Normal</td>
                                                        </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>



                                <div role="tabpanel" class="tab-pane flash" id="flightoperator">
                                    <div class="col-md-12">

                                        <table class="table table-bordered table-striped">
                                            <thead style="background-color:whitesmoke;">
                                                <tr class="tableactivebutton tableactivebuttoneqe">
                                                    <th>
                                                        Flight&nbsp;Type&nbsp;
                                                            <button class="inactivebefore" style="color:red;border-color:red;"><span class="firstcroswe"></span><span class="secondcroswe"></span>In-Active</button>
                                                    </th>
                                                    <th>Commision&nbsp;Value&nbsp;(%)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                        <tr>
                                                            <td>Domestic</td>
                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td>International</td>
                                                            <td>0.00</td>
                                                        </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane flash" id="busoperator">
                                    <div class="col-md-12">

                                        <table class="table table-bordered table-striped">
                                            <thead style="background-color:whitesmoke;">
                                                <tr class="tableactivebutton tableactivebuttoneqe">
                                                    <th>
                                                        Bus&nbsp;Type
                                                            <button class="inactivebefore" style="color:red"><span class="firstcroswe"></span><span class="secondcroswe"></span>In-Active</button>
                                                    </th>
                                                    <th>Commision&nbsp;Value&nbsp;(%)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                        <tr>
                                                            <td>BUS</td>
                                                            <td>0.00</td>
                                                        </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane flash" id="hoteloperator">
                                    <div class="col-md-12">

                                        <table class="table table-bordered table-striped">
                                            <thead style="background-color:whitesmoke;">
                                                <tr class="tableactivebutton tableactivebuttoneqe">
                                                    <th>
                                                        Hotel&nbsp;Type
                                                            <button class="inactivebefore" style="color:red"><span class="firstcroswe"></span><span class="secondcroswe"></span>In-Active</button>
                                                    </th>
                                                    <th>Commision&nbsp;Value&nbsp;(%)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                        <tr>
                                                            <td>International</td>
                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Domestic</td>
                                                            <td>0.00</td>
                                                        </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane flash giftcardoperator-report" id="giftcardoperator">
                                    <div class="col-md-12">

                                        <table class="table table-bordered table-striped">
                                            <thead style="background-color:whitesmoke;">
                                                <tr>
                                                    <th style="padding-left:0px; text-align:center">Operator&nbsp;Current&nbsp;Status</th>
                                                    
                                                    <th style="padding-left:0px; text-align:center">Operator&nbsp;Type</th>
                                                    <th style="padding-left:0px; text-align:center">Code</th>

                                                    <th style="padding-left:0px; text-align:center">Commission</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Allen Solly eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>AAQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Amazon eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>ACQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Arrow eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>AEQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Bata eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>AHQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Big Bazaar eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DPQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>BigBasket eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DQQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Bluestone eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DVQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Bookmyshow eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>AKQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>CaratLane eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DTQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Chumbak eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DSQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Cleartrip eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>APQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Croma eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>ARQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Fabindia eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DUQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Fastrack eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>AVQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Flipkart eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>AWQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Gant eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>AZQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Helios eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>BAQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Hidesign eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>BDQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Himalaya eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>BEQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Hypercity eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DYQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>IZOD eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>BIQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Joyalukkas Diamond eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>BKQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Lakme Salon eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>BLQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Levis eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>BPQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>MakeMyTrip eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>BTQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>MakeMyTrip Holiday eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>BVQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>MakeMyTrip Hotel eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>BXQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Myntra eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>CAQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Nautica eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>CBQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Nike eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>CDQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Nykaa eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>CFQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>P N Rao eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>CGQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Pantaloons eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>CIQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Pavers England eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>CKQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Pepperfry eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DWQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Peter England eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>CMQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Planet Fashion eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>COQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Prestige Smart Kitchen eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>CQQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>PVR Cinemas eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>CVQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Shoppers Stop eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>CZQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>The Raymond Shop eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DXQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Thomas Cook eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DCQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Titan eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DEQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Urban Ladder eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DRQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>US Polo Assn eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DGQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Van Heusen eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DHQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>VLCC eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DJQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Westside eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DLQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Yatra eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DOQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Uber eGift Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DZQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Talwalkars Fitness</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DTF</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>TGI Friday</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DTGI</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Jack &amp; Jones</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DJACK</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Spice-Accessory Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DSPICE</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Spice General Voucher </p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DSPICEG</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Spice-Spice Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DSPICEV</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Baskin Robbins</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DBASKR</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Vero Moda</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DVERO</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>ONLYD</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DONLYD</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Spice HotSpot</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DSPICEH</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>United Colors of Beneton</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DUNITED</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Ristorante Prego</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DPREGO</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>HomeShop18</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DHOME18</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>HomeShop18-Gold</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DHOMEGOLD18</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Yatra.com-Hotels</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DYATRA</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Yatra.com</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DYATRAN</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Archies</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DARCH</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Book My Show</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DBOOK</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Beer Cafe</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DBEER</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Hi Design</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DHI</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Marks And Spencer</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DMARK</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>ArmaniDV</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DARMANI</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>MainLDV</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DMAIN</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>SatyapDV</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DSATYAP</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>PizzahutDV</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DPHUT</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>VGR AMAZON</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DVGRA</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Cafe Coffee Day</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DCCD</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>A.Himanshu Gold &amp; Silver Coins</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DHIMANSHU</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Aldo</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DALDO</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Aurelia</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>AURELIADV</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Beverly Hills Polo Club</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DBEVER</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Bobbi Brown</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DBOBBI</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Brand Factory</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DBRAND</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Celio</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DCELIO</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Chaayos</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DCHAAYOS</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Charles &amp; Keith</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DCHARL</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Costa Coffee</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DCOSTA</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Fab Hotels</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DFAB</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>FBB</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DFBB</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Ferns N Petals</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DFERN</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Goomo</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DGOOMO</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Home Centre</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DHOME</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Hugo Boss</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DHUGO</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Hush Puppies</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DHUSH</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>ICanStay</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DICAN</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Kalyan Jewellers Diamond Jewellery</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DKALYAN</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Kalyan Jewellers Gold Coin</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DKALYANG</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Kalyan Jewellers Gold Jewellery</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DKALYANGJ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>KFC</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DKFC</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Louis Philippe</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DLP</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>MAC</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DMAC</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Machaan</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DMACHAAN</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Michael Kors</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DMI</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>More</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DMORE</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Oh Calcutta</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DOHC</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>PC Jewellers Diamond Jewellery</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DPC</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>PC Jewellers Gold Coin</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DPCG</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>PC Jewellers Gold Jewellery</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DPCGJ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Relaxo</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DRELAXO</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Sigree</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DSIGREE</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Smaaash</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DSMAASH</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Spencer s Retail</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DSPENSR</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Sweet Bengal</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DSWEET</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Tanishq</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DTANISHQ</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>The Beer Café</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DBEERC</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Titan Eye Plus</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DTITANEYE</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Voylla</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DVOYLLA</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>W For Women</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DWOMEN</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>William Penn</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DWILLI</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Wok Express</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DWOK</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Woodland</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DWOOD</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Zomato Gold</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DZOMATO</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>GBI-Amazon Voucher</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DGBI</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Crossword</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DCROSS</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Jabong</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DJabong</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Lifestyle</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DLifestyle</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>PN Rao</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>DPN</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Zivame E-Gift Card</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>ZIVDV</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="activeinactive">
                                                                    <p class="" style="font-size:15px;"><span class="activeopertor">Active</span>Your Holiday Dealz E-Gift Card</p>
                                                            </td>
                                                            
                                                            <td>DigitalVoucher</td>
                                                            <td>YHDDV</td>

                                                            <td>0.00</td>
                                                        </tr>
                                                    <tr>
                                                            <td>
                                                                <button style="color:red">In-Active</button>
                                                            </td>
                                                    </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane flash" id="insuranceoperator">
                                    <div class="col-md-12">



                                    </div>
                                </div>


                            </div>



                        </div>

                    </div>
                </div>
            </div>
        </div>



        

        
    </div>
</section>


<!-- Jquery Core Js -->
<script src="<?php echo base_url();?>vfiles/jquery.min.js.download"></script>
<script src="<?php echo base_url();?>vfiles/bootstrap-colorpicker.js.download"></script>
<script src="<?php echo base_url();?>vfiles/demo.js.download"></script>
<script src="<?php echo base_url();?>vfiles/bootstrap-select.js.download"></script>


<script src="<?php echo base_url();?>vfiles/sweetalert-dev.js.download"></script>
<link href="<?php echo base_url();?>vfiles/sweetalert(1).css" rel="stylesheet">
<!-- Custom Js -->
<script src="<?php echo base_url();?>vfiles/basic-form-elements.js.download"></script>

<script src="<?php echo base_url();?>vfiles/jquery.slimscroll.js.download"></script>
<script>
    $(function () {
        var chh = '';
        $('#' + chh + '').show();
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