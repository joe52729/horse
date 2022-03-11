<!-- uat evn check -->
<?php if ($_SERVER['SERVER_NAME'] == 'tms.agritw.com' ||
            $_SERVER['SERVER_NAME'] == 'localhost') { ?>

    <div class="text-mark-just-for-uat">
        <?php if ($_SERVER['SERVER_NAME'] == 'localhost') { ?>
        『Notice 注意』 DEV Process Now / 開發環境運行中
        <?php } ?>
        <?php if ($_SERVER['SERVER_NAME'] == 'tms.agritw.com') { ?>
        『Notice 注意』 UAT Process Now / 測試環境運作中
        <?php } ?>
    </div>
    <div class="text-mark-just-for-uat-top"></div>
    <div class="text-mark-just-for-uat-left"></div>
    <div class="text-mark-just-for-uat-right"></div>
    <div class="text-mark-just-for-uat-bottom"></div>
<?php } ?>