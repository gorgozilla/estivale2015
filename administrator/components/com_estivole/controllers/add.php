<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 require_once JPATH_COMPONENT . '/models/daytime.php';
 
class EstivoleControllerAdd extends JControllerForm
{
  public function execute()
  {
    $app      = JFactory::getApplication();

    $modelName  = $app->input->get('model', 'Member');
	
	// Required objects 
	$input = JFactory::getApplication()->input; 

	// Get the form data 
	$formData = new JRegistry($input->get('jform','','array')); 
	
	//Get model class
    $model  = 'EstivoleModel'.ucwords($modelName);

   	if ( $row = $model->save($formData) ){
		$app->enqueueMessage('Date ajoutée avec succès!');
  	 }else{
		$app->enqueueMessage('Erreur lors de la création!', 'error');
  	 }
	 
	 //Redirect on referer page
	$app->redirect( $_SERVER['HTTP_REFERER']);
  }
}
