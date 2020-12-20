<section class="section" style="min-height: 500px">
    <div class="columns">
        <div class="column is-one-fifth">
            <?= $sidemenu ?>
        </div>
        <div class="column is-four-fifths">
            <div class="container">
                <div id="profile" class="container form-detail">
                    <div class="container content">
                        <div class="is-size-4">รอบปกติ ชั้นสายสะพาย</div>
                        <div class="is-size-5">ข้อมูลพื้นฐาน</div>
                    </div>

                    <div class="container content">
                        <form id="search-form">
                            <div class="field is-horizontal">
                                <div class="field-label is-normal">
                                    <label class="label">หน่วย</label>
                                </div>

                                <div class="field-body">
                                    <div class="field">
                                        <div class="select is-fullwidth">
                                            <select id="unitid" name="unitid">
                                                <option value="<?= $unitID ?>"><?= $unitname ?></option>
                                            </select>
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

                        <div class="mt-5">
                            <div class="">
                                <span>ผลการค้นหา:</span>
                                <span id="search-result"></span>
                                <div id="data-result"></div>
                            </div>
                            <div class="mt-3">
                                <table id="bdec-data" class="table is-striped">
                                    <thead>
                                        <tr>
                                            <th class="has-text-centered">ลำดับ</th>
                                            <th class="has-text-centered">เลขประจำตัว</th>
                                            <th class="">ยศ-ชื่อ-นามสกุล</th>
                                            <th class="has-text-centered">เครื่องราชฯ</th>
                                            <th class="has-text-centered">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-5">
                                <div class="is-size-5">เพิ่มรายชื่อกำลังพล</div>
                                <button class="button is-success mt-3" id="search-person-btn">Search</button>
                                <div class="mt-3">
                                    <div id="search-person-form-data"></div>
                                </div>
                            </div>
                            <div>
                                <div class="modal" id="search-person-modal">
                                    <div class="modal-background"></div>
                                    <div class="modal-content has-background-light py-5 px-5">
                                        <div class="container">
                                            <form id="search-person-form">
                                                <div class="field">
                                                    <div class="is-size-5">ค้นหารายชื่อกำลังพล</div>
                                                </div>
                                                <div class="field">
                                                    <div class="control">
                                                        <label class="radio">
                                                            <input type="radio" name="type_opt" value="id" checked> เลขประจำตัว
                                                        </label>
                                                        <label class="radio">
                                                            <input type="radio" name="type_opt" value="name"> ชื่อ-นามสกุล
                                                        </label>
                                                        <label class="radio">
                                                            <input type="radio" name="type_opt" value="lastname"> นามสกุล
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="field">
                                                    <div class="control">
                                                        <input class="input" type="text" name="text_search">
                                                    </div>
                                                </div>
                                                <div class="field">
                                                    <button class="button is-primary" type="submit">Search</button>
                                                    <button class="button is-light" type="reset">Reset</button>
                                                </div>
                                            </form>

                                            <div class="mt-3">
                                                <div id="search-person-form-result"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="modal-close is-large" aria-label="close"></button>
                                </div>

                                <div class="modal" id="prepare-person-modal">
                                    <div class="modal-background"></div>
                                    <div class="modal-content has-background-light py-5 px-5">
                                        <div class="container">
                                            <form id="prepare-person-form">
                                                <div class="field">
                                                    <div class="is-size-5">บันทึกรายชื่อกำลังพล</div>
                                                </div>
                                                <div class="field">
                                                    <div class="control">
                                                        <div class="input" id="prepare-person-name">xxxx</div>
                                                    </div>
                                                </div>
                                                <div class="field">
                                                    <label class="label">เครื่องราชฯที่ขอ</label>
                                                    <div class="control">
                                                        <select name="medal">
                                                            <option value="ม.ป.ช.">ม.ป.ช.</option>
                                                            <option value="ม.ว.ม.">ม.ว.ม.</option>
                                                            <option value="ป.ช.">ป.ช.</option>
                                                            <option value="ป.ม.">ป.ม.</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="field">
                                                    <input id="prepare-person-biog-id" type="hidden" name="biog_id">
                                                    <button class="button is-primary" type="submit">Save</button>
                                                </div>
                                            </form>

                                            <div class="mt-3">
                                                <div id="prepare-person-form-result"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="modal-close is-large" aria-label="close"></button>
                                </div>

                                <div class="modal" id="delete-bdec-person-modal">
                                    <div class="modal-background"></div>
                                    <div class="modal-content has-background-light py-5 px-5">
                                        <div class="container">
                                            <form id="delete-bdec-person-form">
                                                <div class="field">
                                                    <div class="is-size-5">ยืนยันการลบรายชื่อ</div>
                                                </div>
                                                <div class="field">
                                                    <div class="control">
                                                        <div class="input" id="delete-bdec-person-name">xxxx</div>
                                                    </div>
                                                </div>
                                                <div class="field">
                                                    <input id="delete-bdec-person-biog-id" type="hidden" name="bdec_id">
                                                    <button class="button is-danger" type="submit">Delete</button>
                                                </div>
                                            </form>

                                            <div class="mt-3">
                                                <div id="delete-bdec-person-result"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="modal-close is-large" aria-label="close"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="<?= base_url('assets/datatable/datatables.min.js') ?>"></script>

<script>
    $(document).ready(function() {
        (function() {
            $("ul#typical-ribbon").removeClass('is-hidden');
            $("a#user-typical-ribbon-fundation").addClass('is-active');
        })();

        // function drawDataTable(dataObj) {
        let bdecDataTable = $("#bdec-data").DataTable({
            ajax: {
                url: '<?= site_url('user_typical_ribbon/ajax_get_person_bdec') ?>',
                data: () => $("#search-form").serialize(),
                type: 'post',
                dataSrc: ''
            },
            columns: [{
                    data: 'NUMBER',
                    className: 'has-text-centered',
                    render: (data, type, row, meta) => meta.row + 1
                },
                {
                    data: 'BDEC_ID',
                    className: 'has-text-centered biog-id'
                },
                {
                    data: 'BDEC_NAME',
                    className: 'bdec-name'
                },
                {
                    data: 'BDEC_COIN',
                    className: 'has-text-centered medal'
                },
                {
                    data: 'BDEC_ID',
                    className: 'has-text-centered',
                    render: (data, type, row, meta) => {
                        let select = `<select class="medal-name">
                                    <option value="ม.ป.ช." ${row.BDEC_COIN == 'ม.ป.ช.' ? 'selected':''}>ม.ป.ช.</option>
                                    <option value="ม.ว.ม." ${row.BDEC_COIN == 'ม.ว.ม.' ? 'selected':''}>ม.ว.ม.</option>
                                    <option value="ป.ช." ${row.BDEC_COIN == 'ป.ช.' ? 'selected':''}>ป.ช.</option>
                                    <option value="ป.ม." ${row.BDEC_COIN == 'ป.ม.' ? 'selected':''}>ป.ม.</option>
                                </select>`;
                        let delButton = `<button 
                            class="del-bdec-person py-1 px-3" 
                            data-biog-id="${row.BDEC_ID}" 
                            style="color:white; background-color: #ff4b4b; border: none; cursor:pointer">- ลบ</button>`;
                        return `${select} ${delButton}`;
                    }
                }
            ]
        });

        function generateDataTable(formData) {
            $.post({
                url: '<?= site_url('user_typical_ribbon/ajax_get_person_bdec') ?>',
                data: formData,
                dataType: 'json',
            }).done(res => {
                bdecDataTable.ajax.reload(() => $("#search-result").text(''), false);
            }).fail((jhr, status, error) => console.error(jhr, status, error));
        }

        $("#search-form").submit(function(event) {
            /** search person in per_bdec_tab */
            event.preventDefault();
            $("#search-result").text('Loading...');
            let formData = $(this).serialize();
            bdecDataTable.ajax.reload(() => $("#search-result").text(''), false);
        });

        $(document).on("change", ".medal-name", function() {
            /** change person's medal */
            let formData = {
                id: $(this).parent('td').siblings('.biog-id').text(),
                medal: $(this).parent('td').siblings('.medal').text(),
                nextMedal: $(this).val()
            };

            $.post({
                url: '<?= site_url('user_typical_ribbon/ajax_update_medal_bdec') ?>',
                data: formData,
                dataType: 'json'
            }).done(res => {
                if (res.status) {
                    $("#data-result").prop('class', 'has-text-success');
                    $("#data-result").text(res.text);
                    bdecDataTable.ajax.reload(null, false);
                } else {
                    $("#data-result").prop('class', 'has-text-warning');
                    $("#data-result").text(res.text);
                }

                setTimeout(() => {
                    $("#data-result").prop('class', '');
                    $("#data-result").text('');
                }, 2000);
            }).fail((jhr, status, error) => console.error(jhr, status, error));
        });

        $(".modal-close").click(function() {
            $(this).parent(".modal").removeClass("is-active");
        });

        $("#search-person-btn").click(function() {
            $("#search-person-modal").addClass("is-active");
        });

        $("#search-person-form").submit(function(event) {
            /** search person for insert to per_bdec_tab */
            event.preventDefault();
            $("#search-person-form-result").html('Loading...');
            $("#search-person-form-data").html('');
            let formData = $(this).serialize();
            let unitID = $("#unitid").val();
            formData += "&unitID=" + unitID;

            $.post({
                url: '<?= site_url('user_typical_ribbon/ajax_search_person') ?>',
                data: formData,
                dataType: 'json'
            }).done(res => {
                console.log(res)
                if (res.status) {
                    let person = `<table class="table"><thead><tr>
                                <th>ชื่อ-นามสกุล</th>
                                <th>เครื่องราชฯเดิม</th>
                                <th>เครื่องราชฯ ที่จะขอ</th>
                                <th>สถานะ</th>
                                <th>#</th>
                            </tr></thead><tbody>   
                    `;
                    res.data.forEach(el => {
                        let stat = (el.BDEC_ID !== null) ? 'มีรายชื่อแล้ว' : 'ยังไม่มีรายชื่อ';
                        person += `<tr>
                            <td class="biog-name">${el.BIOG_NAME}</td>    
                            <td>${el.BIOG_DEC}</td>    
                            <td>${el.BDEC_COIN === null ? '-' : el.BDEC_COIN}</td>    
                            <td>${stat}</td>
                            <td><button 
                                class="add-bdec-person py-1 px-3" 
                                data-biog-id="${el.BIOG_ID}" 
                                style="color:white; background-color: #3ec46d; border: none; cursor:pointer">+ เพิ่ม</button></td>
                            </tr>`;
                    });
                    person += `</tbody></table>`;
                    $("#search-person-form-data").html(person);

                    $("#search-person-form-result").html(res.text);
                    setTimeout(() => {
                        $("#search-person-form-result").text('');
                        $("#search-person-modal").removeClass('is-active');

                    }, 1000);
                } else {
                    $("#search-person-form-result").html(res.text);
                }

            }).fail((jhr, status, error) => console.error(jhr, status, error));
        });

        $(document).on("click", ".add-bdec-person", function() {
            /** on click "เพิ่ม" button to active prepare person form modal */
            let biogID = $(this).data("biog-id");
            let personName = $(this).parent("td").siblings(".biog-name").html();
            $("#prepare-person-modal").addClass("is-active");
            $("#prepare-person-name").html(personName);
            $("#prepare-person-biog-id").val(biogID);
        });

        $("#prepare-person-form").submit(function(event) {
            /** submit add person to per_bdec_tab */
            event.preventDefault();
            let formData = $(this).serialize();
            console.log(formData);
            $.post({
                url: '<?= site_url('user_typical_ribbon/ajax_add_person_to_bdec') ?>',
                data: formData,
                dataType: 'json'
            }).done(res => {
                console.log(res);
                if (res.status) {
                    $("#prepare-person-form-result").html(`Success: ${res.text}`);
                    $("#prepare-person-modal").removeClass("is-active");
                    bdecDataTable.ajax.reload(null, false);
                } else {
                    $("#prepare-person-form-result").html(`Error: ${res.text}`);
                }

                setTimeout(() => $("#prepare-person-form-result").html(''), 2000);
            }).fail((jhr, status, error) => console.error(jhr, status, error));
        });

        $(document).on('click', ".del-bdec-person", function() {
            /** click to popup delete-cdec-person modal */
            $("#delete-bdec-person-modal").addClass("is-active");
            let biogID = $(this).data("biog-id");
            let name = $(this).parent("td").siblings(".bdec-name").html();
            $("#delete-bdec-person-name").addClass('has-text-danger');
            $("#delete-bdec-person-name").html(name);
            $("#delete-bdec-person-biog-id").val(biogID);
        });

        $("#delete-bdec-person-form").submit(function(event) {
            event.preventDefault();
            let formData = $(this).serialize();
            console.log(formData);
            $.post({
                url: '<?= site_url('user_typical_ribbon/ajax_delete_bdec_person') ?>',
                data: formData,
                dataType: 'json'
            }).done(res => {
                if (res.status) {
                    $("#delete-bdec-person-result").html(`Success: ${res.text}`);
                    bdecDataTable.ajax.reload(null, false);

                    setTimeout(() => {
                        $("#delete-bdec-person-modal").removeClass('is-active');
                        $("#delete-bdec-person-result").html('');
                    }, 2000);
                } else {
                    $("#delete-bdec-person-result").html(`Error: ${res.text}`);
                }
            }).fail((jhr, status, error) => console.error(jhr, status, error));
        });

    });
</script>