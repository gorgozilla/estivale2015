<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleViewsBookHtml extends JViewHtml
{
  function render()
  {
    $app = JFactory::getApplication();
    $layout = $this->getLayout();

    $this->params = JComponentHelper::getParams('com_estivole');

    //retrieve task list from model
    $model = new EstivoleModelsBook();

    if($layout == 'list')
    {
        $this->books = $model->listItems();
        $this->_bookListView = EstivoleHelpersView::load('Book','_entry','phtml');
    } else {
        
        $this->book = $model->getItem();
        
        $this->_addReviewView = EstivoleHelpersView::load('Review','_add','phtml');
        $this->_addReviewView->book = $this->book;
        $this->_addReviewView->user = JFactory::getUser();

        $this->_lendBookView = EstivoleHelpersView::load('Book', '_lend', 'phtml');
        $this->_lendBookView->borrower = $this->book->waitlist_user;
        $this->_lendBookView->book = $this->book;

        $this->_returnBookView = EstivoleHelpersView::load('Book', '_return', 'phtml');
        $this->_returnBookView->borrower = $this->book->waitlist_user;
        $this->_returnBookView->book = $this->book;

        $this->_reviewsView = EstivoleHelpersView::load('Review','list','phtml');
        $this->_reviewsView->reviews = $this->book->reviews;

        $this->_modalMessage = EstivoleHelpersView::load('Profile','_message','phtml');
    }

    //display
    return parent::render();
  } 
}