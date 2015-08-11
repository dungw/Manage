<?php

namespace frontend\modules\tbmt\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\tbmt\models\Tbmt;
use common\components\helpers\Convert;

/**
 * TbmtSearch represents the model behind the search form about `frontend\modules\tbmt\models\Tbmt`.
 */
class TbmtSearch extends Tbmt
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category', 'temp_id'], 'integer'],
            [['so_tbmt', 'loai_tb', 'linh_vuc', 'hinh_thuc_tb', 'goi_thau', 'thuoc_du_an', 'nguon_von', 'ben_mt', 'hinh_thuc_lua_chon', 'tg_ban_hs_tu', 'tg_ban_hs_den', 'dia_diem', 'gia_ban', 'han_cuoi_nhan_hs', 'hs_moi_thau'], 'safe'],
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
        $query = Tbmt::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        //category
        if (!$this->category && isset($params['category'])) {
            $this->category = $params['category'];
        }

        //date range && date type
        if (isset($params['date-range']) && $params['date-range'] !== '' && isset($params['date-type']) && $params['date-type'] !== '') {
            $t = explode('-', $params['date-range']);
            if (!empty($t)) {
                $start = strtotime(trim($t[0]) . ' 00:00');
                $end = strtotime(trim($t[1]) . ' 23:59');

                $type = trim($params['date-type']);

                $query->andFilterWhere(['>=', $type, $start]);
                $query->andFilterWhere(['<=', $type, $end]);
            }
        }

        //export by time
        if (isset($_GET['time']) && $_GET['time'] !== '') {
            if ($_GET['time'] == 'today') {
                $range = Convert::currentTimePoints();
            } elseif ($_GET['time'] == 'this-week') {
                $range = Convert::currentWeekTimePoints();
            } elseif ($_GET['time'] == 'this-month') {
                
            }
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category' => $this->category,
            'temp_id' => $this->temp_id,
        ]);

        $query->andFilterWhere(['like', 'so_tbmt', $this->so_tbmt])
            ->andFilterWhere(['like', 'loai_tb', $this->loai_tb])
            ->andFilterWhere(['like', 'linh_vuc', $this->linh_vuc])
            ->andFilterWhere(['like', 'hinh_thuc_tb', $this->hinh_thuc_tb])
            ->andFilterWhere(['like', 'goi_thau', $this->goi_thau])
            ->andFilterWhere(['like', 'thuoc_du_an', $this->thuoc_du_an])
            ->andFilterWhere(['like', 'nguon_von', $this->nguon_von])
            ->andFilterWhere(['like', 'ben_mt', $this->ben_mt])
            ->andFilterWhere(['like', 'hinh_thuc_lua_chon', $this->hinh_thuc_lua_chon])
            ->andFilterWhere(['like', 'tg_ban_hs_tu', $this->tg_ban_hs_tu])
            ->andFilterWhere(['like', 'tg_ban_hs_den', $this->tg_ban_hs_den])
            ->andFilterWhere(['like', 'dia_diem', $this->dia_diem])
            ->andFilterWhere(['like', 'gia_ban', $this->gia_ban])
            ->andFilterWhere(['like', 'han_cuoi_nhan_hs', $this->han_cuoi_nhan_hs])
            ->andFilterWhere(['like', 'hs_moi_thau', $this->hs_moi_thau]);

        return $dataProvider;
    }
}
