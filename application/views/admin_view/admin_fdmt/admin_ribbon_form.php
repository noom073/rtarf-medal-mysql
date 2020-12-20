<section class="section" style="min-height: 500px">
    <div class="columns">
        <div class="column is-one-fifth">
            <?= $sidemenu ?>
        </div>
        <div class="column is-four-fifths">
            <div class="container">
                <progress id="loading-page" class="progress is-small is-link" max="100">15%</progress>
                <h1 class="container content is-size-4">บัญชีการรับเครื่องราชฯ ชั้นสายสะพาย</h1>
                <div class="container">
                    <div class="content">
                        <div class="is-size-5 content">เครื่องราชฯ ชั้นสายสะพาย</div>
                        <div class="columns">
                            <div class="column is-one-third">
                                <form id="ribbon-report-form" method="post" action="<?= site_url('admin_fundamental/ajax_ribbon_generate_report') ?>">
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label class="label">เลือกปีที่ขอ :</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">
                                                <div class="control">
                                                    <input type="text" name="year" class="input" value="<?= date("Y") + 543 ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label class="label">หน่วย</label>
                                        </div>

                                        <div class="field-body">
                                            <div class="field">
                                                <div class="select">
                                                    <select id="unitid" name="unitid"></select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field is-horizontal">
                                        <div class="field-label"></div>
                                        <div class="field-body">
                                            <button id="ribbon-report-form-submit" class="button is-primary">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
        console.log('ok');

        const init_func = function() {
            $("ul#fdmt-report-ul").removeClass('is-hidden');
            $("a#fdmt-report-ul-ribbon").addClass('is-active');
        };
        init_func();

        const getUnitList = function() {
            $.get({
                    url: '<?= site_url("admin/ajax_get_unit") ?>',
                    dataType: 'json'
                })
                .done(res => {
                    let hq = res.filter(r => r.NPRT_KEY.substring(0, 2) == '60');
                    let joint = res.filter(r => r.NPRT_KEY.substring(0, 2) == '61');
                    let operation = res.filter(r => r.NPRT_KEY.substring(0, 2) == '62');
                    let special = res.filter(r => r.NPRT_KEY.substring(0, 2) == '63');
                    let education = res.filter(r => r.NPRT_KEY.substring(0, 2) == '64');

                    let hqOpt = '<optgroup label="ส่วนบังคับบัญชา">';
                    hq.forEach(r => {
                        hqOpt += `<option value="${r.NPRT_UNIT}">${r.NPRT_ACM}</option>`
                    });
                    hqOpt += `</optgroup>`;

                    let jointOpt = '<optgroup label="ส่วนเสนาธิการร่วม">';
                    joint.forEach(r => {
                        jointOpt += `<option value="${r.NPRT_UNIT}">${r.NPRT_ACM}</option>`
                    });
                    jointOpt += `</optgroup>`;

                    let operationOpt = '<optgroup label="ส่วนปฏิบัติการ">';
                    operation.forEach(r => {
                        operationOpt += `<option value="${r.NPRT_UNIT}">${r.NPRT_ACM}</option>`
                    });
                    operationOpt += `</optgroup>`;

                    let specialOpt = '<optgroup label="ส่วนกิจการพิเศษ">';
                    special.forEach(r => {
                        specialOpt += `<option value="${r.NPRT_UNIT}">${r.NPRT_ACM}</option>`
                    });
                    specialOpt += `</optgroup>`;

                    let educationOpt = '<optgroup label="ส่วนการศึกษา">';
                    education.forEach(r => {
                        educationOpt += `<option value="${r.NPRT_UNIT}">${r.NPRT_ACM}</option>`
                    });
                    educationOpt += `</optgroup>`;

                    $("#unitid").html(hqOpt + jointOpt + operationOpt + specialOpt + educationOpt);
                    $("#loading-page").addClass('is-invisible');
                })
                .fail((jhr, status, error) => {
                    console.error(jhr, status, error);
                });
        };
        getUnitList();

        $("#ribbon-report-form").submit(function() {
            $("#ribbon-report-form-submit").addClass("is-loading");
        });


    });
</script>