# PHP API SDK
Класс для работы с API SMS Club.

## Подключение сервиса
Для установки сервиса, необходимо добавить атозагрузчик классов в начало файла:
```php
require_once 'smsclub_api/autoload.php';
```

Затем объявить класс:
```php
$api = new \SmsclubApi\Services\ApiService([
    'token' => 'your_token',      // Токен пользователя
]);
```

## Использование
### Акканут
#### Просмотр баланса
Для просмотра баланса необходимо вызвать метод ```$api->getBalance();```. В ответ вернется объект интерфейса ```BalanceInterface``` или ```false``` в случае ошибки.

**Пример:**
```php
$balance = $api->getBalance();

if ($balance) {
    // Получить остаток на балансе
    var_dump($balance->getMoney());    
    
    // Получить валюту аккаунта
    var_dump($balance->getCurrency()); 
}
```

#### Получение списака Альфа-имен для отправки СМС
Для получения спсиска Альфа-имен необходимо вызвать метод ```$api->getSmsOriginators();```. В ответ вернется массив объектов интерфейса ```OriginatorInterface``` или ```false``` в случае ошибки.

**Пример:** 
```php
$originators = $api->getSmsOriginators();

if ($originators) {
    foreach($originators as $originator) {
        // Получить ID отправителя
        var_dump($originator->getId());   
        
        // Получить имя отправителя
        var_dump($originator->getName());  
    }
}
```

### Отправка сообщений
#### Отправка СМС
Для отправки СМС сообщения необходимо создать объект реализующий ```SmsInterface``` и передать его в метод ```sendSms($sms)``` API сервиса. Вызов метода ```sendSms($sms)``` вернет массив объектов интерфеса ```SendResponseInterface``` или ```false``` в случае ошибки.

Сервис содержит готовый объект интерфейса ```SmsInterface``` - ```Sms```.

**Пример:**
```php
$sms = new \SmsclubApi\Classes\Sms();
$sms
    // Устанавливаем отправителя
    ->setOriginator(new \SmsclubApi\Classes\Originator('InetShop'))
    // Устанавливаем номера получателей
    // Если получатель один, следует указывать один елемент массива
    ->setPhones(['380123456789', '380123456780'])
     // Устанавливаем текст сообщения
    ->setMessage('Message text')

$result = $api->sendSms($sms);

if ($result) {
    foreach($result as $item) {
        // Получить ID сообщения от SMS Club
        var_dump($item->getId());
        
        // Получить номер на которой отправлено СМС
        var_dump($item->getNumber());
    }
}
```

#### Отправка Viber сообщений
Для отправки Viber сообщения необходимо создать объект реализующий ```ViberMessageInterface``` и передать его в метод ```sendViber($viberMessage)``` API сервиса. Вызов метода ```sendViber($viberMessage)``` вернет массив объектов интерфеса ```SendResponseInterface``` или ```false``` в случае ошибки.

Сервис содержит готовый объект интерфейса ```ViberMessageInterface``` - ```Sms```.

**Пример:**
```php
$viberMessage = new \SmsclubApi\Classes\ViberMessage();
$viberMessage
    // Устанавливаем отправителя
    ->setOriginator(new \SmsclubApi\Classes\Originator('InetShop'))
    // Устанавливаем номера получателей
    // Если получатель один, следует указывать один елемент массива
    ->setPhones(['380123456789', '380123456780'])
     // Устанавливаем текст сообщения
    ->setMessage('Message text');

$result = $api->sendViber($viberMessage);

if ($result) {
    foreach($result as $item) {
        // Получить ID сообщения от SMS Club
        var_dump($item->getId());
        
        // Получить номер на которой отправлено СМС
        var_dump($item->getNumber());
    }
}
```

#### Получение списака Альфа-имен для отправки Viber сообщений
Для получения спсиска Альфа-имен необходимо вызвать метод ```$api->getViberOriginators();```. В ответ вернется массив объектов интерфейса ```OriginatorInterface``` или ```false``` в случае ошибки.

**Пример:** 
```php
$originators = $api->getViberOriginators();

if ($originators) {
    foreach($originators as $originator) {
        // Получить ID отправителя
        var_dump($originator->getId());   
        
        // Получить имя отправителя
        var_dump($originator->getName());  
    }
}
```

### Получение статусов
#### Константы статусов и их описание
Для сверки статусов рекомендуется использовать константы класса `StatusHandler`:
* `SMS_ENROUTE_STATUS` - сообщение отправлено;
* `SMS_DELIVRD_STATUS` - сообщение доставлено;
* `SMS_REJECTED_STATUS` - сообщение отклонено системой (черный список или же другие фильтры);
* `SMS_EXPIRED_STATUS` - истек срок жизни, сообщение не доставлено;
* `SMS_UNDELIV_STATUS` - невозможно доставить сообщение.

#### Получение СМС стутсов
Для получения стасов СМС необходимо вызвать метод ```getSmsStatuses([...])``` и передать в него массив с ID смс в системе SMS Club. Вызов метода вернет массив объектов интрефейса ```SmsStatusInterface``` или ```false``` в случае ошибки.

**Пример:**
```php
$result = $api->getSmsStatuses(['111222333', '444555666']);

if ($result) {
    foreach($result as $item) {
        // Получить ID СМС в системе SMS Club
        var_dump($result->getId());

        // Получить статус сообщения
        var_dump($result->getStatus());
    }
}
```

**Список возможных статусов:**
* `StatusHandler::SMS_ENROUTE_STATUS` (`Message enroute.`)  – сообщение отправлено;
* `StatusHandler::SMS_DELIVRD_STATUS` (`Message delivered.`) – сообщение доставлено;
* `StatusHandler::SMS_EXPIRED_STATUS` (`Message expired.`) – истек срок жизни, сообщение не доставлено;
* `StatusHandler::SMS_UNDELIV_STATUS` (`Message undelivered.`) – невозможно доставить сообщение;
* `StatusHandler::SMS_REJECTED_STATUS` (`Message rejected.`) – сообщение отклонено системой (черный список или же другие фильтры).

**Примечание:** Для корретной проверки статусов следует использовать константы класса `StatusHandler`, а не текстовые значения.

#### Получение Viber статусов
Для получения стасов Viber сообщений необходимо вызвать метод ```getViberStatuses([...])``` и передать в него массив с ID Viber сообщений в системе SMS Club. Вызов метода вернет массив объектов интрефейса ```ViberStatusInterface``` или ```false``` в случае ошибки.

**Пример:**
```php
$result = $api->getViberStatuses(['111222333', '444555666']);

if ($result) {
    foreach($result as $item) {
        // Получить ID Viber сообщения в системе SMS Club
        var_dump($result->getId());

        // Получить статус Viber сообщения
        var_dump($result->getStatus());
        
        // Получить дополнительный статус
        var_dump($result->getAdditionalStatus());
    }
}
```

**Список возможных статусов:**
* `StatusHandler::SMS_ENROUTE_STATUS` (`Message enroute.`) - сообщение отправлено;
* `StatusHandler::SMS_DELIVRD_STATUS` (`Message delivered.`) – сообщение доставлено;
* `StatusHandler::SMS_EXPIRED_STATUS` (`Message expired.`) – истек срок жизни, сообщение не доставлено;
* `StatusHandler::SMS_UNDELIV_STATUS` (`Message undelivered.`) – невозможно доставить сообщение;
* `StatusHandler::SMS_REJECTED_STATUS` (`Message rejected.`) – сообщение отклонено системой (черный список или же другие фильтры).

**Список возсожных дополнительных статусов:**
* ```Прочитано``` – абонент прочитал сообщение;
* ```Заблокировано получателем``` – абонент заблокировал сообщение от заданного альфа-имени.
* ```Не зарегистрирован``` – на мобильном устройстве абонента не установлено актуальное Viber-приложение.
* ```Не поддерживаются рассылки``` – для мобильного устройства абонента не предусмотрены Viber-рассылки (как правило это планшеты).
* ```Черный список``` — телефон в черном списке, рассылка на него запрещена.
* ```Спам``` — отправка сообщения заблокирована по подозрению на спам.
* ```Цензура``` — в сообщении обнаружена нецензурная лексика или стоп-слова.
* ```Некорректный номер получателя``` — указан некорректный номер абонента.
* ```Запрещенный оператор``` — запрещена отправка сообщений на номера данного оператора.



**Важно!** Дополнительные статусы несут исключительно информативный характер и могут быть изменены на стороне сервиса SMS Club. Не стоит использовать дополнительные статусы для программной логики (например сравнений, выборок и т.д.).

**Примечание:** Для корретной проверки статусов следует использовать константы класса `StatusHandler`, а не текстовые значения.

### Обработка ошибок
При вызове методов отвечающих за запросы к сервису SMS Club, возвращаемое значение может быть ```false```, это указывает на наличие ошибки. Для получения списка ошибок стоит использовать метод ```getErrors()```.

Для проверки наличия ошибок следует использовать метод ```hasErrors()```.

Метод ```getErrors()``` возвращает массив объектов интерфеса ```ErrorInterface```.

Методы интерфейса ```ErrorInterface```:
* ```getCode()``` - получить код ошибки;
* ```getMessage()``` - получить сообщение ошибки;

**Пример:**
```php
$balance = $api->getBalance();

if (!$balance) {
    foreach($api->getErrors() as $error) {
        // Получить код ошибки
        var_dump($error->getCode());
        
        // Получить сообщение ошибки
        var_dump($error->getMessage());
    }
}

// Или:

if ($api->hasErrors()) {
    foreach($api->getErrors() as $error) {
        // Получить сообщение ошибки
        var_dump($error->getCode());
        
        // Получить сообщение ошибки
        var_dump($error->getCode());
    }
}
```

**Достпуные коды ошибок (описание в работе)** 
* `ErrorHandler::SMS_PHONE_EMPTY` (`101`) - не заполнен номер получателя;
* `ErrorHandler::SMS_MESSAGE_EMPTY` (`102`) - не заполнен текст сообщения;
* `ErrorHandler::SMS_SRC_ADDR_EMPTY` (`103`) - не заполнен отправитель сообщения;
* `ErrorHandler::SMS_INVALID_PHONE` (`104`) - некорректный номер получателя;
* `ErrorHandler::SMS_INVALID_ID_SMS` (`105`) - некорректный ID сообщения;
* `ErrorHandler::SMS_UNAUTHORIZED` (`106`) - некорректные данные авторизации;
* `ErrorHandler::SMS_VALIDATION` (`107`) - ошибка валидации данных;
* `ErrorHandler::SMS_TOO_MANY_QUERIES` (`108`) - превышен лимит запросов;
* `ErrorHandler::SMS_SERVICE_UNAVAILABLE` (`109`) - сервис недоступен;
* `ErrorHandler::VIBER_ACCOUNT` (`110`) - осуществление Viber рассылок с данного аккаунта недоступно;
* `ErrorHandler::VIBER_SYSTEM_ERROR` (`111`) - системная ошибка;
* `ErrorHandler::VIBER_NO_MONEY` (`112`) - недостаточно средств;
* `ErrorHandler::VIBER_ANY_CORRECT_PHONES` (`113`) - некоррекнтые номера получателей;
* `ErrorHandler::VIBER_TEXT` (`114`) - некорректный текст сообщения;
* `ErrorHandler::VIBER_UPLOAD_IMG` (`115`) - ошибка при загрузке изображения;
* `ErrorHandler::VIBER_SENDER` (`116`) - некорректный отправитель;
* `ErrorHandler::VIBER_SMS` (`117`) - некорректное СМС сообщения (каскадная отправка);
* `ErrorHandler::VIBER_INCORRECT_PHONES` (`118`) - некоррекнтые номера получателей;
