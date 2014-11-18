<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleViewCalendars extends JViewLegacy
{
	function display($tpl=null)
	{

		$app = JFactory::getApplication();
		$model = new EstivoleModelCalendars();
		$layout = $app->input->get('layout', 'default');

		switch($layout) {
		  case "edit":
			$this->calendar = $model->getItem();

		  default:
			$this->calendars = $model->listItems();
		  break;

		}
		//retrieve task list from model

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