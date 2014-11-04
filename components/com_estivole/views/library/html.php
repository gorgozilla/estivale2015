<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleViewsLibraryHtml extends JViewHtml
{
  function render()
  {

    //retrieve list of libraries	 from model
    $libraryModel = new EstivoleModelsLibrary();
    $this->libraries = $libraryModel->listItems();
    
    //display
    return parent::render();
  } 
}