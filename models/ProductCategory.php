<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_category".
 *
 * @property string $id
 * @property string $name
 * @property string $filename
 * @property string $created_date
 * @property int $active
 *
 * @property Goal[] $goals
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_date'], 'safe'],
            [['active'], 'integer'],
            [['name', 'filename'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'filename' => 'Filename',
            'created_date' => 'Created Date',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoals()
    {
        return $this->hasMany(Goal::className(), ['pro_cat_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ProductCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductCategoryQuery(get_called_class());
    }
}
