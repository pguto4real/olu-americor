<?php

namespace app\controllers;

use app\models\search\HistorySearch;
use app\widgets\Export\LinkExport;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            "linkExport" => (new LinkExport())->getLinkExport()
        ]);
    }


    /**
     * @param string $exportType
     * @return string
     */
    public function actionExport($exportType)
    {
        $model = new HistorySearch();

        return $this->render('export', [
            'dataProvider' => $model->search(Yii::$app->request->queryParams),
            'exportType' => $exportType,
            'model' => $model
        ]);
    }

    function actionAjaxlisthistory($user_id = '', $customer_id = "", $event = "")
    {
        return $this->render("ajax_list_history", [
            "linkExport" => (new LinkExport())->getLinkExport(
                $user_id,
                $customer_id,
                $event
            ),
            "user_id" => $user_id,
            "customer_id" => $customer_id,
            "event" => $event
        ]);
    }
}
