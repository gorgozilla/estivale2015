<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
require_once JPATH_COMPONENT . '/models/daytime.php';
  
class EstivoleViewDaytime extends JViewLegacy
{
	function display($tpl=null)
	{

		$app = JFactory::getApplication();
		
		$model = new EstivoleModelDaytime();

		$this->daytimes = $model->listItems();
		$this->state	= $this->get('State');
		$this->daytime		= $this->get('Item');
		$this->form		= $this->get('Form');

		$this->_dayTimeStartList = EstivoleHelpersHtml::hoursList('0000-00-00', 'jform[daytime_hour_start]');
		$this->_dayTimeEndList = EstivoleHelpersHtml::hoursList('0000-00-00', 'jform[daytime_hour_end]');
		
		$this->addToolbar();

		//display
		return parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since   1.6
	 */
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		JToolbarHelper::title(JText::_('Editer un jour/horaire'));

		JToolbarHelper::apply('daytime.apply');
		JToolbarHelper::save('daytime.save');

		if (empty($this->item->id))
		{
			JToolbarHelper::cancel('daytime.cancel');
		}
		else
		{
			JToolbarHelper::cancel('daytime.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}