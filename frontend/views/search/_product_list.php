<h3 class="b"><?= strtoupper('category') ?> :: <?= strtoupper($category) ?> (RECOMMENDED)
    <small>
        Sort by price&nbsp;<a href="javascript:sortCozxy(<?php echo $categoryId; ?>,'price')"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
        Sort by brand&nbsp;<a href="javascript:sortCozxy(<?php echo $categoryId; ?>,'brand')"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
        Sort by new product&nbsp;<a href="javascript:sortCozxy(<?php echo $categoryId; ?>,'new')"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
    </small>
</h3>

<div class="row">
    <div class="wf-container">
        <?= yii\helpers\Html::hiddenInput("categoryId", $categoryId); ?>
        <?php
        yii\widgets\Pjax::begin([
            'id' => 'notsale',
            'enablePushState' => false, // to disable push state
            'enableReplaceState' => false, // to disable replace state
            'timeout' => 5000,
            'clientOptions' => [
                'registerClientScript' => "$.pjax.reload({container:'#notsale'});",
                'linkSelector' => '#notsale'
            ]
        ]);
        echo \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => [
                'tag' => false,
            ],
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('@app/themes/cozxy/layouts/product/_product_item', ['model' => $model]);
            },
            'emptyText' => ' ',
            'summaryOptions' => ['class' => 'size18 size16-sm size14-xs text-right'],
            'layout' => "{summary}\n{items}\n<center>{pager}</center>\n",
            //'layout' => "{items}",
            'itemOptions' => [
                'tag' => false,
            ], 'pager' => [
                'firstPageLabel' => 'first',
                'lastPageLabel' => 'last',
                'prevPageLabel' => 'previous',
                'nextPageLabel' => 'next',
                'maxButtonCount' => 3,
            ],
        ]);
        yii\widgets\Pjax::end();
        ?>

    </div>
</div>