<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
  require_once JPATH_COMPONENT . '/models/member.php';
  
class EstivoleControllerMember extends JControllerLegacy
{
	public $formData = null;
	public $model = null;
	
	public function execute($task=null)
	{
		$app      = JFactory::getApplication();
		$modelName  = $app->input->get('model', 'Member');
		// Required objects 
		$input = JFactory::getApplication()->input; 
		// Get the form data 
		$this->formData = new JRegistry($input->get('jform','','array')); 

		//Get model class
		$this->model = $this->getModel($modelName);

		if($task=='modifyProfile'){
			$this->modifyProfile($this->formData);
		}else{
			$this->display();
		}
		 //Redirect on referer page
		//$app->redirect( $_SERVER['HTTP_REFERER']);
	}
	
	public function display($cachable = false, $urlparams = false)
	{	
		// Get the document object.
		$document = JFactory::getDocument();

		// Set the default view name and format from the Request.
		$vName   = $this->input->get('view', 'members');
		$vFormat = $document->getType();
		$lName   = $this->input->get('layout', 'default', 'string');
		$this->model = $this->getModel($vName);

		// Get and render the view.
		if ($view = $this->getView($vName, $vFormat))
		{
			// Push the model into the view (as default).
			$view->setModel($this->model, true);
			$view->setLayout($lName);

			// Push document object into the view.
			$view->document = $document;

			$view->display();
		}

		return $this;
	}

	public function modifyProfile($formData)
	{
		$app      = JFactory::getApplication();
		$return = array("success"=>false);
 
		if($this->model->saveMember($formData)){
			$return['success'] = true;
			$return['msg'] = 'Yes';
		}
		$app->redirect( $_SERVER['HTTP_REFERER']);
	}
}