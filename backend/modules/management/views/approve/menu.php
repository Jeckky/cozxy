<li class="<?php echo isset($pending) ? $pending : ''; ?>">
    <a href="<?php echo Yii::$app->homeUrl; ?>management/approve/pending?pending=active" class="uidemo-tabs-default-demo-home">รออนุมัติ</a>
</li>
<li class="<?php echo isset($approved) ? $approved : ''; ?>">
    <a href="<?php echo Yii::$app->homeUrl; ?>management/approve/approved?approved=active" class="uidemo-tabs-default-demo-profile">อนุมัติแล้ว </a>
</li>
<li class="<?php echo isset($modify) ? $modify : ''; ?>">
    <a href="<?php echo Yii::$app->homeUrl; ?>management/approve/modify?modify=active" class="uidemo-tabs-default-demo-modify">แก้ไขที่อนุมัติแล้ว</a>
</li>
<li class="<?php echo isset($review) ? $review : ''; ?>">
    <a href="<?php echo Yii::$app->homeUrl; ?>management/approve/review?review=active" class="uidemo-tabs-default-demo-review">Suppliers หรือ Content ปรับปรุงสินค้า</a>
</li>
