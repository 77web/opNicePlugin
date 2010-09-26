<?php

class opNicePluginNiceActions extends sfActions
{
  public function executeRegist(sfWebRequest $request)
  {
    $this->form = new NiceForm();
    $this->form->bind($request->getParameter($this->form->getName()));
    if($this->form->isValid())
    {
      $nice = $this->form->save();
    }
    $this->redirect($nice->getForeignUrl());
  }
  
  public function executeDelete(sfWebRequest $request)
  {
    $this->nice = Doctrine::getTable('Nice')->find($request->getParameter('id', 0));
    $this->forward404Unless($this->nice && $this->nice->isDeletable($this->getUser()->getMemberId()));
    
    $request->checkCSRFProtection();
    
    $url = $this->nice->getForeignUrl();
    
    $this->nice->delete();
    
    $this->redirect($url);
  }
  
}