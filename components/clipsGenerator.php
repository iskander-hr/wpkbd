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


class clipsGenerator
{
    /**
     * Генерация кода описания шаблонов фактов (deftemplate).
     */
    public function generateDefTemplate($knowledgebase_id)
    {
        $templates = Template::find()->where(['knowlegebase_id' => $knowledgebase_id])->all();
        $res = ";**************Templates*********************************************************\r\n";
        foreach($templates as $template) {
            $res .= "(deftemplate {$template->shortname} ;{$template->description}\r\n";
            $res .= self::generateDefTemplateSlot($template->id);
            $res .=")\r\n";
        }    
        return $res;
    }

    public function generateDefTemplateSlot($template_id)
    {
        $templateslots = TemplateSlot::find()->where(['template_id' => $template_id])->all();
        $res="";
        foreach($templateslots as $slot) {
            $datavalue =  mb_strtoupper($slot->datavalue);
            if($slot->datatype==2)
                $res .= "(slot {$slot->shortname} (default {$datavalue}));$slot->description\r\n";
            else    
            $res .= "(slot {$slot->shortname} (default \"{$datavalue}\"));$slot->description\r\n"; 
        }  
        
        return $res;
    }


    public function generateDefFact($knowledgebase_id)
    {
        $facts = Fact::find()->where(['knowlegebase_id' => $knowledgebase_id])->all();
        $res = ";**************Facts*************************************************************\r\n";
        $res .= "(deffacts initial-settings\r\n";
        foreach($facts as $fact) {
            $res .= "({$fact->shortname} ;{$fact->description}\r\n";
            $res .= self::generateDefFactSlot($fact->id);
            $res .=")\r\n";
        }
        $res .= ")\r\n";    
        return $res;
    }

    public function generateDefFactSlot($fact_id)
    {
        $factslots = FactSlot::find()->where(['fact_id' => $fact_id])->all();
        $res="";
        foreach($factslots as $slot) {
            $datavalue =  mb_strtoupper($slot->datavalue);
            if($slot->datatype==1)
                $res .= "({$slot->shortname} \"{$datavalue}\")\r\n";
            else    
                $res .= "({$slot->shortname} {$datavalue})\r\n";
        }
        return $res;
    }

    public function generateDefRule($knowledgebase_id)
    {
        $res = ";**************Rules*************************************************************\r\n";
        $rules = Rule::find()->where(['knowlegebase_id' => $knowledgebase_id])->all();
        foreach($rules as $rule) {
            if($rule->description != null)
                $res .= "(defrule {$rule->shortname} \"{$rule->description}\"\r\n";
            else 
            $res .= "(defrule {$rule->shortname}\r\n";                
            
            $res .= self::generateDefRuleSlot($rule->id);
        } 
        //$res .=")\r\n";   
        return $res;
    }


    public function generateDefRuleSlot($rule_id)
    {
        $res ="";
        //condition
        $RuleTemplate = RuleTemplate::find()->where(['rule_id' => $rule_id , 'type'=>1])->all();
        foreach($RuleTemplate as $rt) {
            $template = Template::find()->where(['id' => $rt['template_id']])->one();
            $res .= "({$template['shortname']} ; {$template['description']}\r\n"; //служебное имя шаблона нач.факта 

            $RuleSlot = RuleSlot::find()->where(['ruletemplate_id' => $rt['id']])->all();
            foreach($RuleSlot as $slot) {
                $datavalue =  mb_strtoupper($slot->datavalue);
                if($slot->datatype == 1)
                    $res .= "({$slot->shortname} \"{$datavalue}\")\r\n";
                else 
                    $res .= "({$slot->shortname} {$datavalue})\r\n"; 

                $res .= ")\r\n";  
            }    
            //$res .= ")\r\n";   

        }
        //action
        $res .= "=>\r\n";
        $res .= "(assert \r\n";
        $RuleTemplate = RuleTemplate::find()->where(['rule_id' => $rule_id , 'type'=>2])->all();
        foreach($RuleTemplate as $rt) {
            $template = Template::find()->where(['id' => $rt['template_id']])->one();
            $res .= "({$template['shortname']} ; {$template['description']}\r\n"; //служебное имя шаблона нач.факта 

            $RuleSlot = RuleSlot::find()->where(['ruletemplate_id' => $rt['id']])->all();
            foreach($RuleSlot as $slot) {
                $datavalue =  mb_strtoupper($slot->datavalue);
                if($slot->datatype == 1)
                    $res .= "({$slot->shortname} \"{$datavalue}\")\r\n";
                else 
                    $res .= "({$slot->shortname} {$datavalue})\r\n"; 

            $res .= "))\r\n";      
                
            }    
           
 
        }        
        $res .= ")\r\n";      
        return $res;  
    }

    public function generateCLIPSCode($knowledge_base) 
    {
       // Начальное описание файла базы знаний
       $content =  ";***********************************************************************************\r\n";
       $content .= "; Наименование базы знаний: {$knowledge_base->name}\r\n";
       $content .= ";***********************************************************************************\r\n";
       $content .= "; Описание: {$knowledge_base->description}\r\n";
       $content .=  ";***********************************************************************************\r\n";
       
       $content .= self::generateDefTemplate($knowledge_base->id); 
       $content .= self::generateDefFact($knowledge_base->id); 
       $content .= self::generateDefRule($knowledge_base->id); 

       return $content;
    }
}    