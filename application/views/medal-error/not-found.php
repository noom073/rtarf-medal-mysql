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

    <script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>

    <style>
        html,
        body {
            height: 100%;
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>

<body>
    <section class="">
        <nav class="navbar is-info" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="<?= site_url() ?>">
                    <img src="<?= base_url('assets/images/medal.png') ?>" height="28">
                    RTARF-MEDAL
                </a>
            </div>
        </nav>
    </section>
    <section class="section">
        <div class="columns is-centered">
            <div class="column is-half box">
                <div class="hero">
                    <div class="hero-head">
                        <h2 class="title">ERROR: <?= $heading ?></h2>
                    </div>
                    <div class="hero-body">
                        <button class="button" onclick="window.history.back();">ย้อนกลับ</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <footer class="footer">
            <div class="">
                <strong>กพร.ศทส.สส.ทหาร</strong>
            </div>
            <div>
                โทร. ๕๗๑-๒๗๑๒
            </div>
        </footer>
    </section>
</body>

</html>

<script>
    $(document).ready(function() {
        console.log('ok')
    });
</script>