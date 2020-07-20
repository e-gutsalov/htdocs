<?php


namespace components;


use models\OrderModel;

class Cart
{
    private object $db;
    public array $errors = [];
    public object $userProcess;
//    Поля для формы
    public string $userName;
    public string $userPhone;
    public string $userComment;
//    Статус успешного оформления заказа
    public bool $result = false;
//    Отправка почты
    private object $sendMail;
    private object $paramsMail;


    public function __construct()
    {
//        Соединение с БД
        $this->db = Db::getConnection();
//        Работа с пользователем
        $this->userProcess = new UserProcess();
//        Настройка почты
        $this->sendMail = new SendMail();
        $this->paramsMail = new \stdClass();
    }

    /**
     * Action для страницы "Корзина"
     */
    public function showCartProcess(): void
    {
        // Получим идентификаторы и количество товаров в корзине
        $productsInCart = $this->getProducts();

        if ( $productsInCart ) {
            // Если в корзине есть товары, получаем полную информацию о товарах для списка
            // Получаем массив только с идентификаторами товаров
            $productsIds = array_keys( $productsInCart );

            // Получаем массив с полной информацией о необходимых товарах
            $products = $this->getProdustsByIds( $productsIds );

            // Получаем общую стоимость товаров
            $_SESSION[ 'cart' ][ 'totalPrice' ] = $this->getTotalPrice( $products );
        }
    }

    /**
     * Добавление товара в корзину (сессию)
     * @param int $code <p>code товара</p>
     * @return integer <p>Количество товаров в корзине</p>
     */
    public function addProductProcess( int $code )
    {
        // Приводим $id к типу integer
        $code = intval( $code );

        // Пустой массив для товаров в корзине
        $productsInCart = [];

        // Если в корзине уже есть товары (они хранятся в сессии)
        if ( isset( $_SESSION[ 'cart' ][ 'productsCode' ] ) ) {
            // То заполним наш массив товарами
            $productsInCart = $_SESSION[ 'cart' ][ 'productsCode' ];
        }

        // Проверяем есть ли уже такой товар в корзине
        if ( array_key_exists( $code, $productsInCart ) ) {
            // Если такой товар есть в корзине, но был добавлен еще раз, увеличим количество на 1
            $productsInCart[ $code ]++;
        } else {
            // Если нет, добавляем id нового товара в корзину с количеством 1
            $productsInCart[ $code ] = 1;
        }

        // Записываем массив с товарами в сессию
        $_SESSION[ 'cart' ][ 'productsCode' ] = $productsInCart;
        $_SESSION[ 'cart' ][ 'count' ] = $this->countItems();

        // Возвращаем количество товаров в корзине
        return $this->countItems();
    }

    /**
     * Удаляет товар с указанным code из корзины
     * @param integer $code <p>code товара</p>
     * @return string <p>Возвращает JSON объект</p>
     */
    public function deleteProductProcess( int $code )
    {
        // Получаем массив с идентификаторами и количеством товаров в корзине
        $productsCodeInCart = $this->getProducts();

        // Удаляем из массива элемент с указанным code
        unset( $productsCodeInCart[ $code ] );

        // Записываем массив товаров с удаленным элементом в сессию
        $_SESSION[ 'cart' ][ 'productsCode' ] = $productsCodeInCart;

        // Пересчет количества товаров в корзине (в сессии)
        $_SESSION[ 'cart' ][ 'count' ] = $this->countItems();

        // Удаляем из массива элемент с указанным code
        unset( $_SESSION[ 'cart' ][ 'productsInCart' ][ $code ] );

        // Пересчет общей стоимости товаров
        $_SESSION[ 'cart' ][ 'totalPrice' ] = $this->getTotalPrice( $_SESSION[ 'cart' ][ 'productsInCart' ] );

        return json_encode( [ 'count' => $_SESSION[ 'cart' ][ 'count' ], 'totalPrice' => $_SESSION[ 'cart' ][ 'totalPrice' ] ] );
    }

    /**
     * Action для страницы "Оформление покупки"
     */
    public function checkoutProductsProcess()
    {
        // Получием данные из корзины
        $productsInCart = $this->getProducts();

        // Если товаров нет, отправляем пользователи искать товары на главную
        if ( $productsInCart == false ) {
            header( 'Location: /catalog' );
        }

        // Проверяем является ли пользователь гостем
        if ( !$this->userProcess->isGuest() ) {
            // Если пользователь не гость
            // Получаем информацию о пользователе из БД
            $userId = $_SESSION[ 'user' ]->id;
//            $user = $this->userProcess->getUserById( $userId );
            $userName = $_SESSION[ 'user' ]->name;
        } else {
            // Если гость, поля формы останутся пустыми
            $userId = false;
        }

        // Обработка формы
        if ( isset( $_POST[ 'submit' ] ) ) {
            // Если форма отправлена
            // Получаем данные из формы

            // Валидация полей
            if ( !$this->userProcess->checkName() ) {
                $this->errors[] = 'Неправильное имя';
            }
            if ( !$this->userProcess->checkPhone() ) {
                $this->errors[] = 'Неправильный телефон';
            }
            if ( !$this->userProcess->checkAddress() ) {
                $this->errors[] = 'Неправильный адрес';
            }
            if ( !$this->userProcess->checkComment() ) {
                $this->errors[] = 'Слишком длинный комментарий';
            }

            if ( empty( $this->errors ) ) {
                // Если ошибок нет
                // Сохраняем заказ в базе данных
                $this->result = OrderModel::save( $userId, $this->userProcess->name, $this->userProcess->address, $this->userProcess->phone, $this->userProcess->comment, $productsInCart );
                if ( $this->result ) {
                    // Если заказ успешно сохранен
                    // Оповещаем администратора о новом заказе по почте
                    $this->paramsMail->subject = 'Новый заказ! C сайта gutsalov.h1n.ru';
                    $this->paramsMail->email = 'egutsalov@yandex.ru';
                    $this->paramsMail->body = '<a href="https://www.gutsalov.h1n.ru/admin/orders">Список заказов</a>';
                    $this->sendMail->send( $this->paramsMail );
                    // Очищаем корзину
                    Cart::clear();
                }
            }
        }
    }

    /**
     * Подсчет количество товаров в корзине (в сессии)
     * @return int <p>Количество товаров в корзине</p>
     */
    public function countItems()
    {

        // Проверка наличия товаров в корзине
        if ( isset( $_SESSION[ 'cart' ][ 'productsCode' ] ) ) {
            // Если массив с товарами есть
            // Подсчитаем и вернем их количество
            return array_sum( $_SESSION[ 'cart' ][ 'productsCode' ] );
        } else {
            // Если товаров нет, вернем 0
            return 0;
        }
    }

    /**
     * Возвращает массив с идентификаторами и количеством товаров в корзине<br/>
     * Если товаров нет, возвращает false;
     * @return mixed: boolean or array
     */
    public function getProducts()
    {
        if ( isset( $_SESSION[ 'cart' ][ 'productsCode' ] ) ) {
            return $_SESSION[ 'cart' ][ 'productsCode' ];
        }
        return false;
    }

    /**
     * Возвращает список товаров с указанными индентификторами
     * @param array $codesArray <p>Массив с идентификаторами</p>
     * @return array <p>Массив со списком товаров</p>
     */
    public function getProdustsByIds( array $codesArray )
    {
        // Превращаем массив в строку для формирования условия в запросе
        $codesString = str_repeat( '?,', count( $codesArray ) - 1 ) . '?';

        $query = "SELECT * FROM product WHERE status = 1 AND code IN ( $codesString )";
        $stmt = $this->db->prepare( $query );
        $stmt->execute( $codesArray );

        // Получение и возврат результатов
        while ( $row = $stmt->fetch() ) {
            $_SESSION[ 'cart' ][ 'productsInCart' ][ $row->code ] = $row;
        }
        return $_SESSION[ 'cart' ][ 'productsInCart' ];
    }

    /**
     * Получаем общую стоимость переданных товаров
     * @param array $products <p>Массив с информацией о товарах</p>
     * @return integer <p>Общая стоимость</p>
     */
    public function getTotalPrice( array $products )
    {
        // Получаем массив с идентификаторами и количеством товаров в корзине
        $productsInCart = $this->getProducts();

        // Подсчитываем общую стоимость
        $total = 0;
        if ( is_array( $productsInCart ) ) {
            // Если в корзине не пусто
            // Проходим по переданному в метод массиву товаров
            foreach ( $products as $item ) {
                // Находим общую стоимость: цена товара * количество товара
                $total += $item->price * $productsInCart[ $item->code ];
            }
        }
        return $total;
    }

    /**
     * Очищает корзину
     */
    public function clear()
    {
        if ( isset( $_SESSION[ 'cart' ] ) ) {
            unset( $_SESSION[ 'cart' ] );
        }
    }
}
