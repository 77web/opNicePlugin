<?php
$options = array();
$options['title'] = __('Members who niced %name%', array('%name%'=>$name));

if($pager->getNbResults()>0)
{
  slot('pagenavi');
  op_include_pager_navigation($pager, '@niced_member_list?table='.$table.'&id='.$id.'&page=%s');
  end_slot();
  $options['body'] = get_slot('pagenavi');
  foreach($pager->getResults() as $nice)
  {
    $list[] = link_to($nice->getMember()->getName(), '@member_profile?id='.$nice->getMemberId());
  }
}
else
{
  $list[] = __('No member niced.');
}

op_include_list('niceMemberList', $list, $options);