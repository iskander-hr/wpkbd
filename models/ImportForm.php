<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class ImportForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $ekbFile;

    public function rules()
    {
        return [
           [['ekbFile'], 'file', 'extensions' => 'ekb', 'checkExtensionByMimeType'=>false, 'skipOnEmpty' => false],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->ekbFile->saveAs('../data/' . $this->ekbFile->baseName . '.' . $this->ekbFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
