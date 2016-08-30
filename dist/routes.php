<?php

  /*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
  */
  /**
   */

  if ($app) {
    $app->get('/contato', function (Request $request) use ($app) {
      $nome = $request->get('nome');
      $email = $request->get('email');
      $phone = $request->get('phone');
      $subject = $request->get('subject');
      $mensagem = $request->get('mensagem');
      $to = "cristiano-acosta@hotmail.com";
      $subject = "Contato de: $nome";
      $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <title>Duo Cirurgia Cardio Vascular</title>
        </head>
        <body>
        <table>
            <tr><td>Nome</td><td>' . $nome . '</td></tr>
            <tr><td>Email</td><td>' . $email . '</td></tr>
            <tr><td>Telefone</td><td>' . $phone . '</td></tr>
            <tr><td>Assunto</td><td>' . $subject . '</td></tr>
            <tr><td>Mensagem</td><td>' . nl2br($mensagem) . '</td></tr>
            <tr><td><br></td></tr>
            <tr><td><img width="372" height="179" border="0" src="http://tekoa-test.herokuapp.com/img/header/marca-horizontal.png"></td></tr>
        </table>
        </body>
        </html>';
      /* Montando o cabeçalho da mensagem */
      $headers = "MIME-Version: 1.1" . PHP_EOL;
      $headers .= "Content-type: text/html; charset=iso-8859-1" . PHP_EOL;
      // Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
      $headers .= "From: " . $nome . " <" . $email . ">" . PHP_EOL;
      $headers .= "Return-Path:  " . $email . PHP_EOL;
      // Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
      $headers .= "Reply-To: " . $nome . "<" . $email . ">" . PHP_EOL;
      // Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)
      if (mail($to, $subject, utf8_decode($message), $headers, "-r " . $email . "")) {
        // Se for Postfix
        return new Response('Thank you for your feedback!', 201);
      } else {
        return new Response('Error!', 201);
      }
    });
    /*
     Defina aqui a rota do link 'assine' para chamar o método 'assine' do controler AssinanteController
    */
    $app->get("/newslleter", "Controllers/AssinantesController::assine");
    /*
     Defina aqui a rota do link 'atualizaAssinaturas' para chamar o método 'atualizaAssinaturas' do controler AssinanteController
    */
    $app->get("/newslleter", "Controllers/AssinantesController::atualizaAssinaturas");
  } else {
    /*
     Defina aqui a rota do link 'assine' para chamar o método 'assine' do controler AssinanteController
    */
    Route::get('/', function () {
      return view('welcome');
    });
    /*
     Defina aqui a rota do link 'assine' para chamar o método 'assine' do controler AssinanteController
    */
    //We define a RESTful controller and all its via route//directly
    Route::controller('assinantes', 'AssinantesController');
    Route::post('assine', 'AssinantesController@assine');
    /*
     Defina aqui a rota do link 'atualizaAssinaturas' para chamar o método 'atualizaAssinaturas' do controler AssinanteController
    */
  }
