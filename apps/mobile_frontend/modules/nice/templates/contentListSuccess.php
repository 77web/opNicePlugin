<?php
$options = array();
$options['title'] = __('%member% niced these.', array('%member%'=>$member->getName()));


$list = array();
if($pager->getNbResults()>0)
{
  slot('pagenavi');
  op_include_pager_navigation($pager, '@nice_my_list?page=%s');
  end_slot();
  $options['body'] = get_slot('pagenavi');
  foreach($pager->getResults() as $nice)
  {
      $list[] = link_to($nice->getForeignTitle(), $nice->getForeignUrl());
  }
}
else
{
    $list[] = __('No content.');
}

op_include_list('niceContentList', $list, $options);