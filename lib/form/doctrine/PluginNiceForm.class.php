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
    $this->setWidget('foreign_table', new sfWidgetFormInputHidden());
    
    $validatorForeignObject = new sfValidatorCallback(array('callback' => array($this, 'validateForeignObject')));
    $this->mergePostValidator($validatorForeignObject);
  }
  
  public function validateForeignObject($validator, $values)
  {
    $obj = Doctrine::getTable($values['foreign_table'])->find($values['foreign_id']);
    if(!$obj || $obj->getMemberId()==$this->getObject()->getMemberId())
    {
      throw new sfValidatorError($validator, 'invalid target');
    }
    
    if(Doctrine::getTable('Nice')->isAlreadyNiced($this->getObject()->getMemberId(), get_class($obj), $obj->getId()))
    {
      throw new sfValidatorError($validator, 'you have already niced this content');
    }
    return $values;
  }
}
