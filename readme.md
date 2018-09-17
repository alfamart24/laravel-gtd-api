    
    
    Установка
    -----------------------------------------------------------------------------
    
    composer require webadvance/kitapiv2:dev-master
    
    
    
    
    Использование:
    -----------------------------------------------------------------------------
    
    use Webadvance\Kitapiv2\KitService;
    
    создаем сервис:
    $service = new KitService();
    
    
    
    
    получение всех данных на примере функции (/2.0/order/insurance/get-list):
    -----------------------------------------------------------------------------
    
    Получаем ответ целиком
    $service->insurance()->all()
    
    Получение типа agent:
    $service->insurance()->agent()
    
    Получение типа cargo_type:
    $service->insurance()->cargo_type()
    
    
    
    
    Получение цены перевозки:
    -----------------------------------------------------------------------------
    
    Передаем все данные с формы в метод calculate
    $result = $service->calculate($request->all());
    
    Получаем ответ целиком
    $result->all()
    
    Получаем цену
    $result->standart()->cost;
    $result->economy()->cost;
    $result->express()->cost;
    $result->standard_courier()->cost;
    $result->express_courier()->cost;
    
    Можно так:
    $price = $service->calculate($request->all())->standart()->cost;
    
    
    