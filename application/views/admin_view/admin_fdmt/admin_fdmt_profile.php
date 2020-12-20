<section class="section" style="min-height: 500px">
    <div class="columns">
        <div class="column is-one-fifth">
            <?= $sidemenu ?>
        </div>
        <div class="column is-four-fifths">
            <div class="container">
                <div id="profile" class="container form-detail">
                    <progress id="loading-page" class="progress is-small is-link" max="100">15%</progress>

                    <div class="container content is-size-4">
                        ประวัติบุคคล
                    </div>

                    <div class="container content">
                        <div class="columns is-centered">
                            <div class="column is-half">
                                <form id="search-profile">
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
                                        <div class="field-label is-normal">
                                            <label class="label">ประเภท</label>
                                        </div>

                                        <div class="field-body">
                                            <div class="field">
                                                <div class="control">
                                                    <div class="select">
                                                        <select name="type">
                                                            <option value="name">ชื่อ นามสกุล</option>
                                                            <option value="mid">เลขประจำตัวข้าราชการ</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label class="label">คำค้นหา</label>
                                        </div>

                                        <div class="field-body">
                                            <div class="field">
                                                <div class="control">
                                                    <input class="input" type="text" name="text" placeholder="Text input">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field is-horizontal">
                                        <div class="field-label"></div>
                                        <div class="field-body">
                                            <div class="field">
                                                <button class="button">ค้นหา</button>
                                                <button id="search-reset" type="reset" class="button">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div id="search-result"></div>

                        <div id="search-data" class="has-background-light px-3 py-3" style="height: 400px; overflow-y: auto">ผลการค้นหา:</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        console.log('ok');

        $("#search-reset").click(function() {
            // $("#search-data").prop("class", '');
            $("#search-data").text('');
        });

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

        $("#search-profile").submit(function(event) {
            $("#search-data").html('Loading...');
            event.preventDefault();
            let formData = $(this).serialize();
            $.post({
                    url: '<?= site_url('admin_fundamental/ajax_search_person') ?>',
                    dataType: 'json',
                    data: formData
                })
                .done(res => {
                    // console.log(res)
                    if (res.status) {

                        let totalPersons = res.data.length;
                        let html = `<p>ทั้งหมด จำนวน: ${totalPersons} นาย</p>`;
                        res.data.forEach(r => {
                            html += `
                                <p class="container">
                                    <a href="<?= site_url('admin_fundamental/biog/') ?>${r.BIOG_ID}">${r.BIOG_NAME}</a>
                                </p>`;
                        });
                        $("#search-data").html(html);
                    } else {
                        $("#search-result").prop("class", 'notification is-warning');
                        $("#search-result").text(res.data);
                        $("#search-data").html('');
                    }

                    setTimeout(() => {
                        $("#search-result").prop("class", '');
                        $("#search-result").text('');
                    }, 2000);
                })
                .fail((jhr, status, error) => {
                    console.error(jhr, status, error);
                });

        });
    });
</script>