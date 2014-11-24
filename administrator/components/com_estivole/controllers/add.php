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

    $modelName  = 'EstivoleModel'.ucwords($modelName);
  	$model = new $modelName();
   	if ( $row = $model->save($formData) ){
		$app->enqueueMessage('Date ajoutée avec succès!');
  	 }else{
		$app->enqueueMessage('Erreur lors de la création!', 'error');
  	 }
	$app->redirect( $_SERVER['HTTP_REFERER']);
  }
}
