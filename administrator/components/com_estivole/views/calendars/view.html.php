<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
  require_once JPATH_COMPONENT . '/models/daytime.php';
class EstivoleViewCalendars extends JViewLegacy
{
	function display($tpl=null)
	{

		$app = JFactory::getApplication();
		$model = new EstivoleModelCalendars();
		$layout = $app->input->get('layout', 'default');
		$this->calendars = $model->listItems();

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
        // $canDo  = EstivoleHelpersEstivole::getActions();

        // Get the toolbar object instance
        $bar = JToolBar::getInstance('toolbar');

        JToolbarHelper::title(JText::_('Liste des calendriers'));
               
        // if ($canDo->get('core.admin'))
        // {
            JToolbarHelper::addNew('calendar.add');
			JToolbarHelper::editList();
			JToolbarHelper::cancel();
        // }
    }
}