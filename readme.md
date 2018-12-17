
# Laravel TK GTD api

Api для работы с ТК GTD. <br>
Рализована работа калькулятора, создание ордера и многих других функций. По мере разработки буду обновлять документацию.<br>
По вопросам работы пишите в телеграмм WStanley

<br>


# Installation
```
composer require alfamart24/laravel-gtd-api:dev-master
```

<br>

# Usage

Добавляем токен в файл .env
```
TOKEN_GTD=
```

Подключаем сервис в контроллере:

```
use Alfamart24\Gtdapi\GtdService;

$service = new GtdService();
```

<br>
<br>


## Реализованные функции:

#### Получение списка городов - `geography/city/get-list`<br>
```
$service->cityGeography()->all()
```

#### Получение списка электронных адресов - `geography/email/get-list`<br>
```
$service->email()->all()
```

#### Получение списка телефонов - `geography/phone/get-list`<br>
```
$service->phone()->all()
```

#### Получение списка режимов работы - `geography/schedule/get-list`<br>
```
$service->schedule()->all()
```

#### Получение списка видов графиков работы - `geography/schedule-group/get-list`<br>
```
$service->scheduleGroup()->all()
```

#### Расчет стоимости - `order/calculate`<br>
```
Получение всего отвера от сервера:
$service->calculate(...)->all()

Заполнение свойств метода с ответа (подробнее см ниже)
$service->calculate(...)->calculateResult()
```

#### Получение списка валют - `order/currency/get-list`<br>
```
$service->currency()->all()
```

#### Список страховых агентов - `order/insurance/get-list`<br>
```
$service->insurance()->all()
```

#### Оформление заказа - `order/service/get-list`<br>
```
$service->service()->all()
```

#### Статус заказа - `order/status/get`<br>
```
$service->status(...)->all()
```

#### Список городов - `tdd/city/get-list`<br>
```
$service->cityTdd()->all()
```

#### Получение списка стран - `tdd/country/get-list`<br>
```
$service->country()->all()
```

#### Список регионов - `tdd/region/get-list`<br>
```
$service->region()->all()
```
<br>
<br>

## Примеры работы с функциями:

#### Список городов - `tdd/city/get-list`<br>

Чтобы получить весь список городов используем all().<br> all() используется для получения полного ответа от сервера.
```
Получение всего ответа от сервера
$cyties = $service->cityTdd()->all()

Вернет массив вида [код города => имя города]
$cyties = $service->cityTdd()->cities()
```
Для отправки запроса передаем параметры в функцию
```
$cyti = $service->cityTdd(
                [
                    "code"         => "660002900000",
                    "region_code"  => "66",
                    "country_code" => "RU"
                ])->all()
```
Либо так
```
$cyti = $service->cityTdd(["code" => "660002900000"])->all()
```
Какие параметры принимает конкретная функция вы можете узнать из документации, либо в классе функции, в поле optional перечислены необязательные параметры, в поле  necessary перечислены обязательные параметры.

<br>

#### Список страховых агентов - `order/insurance/get-list`<br>

Чтобы получить весь ответ от сервера используем all()

```
$response = $service->insurance()->all()
```
В полном ответе от сервера содержатся типы данных `agent` и `cargo_type`<br>
Получение только типа `agent`
```
$agents = $service->insurance()->agent()
```
Получение типа `cargo_type`
```
$cargoType = $service->insurance()->cargo_type()
```
С детальной информацией об ответах от сервера вы можете ознакомиться в документации.

<br>
<br>

## Расчет стоимости перевозки

#### Расчет стоимости - `order/calculate`

#### Есть 2 варианта расчета стоимости:

### С указанием объема багажа `volume`
Получение полного ответа от сервера
```
$response = $service->calculate($request->all())->all();
```
Заполнение полей метода ответом от сервера
```
$response = $service->calculate($request->all())->calculateResult();

Поля:
$response->standart
$response->economy
$response->express
$response->standard_courier
$response->express_courier

Получение цены:
$response->cost('standart')

Проверить верно ли произведен расчет можно(нужно) вот так
$response->error = 'Ошибка расчета' - переданы неправильные параметры
$response->error = null             - поля ответа заполнены(расчет верный)
```
Обязательные параметры для расчета стоимости:<br>
```
'city_pickup_code'      => 'Код города откуда',<br>
'city_delivery_code'    => 'Код города куда',<br>
'declared_price'        => 'Объявленная стоимость груза (руб)',<br>
'count_place'           => 'Количество мест в позиции',<br>
'weight'                => 'Масса КГ позиции',<br>
'volume'                => 'Объем М³ позиции',
```
Необязательные параметры, для более дтального расчета, также можно передать в функцию:
```
'have_doc'              => 'Есть документы подтверждающие стоимость груза',
'insurance'             => 'Услуга страхования груза',
'insurance_agent_code'  => 'Код страхового агента',
'service'               => 'массив кодов услуг',
'pick_up'               => 'Забор груза по городу',
'delivery'              => 'Доставка груза по городу',
'cargo_type_code'       => 'Код характера груза',
'currency_code'         => 'Валюта результата расчета',
'all_places_same'       => 'Все места одинаковы по размеру'
```
Параметры о месте багажа ожидаются такого формата:
```
"count_place" => [
    0 => "1"
    1 => "3"],
"weight" => [
    0 => "2"
    1 => "3"],
"volume" => [
    0 => "8"
    1 => "2"],
```
Пример поля `input` на форме калькулятора:
 ```
<input type="text" name="volume[]" placeholder="Объем">
<input type="text" name="weight[]" placeholder="Вес">
<input type="text" name="count_place[]" placeholder="Количество мест">
 ```
 Также у функции `canculate` <u>есть зависимые параметры</u>, с полной работой функции вы можете ознакомиться в документации.<br>
 Функция не отправит запрос пока не передадут все требуемяе параметры для расчета стоимости, выпадающие исключения подскажут чего не хватает.
 <br>
 <br>

Получить стоимость перевозки можно так
```
$response = $service->calculate($request->all())->calculateResult();

$price = $response->cost('standart')
$price = $response->cost('economy')
$price = $response->cost('express')
$price = $response->cost('standard_courier')
$price = $response->cost('express_courier')
```
Либо сразу так
```
$price = $service->calculate($request->all())->calculateResult()->cost('standart');
```

<br>

### С указанием размеров багажа `height`, `width`, `length`
В случае работы с размерами в функцию требуется передать флаг `false` вторым параметром, ианче расчет будет вестись как для объема.<br> 
Получение полного ответа от сервера
```
$response = $service->calculate($request->all(), false)->all();
```
Обязательные параметры для расчета:<br>
```
'city_pickup_code'      => 'Код города откуда',<br>
'city_delivery_code'    => 'Код города куда',<br>
'declared_price'        => 'Объявленная стоимость груза (руб)',<br>
'count_place'           => 'Количество мест в позиции',<br>
'weight'                => 'Масса КГ позиции',<br>
'height'                => 'Высота груза (см) позиции',
'width'                 => 'Ширина груза (см) позиции',
'length'                => 'Длина груза (см) позиции',
```
Необязательные параметры, для более дтального расчета, также можно передать в функцию:
```
'have_doc'              => 'Есть документы подтверждающие стоимость груза',
'insurance'             => 'Услуга страхования груза',
'insurance_agent_code'  => 'Код страхового агента',
'service'               => 'массив кодов услуг',
'pick_up'               => 'Забор груза по городу',
'delivery'              => 'Доставка груза по городу',
'cargo_type_code'       => 'Код характера груза',
'currency_code'         => 'Валюта результата расчета',
'all_places_same'       => 'Все места одинаковы по размеру'
```
Параметры о месте багажа ожидаются такого формата:
```
"count_place" => [
    0 => "1"
    1 => "3"],
"weight" => [
    0 => "2"
    1 => "3"],
"height" => [
    0 => "8"
    1 => "2"],
"width" => [
    0 => "4"
    1 => "6"],
"length" => [
    0 => "1"
    1 => "8"],
```
Пример поля `input` на форме калькулятора:
 ```
<input type="text" name="width[]" placeholder="Укажите ширину">
<input type="text" name="height[]" placeholder="Укажите высоту">
 ```
 Также у функции `canculate` <u>есть зависимые параметры</u>, с полной работой функции вы можете ознакомиться в документации.<br>
 Функция не отправит запрос пока не передадут все требуемяе параметры для расчета стоимости, выпадающие исключения подскажут чего не хватает.
  <br>
  <br>
 
Получить стоимость перевозки можно так
```
$response = $service->calculate($request->all())->calculateResult();

$price = $response->cost('standart')
$price = $response->cost('economy')
$price = $response->cost('express')
$price = $response->cost('standard_courier')
$price = $response->cost('express_courier')
```
Либо сразу так
```
$price = $service->calculate($request->all())->calculateResult()->cost('standart');
```
