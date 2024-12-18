<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Grocery - Admin & Dashboard </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="images/logo/grocery.png">

    <!-- Bootstrap Css -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php
        
            include_once("includes/header.php");

            include_once("includes/sidebar.php");
        ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
    <?php
     if(empty($_SESSION['admin_id']))
     {
         header("Location: ".$adminBaseUrl."/index.php");
         exit;
     }
     
    ?>
    
