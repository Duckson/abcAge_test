<?php

namespace app\models;

use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "good".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property Arrival[] $arrivals
 * @property Order[] $orders
 */
class Good extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'good';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
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
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['good_id' => 'id']);
    }

    /**
     * Gets amount of remaining goods.
     *
     * @return int
     */
    public function getCount()
    {
        $count = 0;
        foreach($this->arrivals as $i=>$v){
            if ($v->date <= Yii::$app->session['date']) $count += $v->count;
        };
        foreach($this->orders as $i=>$v){
            if ($v->date <= Yii::$app->session['date']) $count -= $v->count;
        };
        return $count;
    }

    /**
     * Gets current price.
     *
     * @return int
     */
    public function getPrice()
    {
        $orders = 0;
        foreach($this->orders as $i=>$order){
            if ($order->date < Yii::$app->session['date']) $orders += $order->count;
        };
        $price=0;
        foreach($this->getArrivals()->andWhere(['between', 'date', '0000-00-00', Yii::$app->session['date']])->orderBy('date DESC')->all() as $arrival){
            $orders -= $arrival->count;
            if ($orders <= 0) {
                $price = $arrival->price;
                break;
            }
        }

        return $price;
    }


}
