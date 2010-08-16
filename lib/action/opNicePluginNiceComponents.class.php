<?php

class opNicePluginNiceComponents extends sfComponents
{
  public function executeShow($request)
  {
    $this->form = new sfForm();
  }
}