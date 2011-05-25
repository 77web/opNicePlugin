<?php

/**
 * PluginNice form.
 *
 * @package    opNicePlugin
 * @subpackage form
 * @author     Hiromi Hishida<info@77-web.com>
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginNiceForm extends BaseNiceForm
{
  public function setup()
  {
    parent::setup();
    
    unset($this['id']);
    $this->useFields(array('foreign_id', 'foreign_table'));
    
    $this->setWidget('foreign_id', new sfWidgetFormInputHidden());
    $this->setValidator('foreign_id', new sfValidatorString(array('required'=>true)));
    $this->setWidget('foreign_table', new sfWidgetFormInputHidden());
    $allowedTables = array('Diary', 'CommunityTopic', 'CommunityEvent');
    $this->setValidator('foreign_table', new sfValidatorChoice(array('required'=>true, 'choices'=>$allowedTables), array('invalid'=>'You cannot nice to this content.')));
    
    $validatorForeignObject = new sfValidatorCallback(array('callback' => array($this, 'validateForeignObject')));
    $this->mergePostValidator($validatorForeignObject);
  }
  
  public function validateForeignObject($validator, $values)
  {
    if(!empty($values['foreign_id']) && !empty($values['foreign_table']))
    {
      $obj = Doctrine::getTable($values['foreign_table'])->find($values['foreign_id']);
      if(!$obj || $obj->getMemberId()==$this->getObject()->getMemberId())
      {
        throw new sfValidatorError($validator, 'You cannot nice to this content.');
      }
      
      if(Doctrine::getTable('Nice')->isAlreadyNiced($this->getObject()->getMemberId(), get_class($obj), $obj->getId()))
      {
        throw new sfValidatorError($validator, 'You have already niced this content.');
      }
    }
    return $values;
  }
}
