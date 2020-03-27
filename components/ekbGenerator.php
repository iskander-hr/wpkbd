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


class ekbGenerator
{
    public function ekbKnowlegebase($knowledgebase_id) 
    {
        $knowlegebase = Knowlegebase::find()->where(['id' => $knowledgebase_id])->one();
 
        return "<Structure>".
               "\n<KnowledgeBase>".
               "\n\t<ID>" . $knowlegebase->id . strtotime($knowlegebase->created_at) ."</ID>".
               "\n\t<Name>{$knowlegebase->name}</Name>".
               "\n\t<ShortName>{$knowlegebase->shortname}</ShortName>".
               "\n\t<Kind>0</Kind>".
               "\n\t<Description>{$knowlegebase->description}</Description>".
               "\n<Vars/>";
    }

    public function ekbTemplate($knowledgebase_id) 
    {
       $templates = Template::find()->where(['knowlegebase_id' => $knowledgebase_id])->all();
       $str ="\n<Templates>"; 
       foreach($templates as $template) {
          $str .=  "\n<Template>" . 
          "\n\t<ID>{$template->uin}</ID>" .
          "\n\t<Name>{$template->name}</Name>".
          "\n\t<ShortName>{$template->shortname}</ShortName>".
          "\n\t<Description>{$template->description}</Description>".
          "\n\t<PackageName></PackageName>".
          "\n\t<RootPackageName></RootPackageName>".
          "\n\t<DrawParams></DrawParams>";
          $str = $str . $this->ekbTemplateSlot($template->id); 
          $str .= "\n</Template>";    
       }
       $str .= "\n</Templates>";
       return $str;
    }
   
    public function ekbTemplateSlot($template_id) 
    {
       $templateslots = TemplateSlot::find()->where(['template_id' => $template_id])->all();
       $str ="\n\t<Slots>"; 
       foreach($templateslots as $slot) {
          $str .=  "\n\t\t<Slot>" . 
          "\n\t\t\t<Name>{$slot->name}</Name>".
          "\n\t\t\t<ShortName>{$slot->shortname}</ShortName>".
          "\n\t\t\t<Description>{$slot->description}</Description>".
          "\n\t\t\t<Value>{$slot->datavalue}</Value>".
          "\n\t\t\t<DataType>".($slot->datatype == 1 ? 'String' : 'Number') ."</DataType>".
          "\n\t\t\t<Constraint></Constraint>".
          "\n\t\t</Slot>";    
       }
       $str .= "\n\t</Slots>";
       return $str;
    }
   
    public function ekbFact($knowledgebase_id) 
    {
       $facts = Fact::find()->where(['knowlegebase_id' => $knowledgebase_id])->all();
       $str ="\n<Facts>"; 
       foreach($facts as $fact) {
          $str .=  "\n<Fact>" . 
          "\n\t<ID>{$fact->uin}</ID>" .
          "\n\t<Name>{$fact->name}</Name>".
          "\n\t<ShortName>{$fact->shortname}</ShortName>".
          "\n\t<Mode>1</Mode>".
          "\n\t<Description>{$fact->description}</Description>".
          "\n\t<PackageName></PackageName>".
          "\n\t<RootPackageName></RootPackageName>".
          "\n\t<DrawParams></DrawParams>";
          $str = $str . $this->ekbFactSlot($fact->id); 
          $str .= "\n</Fact>";    
       }
       $str .= "\n</Facts>";
       return $str; 
    }
   
    public function ekbFactSlot($fact_id) 
    {
       $factslots = FactSlot::find()->where(['fact_id' => $fact_id])->all();
       $str ="\n\t<Slots>"; 
       foreach($factslots as $slot) {
          $str .=  "\n\t\t<Slot>" . 
          "\n\t\t\t<Name>{$slot->name}</Name>".
          "\n\t\t\t<ShortName>{$slot->shortname}</ShortName>".
          "\n\t\t\t<Description>{$slot->description}</Description>".
          "\n\t\t\t<Value>{$slot->datavalue}</Value>".
          "\n\t\t\t<DataType>".($slot->datatype == 1 ? 'String' : 'Number') ."</DataType>".
          "\n\t\t\t<Constraint></Constraint>".
          "\n\t\t</Slot>";    
       }
       $str .= "\n\t</Slots>";
       return $str;
    }
   

    public function ekbGrule($knowledgebase_id) 
    {
        $grules = Grule::find()->where(['knowlegebase_id' => $knowledgebase_id])->all();
        $str ="\n<Grules>"; 
        foreach($grules as $grule) {
            $str .=  "\n<Grule>" . 
            "\n\t<ID>{$grule->uin}</ID>" .
            "\n\t<Name>{$grule->name}</Name>".
            "\n\t<ShortName>{$grule->shortname}</ShortName>".
            "\n\t<Description>{$grule->description}</Description>".
            "\n\t<PackageName></PackageName>".
            "\n\t<RootPackageName></RootPackageName>".
            "\n\t<DrawParams></DrawParams>";
            $str = $str . $this->ekbGruleTemplate($grule->id); 
            $str .= "\n</Grule>";    
        }
        $str .= "\n</Grules>";
        return $str; 
    }


    public function ekbGruleTemplate($grule_id)    
    {
        //condition
        $GruleTemplate = GruleTemplate::find()->where(['grule_id' => $grule_id, 'type'=> 1])->all();
        $str ="\n\t<Conditions>"; 
        $i=0;
        foreach($GruleTemplate as $gt) {
            $template = Template::find()->where(['id' => $gt['template_id']])->one();
            $str .= "\n\t\t<C{$i}>{$template['shortname']}</C{$i}>";
            $i++;
        }
        $str .= "\n\t</Conditions>";
        
        //action
        $GruleTemplate = GruleTemplate::find()->where(['grule_id' => $grule_id, 'type'=> 2])->all();
        $str .="\n\t<Actions>"; 
        $i=0;
        foreach($GruleTemplate  as $gt) {
            $template = Template::find()->where(['id' => $gt['template_id']])->one();
            $str .= "\n\t\t<A{$i}>{$template['shortname']}</A{$i}>";
            $i++;
        }
        $str .= "\n\t</Actions>";
        
        return $str;
    }

    public function ekbRule($knowledgebase_id) 
    {
        $Rules = Rule::find()->where(['knowlegebase_id' => $knowledgebase_id])->all();
        $str ="\n<Rules>"; 
        foreach($Rules as $rule) {
            $str .=  "\n<Rule>" . 
            "\n\t<ID>{$rule->uin}</ID>" .
            "\n\t<Name>{$rule->name}</Name>".
            "\n\t<ShortName>{$rule->shortname}</ShortName>".
            "\n\t<Description>{$rule->description}</Description>".
            "\n\t<Salience>0</Salience>".
		    "\n\t<PackageName></PackageName>".
            "\n\t<RootPackageName></RootPackageName>";
            $str = $str . $this->ekbRuleTemplate($rule->id); 
            $str .= "\n</Rule>";    
        }
        $str .= "\n</Rules>";
        return $str; 
    }

    public function ekbRuleTemplate($rule_id) 
    {
        $RuleTemplate = RuleTemplate::find()->where(['rule_id' => $rule_id , 'type'=>1])->all();
        $str ="\n\t<Conditions>"; 
        foreach($RuleTemplate as $rt) {
            $RuleSlot = RuleSlot::find()->where(['ruletemplate_id' => $rt['id']])->all();
            foreach($RuleSlot as $slot) {
                $str .=  "\n\t\t<Condition>" . 
                "\n\t\t\t<Name>{$slot->name}</Name>".
                "\n\t\t\t<Operator>and</Operator>".
                "\n\t\t\t<Fact>".
                "\n\t\t\t\t<ID></ID>".
                "\n\t\t\t\t<Name>{$slot->name}</Name>".
                "\n\t\t\t\t<ShortName>{$slot->shortname}</ShortName>".
                "\n\t\t\t\t<Mode>1</Mode>".
                "\n\t\t\t\t<PackageName></PackageName>".
                "\n\t\t\t\t<DrawParams></DrawParams>".
                "\n\t\t\t\t<Slots>".
                "\n\t\t\t\t\t<Slot>".
                "\n\t\t\t\t\t<Name>{$slot->name}</Name>".
                "\n\t\t\t\t\t<ShortName>{$slot->shortname}</ShortName>".
                "\n\t\t\t\t\t<Description></Description>".
                "\n\t\t\t\t\t<Value>{$slot->datavalue}</Value>".
                "\n\t\t\t\t\t<DataType>{$slot->datatype}</DataType>".
                "\n\t\t\t\t\t<Constraint></Constraint>".
                "\n\t\t\t\t\t</Slot>".
                "\n\t\t\t\t</Slots>".
                "\n\t\t\t</Fact>".
                "\n\t\t</Condition>";
            }
            $str .= "\n\t</Conditions>";
        }
        
        $RuleTemplate = RuleTemplate::find()->where(['rule_id' => $rule_id , 'type'=>2])->all();
        $str .="\n\t<Actions>"; 
        foreach($RuleTemplate as $rt) {
            $RuleSlot = RuleSlot::find()->where(['ruletemplate_id' => $rt['id']])->all();
            foreach($RuleSlot as $slot) {
                $str .=  "\n\t\t<Action>" . 
                "\n\t\t\t<Name>{$slot->name}</Name>".
                "\n\t\t\t<Operator>add</Operator>".
                "\n\t\t\t<Fact>".
                "\n\t\t\t\t<ID></ID>".
                "\n\t\t\t\t<Name>{$slot->name}</Name>".
                "\n\t\t\t\t<ShortName>{$slot->shortname}</ShortName>".
                "\n\t\t\t\t<Mode>1</Mode>".
                "\n\t\t\t\t<PackageName></PackageName>".
                "\n\t\t\t\t<DrawParams></DrawParams>".
                "\n\t\t\t\t<Slots>".
                "\n\t\t\t\t\t<Slot>".
                "\n\t\t\t\t\t<Name>{$slot->name}</Name>".
                "\n\t\t\t\t\t<ShortName>{$slot->shortname}</ShortName>".
                "\n\t\t\t\t\t<Description></Description>".
                "\n\t\t\t\t\t<Value>{$slot->datavalue}</Value>".
                "\n\t\t\t\t\t<DataType>{$slot->datatype}</DataType>".
                "\n\t\t\t\t\t<Constraint></Constraint>".
                "\n\t\t\t\t\t</Slot>".
                "\n\t\t\t\t</Slots>".
                "\n\t\t\t</Fact>".
                "\n\t\t</Action>";
         
             }
             $str .= "\n\t</Actions>";
        }    

        return $str;
    }


  
    public function generateEKBCode($knowledge_base)
    {
  
      $content = self::ekbKnowlegebase($knowledge_base->id) . 
                 $this->ekbTemplate($knowledge_base->id) . 
                 $this->ekbFact($knowledge_base->id) . 
                 $this->ekbGrule($knowledge_base->id) . 
                 $this->ekbRule($knowledge_base->id) . 
      "\n<Functions/>\n<Tasks/>\n<TempPackageList/>\n<FactPackageList/>\n<RulePackageList/>\n<GRulePackageList/>\n</KnowledgeBase>\n</Structure>";
     
      return $content;
  
   }
} 