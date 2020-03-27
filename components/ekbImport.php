<?php

namespace app\components;

use Yii;
use app\models\Knowlegebase;
use app\models\Template;
use app\models\TemplateSlot;
use app\models\Fact;
use app\models\FactSlot;
use app\models\Grule;
use app\models\GruleTemplate;
use app\models\Rule;
use app\models\RuleTemplate;
use app\models\RuleSlot;
use XMLReader;
use SimpleXMLElement;


class ekbImport 
{
    public $knowlegebase_id; 
  

    public function parcerKnowlegebase($file)
    {
        $xml = simplexml_load_file($file);
              
        Yii::$app->db->createCommand()->insert('knowlegebase', [
            'uin' => Knowlegebase::newUin(),
            'name' => $xml->KnowledgeBase[0]->Name,
            'shortname'=>$xml->KnowledgeBase[0]->ShortName,
            'description' => 'База знаний добавлена из файла',
            'author' => Yii::$app->user->identity->username,
            'created_at' => time(),
            'updated_at' => time(),
        ])->execute();
        $id = Yii::$app->db->getLastInsertID();
        return $id;
    }

    public function parcerTemplate($file,$id) 
    {
        $rxml = new XMLReader();								//Create new XMLReader Object

        if (!$rxml->open($file))   die("Failed to open " .  $file);
                       
        while($rxml->read() && $rxml->name !== 'Template');		//Move to the first product child 
    
        $uin=1;
        while($rxml->name === 'Template')
        {												
            $node = new SimpleXMLElement($rxml->readOuterXML());//Read the current child xml into a SimpleXMLElement                
            
            Yii::$app->db->createCommand()->insert('template', [
                'uin' => 'T00' . $uin,
                'name' => $node->Name,
                'shortname'=> $node->ShortName,
                'description' => $node->Description,
                'knowlegebase_id' => $id,
            ])->execute();
            $template_id = Yii::$app->db->getLastInsertID();
            $uin++;    
            foreach ($node->Slots->Slot as $slot)  {
                Yii::$app->db->createCommand()->insert('template_slot', [
                    'name' => $slot->Name,
                    'shortname'=> $slot->ShortName,
                    'description' => $slot->Description,
                    'datatype' => 1,                  
                    'datavalue' => $slot->Value,
                    'template_id' => $template_id,
                ])->execute();
            }     

            $rxml->next('Template');							//Move to the next product child
        }
               
        $rxml->close();
    }

    public function parcerFact($file,$id) 
    {
        $rxml = new XMLReader();								//Create new XMLReader Object

        if (!$rxml->open($file))   die("Failed to open " .  $file);
                       
        while($rxml->read() && $rxml->name !== 'Fact');		//Move to the first product child 
    
        $uin=1;
        while($rxml->name === 'Fact')
        {												
            $node = new SimpleXMLElement($rxml->readOuterXML());//Read the current child xml into a SimpleXMLElement                
            //Найти id в Template по полю name
            $template = Yii::$app->db->createCommand("SELECT * FROM template WHERE name='" . $node->Name . "' and knowlegebase_id=" . $id)->queryOne();
            $template_id  = $template['id'];
  
            Yii::$app->db->createCommand()->insert('fact', [
                'uin' => 'F00' . $uin,
                'name' => $node->Name,
                'shortname'=> $node->ShortName,
                'description' => $node->Description,
                'knowlegebase_id' => $id,
                'template_id' => $template_id,
            ])->execute();
            $fact_id = Yii::$app->db->getLastInsertID();
            $uin++;    
            foreach ($node->Slots->Slot as $slot)  {
                Yii::$app->db->createCommand()->insert('fact_slot', [
                    'name' => $slot->Name,
                    'shortname'=> $slot->ShortName,
                    'description' => $slot->Description,
                    //'datatype' => $slot->DataType,
                    'datatype' => 1,
                    'datavalue' => $slot->Value,
                    'fact_id' => $fact_id,
                ])->execute();
            }     

            $rxml->next('Fact');							
        }
               
        $rxml->close();
    }

     public function parcerGrule($file,$id) 
    {
        $rxml = new XMLReader();								

        if (!$rxml->open($file))   die("Failed to open " .  $file);
                       
        while($rxml->read() && $rxml->name !== 'GRule');		//Move to the first product child 

        $uin=1;
        while($rxml->name === 'GRule')   {													 
            $node = new SimpleXMLElement($rxml->readOuterXML());//Read the current child xml into a SimpleXMLElement                 
            Yii::$app->db->createCommand()->insert('grule', [
                'uin' => 'G00' . $uin,
                'name' => $node->Name,
                'shortname'=> $node->ShortName,
                'description' => $node->Description,
                'knowlegebase_id' => $id,
            ])->execute();
            $grule_id = Yii::$app->db->getLastInsertID();
            $uin++;    
           
           
            //--- Condition ---
            $c=0;
            $cn="C0";
            while (!empty($node->Conditions->$cn)) {
                $template = Yii::$app->db->createCommand("SELECT * FROM template WHERE shortname='" . $node->Conditions->$cn . "' and knowlegebase_id=" . $id)->queryOne();      
                $template_id  = $template['id'];

                Yii::$app->db->createCommand()->insert('grule_template', [
                    'type' => 1,
                    'template_id'=> $template_id,
                    'grule_id' => $grule_id,
                ])->execute();
                $c++;
                $cn = "C{$c}";
               
            } 
           

            //--- Action ---
 
            $a=0;
            $an="A0";
            while (!empty($node->Actions->$an)) {
               
                $template = Yii::$app->db->createCommand("SELECT * FROM template WHERE shortname='" . $node->Actions->$an . "' and knowlegebase_id=" . $id)->queryOne();
                $template_id  = $template['id'];
                
                Yii::$app->db->createCommand()->insert('grule_template', [
                    'type' => 2,
                    'template_id'=> $template_id,
                    'grule_id' => $grule_id,
                ])->execute();
                $a++;
                $an = "A{$a}";    
            } 
          

            $rxml->next('GRule');							
        }
               
        $rxml->close();
    }

    public function parcerRule($file,$id) 
    {
        $rxml = new XMLReader();								//Create new XMLReader Object

        if (!$rxml->open($file))   die("Failed to open " .  $file);
                       
        while($rxml->read() && $rxml->name !== 'Rule');		//Move to the first product child       
        
        $uin=1;
        while($rxml->name === 'Rule')   {													 
            $node = new SimpleXMLElement($rxml->readOuterXML());//Read the current child xml into a SimpleXMLElement                 
              //Найти id в Grule по полю shortname
             $pos = strripos($node->ShortName, "-");
             if($pos>0)   $shortname = substr($node->ShortName, 0, $pos);   
             else $shortname =  $node->ShortName;
      
             $grule = Yii::$app->db->createCommand("SELECT * FROM grule WHERE shortname='" . $shortname . "' and knowlegebase_id=" . $id)->queryOne();
             $grule_id  = $grule['id'];
      
            Yii::$app->db->createCommand()->insert('rule', [
                'uin' => 'R00' . $uin,
                'name' => $node->Name,
                'shortname'=> $node->ShortName,
                'description' => $node->Description,
                'knowlegebase_id' => $id,
                'grule_id'=>$grule_id
            ])->execute();
            $rule_id = Yii::$app->db->getLastInsertID();
            $uin++;    

            //Condition     
            foreach ($node->Conditions->Condition as $c)   {
                
                $template = Yii::$app->db->createCommand("SELECT * FROM template WHERE name='" . $c->Name . "' and knowlegebase_id=" . $id)->queryOne();
                $template_id  = $template['id'];
                Yii::$app->db->createCommand()->insert('rule_template', [
                    'type' => 1,
                    'template_id' => $template_id,
                    'rule_id'=>$rule_id 
                ])->execute();
                $template_id = Yii::$app->db->getLastInsertID();
             
                foreach ($c->Fact as $fact)  {
                     //echo "{$fact->Name} <br>";
                    foreach ($fact->Slots->Slot as $slot)   {
                         //echo "{$Slot->Name}  - Возможное значение [{$Slot->Value}]<br>";
                         Yii::$app->db->createCommand()->insert('rule_slot', [
                            'name' => $slot->Name,
                            'shortname'=> $slot->ShortName,
                            //'datatype' => $slot->DataType,
                            'datatype' => 1,
                            'datavalue' => $slot->Value,
                            'vardatavalue' => $slot->Value,
                            'ruletemplate_id' => $template_id 
                        ])->execute(); 
                    }
                }
            }          
            //Action
            foreach ($node->Actions->Action as $a)   {    
                $template = Yii::$app->db->createCommand("SELECT * FROM template WHERE name='" . $a->Name . "' and knowlegebase_id=" . $id)->queryOne();
                $template_id  = $template['id'];
                Yii::$app->db->createCommand()->insert('rule_template', [
                    'type' => 2,
                    'template_id' => $template_id,
                    'rule_id'=>$rule_id 
                ])->execute();
                $template_id = Yii::$app->db->getLastInsertID();
             
                foreach ($c->Fact as $fact)  {
                    foreach ($fact->Slots->Slot as $slot)   {
                        Yii::$app->db->createCommand()->insert('rule_slot', [
                            'name' => $slot->Name,
                            'shortname'=> $slot->ShortName,
                            //'datatype' => $slot->DataType,
                          	'datatype' => 1,
                            'datavalue' => $slot->Value,
                            'vardatavalue' => $slot->Value,
                            'ruletemplate_id' => $template_id 
                        ])->execute(); 
                    }
                }
            } 

            $rxml->next('Rule');							
        }
               
        $rxml->close();
    }


    public function EKBtoDB($file)
    {
       
      $knowlegebase_id = self::parcerKnowlegebase($file);
      self::parcerTemplate($file,$knowlegebase_id);
      self::parcerFact($file,$knowlegebase_id);
      self::parcerGrule($file,$knowlegebase_id);
      self::parcerRule($file,$knowlegebase_id);
    }
}