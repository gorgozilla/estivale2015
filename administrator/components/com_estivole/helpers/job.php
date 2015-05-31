<?php
// no direct access
defined('_JEXEC') or die;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_content
 */
abstract class JHtmlJob
{
    /**
     * @param   int $value  The state value
     * @param   int $i
     */
    static function publish($value = 0, $i)
    {
        // Array of image, task, title, action
        $states = array(
            0   => array('disabled.png',    'services.publish',  'Unpublished',   'Toggle to publish'),
            1   => array('tick.png',        'services.unpublish',    'Published',     'Toggle to unpublish'),
        );
        $state  = JArrayHelper::getValue($states, (int) $value, $states[1]);
        $html   = JHtml::_('image', 'admin/'.$state[0], JText::_($state[2]), NULL, true);
        //if ($canChange) {
            $html   = '<a href="#" onclick="return listItemTask(\'cb'.$i.'\',\''.$state[1].'\')" title="'.JText::_($state[3]).'">'
                    . $html.'</a>';
        //}

        return $html;
    }
}

?>