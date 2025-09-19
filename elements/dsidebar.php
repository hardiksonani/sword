<?php


  $WEBSITE_MODE = "LIVE";
    $WEBSITE_MODE_info = $this->db->query("select value from admininfo where param = 'WEBSITE_MODE'");
    if($WEBSITE_MODE_info->num_rows() == 1)
    {
      $WEBSITE_MODE = $WEBSITE_MODE_info->row(0)->value;
      
    }

    if($WEBSITE_MODE == "SLEEP")
    {
      redirect(base_url()."AuthSleepMode");
    }
 ?>
<link rel="stylesheet" type="text/css" href="dilip.css"> 
<div class="br-logo"><a href=""><span style="margin-left:2px;"><img style="width:140px;height:60px;" src="<?php echo base_url(); ?>vfiles/79444dab-571e-4737-99c1-99ffa47ea94d_M.png" /></span></a></div>
<div class="br-sideleft sideleft-scrollbar">
      <label class="sidebar-label pd-x-10 mg-t-20 op-3">Navigation</label>
      <ul class="br-sideleft-menu background-color:#f01d75;">
        <li class="br-menu-item">
          <a href="<?php echo base_url()."_Admin/Dashboard"; ?>" class="br-menu-link">
            <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
            <span class="menu-item-label">Dashboard</span>
          </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        
        
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub">
            <!--<i class="menu-item-icon icon ion-ios-briefcase-outline tx-22"></i>-->
            <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
            <span class="menu-item-label">Commission</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
              <li class="sub-item"><a href="<?php echo base_url()."_Admin/group?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Commission Package</a></li>
              <li class="sub-item"><a href="<?php echo base_url()."_Admin/dmr_margin_slab?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Slabs</a></li>
              <li class="sub-item"><a href="<?php echo base_url()."_Admin/Prepaid_commission?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Set Commission</a></li>

               <li class="sub-item"><a href="<?php echo base_url()."_Admin/state_wise_commission?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">State Wise Commission</a></li>
               <li class="sub-item"><a href="<?php echo base_url()."_Admin/utility_group?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Utility Group</a></li>
               <li class="sub-item"><a href="<?php echo base_url()."_Admin/groupapi_utility?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Utility Commission</a></li>
          </ul>
        </li>
        
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub">
            <!--<i class="menu-item-icon icon ion-ios-briefcase-outline tx-22"></i>-->
            <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
            <span class="menu-item-label">API</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
              <li class="sub-item"><a href="<?php echo base_url()."_Admin/api?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">API List</a></li>
              <li class="sub-item"><a href="<?php echo base_url()."_Admin/company?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Add New Operator</a></li>
               <li class="sub-item"><a href="<?php echo base_url()."_Admin/operatorapi?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Operator Switching</a></li>
               <li class="sub-item"><a href="<?php echo base_url()."_Admin/randomapirouting?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Statewise Api Setting</a></li>
              <li class="sub-item"><a href="<?php echo base_url()."api_document.html?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link" target="_blank">Api Document</a></li>
              <li class="sub-item"><a href="<?php echo base_url()."_Admin/requestlog?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Api Logs</a></li>
              <li class="sub-item"><a href="<?php echo base_url()."_Admin/mesage_setting?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Api Parsing Setting</a></li>


               


              
              <li class="sub-item"><a href="<?php echo base_url()."_Admin/Response_Tester?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Response Tester</a></li>
              <li class="sub-item"><a href="<?php echo base_url()."_Admin/Smsapi?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Sms Api</a></li>
              
          </ul>
        </li>
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub">
            <i class="menu-item-icon ion-person-stalker tx-24"></i>
            <span class="menu-item-label">Users</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/Sd_list?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">WhiteLabel List</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/Md_list?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Md List</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/Distributor_list?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Distributor List</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/agent_list?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Retailer List</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/UserList?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Apiuser List</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/Change_parent?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Change Parent</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/kyc?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Kyc Verification</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/kyc_list?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Kyc Verified</a></li>
          </ul>
        </li>
        
       
       
       
       <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub">
            <!--<i class="menu-item-icon icon ion-ios-briefcase-outline tx-22"></i>-->
            <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
            <span class="menu-item-label">Balance</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/AddMainBalance?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Add Main Balance</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/RevertMainBalance?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Revert Main Balance</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/AddDmtBalance?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Add Dmr Balance</a></li>
             <li class="sub-item"><a href="<?php echo base_url()."_Admin/downline_outstanding?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Downline Outstanding</a></li>
             
            
           
          </ul>
        </li>
       <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub">
            <!--<i class="menu-item-icon icon ion-ios-briefcase-outline tx-22"></i>-->
            <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
            <span class="menu-item-label">REPORTS</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/list_recharge_pending?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Pending Recharges</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/list_recharge_pending2?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Auto Pending Recharges</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/list_recharge?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Recharge Report</a></li>
             <li class="sub-item"><a href="<?php echo base_url()."_Admin/account_report?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Account Report</a></li>
              <li class="sub-item"><a href="<?php echo base_url()."_Admin/Account_report2?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">DMT Account Report</a></li>
             <li class="sub-item"><a href="<?php echo base_url()."_Admin/Operatorwisereport?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Operatorwise Report</a></li>
             <li class="sub-item"><a href="<?php echo base_url()."_Admin/turnover?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Turnover Report</a></li>
             <li class="sub-item"><a href="<?php echo base_url()."_Admin/lowbalanceret?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Low Balance Retailer</a></li>
              <li class="sub-item"><a href="<?php echo base_url()."_Admin/sent_sms?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Sent Sms Report</a></li>
              <li class="sub-item"><a href="<?php echo base_url()."_Admin/rcno?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Daily Report</a></li>
              <li class="sub-item"><a href="<?php echo base_url()."_Admin/check_transaction?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Check TXN with Rec ID</a></li>
               <li class="sub-item"><a href="<?php echo base_url()."_Admin/status_refund_to_success_report?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Fail To Success Report</a></li>

               <li class="sub-item"><a href="<?php echo base_url()."_Admin/Aeps_report?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Aeps Report</a></li>
              
          </ul>
        </li>
       
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub">
            <!--<i class="menu-item-icon icon ion-ios-briefcase-outline tx-22"></i>-->
            <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
            <span class="menu-item-label">Admin</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/addFund?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Add Admin Main Balance</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/addFund2?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Add Admin Dmr Balance</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/state?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">State</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/city?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">City</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/banner?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">MANAGE BANNERS</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/admin_info?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">ADMIN INFO</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/Sms_template?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">SMS TEMPLATE</a></li>
          </ul>
        </li>
        
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub">
            <!--<i class="menu-item-icon icon ion-ios-briefcase-outline tx-22"></i>-->
            <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
            <span class="menu-item-label">Manage Users</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/list_complain_pending?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">PENDING COMPLAINS</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/list_complain?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">SOLVED COMPLAINS</a></li>
            
             
             <li class="sub-item"><a href="<?php echo base_url()."_Admin/addFund?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Add Fund To AdminWallet</a></li>
            
           
          </ul>
        </li>
        
        
        
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub">
            <!--<i class="menu-item-icon icon ion-ios-briefcase-outline tx-22"></i>-->
            <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
            <span class="menu-item-label">Payment Request</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/payment_request?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Payment Request</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/payment_history?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">Payment History</a></li>
            
          </ul>
        </li>
        
        
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub">
            <!--<i class="menu-item-icon icon ion-ios-briefcase-outline tx-22"></i>-->
            <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
            <span class="menu-item-label">Money Transfer</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/dmr_report?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">DMT Transactions</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/Dmr_accval_report?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">DMT ACC.Validation</a></li>
            <li class="sub-item"><a href="<?php echo base_url()."_Admin/account_report2?crypt=".$this->Common_methods->encrypt("MyData"); ?>" class="sub-link">DMT WALLET REPORT</a></li>
           
          </ul>
        </li>
        
       
        
       
        
        <!-- br-menu-item -->
        
       
        <li class="br-menu-item">
          <a href="<?php echo base_url()."_Admin/change_password"; ?>" class="br-menu-link">
            <i class="menu-item-icon icon icon ion-key tx-22"></i>
            <span class="menu-item-label">Change Password</span>
          </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
          <a href="<?php echo base_url()."logout"; ?>" class="br-menu-link">
            <i class="menu-item-icon icon icon ion-power tx-22"></i>
            <span class="menu-item-label">Sign Out</span>
          </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
      </ul><!-- br-sideleft-menu -->

      <label class="sidebar-label pd-x-10 mg-t-25 mg-b-20 tx-info">Information Summary</label>

      <div class="info-list">
      
      
      <div class="info-list-item">
          <div>
            <p class="info-list-label">Success</p>
            <h5 class="info-list-amount" id="sidebargrosssuccess">...</h5>
          </div>
          <span class="peity-bar" data-peity='{ "fill": ["#1C7973"], "height": 35, "width": 60 }'>4,3,5,7,12,10,4,5,11,7</span>
        </div><!-- info-list-item -->
        <div class="info-list-item">
          <div>
            <p class="info-list-label">Pending</p>
            <h5 class="info-list-amount" id="sidebargrosspending">...</h5>
          </div>
          <span class="peity-bar" data-peity='{ "fill": ["#336490"], "height": 35, "width": 60 }'>8,6,5,9,8,4,9,3,5,9</span>
        </div><!-- info-list-item -->

        

        <div class="info-list-item">
          <div>
            <p class="info-list-label">Failure</p>
            <h5 class="info-list-amount" id="sidebargrosfailure">...</h5>
          </div>
          <span class="peity-bar" data-peity='{ "fill": ["#8E4246"], "height": 35, "width": 60 }'>1,2,1,3,2,10,4,12,7</span>
        </div><!-- info-list-item -->

        <div class="info-list-item">
          <div>
            <p class="info-list-label">HOLD</p>
            <h5 class="info-list-amount" id="sidebargroshold">...</h5>
          </div>
          <span class="peity-bar" data-peity='{ "fill": ["#9C7846"], "height": 35, "width": 60 }'>3,12,7,9,2,3,4,5,2</span>
        </div><!-- info-list-item -->
      </div><!-- info-list -->

      <br>
    </div>