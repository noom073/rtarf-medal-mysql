<section class="">
    <nav class="navbar is-info" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="<?= site_url() ?>">
                <img src="<?= base_url('assets/images/medal.png') ?>" height="28">
                RTARF-MEDAL
            </a>
            <a class="navbar-item"><?= $unitname ?></a>

            <a role="button" id="nav-menu-burger" class="navbar-burger burger">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="nav-menu" class="navbar-menu">
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-info" href="<?= site_url('login/logout') ?>">Log out</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</section>
<script>
    $(document).ready(function() {
        $("#nav-menu-burger").click(function() {
            $("#nav-menu-burger").toggleClass('is-active');
            $("#nav-menu").toggleClass('is-active');
        });
    });
</script>