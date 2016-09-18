<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LogUpload;

/**
 * LogUploadSearch represents the model behind the search form about `app\models\LogUpload`.
 */
class LogUploadSearch extends LogUpload {

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userId', 'type', 'userCreate', 'userUpdate'], 'integer'],
            [['title', 'filename', 'fileori', 'params', 'values', 'warning', 'keys', 'updateDate', 'createDate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = LogUpload::find();

        $pagesize = TblDynagrid::pageMe("LogUpload");
        $pagesizes = empty($pagesize) ? 50 : $pagesize;
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => $pagesizes // in case you want a default pagesize
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'userId' => $this->userId,
            'type' => $this->type,
            'userCreate' => $this->userCreate,
            'userUpdate' => $this->userUpdate,
            'updateDate' => $this->updateDate,
            'createDate' => $this->createDate,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'filename', $this->filename])
                ->andFilterWhere(['like', 'fileori', $this->fileori])
                ->andFilterWhere(['like', 'params', $this->params])
                ->andFilterWhere(['like', 'values', $this->values])
                ->andFilterWhere(['like', 'warning', $this->warning])
                ->andFilterWhere(['like', 'keys', $this->keys]);

        return $dataProvider;
    }

}
