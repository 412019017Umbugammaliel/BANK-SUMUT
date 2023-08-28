<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Portal - Cloud Bank Sumut</title>
    
  <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Cloud Bank Sumut For Client">
    <meta name="author" content="Tekna Cloud">    
    <!-- <link rel="shortcut icon" href="favicon.ico">  -->
  <!-- End Meta -->

  <!-- Link & Script -->
    <!--===============================================================================================-->
    <link rel="icon" type="assets_login/image/png" href="<?php echo base_url();?>/assets/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <!-- jQuery 3.6.3 =================================================================================-->
    <script src="<?php echo base_url();?>/assets/plugins/jQuery/jquery-3.6.3.min.js"></script> 
    <!--===============================================================================================-->
    <!-- Bootstrap JS -->
    <script src="<?php echo base_url();?>/assets/plugins/bootstrap/js/popper.min.js"></script> <!-- Posisi harus berada diatas bootstrap.min.js -->
    <script src="<?php echo base_url();?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>  
    <!--===============================================================================================-->
    <!-- Bootstrap CSS-->     
    <link id="theme-style" rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/plugins/bootstrap/css/bootstrap.min.css">    
    <!--===============================================================================================-->
    <!-- Tilt SCSS -->  
    <link id="theme-style" rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/plugins/tilt_effect/scss/tilt-custome.scss">
    <!--===============================================================================================-->
    <!-- Sweat Alert 2-->
    <script src="<?php echo base_url();?>/assets/plugins/sweetalert_2/sweetalert2@11.js"></script>
    <!--===============================================================================================-->
    <!-- FontAwesome JS-->
    <script defer src="<?php echo base_url();?>/assets/plugins/fontawesome/js/all.min.js"></script>
    <link id="theme-style" rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/plugins/fontawesome/css/all.min.css">
    <!--===============================================================================================-->
    <!-- animate -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/plugins/animate/css/animate.css">
    <!-- hamburgers -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/plugins/hamburgers/css/hamburgers.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/plugins/select2/dist/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/plugins/select2/dist/css/select2-bootstrap4.min.css">

    <!-- Themes -->
      <link id="theme-style" rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/addition/css/portal.css">  
      <?php 
          $colorSelected = (session()->get('themes'));
          if($colorSelected == 'green_light'){ 
              $portalCSS = 'themes_green.css';
          }else if($colorSelected == 'blue_light'){
              $portalCSS = 'themes_blue.css';
          }else if($colorSelected == ''){
              $portalCSS = 'themes_green.css';
          }
      ?>
      <!-- App CSS style -->  
      <link id="theme-style" rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/addition/css/<?php echo $portalCSS;?>">
    <!-- End Themes -->

    <!-- Table Bootstrap -->
    <link href="<?php echo base_url();?>/assets/plugins/dataTable/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>/assets/plugins/dataTable/fixedColumns.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>/assets/plugins/dataTable/responsive.dataTables.min.css" rel="stylesheet">
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="<?php echo base_url();?>/assets/plugins/dataTable/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>/assets/plugins/dataTable/dataTables.fixedColumns.min.js"></script>
    <script src="<?php echo base_url();?>/assets/plugins/dataTable/dataTables.responsive.min.js"></script>
    <!--===============================================================================================-->
    
   



  <!-- End Link & Script -->
</head> 