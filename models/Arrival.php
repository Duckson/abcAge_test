<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "arrival".
 *
 * @property int $id
 * @property string|null $number
 * @property int $good_id
 * @property int $count
 * @property int $price
 * @property string $date
 *
 * @property Arrival[] $arrivals
 * @property Good $good
 */
class Arrival extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'arrival';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['good_id', 'count', 'price', 'date'], 'required'],
            [['good_id', 'count', 'price'], 'integer'],
            [['date'], 'safe'],
            [['number'], 'string', 'max' => 50],
            [['good_id'], 'exist', 'skipOnError' => false, 'targetClass' => Good::class, 'targetAttribute' => ['good_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Номер Поставки',
            'good_id' => 'Товар',
            'count' => 'Количество',
            'price' => 'Стоимость',
            'date' => 'Дата',
        ];
    }

    /**
     * Gets query for [[Arrivals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArrivals()
    {
        return $this->hasMany(Arrival::class, ['good_id' => 'id']);
    }

    /**
     * Gets query for [[Good]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGood()
    {
        return $this->hasOne(Good::class, ['id' => 'good_id']);
    }
}
