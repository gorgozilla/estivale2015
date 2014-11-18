<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleViewMember extends JViewLegacy
{
	function display($tpl=null)
	{
		$app = JFactory::getApplication();

		$model = new EstivoleModelMember();

		$this->state	= $this->get('State');
		$this->member		= $this->get('Item');
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

		JToolbarHelper::title(JText::_('Editer un secteur'));

		JToolbarHelper::apply('member.apply');
		JToolbarHelper::save('member.save');

		if (empty($this->item->id))
		{
			JToolbarHelper::cancel('member.cancel');
		}
		else
		{
			JToolbarHelper::cancel('member.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}