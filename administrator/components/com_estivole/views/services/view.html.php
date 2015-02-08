<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
require_once JPATH_COMPONENT . '/helpers/estivole.php';
 
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

		EstivoleHelpersEstivole::addSubmenu('services');
		$this->sidebar = JHtmlSidebar::render();

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

		JToolbarHelper::title(JText::_('Gestion des bénévoles : Secteurs'));
               
        // if ($canDo->get('core.admin'))
        // {
            JToolbarHelper::addNew('service.add');
        // }
    }
}