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
            'so_tbmt' => 'Số TBMT',
            'category' => 'Danh mục',
            'loai_tb' => 'Loại thông báo',
            'linh_vuc' => 'Lĩnh vực',
            'hinh_thuc_tb' => 'Hình thức thông báo',
            'goi_thau' => 'Gói thầu',
            'thuoc_du_an' => 'Thuộc dự án',
            'nguon_von' => 'Nguồn vốn',
            'ben_mt' => 'Bên mời thầu',
            'hinh_thuc_lua_chon' => 'Hình thức lựa chọn',
            'tg_ban_hs_tu' => 'Thời gian bán HS từ',
            'tg_ban_hs_den' => 'Thời gian bán HS đến',
            'dia_diem' => 'Địa điểm',
            'gia_ban' => 'Giá bán',
            'han_cuoi_nhan_hs' => 'Hạn cuối nhận HS',
            'hs_moi_thau' => 'HS mời thầu',
            'temp_id' => 'Temp ID',
            'thoi_diem_dang_tai'    => 'Thời điểm đăng tải',
            'thoi_diem_dong_thau'   => 'Thời điểm đóng thầu',
            'hinh_thuc_du_thau'     => 'Hình thức dự thầu',
        ];
    }
}
