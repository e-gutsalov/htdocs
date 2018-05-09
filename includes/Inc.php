<?php

// Проверка логина и пароля
function f_test_lgpass($login, $passw) {
	if (file_exists("log_pass.csv")) {
		$file = fopen("log_pass.csv", "r") or die('Ошибка');
		flock($file, LOCK_SH);
		while (!feof($file)){
			$arr = fgetcsv($file, 0, ';');
			for ($i=0, $c=count($arr); $i<$c; $i++) {
				if ($login == $arr[$i]) {
					for ($i=0, $c=count($arr); $i<$c; $i++) {
						if ($passw == $arr[$i]) {
							flock($file, LOCK_UN);
							fclose($file);
							return(TRUE);
						}
					}
				return(FALSE);
				}
			}
		}
	}
}

class _TestLogPass {
	protected $login;
	protected $passw;
	protected $file;
	public function __construct($login, $passw) {
		$this->login = $login;
		$this->passw = $passw;
	}
	public function ConnectDB() {
		if (file_exists("log_pass.csv")) {
			$this->file = new SplFileObject("log_pass.csv");
			$this->file->flock(LOCK_SH);
		}
	}
	public function Query() {
		while (!$this->file->eof()){
			$arr = $this->file->fgetcsv(";");
			//for ($i=0, $c=count($arr); $i<$c; $i++) {
				if ($this->login == $arr[0]) {
					//for ($i=0, $c=count($arr); $i<$c; $i++) {
						if ($this->passw == $arr[1]) {
							$this->file->flock(LOCK_UN);
							unset($this->file);
							return(TRUE);
						}
					//}
				return(FALSE);
				}
			//}
		}
	}
}
?>