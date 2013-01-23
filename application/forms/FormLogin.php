<?php

class Application_Form_FormLogin extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');

        // Add an email element
        $this->addElement('text', 'login', array(
            'label'      => 'Login',
            'required'   => true,
            'filters'    => array('StringTrim')

        ));

        // Add an email element
        $this->addElement('password', 'senha', array(
                'label'      => 'Senha',
                'required'   => true,
                'filters'    => array('StringTrim'),

        ));

        // Add a captcha
     /*   $this->addElement('captcha', 'captcha', array(
            'label'      => 'Por favor insira os caracteres exibidos abaixo:',
            'required'   => true,
            'captcha'    => array(
                'captcha' => 'Figlet',
                'wordLen' => 5,
                'timeout' => 300
            )
        ));*/

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Logar',
        ));

    }
}
