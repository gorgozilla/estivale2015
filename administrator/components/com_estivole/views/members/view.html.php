<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleViewMembers extends JViewLegacy
{
	function display($tpl=null)
	{
		$app = JFactory::getApplication();

		//retrieve task list from model
		$model = new EstivoleModelMembers();
		$this->members = $model->listItems();

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

        JToolbarHelper::title(JText::_('Liste des membres'));
               
        // if ($canDo->get('core.admin'))
        // {
            JToolbarHelper::addNew('member.add');
			JToolbarHelper::editList();
			JToolbarHelper::cancel();
        // }
    }
}