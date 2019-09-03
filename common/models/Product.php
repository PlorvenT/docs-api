<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $guid
 * @property string $title
 * @property string $h1
 * @property string $short_description
 * @property string $meta_description
 * @property string $description
 * @property string $pdf_url
 * @property array $certificates
 * @property string $installation_content
 * @property string $features_content
 * @property string $sizes_content
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['guid', 'title', 'h1', 'short_description', 'meta_description', 'description', 'pdf_url', 'installation_content', 'features_content', 'sizes_content'], 'required'],
            [['description', 'installation_content', 'features_content', 'sizes_content'], 'string'],
            [['certificates'], 'safe'],
            [['guid'], 'string', 'max' => 50],
            [['title', 'h1', 'short_description', 'meta_description', 'pdf_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'guid' => 'Guid',
            'title' => 'Title',
            'h1' => 'H1',
            'short_description' => 'Short Description',
            'meta_description' => 'Meta Description',
            'description' => 'Description',
            'pdf_url' => 'Pdf Url',
            'certificates' => 'Certificates',
            'installation_content' => 'Installation Content',
            'features_content' => 'Features Content',
            'sizes_content' => 'Sizes Content',
        ];
    }
}
