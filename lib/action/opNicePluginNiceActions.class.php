<?php

class opNicePluginNiceActions extends sfActions
{
  public function executeRegist(sfWebRequest $request)
  {
    $this->form = new NiceForm();
    $this->form->getObject()->setMemberId($this->getUser()->getMemberId());
    $this->form->bind($request->getParameter($this->form->getName()));
    if($this->form->isValid())
    {
      $nice = $this->form->save();
    }
    $this->redirect($nice->getForeignUrl());
  }
  
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    
    $this->nice = $this->getRoute()->getObject();
    $this->forward404Unless($this->nice->isDeletable($this->getUser()->getMemberId()));
    
    $url = $this->nice->getForeignUrl();
    
    $this->nice->delete();
    
    $this->redirect($url);
  }
  
}