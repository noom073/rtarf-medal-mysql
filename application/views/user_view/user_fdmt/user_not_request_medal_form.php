<section class="section" style="min-height: 500px">
    <div class="columns">
        <div class="column is-one-fifth">
            <?= $sidemenu ?>
        </div>
        <div class="column is-four-fifths">
            <div class="container">
                <h1 class="container content is-size-4">บัญชีผู้ยังไม่ได้รับเครื่องราชฯ</h1>
                <div class="container content">
                    <p>
                        <div class="is-size-5 has-text-centere">กรุณาเลือกชั้นยศ</div>
                    </p>
                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button info btn-rank" data-rank-type="commission">สัญญาบัตร</button>
                        </div>
                        <div class="control">
                            <button class="button info btn-rank" data-rank-type="non-commission">ประทวน</button>
                        </div>
                        <div class="control">
                            <button class="button info btn-rank" data-rank-type="employee">ลูกจ้าง</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="search-form-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-content">
            <!-- Any other Bulma elements you want -->
            <div class="container box">
                <div class="is-size-5 content">เครื่องราชฯ ชั้นต่ำกว่าสายสะพาย</div>

                <form id="not-req-medal-report-form" method="post" action="<?= site_url('user_fundamental/not_request_medal_generate_report') ?>">
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
                        <div class="field-label is-normal">
                            <label class="label">ชั้นยศที่ต้องการ</label>
                        </div>

                        <div class="field-body">
                            <div class="field">
                                <div class="select">
                                    <select id="rankid" name="rankid"></select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field is-grouped is-grouped-right">
                        <div class="control">
                            <button id="search-form-submit-modal" class="button is-primary" type="submit">Submit</button>
                        </div>
                        <div class="control">
                            <button id="search-form-close-modal" class="button is-danger" type="button">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <button class="modal-close is-large" aria-label="close"></button>
    </div>
</section>

<script>
    $(document).ready(function() {
        console.log('ok');

        const init_func = function() {
            $("ul#fdmt-report-ul").removeClass('is-hidden');
            $("a#fdmt-report-ul-not-req-medal").addClass('is-active');
        };
        init_func();
        

        $(".btn-rank").click(function() {
            const rankType = $(this).attr('data-rank-type');
            const ranks = <?= json_encode($ranks) ?>;

            let rankList = Array();
            if (rankType == 'commission') {
                rankList = ranks.filter(r => r.CRAK_CODE >= '05' && r.CRAK_CODE <= '11' &&
                    (r.CRAK_CDEP_CODE == '1' || r.CRAK_CDEP_CODE == '0'));
            } else if (rankType == 'non-commission') {
                rankList = ranks.filter(r => r.CRAK_CODE >= '21' && r.CRAK_CODE <= '27' &&
                    (r.CRAK_CDEP_CODE == '1' || r.CRAK_CDEP_CODE == '0'));
            } else if (rankType == 'employee') {
                rankList = ranks.filter(r => r.CRAK_CODE >= '50' && r.CRAK_CODE <= '51' &&
                    (r.CRAK_CDEP_CODE == '1' || r.CRAK_CDEP_CODE == '0'));
            } else {
                rankList = [];
            }

            let rankOption = '';
            rankList.forEach(e => {
                rankOption += `<option value="${e.CRAK_CODE}">${e.CRAK_NAME_ACM}</option>`;
            });

            $('select#rankid').html(rankOption);
            $('#search-form-modal').addClass('is-active');

            console.log(rankList);
        });

        $("#search-form-modal").children(".modal-close").click(function() {
            $("#search-form-modal").removeClass('is-active');
        });

        $("#search-form-close-modal").click(function() {
            $("#search-form-modal").removeClass('is-active');
        });

        $("#not-req-medal-report-form").submit(function() {
            $("#search-form-submit-modal").addClass("is-loading");
        });

    });
</script>