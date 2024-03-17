<?php

use app\widgets\HistoryFilter\HistoryFilter;
use app\widgets\HistoryList\HistoryList;
use yii\helpers\Html;

$this->title = 'Americor Test';
?>

<div class="site-index" id="grid-pjax">


    <?php
    echo HistoryFilter::widget([]);
    ?>

    <div id="content"></div>

</div>