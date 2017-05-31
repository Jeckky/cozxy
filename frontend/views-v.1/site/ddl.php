<?php

use yii\bootstrap\Html;
use yii\web\View;

$this->registerJs("tjq('.select2').select2({
    formatResult: format,
    formatSelection: format,
    escapeMarkup: function(m) { return m; }
});
", View::POS_END, 'my-options');
?>

<script>
    function format(state) {
        if (!state.id)
            return state.text; // optgroup
        return "<i class = '" + state.text + "'></i>" + " " + state.text;
    }
</script>

<?= Html::dropDownList($name, NULL, $dataArray, ['prompt' => $prompt, 'class' => 'select2', 'onchange' => isset($onChange) ? $onChange : "", 'style' => 'width:90%']) ?>