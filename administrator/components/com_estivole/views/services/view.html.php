<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleViewServices extends JViewLegacy
{
	function display($tpl=null)
	{
		$app = JFactory::getApplication();
		$model = new EstivoleModelServices();
		$layout = $app->input->get('layout', 'edit');

		switch($layout) {
		  case "edit":
			$this->service = $model->getItem();

		  default:
			$this->services = $model->listItems();
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

        JToolbarHelper::title(JText::_('Liste des secteurs'));
               
        // if ($canDo->get('core.admin'))
        // {
            JToolbarHelper::addNew('service.add');
			JToolbarHelper::editList();
			JToolbarHelper::cancel();
        // }
    }
}