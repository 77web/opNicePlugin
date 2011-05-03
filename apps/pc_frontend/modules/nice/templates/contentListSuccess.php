<div class="parts" id="niceContentList">
  <div class="partsHeading">
    <h3><?php echo __('%member% niced these.', array('%member%'=>$member->getName())); ?></h3>
  </div>
  <?php if($pager->getNbResults()>0): ?>
    <?php slot('pagenavi'); ?>
    <?php op_include_pager_navigation($pager, '@nice_my_list?page=%s'); ?>
    <?php end_slot(); ?>
    <?php include_slot('pagenavi'); ?>
    <ul>
    <?php foreach($pager->getResults() as $nice): ?>
      <li><?php echo link_to($nice->getForeignTitle(), $nice->getForeignUrl()); ?></li>
    <?php endforeach; ?>
    </ul>
    <?php include_slot('pagenavi'); ?>
  <?php else: ?>
    <p><?php echo __('No content.'); ?></p>
  <?php endif; ?>
</div>