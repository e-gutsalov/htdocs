<?php


namespace components;


use PDO;

class UserProcess
{
    // Переменные для формы
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public bool $result = false;
    public array $errors;
    public bool $isGuest = false;

    /**
     * Регистрация
     */
    public function userRegisterProcess()
    {
        // Обработка формы
        if ( isset( $_POST['submit'] ) ) {
            // Если форма отправлена
            // Получаем данные из формы
            $this->name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $this->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $this->password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            // Валидация полей
            if ( !$this->checkName( $this->name ) ) {
                $this->errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if ( !$this->checkEmail( $this->email ) ) {
                $this->errors[] = 'Неправильный email';
            }
            if ( !$this->checkPassword( $this->password ) ) {
                $this->errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            if ( $this->checkEmailExists( $this->email ) ) {
                $this->errors[] = 'Такой email уже используется';
            }

            if ( empty( $this->errors ) ) {
                // Если ошибок нет
                // Регистрируем пользователя
                $this->result = $this->register( $this->name, $this->email, $this->password );
            }
        }
    }

    /**
     * "Вход на сайт"
     */
    public function userLoginProcess()
    {
        // Обработка формы
        if ( isset( $_POST['submit'] ) ) {
            // Если форма отправлена
            // Получаем данные из формы
            $this->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $this->password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            // Валидация полей
            if ( !$this->checkEmail( $this->email ) ) {
                $this->errors[] = 'Неправильный email';
            }
            if ( !$this->checkPassword( $this->password ) ) {
                $this->errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            // Проверяем существует ли пользователь
            $user = $this->checkUserData( $this->email, $this->password );

            if ( $user == false ) {
                // Если данные неправильные - показываем ошибку
                $this->errors[] = 'Неправильные данные для входа на сайт';
            } else {
                // Если данные правильные, запоминаем пользователя (сессия)
                $this->auth( $user );

                // Перенаправляем пользователя в закрытую часть - кабинет
                header( "Location: /user" );
            }
        }
    }

    /**
     * Action для страницы "Редактирование данных пользователя"
     */
    public function userEditProcess()
    {
        // Обработка формы
        if ( isset( $_POST['submit'] ) ) {
            // Если форма отправлена
            // Получаем данные из формы редактирования
            $this->name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $this->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $this->password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            // Валидация полей
            if ( !$this->checkName( $this->name ) ) {
                $this->errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if ( !$this->checkEmail( $this->email ) ) {
                $this->errors[] = 'Неправильный email';
            }
            if ( !$this->checkPassword( $this->password ) ) {
                $this->errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            if ( empty( $this->errors ) ) {
                // Если ошибок нет, сохраняет изменения профиля
                $this->result = $this->edit( $_SESSION['user']->id, $this->name, $this->email, $this->password );
            }

            // Проверяем существует ли пользователь
            $user = $this->checkUserData( $this->email, $this->password );

            if ( $user == false ) {
                // Если данные неправильные - показываем ошибку
                $this->errors[] = 'Неправильные данные для входа на сайт';
            } else {
                // Если данные правильные, запоминаем пользователя (сессия)
                $this->auth( $user );
            }
        }
    }

    /**
     * Проверяет имя: не меньше, чем 2 символа
     * @param string $name <p>Имя</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public function checkName( string $name )
    {
        if ( strlen( $name ) >= 2 ) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет имя: не меньше, чем 6 символов
     * @param string $password <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public function checkPassword( string $password )
    {
        if ( strlen( $password ) >= 6 ) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет email
     * @param string $email <p>E-mail</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public function checkEmail( string $email )
    {
        if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет не занят ли email другим пользователем
     * @param string $email <p>E-mail</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public function checkEmailExists( string $email )
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT COUNT( * ) FROM users WHERE email = :email';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare( $sql );
        $result->bindParam(':email', $email, PDO::PARAM_STR );
        $result->execute();

        if ( $result->fetchColumn() ){
            return true;
        }
        return false;
    }

    /**
     * Проверяем существует ли пользователь с заданными $email и $password
     * @param string $email <p>E-mail</p>
     * @param string $password <p>Пароль</p>
     * @return mixed : object user id or false
     */
    public function checkUserData( string $email, string $password )
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM users WHERE email = :email';

        // Получение результатов. Используется подготовленный запрос
        $stmt = $db->prepare( $sql );
        $stmt->bindParam( ':email', $email, PDO::PARAM_STR );
        $stmt->execute();

        // Обращаемся к записи
        $user = $stmt->fetch();
        if ( is_object( $user ) ) {
            if ( password_verify( $password, $user->password ) ) {
                $user->password = $password;
                // Если запись существует, возвращаем id пользователя
                return $user;
            }
        }
        return false;
    }

    /**
     * Регистрация пользователя
     * @param string $name <p>Имя</p>
     * @param string $email <p>E-mail</p>
     * @param string $password <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public function register( string $name, string $email, string $password )
    {
        // Соединение с БД
        $db = Db::getConnection();

        $password = password_hash( $password, PASSWORD_BCRYPT);

        // Текст запроса к БД
        $sql = 'INSERT INTO users ( name, email, password ) VALUES ( :name, :email, :password )';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam( ':name', $name, PDO::PARAM_STR );
        $result->bindParam( ':email', $email, PDO::PARAM_STR );
        $result->bindParam( ':password', $password, PDO::PARAM_STR );
        return $result->execute();
    }

    /**
     * Запоминаем пользователя
     * @param object $user <p>id пользователя</p>
     */
    public function auth( object $user )
    {
        // Записываем идентификатор пользователя в сессию
        $_SESSION['user'] = $user;
    }

    /**
     * Возвращает идентификатор пользователя, если он авторизирован.<br/>
     * Иначе перенаправляет на страницу входа
     * <p>Идентификатор пользователя</p>
     */
    public function checkLogged()
    {
        // Если сессия есть, вернем идентификатор пользователя
        if ( !is_object( $_SESSION['user'] ) ) {
            header( 'Location: /user/login' );
        }
    }

    /**
     * Проверяет является ли пользователь гостем
     * <p>Результат выполнения метода</p>
     */
    public function isGuest()
    {
        if ( isset( $_SESSION['user'] ) ) {
            $this->isGuest = false;
        } else {
            $this->isGuest = true;
        }
    }

    /**
     * Возвращает пользователя с указанным id
     * @param integer $id <p>id пользователя</p>
     * @return object <p>Объект с информацией о пользователе</p>
     */
    public function getUserById( $id )
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM users WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare( $sql );
        $result->bindParam( ':id', $id, PDO::PARAM_INT );

        // Указываем, что хотим получить данные в виде массива
        //$result->setFetchMode( PDO::FETCH_ASSOC );
        $result->execute();

        return $result->fetch();
    }

    /**
     * Редактирование данных пользователя
     * @param integer $id <p>id пользователя</p>
     * @param string $name <p>Имя</p>
     * @param string $email <p>Почта</p>
     * @param string $password <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function edit( $id, $name, $email, $password )
    {
        // Соединение с БД
        $db = Db::getConnection();

        $password = password_hash( $password, PASSWORD_BCRYPT );

        // Текст запроса к БД
        $sql = 'UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare( $sql );
        $result->bindParam( ':id', $id, PDO::PARAM_INT );
        $result->bindParam( ':name', $name, PDO::PARAM_STR );
        $result->bindParam( ':email', $email, PDO::PARAM_STR );
        $result->bindParam( ':password', $password, PDO::PARAM_STR );

        return $result->execute();
    }
}
