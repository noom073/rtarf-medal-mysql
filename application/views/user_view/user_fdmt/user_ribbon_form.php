<section class="section" style="min-height: 500px">
    <div class="columns">
        <div class="column is-one-fifth">
            <?= $sidemenu ?>
        </div>
        <div class="column is-four-fifths">
            <div class="container">
                <h1 class="container content is-size-4">บัญชีการรับเครื่องราชฯ ชั้นสายสะพาย</h1>
                <div class="container">
                    <div class="content">
                        <div class="is-size-5 content">เครื่องราชฯ ชั้นสายสะพาย</div>
                        <div class="columns">
                            <div class="column is-one-third">
                                <form id="ribbon-report-form" method="post" action="<?= site_url('user_fundamental/ajax_ribbon_generate_report') ?>">
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

        $("#ribbon-report-form").submit(function() {
            $("#ribbon-report-form-submit").addClass("is-loading");
        });


    });
</script>