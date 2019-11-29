<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $guid
 * @property string $title
 * @property string $section_title
 * @property string $h1
 * @property string $short_description
 * @property string $meta_description
 * @property string $description
 * @property string $pdf_url
 * @property array $certificates
 * @property string $installation_content
 * @property string $marking_content
 * @property string $pickup_modal_content
 *
 * @property ProductSize[] $sizes
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
            [['guid', 'title', 'section_title', 'h1', 'short_description', 'meta_description', 'description', 'pdf_url', 'installation_content'], 'required'],
            [['description', 'installation_content', 'marking_content', 'pickup_modal_content'], 'string'],
            [['certificates'], 'safe'],
            [['guid'], 'string', 'max' => 50],
            [['title', 'section_title', 'h1', 'short_description', 'meta_description', 'pdf_url'], 'string', 'max' => 255],
            ['guid', 'unique'],
			[['marking_content', 'pickup_modal_content'], 'trim'],
			[['marking_content', 'pickup_modal_content'], 'default'],
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
            'section_title' => 'Section Title',
            'h1' => 'H1',
            'short_description' => 'Short Description',
            'meta_description' => 'Meta Description',
            'description' => 'Description',
            'pdf_url' => 'Pdf Url',
            'certificates' => 'Certificates',
            'installation_content' => 'Installation Content',
			'marking_content' => 'Marking Content',
			'pickup_modal_content' => 'Pickup Modal Content',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSizes()
    {
        return $this->hasMany(ProductSize::class, ['product_id' => 'id']);
    }
}
