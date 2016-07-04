<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function testAction()
    {
        $signin = $this->forward()
            ->dispatch('Testar\Controller\Index', array('action' => 'Index'));

        $signup = $this->forward()
            ->dispatch('Testar\Controller\Index', array('action' => 'Index'));

        $page = new ViewModel();

        $page->addChild($signin, 'signinBlock');
        $page->addChild($signup, 'signupBlock');
        return $page;
    }

    public function indexAction()
    {
        return new ViewModel();
    }
}
