<?php
/**
 * Created by PhpStorm.
 * User: walmirlsj
 * Date: 05/07/15
 * Time: 14:48
 */

namespace Mandado\Form;
use Zend\Form\Element\File;
use Zend\Form\Form;

class Mandado extends Form
{
    public function __construct($options = array())
    {
        parent::__construct('Mandado', $options);
        $this->setInputFilter(new MandadoFilter());
        $this->setAttribute('method', 'post')
        ->setAttribute('class', '');

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $oficio= new \Zend\Form\Element\Text("oficio");
        $oficio->setLabel("Oficio")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'XXX/2015');
        $this->add($oficio);

        $nome = new \Zend\Form\Element\Text("nome");
        $nome->setLabel("Nome")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'Juliana');
        $this->add($nome);

        $acusado = new \Zend\Form\Element\Text("acusado");
        $acusado->setLabel("Nome Acusado")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'Luiz');
        $this->add($acusado);

        $data = new \Zend\Form\Element\Date("data");
        $data->setLabel("Data")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'Secção 1');
        $this->add($data);

        $telr = new \Zend\Form\Element\Text("telr");
        $telr->setLabel("Telefone Residencial")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', '67-3291-0000');
        $this->add($telr);

        $telc = new \Zend\Form\Element\Text("telc");
        $telc->setLabel("Telefone Celular")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', '67-9950-9900');
        $this->add($telc);

        $estado = new \Zend\Form\Element\Text("estado");
        $estado->setLabel("Estado")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'Mato Grosso Do Sul');
        $this->add($estado);

        $cidade = new \Zend\Form\Element\Text("cidade");
        $cidade->setLabel("Cidade")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'Coxim');
        $this->add($cidade);

        $bairro = new \Zend\Form\Element\Text("bairro");
        $bairro->setLabel("Bairro")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'Flavio Garcia');
        $this->add($bairro);

        $rua = new \Zend\Form\Element\Text("rua");
        $rua->setLabel("Endereço")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'Rua Salvima Maria Do Carmo');
        $this->add($rua);

        $arquivo = new \Zend\Form\Element\File("files");
        $arquivo->setLabel("Arquivo para Uplod" );
        $this->add($arquivo);

        $security = new \Zend\Form\Element\Csrf("security");
        $this->add($security);

        $salvar = new \Zend\Form\Element\Submit('submit');
        $salvar->setAttribute('value', 'Salvar')
            ->setAttribute('class', 'btn btn-primary pull-right ');
        $this->add($salvar);

    }

}