<?php

namespace app\models\search;


use app\models\History;
use Throwable;
use yii\data\ActiveDataProvider;
use yii\db\Exception;

/**
 * HistorySearch represents the model behind the search form about `app\models\History`.
 *
 * @property array $objects
 */
class HistorySearch extends History
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }



    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params The search parameters
     * *
     * * @return ActiveDataProvider The data provider
     */
    public function search($params)
    {
        $query = History::find()->with([
            'customer',
            'user',
            'sms',
            'task',
            'call',
            'fax',
        ]);

        // Filtering based on search parameters
        if (!empty($params)) {
            $query->andFilterWhere([
                'user_id' => $params['user_id'] ?? null,
                'customer_id' => $params['customer_id'] ?? null,
                'event' => $params['event'] ?? null,
            ]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'defaultOrder' => [
                'ins_ts' => SORT_DESC,
                'id' => SORT_DESC,
            ],
        ]);

        // Load search parameters
        $this->load($params);

        return $dataProvider;
    }

    /**
     * Retrieves unique events from the history table.
     *
     * @return array The list of unique events
     * @throws Exception
     */
    static function getUniqueEvents()
    {
        try {
            $sql = "SELECT DISTINCT `event` FROM `history`";
            $command = \Yii::$app->getDb()->createCommand($sql);
            return $command->queryAll();
        } catch (Throwable $e) {
            throw new Exception("Error fetching unique events: " . $e->getMessage());
        }
    }
}
