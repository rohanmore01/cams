<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CAMS</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>/application/css/main.css">
  <script type = 'text/javascript' src = "<?php echo base_url(); ?>/application/js/main.js"></script>
  <link rel = "stylesheet" type = "text/css" href = "https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <script type = 'text/javascript' src = "https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src = "<?php echo base_url(); ?>/application/js/form-validation.min.js" > </script>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>

<body onload="myFunction()">
  
  <!-- loader -->
  <div id="loading"></div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php echo base_url(); ?>">CAMS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <?php
        if(!$this->session->userdata('logged_in'))
        { ?>
        <li class="nav-item">
          <a class="nav-link" href="login">Login</a>
        </li>
       <?php
        }
        ?>

      <?php
      if($this->session->userdata('logged_in'))
      { ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Transaction
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo base_url().'camDataEntry'; ?>">CAM Data Entry</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Setup
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo base_url().'ChangeCurrentPassword'; ?>">Change Current Password</a>
          <?php
            if($this->session->userdata('user_type') == 'admin')
            { ?>
              <a class="dropdown-item" href="<?php echo base_url().'CreateNewUser'; ?>">Create New User</a>
          <?php  
            } ?>
          <a class="dropdown-item" href="<?php echo base_url().'UsersList'; ?>">Users List</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo base_url().'DepartmentMaster'; ?>">Department Master</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo base_url().'ApplicationTypes'; ?>">Application Types</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Reports
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo base_url().'DailyReport'; ?>">Daily Report</a>
          <a class="dropdown-item" href="<?php echo base_url().'ListOfQueriedApplicants'; ?>">List Of Queried Applicants</a>
          <a class="dropdown-item" href="<?php echo base_url().'ListOfRejectedApplicationDepartmentwise'; ?>">List Of Rejected Application For All Departments</a>
          <a class="dropdown-item" href="<?php echo base_url().'ListOfPendingApplicationForAllDepartments'; ?>">List Of Pending Application For All Departments</a>
          <a class="dropdown-item" href="<?php echo base_url().'ListOfGrantedApplicationForAllDepartments'; ?>">List Of Granted Application For All Departments</a>
          <a class="dropdown-item" href="<?php echo base_url().'DepartmentWiseYearlyDetailedReport'; ?>" target="_blank">Department Wise Yearly Detailed Report</a>
          <a class="dropdown-item" href="<?php echo base_url().'YearlyDepartmentDetailedReport'; ?>" target="_blank">Yearly Department Detailed Report</a>
          <a class="dropdown-item" href="<?php echo base_url().'GeneralInformationDepartmentWise'; ?>">General Information - Department Wise</a>
      </li>
      <?php } ?>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Help
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo base_url().'about'; ?>">About</a>
      </li>

        <?php
        if($this->session->userdata('logged_in'))
        { ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url().'logout'; ?>">Logout</a>
        </li>
        <?php } ?>
      </ul>
      <span class="float-left text-white" style="padding:5px;"><?php echo ($this->session->userdata('district')) ? strtoupper($this->session->userdata('district')) : ""; ?></span>
      <span class="float-left" style="padding:5px;"><img src="<?php echo base_url(); ?>application/uploads/nic-logo.jpg" width="52"></span>
      <div id="google_translate_element"></div> 
    </div>
  </nav>

  <?php if ($this->session->flashdata()) { ?>
        <div class="alert alert-warning mt-3" style="text-align:center;">
            <?= $this->session->flashdata('msg'); ?>
        </div>
  <?php } ?>

 <script>
  function myFunction()
  {
      $('#loading').fadeOut(1000);
  };

  function googleTranslateElementInit() 
  {
    new google.translate.TranslateElement({pageLanguage: 'en',includedLanguages : 'en,hi,mr,gu', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
  }
</script>