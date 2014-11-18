<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleViewsMemberHtml extends JViewHtml
{
  function render()
  {
    $app = JFactory::getApplication();
    $layout = $app->input->get('layout');

    //retrieve task list from model
    $memberModel = new EstivoleModelsMember();

    $this->_modalMessage = EstivoleHelpersView::load('Member','_message','phtml');

    switch($layout) {

      case "member":
        $this->member = $memberModel->getItem();
        // $this->_addBookView = EstivoleHelpersView::load('Book','_add','phtml');

        // $this->_libraryView = EstivoleHelpersView::load('Library','_library','phtml');
        // $this->_libraryView->library = $this->member->library;

        // $this->_waitlistView = EstivoleHelpersView::load('Waitlist','_waitlist','phtml');
        // $this->_waitlistView->waitlist = $this->member->waitlist;

        // $this->_wishlistView = EstivoleHelpersView::load('Wishlist','_wishlist','phtml');
        // $this->_wishlistView->wishlist = $this->member->wishlist;

      break;

      case "list":
      default:
        $this->members = $memberModel->listItems();
        $this->_memberListView = EstivoleHelpersView::load('Member','_entry','phtml');
      break;
	  
      case "edit":
      default:
        $this->member = $memberModel->getItem();
		$this->_modalMessage = EstivoleHelpersView::load('Member','_message','phtml');
      break;

    }

    //display
    return parent::render();
  } 
}