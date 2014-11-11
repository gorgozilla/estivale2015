<h2 class="page-header">Secteurs</h2>
<div class="services" id="service-list">
	<?php for($i=0, $n = count($this->services);$i<$n;$i++) { 
	        $this->_serviceListView->service = $this->services[$i];
	        echo $this->_serviceListView->render();
	} ?>
</div>