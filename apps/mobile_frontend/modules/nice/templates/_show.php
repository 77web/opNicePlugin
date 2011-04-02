<?php if($isNiceable): ?>

<form action="<?php echo url_for('@nice_regist'); ?>" method="post">
<?php echo $newForm; ?>
<input type="submit" value="<?php echo __('Nice!'); ?>" />
</form>



<?php else: ?>

<?php echo __('Nice!'); ?>

<?php endif; ?>

<?php if($nicedCount>0): ?>
  (<?php echo $niceCount; ?>)
  <?php foreach($nicedList as $nice): ?>
    <?php echo link_to($nice->getMember()->getName(), '@member_profile?id='.$nice->getMemberId()); ?><?php if($nice->getMemberId()==$sf_user->getMemberId()): ?><?php echo link_to(__('Delete'), '@nice_delete?id='.$nice->getId()); ?><?php endif; ?>&nbsp;
  <?php endforeach; ?>
<?php endif; ?>