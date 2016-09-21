<div class="modal fade ledList">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">LED List</h4>
            </div>
            <div class="modal-body">
                <?= \yii\helpers\Html::hiddenInput('slotCode', NULL, ['class' => 'slotCode']); ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>LED</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($leds as $led): ?>
                            <tr>
                                <td><?= \yii\helpers\Html::radio('led', FALSE, ['value' => $led->ledId, 'id' => $led->code, 'class' => 'led']) ?><label for="<?= $led->code ?>">&nbsp; <?= $led->code ?></label></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary " onclick="saveModal('<?= Yii::$app->homeUrl . "store/virtual/add-led-to-slot" ?>')">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->