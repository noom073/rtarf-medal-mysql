<section class="section" style="min-height: 500px">
    <div class="columns">
        <div class="column is-one-fifth">
            <?= $sidemenu ?>
        </div>
        <div class="column is-four-fifths">
            <div class="container">
                <div id="profile" class="container form-detail">
                    <div class="container content is-size-4">
                        พิมพ์สรุปจำนวน
                    </div>

                    <div class="container content">
                        <form id="property-form" method="post" action="<?= site_url('admin_non_ribbon/action_person_amount') ?>">
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
                                    <label class="label">ตำแหน่ง</label>
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
            $("a#amount-person-ul-nonribbon").addClass('is-active');
        };
        init_func();

        $("#property-form").submit(function(event) {
            // $("#property-form-data").html('Loading...');           
        });
    });
</script>