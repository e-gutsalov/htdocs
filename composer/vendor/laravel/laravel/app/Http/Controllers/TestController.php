<?php

	namespace App\Http\Controllers;
	
	use App\Http\Controllers\Controller;
	use Illuminate\Http\Request; // подключим класс Request
	
	class TestController extends Controller
	{
		public function show()
		{
			return view('test.show', ['var1' => '1', 'var2' => '2']);
		}
		
		public function form(Request $request)
		{			
			// Выполнится при первом заходе:
			if ($request->isMethod('get')) {
				return view('test.form'); // представление с формой
			}
			
			// Выполнится после отправки формы:
			if ($request->isMethod('post')) {
				$request->flash(); // сохраняем ввод в сессию
				$text = $request->input('text');
				return view('test.form', ['text' => $text]); // представление с результатом
			}
		}
		
		public function show1()
		{
			return 'TestController1';
		}
		
		public function show2($param) // получаем переданный параметр
		{
			return $param; // выводим параметр в браузер
		}
	}