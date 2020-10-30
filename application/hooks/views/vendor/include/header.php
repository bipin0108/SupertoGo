<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Vendor | Smart Crop</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?=base_url('public')?>/components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=base_url('public')?>/components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?=base_url('public')?>/components/Ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="<?=base_url('public');?>/components/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="<?=base_url('public')?>/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?=base_url('public')?>/dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="<?=base_url('public')?>/plugins/pace/pace.min.css">
        <script src="<?=base_url('public')?>/components/jquery/dist/jquery.min.js"></script>
       
        <!-- <link rel="stylesheet" href="<?=base_url('public');?>/components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> -->
        <!--   <link rel="stylesheet" href="<?=base_url('public');?>/plugins/timepicker/bootstrap-timepicker.min.css"> -->
        <link rel="stylesheet" href="<?=base_url('public')?>/dist/css/font.css">
        <link rel="icon" href="<?=base_url('public/images/favicon.png');?>" type="image/x-icon" />
        <style>
            .imgcls{
                height: 70px;
                width: 120px;
            }
            .numcls::-webkit-inner-spin-button, 
            .numcls::-webkit-outer-spin-button { 
              -webkit-appearance: none; 
              margin: 0; 
            }
            .datepicker {z-index: 9999 !important;}
            .is_active{
                color: green;
                font-size: 20px;    
            }
            .is_not_active{
                color: red;
                font-size: 20px;    
            }
            .alert .close{
                font-size: 19px !important;
                color: #fff !important;
                opacity: 1 !important;
            }
            .alert{
                padding: 2px 6px;
                font-weight: 500 !important;
                font-size: 15px !important;
            }
            .btn{
                border-radius:0;
            }
            .btn-default{
                background-color: #fff;
                color: #444;
                border: #333 1px solid;
                font-weight:600;
            }
            .checkbox .label{
                display: -webkit-inline-block;
            }
            a.btn-sm{
                padding: 2px 5px;
                font-size: 16px;
            }
            .mr-5
            {
                margin-right: 5px !important;
            }
            
        </style>
    </head>
    <body class="hold-transition skin-blue sidebar-mini fixed " width="100%">
        <div class="wrapper">
