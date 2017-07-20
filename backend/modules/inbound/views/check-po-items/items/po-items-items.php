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
                <li><a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;&nbsp;ดูข้อมูล</a>
                </li><li class="divider"></li>
                <!--<li><a href="#approve" onclick="approve('5', 'PO# 2017-07-20 11:29:27', 'อนุมัติใบสั่งซื้อ');"><i class="iconfa-ok"></i>&nbsp;&nbsp;อนุมัติใบสั่งซื้อ</a></li>-->
                <li><a href="#" onclick="init_quick_import('<?= $model['poItemId'] ?>')"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;&nbsp;นำเข้าสินค้า</a></li>
                <li><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;แก้ไข</a></li>
                <li><a href="#delete" onclick="delete_data('1', 'โค๊ก', 'ลบข้อมูล')"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;&nbsp;ลบข้อมูล</a></li>
            </ul>
        </div>
    </td>
</tr>
