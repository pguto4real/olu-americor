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
        return $this->render('index');
    }


    /**
     * @param string $exportType
     * @return string
     */
    public function actionExport($exportType)
    {
        $model = new HistorySearch();
        $dataProvider = $model->search(Yii::$app->request->queryParams);

        return $this->render('export', [
            'dataProvider' => $dataProvider,
            'exportType' => $exportType,
            'model' => $model
        ]);
    }
    /**
     * Renders the AJAX history list.
     *
     * @param string $user_id
     * @param string $customer_id
     * @param string $event
     * @return string
     */
    function actionAjaxlisthistory($user_id = '', $customer_id = "", $event = "")
    {
        $linkExport = (new LinkExport())->getLinkExport($user_id, $customer_id, $event);
        return $this->render("ajax_list_history", compact('linkExport', 'user_id', 'customer_id', 'event'));
    }
}
