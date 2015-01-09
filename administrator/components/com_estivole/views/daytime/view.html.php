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
		$this->daytime	= $this->daytimes[0];
		$this->form		= $this->get('Form');
		
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

		JToolbarHelper::title(JText::_('Gestion des bénévoles : Editer un jour/horaire'));

		JToolbarHelper::apply('daytime.apply');
		JToolbarHelper::save('daytime.save');

		if (empty($this->item->id))
		{
			JToolbarHelper::cancel('calendar.edit');
		}
		else
		{
			JToolbarHelper::cancel('calendar.edit', 'JTOOLBAR_CLOSE');
		}
	}
}