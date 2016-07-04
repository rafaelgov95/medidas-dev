<?php

namespace User\Form;

use Zend\Form\Form;

class Login extends Form
{

    public function __construct($name = null, $options = array()) {
        parent::__construct('Login', $options);
        $this->setInputFilter(new LoginFilter());
        $this->setAttribute('method', 'post')
            ->setAttribute('id','form_login');
//             ->setAttribute("class", "overlay overlay-slidedown");

//        ->setAttribute("style", "navbar-form navbar-left");


        $login = new \Zend\Form\Element\Text("login");
        $login->setLabel("Login: ")
            ->setAttribute('placeholder','Login ou Email')
            ->setAttribute("class", "form-control");
        $this->add($login);

        $password = new \Zend\Form\Element\Password("password");
        $password->setLabel("Password: ")
            ->setAttribute('placeholder','Senha')
            ->setAttribute("class", "form-control");
        $this->add($password);

        $this->add(array(
            'name' => 'submit',
            'type'=>'Zend\Form\Element\Submit',
            'attributes' => array(
                'value'=>'Entrar',
                'class' => 'btn btn-primary btn-lg col-xs-12',
            )
        ));
    }

}