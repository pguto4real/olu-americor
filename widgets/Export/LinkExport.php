<?php

namespace app\widgets\Export;

use app\widgets\Export\Export;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class LinkExport
{

    static function getLinkExport($user_id = '', $customer_id = "", $event = "")
    {
        $params = Yii::$app->getRequest()->getQueryParams();

        $params["user_id"] = $user_id;
        $params["customer_id"] = $customer_id;
        $params["event"] = $event;

        $params = ArrayHelper::merge([
            'exportType' => Export::FORMAT_CSV
        ], $params);
        $params[0] = 'site/export';

        return Url::to($params);
    }
}
