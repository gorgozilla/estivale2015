<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleControllersDefault extends JControllerBase
{
  public function execute()
  {

    // Get the application
    $app = $this->getApplication();

    $params = JComponentHelper::getParams('com_estivole');
    if ($params->get('required_account') == 1) 
    {
        $user = JFactory::getUser();
        if ($user->get('guest'))
        {
            $app->redirect('index.php',JText::_('COM_ESTIVOLE_ACCOUNT_REQUIRED_MSG'));
        }
    }
 
    // Get the document object.
    $document     = JFactory::getDocument();
 
    $viewName     = $app->input->getWord('view', 'profile');
    $viewFormat   = $document->getType();
    $layoutName   = $app->input->getWord('layout', 'list');

    $app->input->set('view', $viewName);
 
    // Register the layout paths for the view
    $paths = new SplPriorityQueue;
    $paths->insert(JPATH_COMPONENT . '/views/' . $viewName . '/tmpl', 'normal');
 
    $viewClass  = 'EstivoleViews' . ucfirst($viewName) . ucfirst($viewFormat);
    $modelClass = 'EstivoleModels' . ucfirst($viewName);

    if (false === class_exists($modelClass))
    {
      $modelClass = 'EstivoleModelsDefault';
    }

    $view = new $viewClass(new $modelClass, $paths);

    $view->setLayout($layoutName);

    // Render our view.
    echo $view->render();
 
    return true;
  }

}