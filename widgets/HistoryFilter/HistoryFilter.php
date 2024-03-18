<?php

namespace app\widgets\HistoryFilter;

// use kartik\export\ExportMenu;

use app\models\Customer;
use app\models\search\HistorySearch;
use app\models\User;
use Throwable;
use Yii;
use yii\base\Widget;
use yii\db\Exception;

class HistoryFilter extends Widget
{
    /**
     * Retrieves data for users, customers, and unique events and renders the filter UI.
     *
     * @return string The rendered filter UI
     * @throws Exception
     */
    public function run()
    {
        try{
            // Fetch users, customers, and unique events in a single database query
        $data = [
            "users" => User::find()->all(),
            "customers" => Customer::find()->all(),
            "events" => HistorySearch::getUniqueEvents(),
        ];

        // Pass the data to the view
        return $this->render("main", $data);
    } catch
        (Throwable $e) {
        // Log the error or handle it appropriately based on your application's requirements
        Yii::error("Error in run(): " . $e->getMessage());
        // You can render an error page or return a user-friendly message
        return $this->render("error", [
            'message' => 'An error occurred while processing your request.',
        ]);

    }
    }
}
