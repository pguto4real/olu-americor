<?php

use app\widgets\HistoryList\HistoryList;
use yii\helpers\Html;

?>

<div class="panel panel-primary panel-small m-b-0">
    <div class="panel-body panel-body-selected">

        <div class="pull-sm-right">
            <?php if (!empty($linkExport)) {
                echo Html::a(
                    Yii::t('app', 'CSV'),
                    $linkExport,
                    [
                        'class' => 'btn btn-success',
                        'data-pjax' => 0
                    ]
                );
            } ?>
        </div>

    </div>
</div>


<?= HistoryList::widget([]) ?>