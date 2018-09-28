    
    
## Laravel TK kit api

Api для работы с ТК КИТ.
Пакет находится в разработке, но использовать многие функции уже можно.
По мере разработки буду обновлять документацию

По вопросам работы пишите в телеграмм WStanley



## Installation
```
composer require wstanley/kitapi:dev-master
```



## Usage

Добавляем токен в файл .env
```
TOKEN_KIT=
```

Подключаем сервис в контроллере:

```
use Wstanley\Kitapi\KitService;

$service = new KitService();
```



Пример получения списка агентов (/2.0/order/insurance/get-list)

чтобы получить весь ответ от сервера используем all()

```
$response = $service->insurance()->all()
```
получение только типа agent
```
$agents = $service->insurance()->agent()
```
получение типа cargo_type
```
$cargoType = $service->insurance()->cargo_type()
```


Пример получения городов (/2.0/tdd/city/get-list)

чтобы получить весь список городов используем all()
```
$cyties = $service->cityTdd()->all()
```
для отправки запроса передаем параметры в функцию
```
$cyti = $service->cityTdd(
                [
                    "code"         => "660002900000",
                    "region_code"  => "66",
                    "country_code" => "RU"
                ])
```




Для расчета стоимости перевозки достаточно в calculate передать все данные с формы.
```
$result = $service->calculate($request->all());
```

С формы должны прийти все обязательные поля:

* 'city_pickup_code'      => 'Код города откуда',
* 'city_delivery_code'    => 'Код города куда',
* 'declared_price'        => 'Объявленная стоимость груза (руб)',
* 'height'                => 'Высота груза (см) позиции',
* 'width'                 => 'Ширина груза (см) позиции',
* 'length'                => 'Длина груза (см) позиции',
* 'count_place'           => 'Количество мест в позиции',
* 'weight'                => 'Масса КГ позиции',

Чтобы получить ответ полностью используем all()
```
$response = $result->all()
```
Получить цену можно так
```
$price = $result->standart()->cost;
$price = $result->economy()->cost;
$price = $result->express()->cost;
$price = $result->standard_courier()->cost;
$price = $result->express_courier()->cost;
```
Либо сразу так
```
$price = $service->calculate($request->all())->standart()->cost;
```

Позже добавлю описание всех функций