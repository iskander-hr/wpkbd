<?php
   namespace app\components;
   use yii\base\Behavior;
   use yii\db\ActiveRecord;

   class UppercaseBehavior extends Behavior {
      public function events() {
         return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
         ];
      }
      public function beforeValidate($event) {
         $this->owner->datavalue = strtoupper($this->owner->datavalue);
     }
   }
?>