<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('images/tslogo.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('images/tslogo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('images/tslogo.png') }}">
    <link rel="shortcut icon" href="{{ url('images/tslogo.ico')}}">
    <meta name="msapplication-TileColor" content="#faa700">
    <meta name="msapplication-config" content="https://i.morioh.com/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tirespeed</title>

    <link rel="stylesheet" href="https://unpkg.com/@fortawesome/fontawesome-free@5.11.2/css/all.min.css">
    {{-- <link rel="stylesheet" href="https://unpkg.com/perfect-scrollbar@1.4.0/css/perfect-scrollbar.css"> --}}
    <link rel="stylesheet" href="https://unpkg.com/@mdi/font@4.7.95/css/materialdesignicons.min.css">
    {{-- <link rel="stylesheet" href="https://unpkg.com/animate.css@3.7.2/animate.min.css"> --}}

    {{-- <link rel="stylesheet" href="{{ url('moriotheme/css/all.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ url('moriotheme/css/perfect-scrollbar.css') }}">
    {{-- <link rel="stylesheet" href="{{ url('moriotheme/css/materialdesignicons.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ url('moriotheme/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ url('moriotheme/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ url('moriotheme/css/morioh.css') }}">
    <link rel="stylesheet" href="{{ url('moriotheme/css/w3.css') }}">
    <link rel="stylesheet" href="{{ url('datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('select2/css/select2.min.css') }}">

    {{-- Amaran alert --}}
    <link rel="stylesheet" href="{{ url('Amaranjs/css/amaran.min.css')}}">
    <link rel="stylesheet" href="{{ url('Amaranjs/css/animate.min.css')}}">

    <style>
        select.selectpicker { display:none; /* Prevent FOUC */}
    </style>

    {{-- sweet alert libralies  --}}
    <script src="{{ url('moriotheme/js/sweetalert.min.js') }}"></script>

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance:textfield;
        }
    </style>


</head>

<body class="menubar-enabled navbar-top-fixed">