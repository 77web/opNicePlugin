<?php

class opNicePluginNiceRemover
{
  public static function listenToDiaryDelete($args)
  {
    $obj = $args['actionInstance']->getVar("diary");
    self::removeNices($obj);
  }
  
  public static function listenToCommunityEventDelete($args)
  {
    $obj = $args['actionInstance']->getVar("communityEvent");
    self::removeNices($obj);
  }
  
  public static function listenToCommunityTopicDelete($args)
  {
    $obj = $args['actionInstance']->getVar("communityTopic");
    self::removeNices($obj);
  }
  
  private function removeNices($obj)
  {
    foreach(Doctrine::getTable('Nice')->getNicedList(get_table($obj, $obj->getId())) as $nice)
    {
      $nice->delete();
    }
  }
}