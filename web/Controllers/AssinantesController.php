<?php
  namespace App\Http\Controllers;
  use App\Http\Requests;
  use App\Http\Controllers\Controller;
  //Necessário para obter o ID do usuário
  use Auth;
  //Este model será necessário para a obtenção da informação email de cada usuário assinante
  use User;
  //Este módel será utilizado para verificar se o usuário logado é assinante e se o status esta como pago
  use App\Assinante;
  //Controller das ações dos assinantes
  class AssinantesController extends Controller {
    //Middleware de segurança que só permite que usuários logados executem métodos desta classe
    public function __construct() {
      $this->middleware('auth');
    }
    //The method to show the form to add a new feed
    public function getIndex() {
      //We load a view directly and return it to be served
      return View::make('subscribe_form');
    }
    public function assine(Request $request) {
      /*
      Implemente este método, que verifique se o usuário logado é assinante
      (ou seja, se exista algum registro no model Assinante onde o campo user_id seja igual ao ID do usuário logado
      Caso exista e o campo status do mesmo model seja igual a 'paid', retorna a view "assinantes.ja_assinante"
      passando como parâmetro para a view, o campo creditos do model Assinante
      Caso contrário, retorna a view "assinantes.cadastro"
      OBS: Não esqueça de utilizar eloquent ORM para obter os dados do model Assinante
      Clareza, organização e comentários nos blocos de instruções são boa práticas
      */
      //we check if it's really an AJAX request
      if(Request::ajax()) {
        $validation = Validator::make(Input::all(), array(
            //email field should be required, should be in an email//format, and should be unique
            'email' => 'required|email|unique:newsletter,email'
          )
        );
        if($validation->fails()) {
          return $validation->errors()->first();
        } else {
          $create = \Users::create(array(
            'email' => Input::get('email')
          ));
          //If successful, we will be returning the '1' so the form//understands it's successful
          //or if we encountered an unsuccessful creation attempt,return its info
          return $create?'1':'We could not save your address to oursystem, please try again later';
        }
      } else {
        return Redirect::to('newsletter');
      }
    }
    public function atualizaAssinaturas() {
      /*
      Implemente este método, que deve verificar se a data do prazo de assinatura (campo prazo_assinatura do tipo Date) de
      cada assinante com o campo status igual a pago, é igual à data atual.
      Caso seja, incrementa o campo prazo_assinutura para mais 30 dias e envia email para o usuário
      (obter do model User, o email de cada usuário assinante) agradecendo e informando novo prazo
      OBS: o layout do email deve ser a view "emails.renovaAssinatura", a qual espera a variável $mensagem como parâmetro
      */
      //we check if it's really an AJAX request
      if(Request::ajax()) {
        $validation = Validator::make(Input::all(), array(
            //email field should be required, should be in an email//format, and should be unique
            'email' => 'required|email|unique:subscribers,email'
          )
        );
        if($validation->fails()) {
          return $validation->errors()->first();
        } else {
          $create = \Users::update(array(
            'email' => Input::get('email')
          ));
          //If successful, we will be returning the '1' so the form//understands it's successful
          //or if we encountered an unsuccessful creation attempt,return its info
          return $create?'1':'We could not save your address to oursystem, please try again later';
        }
      } else {
        return Redirect::to('subscribers');
      }
    }
  }
