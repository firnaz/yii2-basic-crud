<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "site".
 *
 * @property int $id
 * @property int $id_category
 * @property string $site_name
 * @property string $description
 * @property string $url
 * @property string $author
 * @property int $created_at
 * @property int $updated_at
 */
class Site extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'site';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_category', 'created_at', 'updated_at'], 'integer'],
            [['site_name'], 'required'],
            [['description'], 'string'],
            [['site_name', 'url', 'author'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_category' => 'Id Category',
            'site_name' => 'Site Name',
            'description' => 'Description',
            'url' => 'Url',
            'author' => 'Author',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_category']); 
    }
}
