<div class="media">
  <a class="pull-left" href="<?php echo JRoute::_('index.php?option=com_estivole&view=service&layout=service&id='.$this->service->service_id); ?>">
    <h3><?php echo $this->service->name; ?></h3>
	</a>
  <div class="media-body">
    <p><?php echo $this->service->summary; ?></p>
  </div>
</div>
<div class="clearfix"></div>
<hr />