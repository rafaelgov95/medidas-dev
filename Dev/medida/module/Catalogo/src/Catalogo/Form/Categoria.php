<?php
/**
 * Created by PhpStorm.
 * User: walmirlsj
 * Date: 05/07/15
 * Time: 14:48
 */

namespace Catalogo\Form;

use Zend\Form\Form;

class Categoria extends Form
{
    public function __construct($options = array())
    {
        parent::__construct('Categoria', $options);
        $this->setInputFilter(new CategoriaFilter());
        $this->setAttribute('method', 'post');

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $descricao = new \Zend\Form\Element\Text("descricao");
        $descricao->setLabel("Descrição")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'Categoria');
        $this->add($descricao);

        $seccao = new \Zend\Form\Element\Text("seccao");
        $seccao->setLabel("Secção")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'Secção 1');
        $this->add($seccao);

        $security = new \Zend\Form\Element\Csrf("security");
        $this->add($security);

        $salvar = new \Zend\Form\Element\Submit('submit');
        $salvar->setAttribute('value', 'Salvar')
            ->setAttribute('class', 'btn btn-primary pull-right ');
        $this->add($salvar);

    }

}