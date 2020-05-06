<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property string $name
 * @property string $caption
 * @property string $filename
 */
class Images extends \yii\db\ActiveRecord
{
    public $filename;
    public $useless;
    public function getFilename(){
    	   return explode(';', $this->caption)[0];;
    }
    public function setFilename($value){
    	   $this->filename = 'upload/shrek.jpg';
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'caption'], 'required'],
            [['name', 'caption'], 'string', 'max' => 255],
	    [['filename'], 'file', 'extensions' => 'png, jpg'],
	    [['filename'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'File',
            'caption' => 'Caption',
	    'filename' => 'Filename',
        ];
    }
    

    /**
     * {@inheritdoc}
     * @return ImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImagesQuery(get_called_class());
    }


}
