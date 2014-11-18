<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleControllerDisplay extends JControllerAdmin
{
  public function execute()
  {

    // Get the application
    $app = $this->getApplication();
 
    // Get the document object.
    $document     = JFactory::getDocument();
 
    $viewName     = $app->input->getWord('view', 'members');
    $viewFormat   = $document->getType();
    $layoutName   = $app->input->getWord('layout', 'default');

    $app->input->set('view', $viewName);
 
    // Register the layout paths for the view
    $paths = new SplPriorityQueue;
    $paths->insert(JPATH_COMPONENT . '/views/' . $viewName . '/tmpl', 'normal');
 
    $viewClass  = 'EstivoleViews' . ucfirst($viewName) . ucfirst($viewFormat);
    $modelClass = 'EstivoleModels' . ucfirst($viewName);

    $view = new $viewClass(new $modelClass, $paths);

    $view->setLayout($layoutName);

    // Render our view.
    echo $view->render();
 
    return true;
  }
  public function edit()
  {
	echo 'lol';
  }

}