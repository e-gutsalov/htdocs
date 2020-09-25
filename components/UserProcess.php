<?php


namespace components;


use models\OrderModel;
use PDO;

class UserProcess
{
    private object $db;
    // Переменные для формы
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $phone = '';
    public string $comment = '';
    public string $address = '';
    public bool $result = false;
    public array $errors;
    public array $ordersList = [];
    public object $ordersDetails;

    public function __construct()
    {
        // Соединение с БД
        $this->db = Db::getConnection();
    }

    /**
     * Регистрация
     */
    public function userRegisterProcess() : void
    {
        // Обработка формы
        if ( isset( $_POST[ 'submit' ] ) ) {

            // Валидация полей
            if ( !$this->checkName() ) {
                $this->errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if ( !$this->checkEmail() ) {
                $this->errors[] = 'Неправильный email';
            }
            if ( !$this->checkPassword() ) {
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
    public function userLoginProcess() : void
    {
        // Обработка формы
        if ( isset( $_POST[ 'submit' ] ) ) {

            // Валидация полей
            if ( !$this->checkEmail() ) {
                $this->errors[] = 'Неправильный email';
            }
            if ( !$this->checkPassword() ) {
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
    public function userEditProcess() : void
    {
        // Обработка формы
        if ( isset( $_POST[ 'submit' ] ) ) {

            // Валидация полей
            if ( !$this->checkName() ) {
                $this->errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if ( !$this->checkEmail() ) {
                $this->errors[] = 'Неправильный email';
            }
            if ( !$this->checkPassword() ) {
                $this->errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            if ( empty( $this->errors ) ) {
                // Если ошибок нет, сохраняет изменения профиля
                $this->result = $this->edit( $_SESSION[ 'user' ]->id, $this->name, $this->email, $this->password );
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
     * @return boolean <p>Результат выполнения метода</p>
     */
    public function checkName() : bool
    {
        // Если форма отправлена
        // Получаем данные из формы
        $this->name = filter_input( INPUT_POST, 'InputName', FILTER_SANITIZE_STRING );
        if ( strlen( $this->name ) >= 2 ) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет имя: не меньше, чем 6 символов
     * @return boolean <p>Результат выполнения метода</p>
     */
    public function checkPassword() : bool
    {
        // Если форма отправлена
        // Получаем данные из формы
        $this->password = filter_input( INPUT_POST, 'InputPassword', FILTER_SANITIZE_STRING );
        if ( strlen( $this->password ) >= 6 ) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет email
     * @return boolean <p>Результат выполнения метода</p>
     */
    public function checkEmail() : bool
    {
        // Если форма отправлена
        // Получаем данные из формы
        $this->email = filter_input( INPUT_POST, 'InputEmail', FILTER_SANITIZE_EMAIL );
        if ( filter_var( $this->email, FILTER_VALIDATE_EMAIL ) ) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет телефон: не меньше, чем 20 символов
     * @return boolean <p>Результат выполнения метода</p>
     */
    public function checkPhone() : bool
    {
        // Если форма отправлена
        // Получаем данные из формы
        $this->phone = filter_input( INPUT_POST, 'InputPhone', FILTER_SANITIZE_NUMBER_INT );
        if ( strlen( $this->phone ) >= 7 and strlen( $this->phone ) <= 20 ) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет адрес доставки пользователя
     * @return boolean <p>Результат выполнения метода</p>
     */
    public function checkAddress() : bool
    {
        // Если форма отправлена
        // Получаем данные из формы
        $this->address = filter_input( INPUT_POST, 'InputAddress', FILTER_SANITIZE_STRING );
        if ( strlen( $this->address ) > 0 and strlen( $this->address ) <= 555 ) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет комментарий пользователя
     * @return boolean <p>Результат выполнения метода</p>
     */
    public function checkComment() : bool
    {
        // Если форма отправлена
        // Получаем данные из формы
        $this->comment = filter_input( INPUT_POST, 'InputComment', FILTER_SANITIZE_STRING );
        if ( strlen( $this->comment ) <= 555 ) {
            return true;
        }
        return false;
    }

    /**
     * Возвращает идентификатор пользователя, если он авторизирован.<br/>
     * Иначе перенаправляет на страницу входа
     * <p>Идентификатор пользователя</p>
     */
    public function checkLogged() : void
    {
        // Если сессия есть, вернем объект пользователя
        if ( !is_object( $_SESSION[ 'user' ] ) ) {
            header( 'Location: /user/login' );
        }
    }

    /**
     * Проверяет не занят ли email другим пользователем
     * @param string $email <p>E-mail</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public function checkEmailExists( string $email ) : bool
    {

        // Текст запроса к БД
        $sql = 'SELECT COUNT( * ) FROM users WHERE email = :email';

        // Получение результатов. Используется подготовленный запрос
        $result = $this->db->prepare( $sql );
        $result->bindParam( ':email', $email, PDO::PARAM_STR );
        $result->execute();

        if ( $result->fetchColumn() ) {
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
        // Текст запроса к БД
        $sql = 'SELECT * FROM users WHERE email = :email';

        // Получение результатов. Используется подготовленный запрос
        $stmt = $this->db->prepare( $sql );
        $stmt->bindParam( ':email', $email, PDO::PARAM_STR );
        $stmt->execute();

        // Обращаемся к записи
        $user = $stmt->fetch();
        if ( is_object( $user ) ) {
            if ( password_verify( $password, $user->password ) ) {
                $user->password = $password;
                // Если запись существует, возвращаем объект пользователя
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
    public function register( string $name, string $email, string $password ) : bool
    {
        $password = password_hash( $password, PASSWORD_BCRYPT );

        // Текст запроса к БД
        $sql = 'INSERT INTO users ( name, email, password ) VALUES ( :name, :email, :password )';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $this->db->prepare( $sql );
        $result->bindParam( ':name', $name, PDO::PARAM_STR );
        $result->bindParam( ':email', $email, PDO::PARAM_STR );
        $result->bindParam( ':password', $password, PDO::PARAM_STR );

        return $result->execute();
    }

    /**
     * Запоминаем пользователя
     * @param object $user <p>id пользователя</p>
     */
    public function auth( object $user ) : void
    {
        // Записываем идентификатор пользователя в сессию
        $_SESSION[ 'user' ] = $user;
    }

    /**
     * Проверяет является ли пользователь гостем
     * <p>Результат выполнения метода</p>
     */
    public function isGuest() : bool
    {
        if ( isset( $_SESSION[ 'user' ] ) ) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Возвращает пользователя с указанным id
     * @param integer $id <p>id пользователя</p>
     * @return object <p>Объект с информацией о пользователе</p>
     */
    public function getUserById( int $id ) : object
    {
        // Текст запроса к БД
        $sql = 'SELECT * FROM users WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $this->db->prepare( $sql );
        $result->bindParam( ':id', $id, PDO::PARAM_INT );
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
    public function edit( int $id, string $name, string $email, string $password ) : bool
    {
        $password = password_hash( $password, PASSWORD_BCRYPT );

        // Текст запроса к БД
        $sql = 'UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $this->db->prepare( $sql );
        $result->bindParam( ':id', $id, PDO::PARAM_INT );
        $result->bindParam( ':name', $name, PDO::PARAM_STR );
        $result->bindParam( ':email', $email, PDO::PARAM_STR );
        $result->bindParam( ':password', $password, PDO::PARAM_STR );

        return $result->execute();
    }

    /**
     * Формирует список заказов
     * @return void <p>Список заказов</p>
     */
    public function getOrdersListByUser() : void
    {
        // Получение и возврат результатов
        // Текст запроса к БД
        $sql = 'SELECT orders.customers_id, customers.name, customers.address, customers.phone, customers.comment, orders.date, orders.status
                FROM customers
                JOIN orders ON customers.id = orders.customers_id
                WHERE customers.user_id = :user_id ORDER BY customers.id DESC';
        $stmt = $this->db->prepare( $sql );
        $stmt->bindParam( ':user_id', $_SESSION[ 'user' ]->id, PDO::PARAM_INT );
        $stmt->execute();

        if ( $stmt->rowCount() > 0 ) {
            while ( $row = $stmt->fetch() ) {
                $this->ordersList[] = $row;
            }
        }
    }

    /**
     * Детализация заказа
     * @param int $customers_id
     * @return void <p>Список заказов</p>
     */
    public function getOrdersDetailsByUser( int $customers_id ) : void
    {
        // Получение и возврат результатов
        // Текст запроса к БД
        $sql = 'SELECT orders.customers_id, customers.user_id, customers.name, customers.address, customers.phone, customers.comment, orders.date, orders.products, orders.status
                FROM customers
                JOIN orders ON customers.id = orders.customers_id
                WHERE customers.user_id = :user_id AND orders.customers_id = :customers_id';
        $stmt = $this->db->prepare( $sql );
        $stmt->bindParam( ':user_id', $_SESSION[ 'user' ]->id, PDO::PARAM_INT );
        $stmt->bindParam( ':customers_id', $customers_id, PDO::PARAM_INT );
        $stmt->execute();

        if ( $stmt->rowCount() > 0 ) {
            $this->ordersDetails = $stmt->fetch();
        }
    }
}
