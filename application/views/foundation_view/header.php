<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'RTARF-MEDAL' ?></title>

    <link rel="shortcut icon" href="<?= base_url('assets/images/medal.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('assets/bulma/css/bulma.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Kanit" rel="stylesheet"> 
    <link href="<?= base_url('assets/fontawesome/css/all.css') ?>" rel="stylesheet"> 
    <link href="<?= base_url('assets/datatable/datatables.min.css') ?>" rel="stylesheet"> 

    <script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>

    <style>
        html, body {
            height: 100%;
            font-family: 'Kanit', sans-serif;
        }
        
    </style>
</head>

<body>