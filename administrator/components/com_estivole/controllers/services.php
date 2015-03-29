<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 require_once JPATH_COMPONENT . '/models/service.php';
 
class EstivoleControllerServices extends JControllerAdmin
{
	public $formData = null;
	public $model = null;
	
	public function delete(){
		$app      = JFactory::getApplication();
		$modelName  = $app->input->get('model', 'Service');
		$input = JFactory::getApplication()->input; 

		//Get model class
		$this->model = $this->getModel($modelName);
		
		if($model->delete()){
			$app->enqueueMessage('Disponibilité confirmée & validée, le bénévole ne peut plus supprimer cette tranche horaire!');
		}else{
			$app->enqueueMessage('Problème lors de la suppression du secteur!');
		}
		 
		//Redirect on referer page
		$app->redirect($_SERVER['HTTP_REFERER']);
	}
	/**
	 * Method to provide child classes the opportunity to process after the delete task.
	 *
	 * @param   JModelLegacy  $model  The model for the component
	 * @param   mixed         $ids    array of ids deleted.
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	protected function postDeleteHook(JModelLegacy $model, $ids = null)
	{
	}
}