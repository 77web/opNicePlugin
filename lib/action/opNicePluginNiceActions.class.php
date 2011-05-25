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
    else
    {
      $msgs = array();
      if($this->form->hasGlobalErrors())
      {
        foreach($this->form->getGlobalErrors() as $err)
        {
          $msgs[] = (string)$err;
        }
      }
      $this->getUser()->setFlash('error', implode("\n", $msgs));
    }
    $this->redirect( isset($nice) ? $nice->getForeignUrl() : '@homepage');
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
  
  /**
   * list of members who niced to particular content
   */
  public function executeMemberList(sfWebRequest $request)
  {
    $this->id = $request->getParameter('id');
    $this->table = $request->getParameter('table');
    $nice = new Nice();
    $nice->setForeignId($this->id);
    $nice->setForeignTable($this->table);
    $this->forward404Unless($nice->getForeignObject());
    
    $this->name = $nice->getForeignTitle();
    
    $size = 30;
    $this->page = $request->getParameter('page', 1);
    $this->pager = Doctrine::getTable('Nice')->getMemberPager($this->table, $this->id, $size, $this->page);
  }
  
  /**
   * list of contens niced by particular member
   */
  public function executeContentList(sfWebRequest $request)
  {
    $this->member = $this->getUser()->getMember();
    $this->page = $request->getParameter('page', 1);
    $size = 30;
    
    $this->pager = Doctrine::getTable('Nice')->getContentPager($this->member->getId(), $size, $this->page);
  }
}