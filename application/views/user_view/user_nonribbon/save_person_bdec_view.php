<section class="section" style="min-height: 500px">
    <div class="columns">
        <div class="column is-one-fifth">
            <?= $sidemenu ?>
        </div>
        <div class="column is-four-fifths">
            <div class="container">
                <div id="profile" class="container form-detail">
                    <div class="container content is-size-4">
                        บันทึกบัญชีขอเครื่องราชฯ ชั้นต่ำกว่าสายสะพาย
                    </div>

                    <div class="container content">
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
                                    <button id="save-alert" class="button is-primary">Save</button>
                                </div>
                            </div>
                        </div>

                        <div class="save-person-bdec-form-result"></div>
                        <div class="save-person-bdec-form-data"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal save confirm  -->
<div id="save-bdec-modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-content">
        <div class="box">
            <div class="container content is-size-4 has-text-centered">
                ยืนยันการบันทึกบัญชีขอเครื่องราชฯ ชั้นต่ำกว่าสายสะพาย
            </div>

            <form class="content" id="save-person-bdec-form">
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
                            <button id="save-person-bdec-form-save" type="submit" class="button is-primary">Yes</button>
                            <button id="save-person-bdec-form-cancel" type="button" class="button is-danger">Cancel</button>
                        </div>
                    </div>
                </div>

                <div class="save-person-bdec-form-result"></div>
                <div class="save-person-bdec-form-data"></div>
            </form>
        </div>
    </div>
    <button class="modal-close is-large" aria-label="close"></button>
</div>
<!-- End Modal save confirm  -->

<script>
    $(document).ready(function() {
        console.log('ok');

        const init_func = function() {
            // $("ul#fdmt-report-ul").removeClass('is-hidden');
            $("a#save-person-ul-nonribbon").addClass('is-active');
        };
        init_func();

        $("#save-alert").click(function() {
            $("#save-bdec-modal").addClass('is-active');
        });

        $("#save-person-bdec-form-cancel, .modal-close").click(function() {
            $("#save-bdec-modal").removeClass('is-active');
        });

        $("#save-person-bdec-form").submit(function(event) {
            event.preventDefault();
            let formData = $(this).serialize();
            $(".save-person-bdec-form-result").html('Loading...');

            $.post({
                url: '<?= site_url('user_non_ribbon/ajax_save_person_to_bdec') ?>',
                data: formData,
                dataType: 'json'
            }).done(res => {
                console.log(res);
                if (res) {
                    $(".save-person-bdec-form-result").addClass('notification is-info');
                    $(".save-person-bdec-form-result").html('Finish');
                    setTimeout(() => {
                        $(".save-person-bdec-form-result").removeClass('notification is-info');
                        $(".save-person-bdec-form-result").html('');
                    }, 5000);
                } else {
                    $(".save-person-bdec-form-result").addClass('class', 'notification is-warning');
                    $(".save-person-bdec-form-result").html('Failure');
                }
            }).fail((jhr, status, error) => {
                console.error(jhr, status, error);
            });
            // $("#property-form-data").html('Loading...');           
        });
    });
</script>