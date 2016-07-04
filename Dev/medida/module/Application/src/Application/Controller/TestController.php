<?php
/**
 * Created by PhpStorm.
 * User: walmirlsj
 * Date: 04/07/15
 * Time: 14:05
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TestController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
