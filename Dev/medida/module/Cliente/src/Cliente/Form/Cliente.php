<?php
/**
 * Created by PhpStorm.
 * User: walmirlsj
 * Date: 05/07/15
 * Time: 14:48
 */

namespace Cliente\Form;

use Zend\Form\Form;

class Cliente extends Form
{
    public function __construct($options = array())
    {
        parent::__construct('Cliente', $options);
        $this->setInputFilter(new ClienteFilter());
        $this->setAttribute('method', 'post');

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $nome = new \Zend\Form\Element\Text("nome");
        $nome->setLabel("Nome")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'Nome');
        $this->add($nome);

        $sobrenome = new \Zend\Form\Element\Text("sobre_nome");
        $sobrenome->setLabel("Sobrenome")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'Sobrenome');
        $this->add($sobrenome);

        $sexo = new \Zend\Form\Element\Select("sexo");
        $sexo->setLabel("Sexo")
            ->setAttribute('class', 'form-control')
            ->setOptions(array(
                    'empty_option' => '--- Selecione ---',
                    'is_method' => true,
                    'value_options' => array(
                        "1" => "Masculino",
                        "2" => "Feminino"
                    ),
                    'disable_inarray_validator' => true
                )
            );
//        $sexo->setDisableInArrayValidator(true); //corrige bug haystack

        $this->add($sexo);

        $rg = new \Zend\Form\Element\Text("rg");
        $rg->setLabel("RG")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'RG');
        $this->add($rg);

        $cpf = new \Zend\Form\Element\Text("cpf");
        $cpf->setLabel("CPF")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'CPF - 11 digits');
        $this->add($cpf);

        $dataNasc = new \Zend\Form\Element\Date("data_nasc");
        $dataNasc->setLabel("Data de Nascimento")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'Data de Nascimento');
        $this->add($dataNasc);

        $telefone = new \Zend\Form\Element\Text("telefone");
        $telefone->setLabel("Telefone")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'Telefone');
        $this->add($telefone);

        $celular = new \Zend\Form\Element\Text("celular");
        $celular->setLabel("Celular")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'Celular');
        $this->add($celular);

//        $email = new \Zend\Form\Element\Email("email");
//        $email->setLabel("E-mail")
//            ->setAttribute('class', 'form-control')
//            ->setAttribute('placeholder', 'example@dominio.com');
//        $this->add($email);

        $estado = new \Zend\Form\Element\Text("estado");
        $estado->setLabel("Estado")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'Estado');
        $this->add($estado);

        $cidade = new \Zend\Form\Element\Text("cidade");
        $cidade->setLabel("Cidade")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'Cidade');
        $this->add($cidade);

        $endereco = new \Zend\Form\Element\Text("endereco");
        $endereco->setLabel("Endereço")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'Endereço');
        $this->add($endereco);

        $bairro = new \Zend\Form\Element\Text("bairro");
        $bairro->setLabel("Bairro")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'Bairro');
        $this->add($bairro);

        $cep = new \Zend\Form\Element\Text("cep");
        $cep->setLabel("Cep")
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'Cep');
        $this->add($cep);


        $security = new \Zend\Form\Element\Csrf("security");
        $this->add($security);

        $salvar = new \Zend\Form\Element\Submit('submit');
        $salvar->setAttribute('value', 'Salvar')
            ->setAttribute('class', 'btn btn-primary pull-right');
        $this->add($salvar);

    }

}