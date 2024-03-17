<?php

namespace app\widgets\HistoryFilter;

// use kartik\export\ExportMenu;

use app\models\Customer;
use app\models\search\HistorySearch;
use app\models\User;
use Yii;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

class HistoryFilter extends Widget
{

    function run()
    {
        $query = User::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $queryCustomer = Customer::find();
        $dataProviderCustomer = new ActiveDataProvider([
            'query' => $queryCustomer,
        ]);

        $events = HistorySearch::getUniqueEvents();

        return $this->render("main", [
            "users" => $dataProvider->models,
            "events" => $events,
            "customers" => $dataProviderCustomer->models
        ]);
    }
}
