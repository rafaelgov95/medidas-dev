<?php

namespace User\Form;

use Zend\Form\Form;

class User extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('user', $options);

        $this->setInputFilter(new UserFilter());
        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $nome = new \Zend\Form\Element\Text("login");
        $nome->setLabel("Login: ")
            ->setAttribute('placeholder', 'Entre com o login')
            ->setAttribute('class', 'form-control')
            ->setAttribute('type', 'text');
        $this->add($nome);

        $email = new \Zend\Form\Element\Text("email");
        $email->setLabel("Email: ")
            ->setAttribute('placeholder', 'Entre com o Email')
            ->setAttribute('class', 'form-control')
            ->setAttribute('type', 'email');
        $this->add($email);

        $password = new \Zend\Form\Element\Password("password");
        $password->setLabel("Password: ")
            ->setAttribute('placeholder', 'Entre com a senha')
            ->setAttribute('class', 'form-control')
            ->setAttribute('type', 'password');
        $this->add($password);

        $confirmation = new \Zend\Form\Element\Password("confirmation");
        $confirmation->setLabel("Redigite: ")
            ->setAttribute('placeholder', 'Redigite a senha')
            ->setAttribute('class', 'form-control')
            ->setAttribute('type', 'password');
        $this->add($confirmation);

//        $teste = new \DoctrineModule\Form\Element\ObjectSelect("teste");
//        $teste->setLabel("Teste")
//            ->setAttribute('class', 'form-control')
//            ->setOptions(array(
//                'object_manager' => $em,
//                'target_class' => 'Atleta\Entity\Teste',
//                'property' => 'descricao',
//                'empty_option' => '--- Selecione ---',
//                'is_method' => true,
//                'find_method' => array(
//                    'name' => 'findBy',
//                    'params' => array(
//                        'criteria' => array('id' => ''),
//                        'orderBy' => array('descricao' => 'ASC'),
//                    ),
//                ),
//            ));
//        $this->add($teste);

//        $role = new \Zend\Form\Element\Select("role");
//        $role->setLabel("Tipo de Conta: ")
//                ->setOptions(array('empty_option' => 'Não selecionado', 'is_method' => true))
//            ->setValueOptions(array('2' => 'Atleta', '3' => 'Profissional', '4' => 'Olheiro'))
//            ->setAttribute('type', 'select');
//        $this->add($role);

        //CAPTCHA
        $dirdata = './public';
        //criando um objeto Zend_Captcha_Image
        $captcha = new \Zend\Captcha\Image();
        // quantidade de letras
        $captcha->setWordlen(8);
        // o caminho onde o zend vai armazenar as imagens
        $captcha->setImgDir($dirdata . '/captcha/img');
        //especifica a cada quantas vezes o garbage collector vai rodar para eliminar as imagens inválidas
        $captcha->setGcFreq(10);
        // tempo de expiração em segundos.
        $captcha->setSuffix(".jpg");
        $captcha->setExpiration(60);
        // tamanho da imagem de captcha
        $captcha->setHeight(35);
        // largura da imagem
        $captcha->setWidth('100');
        // o nivel das linhas, quanto maior, mais dificil fica a leitura
        $captcha->setLineNoiseLevel(5);
        // nivel dos pontos
        $captcha->setDotNoiseLevel(14);
        //tamanho da fonte em pixels
        $captcha->setFontSize(15);
        //seta o alt da imagem
        $captcha->setImgAlt("Captcha");
        //seta a url de onde a imagem sera carregada

        $captcha->setImgUrl('/captcha/img/');
//        var_dump($captcha->getImgUrl());die;
        // caminho para a fonte a ser usada
        $captcha->setFont($dirdata . '/captcha/font/arial.ttf');

//        $captchaElement = new \Zend\Form\Element\Captcha('captcha', array(
//            'label' => "Digite o código abaixo",
//            'captcha' => array(
//                'captcha' => $captcha,
//            ),
//        ));
//        $this->add($captchaElement);
        $_captcha = new \Zend\Form\Element\Captcha('captcha');

        $_captcha->setCaptcha($captcha)
            ->setLabel('Validação')
            ->setAttribute('class', 'form-control');
        $this->add($_captcha);

        $csrf = new \Zend\Form\Element\Csrf("security");

        $this->add($csrf);

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn btn-primary pull-right'
            )
        ));


    }

}
