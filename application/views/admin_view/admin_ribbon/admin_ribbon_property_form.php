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
                        พิมพ์บัญชีแสดงคุณสมบัติ
                    </div>

                    <div class="container content">
                        <form id="property-form" method="post" action="<?= site_url('admin_ribbon/action_get_ribbon_person_prop') ?>">
                            <div class="field is-horizontal">
                                <div class="field-label is-normal">
                                    <label class="label">หน่วย</label>
                                </div>

                                <div class="field-body">
                                    <div class="field">
                                        <div class="select is-fullwidth">
                                            <select id="unitid" name="unitid"></select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="field is-horizontal">
                                <div class="field-label is-normal">
                                    <label class="label">ชั้น</label>
                                </div>

                                <div class="field-body">
                                    <div class="field">
                                        <div class="control">
                                            <div class="select">
                                                <select name="ribbon_type">
                                                    <option value="ม.ป.ช.">ม.ป.ช.</option>
                                                    <option value="ม.ว.ม.">ม.ว.ม.</option>
                                                    <option value="ป.ช.">ป.ช.</option>
                                                    <option value="ป.ม.">ป.ม.</option>
                                                    <!-- <option value="ท.ช.">ท.ช.</option>
                                                    <option value="ท.ม.">ท.ม.</option>
                                                    <option value="ต.ช.">ต.ช.</option>
                                                    <option value="ต.ม.">ต.ม.</option>
                                                    <option value="จ.ช.">จ.ช.</option>
                                                    <option value="จ.ม.">จ.ม.</option>
                                                    <option value="บ.ช.">บ.ช.</option>
                                                    <option value="บ.ม.">บ.ม.</option> -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="field is-horizontal">
                                <div class="field-label is-normal">
                                    <label class="label">ปีที่ขอ</label>
                                </div>

                                <div class="field-body">
                                    <div class="field">
                                        <div class="control">
                                            <input class="input" type="text" name="year" value="<?= date('Y') + 543 ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="field is-horizontal">
                                <div class="field-label is-normal">
                                    <label class="label">เงื่อนไข</label>
                                </div>

                                <div class="field-body">
                                    <div class="field">
                                        <div class="control">
                                            <div class="select">
                                                <select name="condition">
                                                    <option value="normal">ปกติ</option>
                                                    <option value="retire">เกษียณ</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr />
                            
                            <div class="field is-horizontal">
                                <div class="field-label is-normal"></div>

                                <div class="field-body">
                                    <div class="field">
                                        <label class="label">ชื่อผู้ลงนาม</label>
                                    </div>
                                </div>
                            </div>

                            <div class="field is-horizontal">
                                <div class="field-label is-normal">
                                    <label class="label">ยศ</label>
                                </div>

                                <div class="field-body">
                                    <div class="field">
                                        <div class="control">
                                            <input class="input" type="text" name="p1_rank" placeholder="Text input">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="field is-horizontal">
                                <div class="field-label is-normal">
                                    <label class="label">ชื่อ - สกุล</label>
                                </div>

                                <div class="field-body">
                                    <div class="field">
                                        <div class="control">
                                            <input class="input" type="text" name="p1_name" placeholder="Text input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="field is-horizontal">
                                <div class="field-label is-normal">
                                    <label class="label">ตำแหน่ง <br /> ผู้เสนอขอพระราชทาน</label>
                                </div>

                                <div class="field-body">
                                    <div class="field">
                                        <div class="control">
                                            <input class="input" type="text" name="p1_position" placeholder="Text input">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="field is-horizontal">
                                <div class="field-label is-normal">
                                    <label class="label">ยศ</label>
                                </div>

                                <div class="field-body">
                                    <div class="field">
                                        <div class="control">
                                            <input class="input" type="text" name="p2_rank" placeholder="Text input">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="field is-horizontal">
                                <div class="field-label is-normal">
                                    <label class="label">ชื่อ - สกุล</label>
                                </div>

                                <div class="field-body">
                                    <div class="field">
                                        <div class="control">
                                            <input class="input" type="text" name="p2_name" placeholder="Text input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="field is-horizontal">
                                <div class="field-label is-normal">
                                    <label class="label">ตำแหน่ง</label>
                                </div>

                                <div class="field-body">
                                    <div class="field">
                                        <div class="control">
                                            <input class="input" type="text" name="p2_position" placeholder="Text input">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="field is-horizontal">
                                <div class="field-label"></div>
                                <div class="field-body">
                                    <div class="field">
                                        <button class="button is-primary">Submit</button>
                                        <button id="search-reset" type="reset" class="button">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div id="property-form-result"></div>
                        <div id="property-form-data"></div>
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
            // $("ul#fdmt-report-ul").removeClass('is-hidden');
            $("a#people-property-ul-ribbon").addClass('is-active');
        };
        init_func();

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

        $("#property-form").submit(function(event) {
            // $("#property-form-data").html('Loading...');           
        });
    });
</script>