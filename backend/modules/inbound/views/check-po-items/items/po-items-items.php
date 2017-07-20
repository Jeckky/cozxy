<tr>
    <td>
        <?= ++$index ?>
    </td>
    <td>
        <?= $model['title'] ?>
    </td>
    <td>
        <?= $model['code'] ?>
    </td>
    <td>
        <?= $model['result'] ?>
    </td>
    <td>
        <?= $model['unit'] ?>
    </td>
    <td>
        <?= $model['price'] ?>
    </td>
    <td>
        <div class="btn-group pull-right" id="btn_group1">
            <button class="btn dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="#"><i class="iconfa-info-sign"></i>&nbsp;&nbsp;ดูข้อมูล</a>
                </li><li class="divider"></li>
                <li><a href="<?php echo Yii::$app->homeUrl; ?>inbound/check-po-items/quick-import" onclick="init_quick_import('1')"><i class="iconfa-plus-sign"></i>&nbsp;&nbsp;นำเข้าสินค้า</a></li>
                <li><a href="#"><i class="iconfa-edit"></i>&nbsp;&nbsp;แก้ไข</a></li>
                <li><a href="#delete" onclick="delete_data('1', 'โค๊ก', 'ลบข้อมูล')"><i class="iconfa-trash"></i>&nbsp;&nbsp;ลบข้อมูล</a></li>
            </ul>
        </div>
    </td>
</tr>
