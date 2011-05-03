<div class="parts" id="nicedMemberList">
  <div class="partsHeading">
    <h3><?php echo __('Members who niced %name%', array('%name%'=>$name)); ?></h3>
  </div>
  <?php if($pager->getNbResults()>0): ?>
    <?php slot('pagenavi'); ?>
    <?php op_include_pager_navigation($pager, '@niced_member_list?table='.$table.'&id='.$id.'&page=%s'); ?>
    <?php end_slot(); ?>
    <?php include_slot('pagenavi'); ?>
    <ul>
    <?php foreach($pager->getResults() as $nice): ?>
      <li><?php echo link_to($nice->getMember()->getName(), '@member_profile?id='.$nice->getMemberId()); ?></li>
    <?php endforeach; ?>
    </ul>
    <?php include_slot('pagenavi'); ?>
  <?php else: ?>
    <p><?php echo __('No member niced.'); ?></p>
  <?php endif; ?>
</div>