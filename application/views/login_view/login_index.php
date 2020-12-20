<section class="section">
    <div class="columns is-centered">
        <div class="column is-one-third box">
            <div class="hero">
                <div class="hero-head">
                    <figure class="image is-48x48 is-pulled-right">
                        <img src="<?= base_url('assets/images/medal.png') ?>" alt="">
                    </figure>
                </div>
                <div class="hero-body">
                    <div class="container">
                        <h1 class="title has-text-centered">ระบบเครื่องราชอิสริยาภรณ์</h1>
                    </div>
                </div>
            </div>

            <div class="mx-3">
                <form id="login-form">
                    <div class="field">
                        <label for="" class="label">Username :</label>
                        <div class="control">
                            <input class="input" type="text" name="username" id="usr">
                        </div>
                    </div>

                    <div class="field">
                        <label for="" class="label">Password :</label>
                        <div class="control">
                            <input class="input" type="password" name="password" id="pwd">
                        </div>
                    </div>
                    <div class="field">
                        <div class="control has-text-right">
                            <button class="button">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        console.log('ok')
        $("#login-form").submit(function(event) {
            event.preventDefault();
            let formData = $(this).serialize();
            $.post({
                    url: '<?= site_url('login/ajax_login_process') ?>',
                    data: formData,
                    dataType: 'json'
                })
                .done(res => {
                    console.log(res);
                    let username = $("#usr").val();
                    if (username == 'admin') {
                        window.location.href = '<?= site_url('admin_fundamental/index') ?>';                        
                    } else {
                        window.location.href = '<?= site_url('user_fundamental/index') ?>';                        
                    }
                })
                .fail((jhr, status, error) => {
                    console.error(jhr, status, error);
                });
        });
    });
</script>