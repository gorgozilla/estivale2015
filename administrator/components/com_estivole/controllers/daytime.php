<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
require_once JPATH_COMPONENT . '/models/daytime.php';
   
class EstivoleControllerDaytime extends JControllerForm
{
	public $formData = null;
	public $model = null;
	
	public function execute($task=null)
	{
		$app      = JFactory::getApplication();
		$modelName  = $app->input->get('model', 'Member');
		// Required objects 
		$input = JFactory::getApplication()->input; 

		//Get model class
		$this->model = $this->getModel($modelName);

		if($task=='changeStatusDaytime'){
			$member_daytime_id = $input->get('member_daytime_id'); 
			$status_id = $input->get('status_id'); 
			$this->changeStatusDaytime($member_daytime_id, $status_id);
			if($status_id==1){
				$app->enqueueMessage('Disponibilité confirmée & validée, le bénévole ne peut plus supprimer cette tranche horaire!');
			}else{
				$app->enqueueMessage('Disponibilité à nouveau en attente, le bénévole peut supprimer la tranche horaire.');
			}
		}elseif($task=='getDaytimesByService'){
				$this->getDaytimesByService($this->calendar_id, $this->service_id);
		}
			
		 //Redirect on referer page
		$app->redirect($_SERVER['HTTP_REFERER']);
	}

	public function changeStatusDaytime($member_daytime_id, $status_id)
	{
		$app      = JFactory::getApplication();
		$this->model = new EstivoleModelDaytime();
		$member_daytime = $this->model->getMemberDaytime($member_daytime_id);
		$return = array("success"=>false);

		if($this->model->changeStatusDaytime($member_daytime_id, $status_id)){
			$return['success'] = true;
			$return['msg'] = 'Yes';
			EstivoleHelpersMail::confirmMemberDaytime($member_daytime->member_id, $member_daytime->service_id, $member_daytime->daytime_id);
		}
	}
	
	public function getDaytimesByService($calendar_id, $service_id)
	{
		$modeldaytime = new estivolemodeldaytime();
		$this->daytimes = $modeldaytime->listitems();
		
		echo json_encode($this->daytimes);
		exit;
	}
}