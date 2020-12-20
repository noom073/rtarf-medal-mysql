<div class="has-text-left">
    <a id="side-menu-ctrl" class="has-text-dark">
        <button class="button is-small is-rounded mb-3">Menu</button>
    </a>
</div>
<aside class="menu">
    <p class="menu-label">ข้อมูลพื้นฐาน</p>
    <ul class="menu-list">
        <li><a href="<?= site_url('admin_fundamental/index') ?>">ประวัติบุคคล</a></li>
        <li>
            <a class="has-dropdown">บัญชี <i class="fas fa-angle-down" aria-hidden="true"></i></a>
            <ul class="is-hidden" id="fdmt-report-ul">
                <li><a id="fdmt-report-ul-ribbon" href="<?= site_url('admin_fundamental/ribbon_report') ?>">บัญชีการรับเครื่องราชฯ สายสะพาย</a></li>
                <li><a id="fdmt-report-ul-non-ribbon" href="<?= site_url('admin_fundamental/non_ribbon_report') ?>">บัญชีการรับเครื่องราชฯ ต่ำกว่าสายสะพาย</a></li>
                <li><a id="fdmt-report-ul-not-req-medal" href="<?= site_url('admin_fundamental/not_request_medal') ?>">บัญชีผู้ยังไม่ได้รับเครื่องราชฯ</a></li>
            </ul>
        </li>
    </ul>

    <p class="menu-label">ชั้นสายสะพาย</p>
    <ul class="menu-list">
        <li><a id="people-property-ul-ribbon" href="<?= site_url('admin_ribbon/property_form') ?>">พิมพ์บัญชีแสดงคุณสมบัติ</a></li>
        <li><a id="summarize-name-ul-ribbon" href="<?= site_url('admin_ribbon/summarize_name_form') ?>">พิมพ์สรุปรายชื่อ</a></li>
        <li><a id="amount-person-ul-ribbon" href="<?= site_url('admin_ribbon/ribbon_amount') ?>">พิมพ์สรุปจำนวน</a></li>
        <li><a class="has-text-grey-light" id="save-person-ul-ribbon">บันทึกบัญชีขอเครื่องราชฯ</a></li>
    </ul>

    <p class="menu-label">ชั้นต่ำกว่าสายสะพาย</p>
    <ul class="menu-list">
        <li><a id="people-property-ul-nonribbon" href="<?= site_url('admin_non_ribbon/index') ?>">พิมพ์บัญชีแสดงคุณสมบัติ</a></li>
        <li><a id="summarize-name-ul-nonribbon" href="<?= site_url('admin_non_ribbon/summarize_name') ?>">พิมพ์สรุปรายชื่อ</a></li>
        <li><a id="amount-person-ul-nonribbon" href="<?= site_url('admin_non_ribbon/nonribbon_amount') ?>">พิมพ์สรุปจำนวน</a></li>
        <li><a class="has-text-grey-light" id="save-person-ul-nonribbon" >บันทึกบัญชีขอเครื่องราชฯ</a></li>
    </ul>

    <p class="menu-label">ขอเครื่องราชฯ เพิ่มเติม</p>
    <ul class="menu-list">
        <li>
            <a class="has-dropdown">รอบปกติ ชั้นสายสะพาย <i class="fas fa-angle-down" aria-hidden="true"></i></a>
            <ul class="is-hidden" id="typical-ribbon">
                <li><a id="admin-typical-ribbon-fundation" href="<?= site_url('admin_typical_ribbon/fundation') ?>">รอบปกติ ชั้นสายสะพาย ข้อมูลพื้นฐาน</a></li>
                <li><a id="admin-typical-ribbon-property" href="<?= site_url('admin_typical_ribbon/property') ?>">รอบปกติ ชั้นสายสะพาย พิมพ์บัญชีแสดงคุณสมบัติ</a></li>
                <li><a id="admin-typical-ribbon-summarize-name" href="<?= site_url('admin_typical_ribbon/summarize_name') ?>">รอบปกติ ชั้นสายสะพาย พิมพ์บัญชีสรุปรายชื่อ</a></li>
                <li><a id="admin-typical-ribbon-amount-person" href="<?= site_url('admin_typical_ribbon/ribbon_amount') ?>">รอบปกติ ชั้นสายสะพาย พิมพ์บัญชีสรุปจำนวน</a></li>
            </ul>
        </li>

        <li>
            <a class="has-dropdown">รอบปกติ ชั้นต่ำกว่าสายสะพาย <i class="fas fa-angle-down" aria-hidden="true"></i></a>
            <ul class="is-hidden" id="typical-non-ribbon">
                <li><a id="admin-typical-non-ribbon-fundation" href="<?= site_url('admin_typical_non_ribbon/fundation') ?>">รอบปกติ ชั้นต่ำกว่าสายสะพาย ข้อมูลพื้นฐาน</a></li>
                <li><a id="admin-typical-non-ribbon-property" href="<?= site_url('admin_typical_non_ribbon/property') ?>">รอบปกติ ชั้นต่ำกว่าสายสะพาย พิมพ์บัญชีแสดงคุณสมบัติ</a></li>
                <li><a id="admin-typical-non-ribbon-summarize-name" href="<?= site_url('admin_typical_non_ribbon/summarize_name') ?>">รอบปกติ ชั้นต่ำกว่าสายสะพาย พิมพ์บัญชีสรุปรายชื่อ</a></li>
                <li><a id="admin-typical-non-ribbon-amount-person" href="<?= site_url('admin_typical_non_ribbon/ribbon_amount') ?>">รอบปกติ ชั้นต่ำกว่าสายสะพาย พิมพ์บัญชีสรุปจำนวน</a></li>
            </ul>
        </li>

    </ul>

    <p class="menu-label">ปรับฐานข้อมูลเครื่องราชฯ</p>
    <ul class="menu-list">
        <li><a>ปรับฐานข้อมูลเครื่องราชฯ</a></li>
    </ul>
</aside>

<script>
    $(document).ready(function() {
        $(".has-dropdown").click(function() {
            $(this).siblings("ul").toggleClass('is-hidden');
            
            let angle = $(this).children('i');
            if (angle.hasClass('fa-angle-down')) {
                angle.removeClass('fa-angle-down');
                angle.addClass('fa-angle-up');
            } else {
                angle.removeClass('fa-angle-up');
                angle.addClass('fa-angle-down');                
            }
        });

        $("#side-menu-ctrl").click(function() {
            $("aside.menu").toggleClass('is-hidden');
        });
    });
</script>