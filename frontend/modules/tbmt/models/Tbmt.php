<?php

namespace frontend\modules\tbmt\models;

use Yii;

/**
 * This is the model class for table "tbmt".
 *
 * @property integer $id
 * @property string $so_tbmt
 * @property integer $category
 * @property string $loai_tb
 * @property string $linh_vuc
 * @property string $hinh_thuc_tb
 * @property string $goi_thau
 * @property string $thuoc_du_an
 * @property string $nguon_von
 * @property string $ben_mt
 * @property string $hinh_thuc_lua_chon
 * @property string $tg_ban_hs_tu
 * @property string $tg_ban_hs_den
 * @property string $dia_diem
 * @property string $gia_ban
 * @property string $han_cuoi_nhan_hs
 * @property string $hs_moi_thau
 * @property integer $temp_id
 */
class Tbmt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbmt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'temp_id'], 'integer'],
            [['goi_thau', 'thuoc_du_an', 'dia_diem'], 'string'],
            [['so_tbmt'], 'string', 'max' => 50],
            [['loai_tb', 'linh_vuc', 'hinh_thuc_tb', 'tg_ban_hs_tu', 'tg_ban_hs_den', 'gia_ban', 'han_cuoi_nhan_hs', 'hs_moi_thau'], 'string', 'max' => 100],
            [['nguon_von', 'ben_mt', 'hinh_thuc_lua_chon'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'so_tbmt' => 'So Tbmt',
            'category' => 'Category',
            'loai_tb' => 'Loai Tb',
            'linh_vuc' => 'Linh Vuc',
            'hinh_thuc_tb' => 'Hinh Thuc Tb',
            'goi_thau' => 'Goi Thau',
            'thuoc_du_an' => 'Thuoc Du An',
            'nguon_von' => 'Nguon Von',
            'ben_mt' => 'Ben Mt',
            'hinh_thuc_lua_chon' => 'Hinh Thuc Lua Chon',
            'tg_ban_hs_tu' => 'Tg Ban Hs Tu',
            'tg_ban_hs_den' => 'Tg Ban Hs Den',
            'dia_diem' => 'Dia Diem',
            'gia_ban' => 'Gia Ban',
            'han_cuoi_nhan_hs' => 'Han Cuoi Nhan Hs',
            'hs_moi_thau' => 'Hs Moi Thau',
            'temp_id' => 'Temp ID',
        ];
    }
}
