<?php
  namespace App\Http\Controllers;

  use App\User;
  use App\Http\Controllers\Controller;

  class UserController extends Controller {

    var $users;
    var $email;

    public function __construct() {
      $this->user = User::all();
    }
  }
