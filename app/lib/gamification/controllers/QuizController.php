<?php namespace lib\gamification\controllers;

class QuizController extends \BaseController {

  public function index() {
    return \View::make('quiz');
  }
}