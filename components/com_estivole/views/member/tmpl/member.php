<a href="<?php echo JRoute::_('index.php?option=com_estivole&view=member&layout=list'); ?>" class="btn pull-right"><i class="icon icon-chevron-left"></i> <?php echo JText::_('COM_ESTIVOLE_BACK'); ?></a>
<h2 class="page-header"><?php echo $this->member->firstname; ?> <?php echo $this->member->lastname; ?></h2>
<div class="row-fluid">
  <div class="span3">
    <img src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($this->member->email))); ?>?s=180" />
  </div>
  <?php echo $this->member->registerDate; ?>
  <div class="span9 well well-small">
    <dl class="dl-horizontal">
      <dt><?php echo JText::_('COM_ESTIVOLE_PROFILE_NAME'); ?></dt>
      <dd><?php echo $this->member->firstname; ?></dd>
      <dt><?php echo JText::_('COM_ESTIVOLE_PROFILE_JOIN'); ?></dt>
      <dd><?php echo JHtml::_('date', $this->member->registerDate, JText::_('DATE_FORMAT_LC3')); ?></dd>
      <dt><?php echo JText::_('COM_ESTIVOLE_PROFILE_BIO'); ?></dt>
      <dd><?php if(isset($this->member->details['aboutme'])) echo $this->member->details['aboutme']; ?></dd>
    </dl>
  </div>
</div>
<br />