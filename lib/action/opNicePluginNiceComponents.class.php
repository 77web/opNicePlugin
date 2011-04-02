<?php

class opNicePluginNiceComponents extends sfComponents
{
  public function executeShow($request)
  {
    if(isset($this->diary))
    {
      $this->target = $this->diary;
    }
    elseif(isset($this->communityEvent))
    {
      $this->target = $this->communityEvent;
    }
    elseif(isset($this->communityTopic))
    {
      $this->target = $this->communityTopic;
    }
    
    $this->foreignTable = get_class($this->target);
    $this->foreignId = $this->target->getId();
    
    $this->nicedCount = Doctrine::getTable('Nice')->getNicedCount($this->foreignTable, $this->foreignId);
    $this->nicedList = Doctrine::getTable('Nice')->getNicedList($this->foreignTable, $this->foreignId), 5);
    
    $this->isMine = $this->target->getMemberId() == $this->getUser()->getMemberId();
    $this->isAlreadyNiced = $this->getUser()->getMemberId()?Doctrine::getTable('Nice')->isAlreadyNiced($this->getUser()->getMemberId(), $this->foreignTable, $this->foreignId):false;
    
    $this->isNiceable = $this->getUser()->getMemberId() > 0 ? (!$this->isMine && !$this->isAlreadyNiced) : false;
    
    if($this->isNiceable)
    {
      //new form
      $this->newForm = new NiceForm();
      $this->newForm->getObject()->getMemberId($this->getUser()->getMemberId());
    }
    if($this->isAlreadyNiced)
    {
      //for delete
      $this->deleteForm = new BaseForm();
    }
  }
}