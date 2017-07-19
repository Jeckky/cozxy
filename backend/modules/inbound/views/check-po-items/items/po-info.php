<table class="table table-hover" id="inputs-table">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                สถานะ
            </td>
            <td>
                <span class="label label-warning ticket-label"><?= $model['status'] ?></span>
            </td>
        </tr>

        <tr>
            <td>
                ใบสั่งซื้อ
            </td>
            <td>
                <?= $model['poNo'] ?>
            </td>
        </tr>

        <tr>
            <td>
                ราคา
            </td>
            <td>
                <?= number_format($model['summary'], 2) ?>&nbsp;บาท
            </td>
        </tr>

        <tr>
            <td>
                สถานที่ส่งสินค้า
            </td>
            <td>
                Cozxy Dot Com Co.,Ltd.
            </td>
        </tr>

        <tr>
            <td>
                ผู้ตรวจรับ
            </td>
            <td>
                <?= isset($model['receiveBy']) ? $model['receiveBy'] : 'ไม่พบชื่อ' ?>
            </td>
        </tr>

        <tr>
            <td>
                ผู้จัดเรียง
            </td>
            <td>
                <?= isset($model['arranger']) ? $model['arranger'] : 'ไม่พบชื่อ' ?>
            </td>
        </tr>

        <tr>
            <td>
                ผู้ส่งสินค้า
            </td>
            <td>
                &nbsp;
            </td>
        </tr>

        <tr>
            <td>
                วันสร้าง PO
            </td>
            <td>
                <?= Yii::$app->formatter->asDate($model['createDateTime'], 'long'); ?>
            </td>
        </tr>

        <tr>
            <td>
                กำหนดส่งสินค้า
            </td>
            <td>
                &nbsp;
            </td>
        </tr>

        <tr>
            <td>
                หมายเหตุ
            </td>
            <td>
                &nbsp;
            </td>
        </tr>

    </tbody>
</table>