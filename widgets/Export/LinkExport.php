<?php

namespace app\widgets\Export;


use kartik\export\ExportMenu;
use Yii;
use yii\helpers\Url;

class LinkExport
{

    static function getLinkExport($user_id = '', $customer_id = "", $event = "")
    {
        // Get current query parameters
        $queryParams = Yii::$app->getRequest()->getQueryParams();

        // Set export-specific parameters
        $exportParams = [
            'exportType' => ExportMenu::FORMAT_CSV,
            'user_id' => $user_id,
            'customer_id' => $customer_id,
            'event' => $event,
        ];

        // Merge export parameters with existing query parameters
        $mergedParams = array_merge($queryParams, $exportParams);

        // Set the route for exporting
        $mergedParams[0] = 'site/export';

        // Generate the export link
        return Url::to($mergedParams);
    }
}
