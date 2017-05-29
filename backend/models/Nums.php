<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nums".
 *
 * @property integer $id
 * @property string $card
 * @property string $dueTime
 * @property integer $remainingTime
 * @property string $remark
 */
class Nums extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nums';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dueTime'], 'safe'],
            [['remainingTime'], 'integer'],
            [['remark'], 'string'],
            [['card'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'card' => '序列号',
            'dueTime' => '到期时间',
            'remainingTime' => '剩余天数',
            'remark' => '备注',
        ];
    }
}
