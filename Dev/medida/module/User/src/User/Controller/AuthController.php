<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

use Zend\View\Model\JsonModel;

use User\Form\Login as LoginForm;

/**
 * Class AuthController
 * @package User\Controller
 */
class AuthController extends AbstractActionController
{

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function indexAction()
    {
        $viewmodel = new ViewModel();
        $form = new LoginForm();
        $request = $this->getRequest();
//        $response = $this->getResponse();

        //disable layout if request by Ajax
        $viewmodel->setTerminal($request->isXmlHttpRequest());

        // Criando Storage para gravar sessão da autenticação

        $auth = $this->getServiceLocator()->get("AuthService");

        $error = false;
        if ($auth->hasIdentity()) {
            return $this->redirect()->toRoute("medida"); //strtolower($auth->getIdentity()->getRole())
//            $url = $this->getRequest()->getHeader('Referer')->getUri();
//            $this->redirect()->toUrl($url);
        } else {


//        $role = "Visitante";
//            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
//            $repo = $em->getRepository("\User\Entity\User");

//            $user = $repo->findOneBy(array('id' => $auth->getIdentity()->getId()));


            if ($request->isPost()) {
                $form->setData($request->getPost());
                if ($form->isValid()) {
                    $data = $request->getPost()->toArray();

                    $authAdapter = $this->getServiceLocator()->get("User\Auth\Adapter");

                    $authAdapter->setUsername($data['login']);
                    $authAdapter->setPassword($data['password']);

                    $result = $auth->authenticate($authAdapter);

                    if ($result->isValid()) {
//                        $user = $auth->getIdentity();
//                        $user = $user['user'];
//                        var_dump($result);
                        try {
//                        $historico = new \User\Entity\HistoricoLogin();
//                        $historico->setIp($_SERVER['REMOTE_ADDR']);
//                        $historico->setUser($user);
//                        $this->getEm()->persist($historico);
//                        $this->getEm()->flush();
                        } catch (\Exception $e) {
                            return $this->redirect()->toRoute("medida/auth");
                        }

//                        $auth->write($user, null);

                        return $this->redirect()->toRoute('medida/default', array('controller' => 'medida', 'action' => 'index')); //strtolower($user->getRole()->getNome())
//                        return new JsonModel(array(
//                            'success' => true,
//                        ));

                    } else {

//                        return $response->setContent(\Zend\Json\Json::encode(array(
//                            'success' => false,
//                            'errors' => $result->isValid()
//                        )));
                        $error = true;
                    }
                }
            }
        }

        $viewmodel->setVariables(array(
            'form' => $form,
            'error' => $error,
            'isXmlHttpRequest' => $this->getRequest()->isXmlHttpRequest()));

        return $viewmodel;
    }

    public function validatepostajaxAction()
    {
        $form = new \User\Form\Login();
        $request = $this->getRequest();
        $response = $this->getResponse();

        $messages = array();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if (!$form->isValid()) {
                $errors = $form->getMessages();
                foreach ($errors as $key => $row) {
                    if (!empty($row) && $key != 'submit') {
                        foreach ($row as $keyer => $rower) {
                            //save error(s) per-element that
                            //needed by Javascript
                            $messages[$key][] = $rower;
                        }
                    }
                }
            }

            if (!empty($messages)) {
                $response->setContent(\Zend\Json\Json::encode($messages));
            } else {
                //save to db <span class="wp-smiley wp-emoji wp-emoji-wink" title=";)">;)</span>
//                $this->savetodb($form->getData());
                $response->setContent(\Zend\Json\Json::encode(array('success' => 1)));
            }
        }

        return $response;
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function recoverAction()
    {

        $form = new \User\Form\Recover();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            $data = $request->getPost()->toArray();

//            $error = ($data['role'] >= 2 && $data['role'] <= 4) ? 0 : 1;

//            echo $data['role'];die;
            if ($form->isValid()) {

                $service = $this->getServiceLocator()->get("User\Service\User");

                if ($service->recover($data)) {
                    $this->flashMessenger()
                        ->setNamespace('User')
                        ->addMessage("A nova senha gerada, foi enviado para o seu mail!");
                }

                return $this->redirect()->toRoute('user-auth');
            } else if (!$form->isValid()) {
                $this->flashMessenger()
                    ->setNamespace('User')
                    ->addMessage("Atualize a página e tente novamente!");
            }

        }

        $messages = $this->flashMessenger()
            ->setNamespace('User')
            ->getMessages();

//        return new ViewModel();
        return new ViewModel(array('form' => $form, 'messages' => $messages));
    }

    /**
     * @return \Zend\Http\Response
     */
    public function logoutAction()
    {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage("Auth"));
        $auth->clearIdentity();
//        unset($auth);

        return $this->redirect()->toRoute('home'); //user-auth
//        return $this->redirect()->toRoute("Auth", array("controller" => "Auth", "action" => "index"));
        /** FIXME */
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    private function getEm()
    {
        return $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
    }
}
