<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleViewCalendar extends JViewLegacy
{
	function display($tpl=null)
	{
	echo 'lol';
		$app = JFactory::getApplication();

		$model = new EstivoleModelCalendar();

		$this->state	= $this->get('State');
		$this->calendar		= $this->get('Item');
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

		JToolbarHelper::title(JText::_('Editer un calendrier'));

		JToolbarHelper::apply('calendar.apply');
		JToolbarHelper::save('calendar.save');

		if (empty($this->item->id))
		{
			JToolbarHelper::cancel('calendar.cancel');
		}
		else
		{
			JToolbarHelper::cancel('calendar.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}