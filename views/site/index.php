<?php

use app\widgets\HistoryFilter\HistoryFilter;

// Set the page title
$this->title = 'Americor Test';

/**
* Renders the main site index page.
*
* This page includes a history filter widget and an empty content section.
* The content section is intended to be populated dynamically.
*/
?>
<div class="site-index" id="grid-pjax">
    <?php
    // Render the history filter widget
    echo HistoryFilter::widget([]);
    ?>
    <!-- Content section where dynamic content will be loaded -->
    <div id="content"></div>
</div>