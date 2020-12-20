<section class="section" style="min-height: 500px">
    <div class="columns">
        <div class="column is-one-fifth">
            <?= $sidemenu ?>
        </div>
        <div class="column is-four-quarter">
            <div class="container">
                <div id="profile" class="container form-detail">
                    <progress id="loading-page" class="progress is-small is-link" max="100">15%</progress>

                    <div class="container content is-size-4">
                        ประวัติบุคคล
                    </div>

                    <div class="container content">
                        <div class="tabs">
                            <ul>
                                <li class="is-active"><a>หน้า 1</a></li>
                                <li><a>หน้า 2</a></li>
                                <li><a>หน้า 3</a></li>
                                <li><a>สมุดประวัติ</a></li>
                            </ul>
                        </div>

                        <div class="biog_data container box">
                            <div class="columns" style="border: .5px dotted green;">
                                <div class="column is-one-quarter">
                                    <strong class="">รหัสหน่วย :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_UNIT'] ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">ชื่อหน่วย :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_UNITNAME'] ?></span>
                                </div>
                            </div>

                            <div class="columns" style="border: .5px dotted green;">
                                <div class="column is-one-quarter">
                                    <strong class="">รหัสตำแหน่ง :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_NCPOS12'] ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">ชื่อตำแหน่ง :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_POSNAME'] ?></span>
                                </div>
                            </div>

                            <div class="columns" style="border: .5px dotted green;">
                                <div class="column is-one-quarter">
                                    <strong class="">เลขประจำตัว :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_ID'] ?></span>
                                </div>
                                <div class="column is-one-quarter">
                                    <strong class="">เลขประจำตัวประชาชน :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_IDP'] ?></span>
                                </div>
                                <div class="column is-one-quarter">
                                    <strong class="">เลขประจำตำแหน่ง :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_CPOS'] ?></span>
                                </div>
                                <div class="column is-one-quarter">
                                    <strong class="">สมาชิก กบข. :</strong>
                                    <input type="checkbox" checked onclick="return false;">
                                </div>
                            </div>

                            <div class="columns" style="border: .5px dotted green;">
                                <div class="column is-one-third">
                                    <strong class="">ยศ (ไทย) :</strong>
                                    <span class="has-text-success"><?= '' ?></span>
                                </div>
                                <div class="column is-one-third">
                                    <strong class="">ชื่อ (ไทย) :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_NAME'] ?></span>
                                </div>
                                <div class="column is-one-third">
                                    <strong class="">นามสกุล (ไทย) :</strong>
                                    <span class="has-text-success"><?= '' ?></span>
                                </div>
                            </div>

                            <div class="columns" style="border: .5px dotted green;">
                                <div class="column is-one-third">
                                    <strong class="">ยศ (อังกฤษ) :</strong>
                                    <span class="has-text-success"><?= '' ?></span>
                                </div>
                                <div class="column is-one-third">
                                    <strong class="">ชื่อ (อังกฤษ) :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_NAME_ENG'] ?></span>
                                </div>
                                <div class="column is-one-third">
                                    <strong class="">นามสกุล (อังกฤษ) :</strong>
                                    <span class="has-text-success"><?= '' ?></span>
                                </div>
                            </div>

                            <div class="columns" style="border: .5px dotted green;">
                                <div class="column">
                                    <strong class="">วดป. เกิด :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_DMY_BORN'] ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">วดป. รับราชการ :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_DMY_WORK'] ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">วดป รับยศครั้งแรก :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_DMY_FRANK'] ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">ปรับวุฒิ :</strong>
                                    <input type="checkbox" checked onclick="return false;">
                                </div>
                                <div class="column">
                                    <strong class="">วดป. เลื่อนฐานะโดยการทำหน้าที่ :</strong>
                                    <span class="has-text-success"><?= '' ?></span>
                                </div>
                            </div>

                            <div class="columns" style="border: .5px dotted green;">
                                <div class="column">
                                    <strong class="">รหัสยศ :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_UNIT'] ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">วดป. รับยศ :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_RANK'] ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">แต่งกาย :</strong>
                                    <span class="has-text-success"><?= '' ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">เพศ :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_SEX'] ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">กำเนิด :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_BORN'] ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">กำเนิดปี :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_BORNY'] ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">เหล่า :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_BRANCH'] ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">นตท. รุ่น :</strong>
                                    <span class="has-text-success"><?= '' ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">เหล่า(ฝอ.) :</strong>
                                    <span class="has-text-success"><?= '' ?></span>
                                </div>
                            </div>

                            <div class="columns is-multiline" style="border: .5px dotted green;">
                                <div class="column is-full">
                                    <div class="columns">
                                        <div class="column">
                                            <strong class="">ระดับ / ชั้น / ปี /เงินเดือน :</strong>
                                            <span class="has-text-success"><?= "{$person['BIOG_SLEVEL']} / {$person['BIOG_SCLASS']} / {$person['BIOG_SYEAR']} / {$person['BIOG_SALARY']}" ?></span>
                                        </div>
                                        <div class="column">
                                            <strong class="">เบิกลด / ก่อน-หลัง :</strong>
                                            <span class="has-text-success"><?= '' ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-full">
                                    <div class="columns">
                                        <div class="column">
                                            <strong class="">พคว. :</strong>
                                            <span class="has-text-success"><?= '' ?></span>
                                        </div>
                                        <div class="column">
                                            <strong class="">พนบ. :</strong>
                                            <span class="has-text-success"><?= '' ?></span>
                                        </div>
                                        <div class="column">
                                            <strong class="">พบล. :</strong>
                                            <span class="has-text-success"><?= '' ?></span>
                                        </div>
                                        <div class="column">
                                            <strong class="">พสร. :</strong>
                                            <span class="has-text-success"><?= '' ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="columns" style="border: .5px dotted green;">
                                <div class="column is-three-fifths">
                                    <strong class="">ปีบำเหน็จ :</strong>
                                    <div class="columns is-multiline">
                                        <div class="column">
                                            <span class="has-text-success"><?= $person['BIOG_BONUS'] ?></span>
                                        </div>
                                        <div class="column">
                                            <span class="has-text-success"><?= $person['BIOG_BONUS0'] ?></span>
                                        </div>
                                        <div class="column">
                                            <span class="has-text-success"><?= $person['BIOG_BONUS1'] ?></span>
                                        </div>
                                        <div class="column">
                                            <span class="has-text-success"><?= $person['BIOG_BONUS2'] ?></span>
                                        </div>
                                        <div class="column">
                                            <span class="has-text-success"><?= $person['BIOG_BONUS3'] ?></span>
                                        </div>
                                        <div class="column">
                                            <span class="has-text-success"><?= $person['BIOG_BONUS4'] ?></span>
                                        </div>
                                        <div class="column">
                                            <span class="has-text-success"><?= $person['BIOG_BONUS_1'] ?></span>
                                        </div>
                                        <div class="column">
                                            <span class="has-text-success"><?= $person['BIOG_BONUS_2'] ?></span>
                                        </div>
                                        <div class="column">
                                            <span class="has-text-success"><?= $person['BIOG_BONUS_3'] ?></span>
                                        </div>
                                        <div class="column">
                                            <span class="has-text-success"><?= $person['BIOG_BONUS_4'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="column is-two-fifths">
                                    <div class="columns">
                                        <div class="column">
                                            <strong class="">รหัสเงินฝ่าอันตราย :</strong>
                                            <span class="has-text-success"><?= $person['BIOG_DANGER_CODE'] ?></span>
                                        </div>
                                        <div class="column">
                                            <strong class="">เงินฝ่าอันตราย :</strong>
                                            <span class="has-text-success"><?= $person['BIOG_DANGER_ADD'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="columns" style="border: .5px dotted green;">
                                <div class="column">
                                    <strong class="">คุณวุฒิที่ใช้ในการบรรจุ :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_UNIT'] ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">ปี :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_UNIT'] ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">สถาบัน :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_UNIT'] ?></span>
                                </div>
                            </div>

                            <div class="columns" style="border: .5px dotted green;">
                                <div class="column">
                                    <strong class="">เครื่องราชฯ :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_DEC'] ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">ปีรับเครื่องราชฯ :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_DECY'] ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">เหรียญ :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_COIN'] ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">ปีรับเหรียญ :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_COINY'] ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">วดป. แก้ไขข้อมูล :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_DMYUPD'] ?></span>
                                </div>
                            </div>

                            <div class="columns" style="border: .5px dotted green;">
                                <div class="column">
                                    <strong class="">สมุดประวัติหน่วย :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_HISBOOK1'] ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">เลขที่สมุประวัติ สบ.ทหาร :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_HISBOOK'] ?></span>
                                </div>
                                <div class="column">
                                    <strong class="">ผู้บันทึกข้อมูล :</strong>
                                    <span class="has-text-success"><?= $person['BIOG_UNIT'] ?></span>
                                </div>
                            </div>

                            <div class="container has-text-right">
                                <button class="button" onclick="window.history.back();">ย้อนกลับ</button>
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
        $("#loading-page").addClass('is-invisible');

    });
</script>