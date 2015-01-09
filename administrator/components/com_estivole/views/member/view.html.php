<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
require_once JPATH_COMPONENT . '/models/daytime.php';
require_once JPATH_COMPONENT . '/models/services.php';

class EstivoleViewMember extends JViewLegacy
{
	function display($tpl=null)
	{
		$app = JFactory::getApplication();

		$model = new EstivoleModelMember();
		$serviceModel = new EstivoleModelServices();

		$this->services = $serviceModel->listItems();

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

		JToolbarHelper::title(JText::_('Gestion des bénévoles : Editer un bénévole'));

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