<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

class EstivoleHelpersHtml
{
	function hoursList($day, $field_name)
	{
		$default = 0;
		
		$hours = array();
		for($i=0; $i<=24; $i++){
			$hours[$day.' 0'.$i.':00:00'] = '0'.$i.':00';
			$hours[$day.' 0'.$i.':30:00'] = '0'.$i.':30';
		};
		
		## Initialize array to store dropdown options ##
		$options = array();
		
		foreach($hours as $key=>$value) :
			## Create $value ##
			$options[] = JHTML::_('select.option', $key, $value);
		endforeach;
		
		## Create <select name="month" class="inputbox"></select> ##
		return JHTML::_('select.genericlist', $options, $field_name, 'class="inputbox" z-index="10"', 'value', 'text', $default);
	}
}