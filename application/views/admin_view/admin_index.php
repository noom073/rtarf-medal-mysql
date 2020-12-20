<section class="section">
    <div class="">
        <div class="columns">
            <div class="column is-one-quarter">
                <?= $sidemenu ?>
            </div>

            <div class="column is-three-quarter">
                <div class="container">
                    <div class="content">
                        <progress id="loading-unit-list" class="progress is-small is-link" max="100">15%</progress>
                        <div class="has-text-centered is-size-3">กองบัญชาการ กองทัพไทย</div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <div class="dropdown" id="hq-dropdown">
                                <div class="dropdown-trigger">
                                    <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
                                        <span>ส่วนบังคับบัญชา</span>
                                        <span class="icon is-small">
                                            <i class="fas fa-angle-down" aria-hidden="true"></i>
                                        </span>
                                    </button>
                                </div>
                                <div class="dropdown-menu" id="hq-menu" role="menu">
                                    <div class="dropdown-content">
                                        <a href="#" class="dropdown-item">
                                            Dropdown item
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="column">
                            <div class="dropdown" id="joint-dropdown">
                                <div class="dropdown-trigger">
                                    <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
                                        <span>ส่วนเสนาธิการร่วม</span>
                                        <span class="icon is-small">
                                            <i class="fas fa-angle-down" aria-hidden="true"></i>
                                        </span>
                                    </button>
                                </div>
                                <div class="dropdown-menu" id="joint-menu" role="menu">
                                    <div class="dropdown-content">
                                        <a href="#" class="dropdown-item">
                                            Dropdown item
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="column">
                            <div class="dropdown" id="operation-dropdown">
                                <div class="dropdown-trigger">
                                    <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
                                        <span>ส่วนปฏิบัติการ</span>
                                        <span class="icon is-small">
                                            <i class="fas fa-angle-down" aria-hidden="true"></i>
                                        </span>
                                    </button>
                                </div>
                                <div class="dropdown-menu" id="operation-menu" role="menu">
                                    <div class="dropdown-content">
                                        <a href="#" class="dropdown-item">
                                            Dropdown item
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="column">
                            <div class="dropdown" id="special-dropdown">
                                <div class="dropdown-trigger">
                                    <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
                                        <span>ส่วนกิจการพิเศษ</span>
                                        <span class="icon is-small">
                                            <i class="fas fa-angle-down" aria-hidden="true"></i>
                                        </span>
                                    </button>
                                </div>
                                <div class="dropdown-menu" id="special-menu" role="menu">
                                    <div class="dropdown-content">
                                        <a href="#" class="dropdown-item">
                                            Dropdown item
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="column">
                            <div class="dropdown" id="education-dropdown">
                                <div class="dropdown-trigger">
                                    <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
                                        <span>ส่วนการศึกษา</span>
                                        <span class="icon is-small">
                                            <i class="fas fa-angle-down" aria-hidden="true"></i>
                                        </span>
                                    </button>
                                </div>
                                <div class="dropdown-menu" id="education-menu" role="menu">
                                    <div class="dropdown-content">
                                        <a href="#" class="dropdown-item">
                                            Dropdown item
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        console.log('ok')
        $(".dropdown").click(function() {
            $(this).toggleClass('is-active')
        });

        $.get({
                url: '<?= site_url("admin/ajax_get_unit") ?>',
                dataType: 'json'
            })
            .done(res => {
                // console.log(res)    
                let hq = res.filter(r => r.NPRT_KEY.substring(0, 2) == '60');
                let joint = res.filter(r => r.NPRT_KEY.substring(0, 2) == '61');
                let operation = res.filter(r => r.NPRT_KEY.substring(0, 2) == '62');
                let special = res.filter(r => r.NPRT_KEY.substring(0, 2) == '63');
                let education = res.filter(r => r.NPRT_KEY.substring(0, 2) == '64');

                // generate dropdown HQ
                let hqList = '';
                hq.forEach(e => {
                    hqList += `<a href="<?= site_url('admin_fundamental/index') ?>/${e.NPRT_UNIT}" class="dropdown-item">
                                    ${e.NPRT_ACM}
                                </a>`
                });
                $("#hq-menu").children(".dropdown-content").html(hqList);
                // End generate dropdown HQ

                // generate dropdown JOINT
                let jointList = '';
                joint.forEach(e => {
                    jointList += `<a href="<?= site_url('admin_fundamental/index') ?>/${e.NPRT_UNIT}" class="dropdown-item">
                                    ${e.NPRT_ACM}
                                </a>`
                });
                $("#joint-menu").children(".dropdown-content").html(jointList);
                // End generate dropdown JOINT

                // generate dropdown operation
                let operationList = '';
                operation.forEach(e => {
                    operationList += `<a href="<?= site_url('admin_fundamental/index') ?>/${e.NPRT_UNIT}" class="dropdown-item">
                                    ${e.NPRT_ACM}
                                </a>`
                });
                $("#operation-menu").children(".dropdown-content").html(operationList);
                // End generate dropdown operation

                // generate dropdown special
                let specialList = '';
                special.forEach(e => {
                    specialList += `<a href="<?= site_url('admin_fundamental/index') ?>/${e.NPRT_UNIT}" class="dropdown-item">
                                    ${e.NPRT_ACM}
                                </a>`
                });
                $("#special-menu").children(".dropdown-content").html(specialList);
                // End generate dropdown special

                // generate dropdown education
                let educationList = '';
                education.forEach(e => {
                    educationList += `<a href="<?= site_url('admin_fundamental/index') ?>/${e.NPRT_UNIT}" class="dropdown-item">
                                    ${e.NPRT_ACM}
                                </a>`
                });
                $("#education-menu").children(".dropdown-content").html(educationList);
                // End generate dropdown education

                setTimeout(() => {
                    $("#loading-unit-list").hide();
                }, 500);

            })
            .fail((jhr, status, error) => {
                console.error(jhr, status, error)
            });
    });
</script>