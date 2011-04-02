<?php if($isNiceable): ?>

<form action="<?php echo url_for('@nice_regist'); ?>" method="post" id="NiceForm">
<?php echo $newForm; ?>
<input type="submit" value="<?php echo __('Nice!'); ?>" />
</form>



<?php else: ?>

<?php echo __('Nice!'); ?>

<?php endif; ?>

<?php if($nicedCount>0): ?>
  (<?php echo $nicedCount; ?>)
  <?php foreach($nicedList as $nice): ?>
    <?php echo link_to($nice->getMember()->getName(), '@member_profile?id='.$nice->getMemberId()); ?><?php if($nice->isDeletable($sf_user->getMemberId())): ?>(<form action="<?php echo url_for('@nice_delete?id='.$nice->getId()); ?>" method="post"><?php echo $deleteForm; ?><input type="submit" value="<?php echo __('Delete Nice!'); ?>" /></form>)<?php endif; ?>&nbsp;
  <?php endforeach; ?>
<?php endif; ?>