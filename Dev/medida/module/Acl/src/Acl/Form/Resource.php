<?php

namespace Acl\Form;

use Zend\Form\Form;

class Resource extends Form 
{    
    public function __construct($name = null) 
    {
        parent::__construct('resources');
        
        $this->setAttribute('method', 'post');

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $nome = new \Zend\Form\Element\Text("nome");
        $nome->setLabel("Nome: ")
                ->setAttribute('placeholder', "Entre com o nome");
        $this->add($nome);

        $label = new \Zend\Form\Element\Text("label");
        $label->setLabel("Label: ")
            ->setAttribute('placeholder', "Entre com o nome");
        $this->add($label);

        $route = new \Zend\Form\Element\Text("route");
        $route->setLabel("Rota: ")
            ->setAttribute('placeholder', "rota/default");
        $this->add($route);

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn-success'
            )
        ));
    }

}
