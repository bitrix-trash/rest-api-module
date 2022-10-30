<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global \CMain $APPLICATION */
/** @global \CUser $USER */
/** @global \CDatabase $DB */
/** @var \CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var array $templateData */
/** @var \CBitrixComponent $component */
$this->setFrameMode(true);
$this->addExternalCss($this->GetFolder()."/build/css/main.css");
?>
<div x-data="docspage">
    <div class="main px-4">
        <h1 class="text-xl font-bold mb-2 text-center">Документация к модулю REST API</h1>
        <div class="text-red-600 my-2">Важно! Рекомендуется устанавливать модуль в папку <i>/local/modules/</i>!</div>
        <div class="font-bold mt-2">
            Как использовать:
        </div>
        <ol class="list list-inside">
            <li>
                Создаём в папке <i>/local/modules/vasqo.rest/app/Api/Controllers</i> класс с названием <i>*Name*Controller</i>
                <ol class="list list-inside ml-4">
                    <li>
                        <i>namespace должен быть обязательно namespace <code class="language-php">Vasqo\Rest\Api\Controllers;</code>!</i>
                    </li>
                </ol>
            </li>
            <li>
                Екстендимся от класса <code class="language-php">\Vasqo\Rest\Api\Core\Controller\AbstractController\AbstractController</code>;
            </li>
            <li>
                Создаём метод для логики (или прописываем логику в методе <code class="language-php">index()</code> )
                <ol class="list list-inside ml-4">
                    <li>
                        <i>Что бы вывести что-либо - нужно прописывать <code class="language-php">return $this->view->success(*ARRAY*)</code>!</i>
                    </li>
                </ol>
            </li>
            <li>
                В файлике <i>/local/api/routes.php</i> прописываем нужный нам роут по принципу:
                <code class="language-php">
                    Router::get("*ROUTE NAME*", [\Vasqo\Rest\Api\Controllers\*Name*Controller::class, "METHOD NAME (или оставляем index)"]);
                </code>
                <br>
                Вместо <code class="language-php">get()</code> можно использовать метод <code class="language-php">post()</code> для инициализации POST ендпоинтов, а так же <code class="language-php">put()</code> или <code class="language-php">delete()</code>
            </li>
            <li>
                Для того, что бы вывести какое-нибудь значение, в методе контроллера пишется:
                <ol class="list list-inside ml-4">
                    <li>
                        <code class="language-php">return $this->view->success(*ARRAY DATA*, "MESSAGE");</code> для "позитивного" ответа
                    </li>
                    <li>
                        <code class="language-php">return $this->view->error(*ARRAY DATA*, "MESSAGE");</code> для ошибки
                    </li>
                    <li>
                        вывод будет в JSON с такой схемой:
                        <pre>
                            <code>
                                {
                                    "status": boolean,
                                    "message": string,
                                    "data": array
                                }
                            </code>
                        </pre>
                    </li>
                </ol>
            </li>
            <li>
                Так же можно переопределять представление данных в конструкторе контроллера, например:
                <pre>
                    <code class="language-php">
                        public function __construct()
                        {
                            parent::__construct();
                            $this->view = new \Vasqo\Rest\Api\View\XmlView();
                        }
                    </code>
                </pre>
                или на любой другой View, но только он обязательно должен быть наследником от интерфейса
                <code class="language-php">\Vasqo\Rest\Api\Core\View\Interfaces\ViewInterface</code>
            </li>
            <li>
                Если всё было сделано правильно - то результат будет по пути <i>*DOMEN*/local/api/*ROUTE NAME*</i>
            </li>
        </ol>
        <div class="text-gray-800">Опционально</div>
        <ol class="list list-inside">
            <li>
                Так же по желанию можно использовать миддлвейры. Для этого нужно в <i>local/modules/vasqo.rest/app/Api/Middlewares</i> создать свой
                класс <code class="language-php">*NAME*Middleware</code> с неймспейсом <code class="language-php">namespace Vasqo\Rest\Api\Middlewares;</code>
                <ol class="list list-inside">
                    <li>
                        Унаследовать его от <code class="language-php">\Vasqo\Rest\Api\Core\Middleware\AbstractMiddleware</code>
                    </li>
                    <li>
                        Реализовать метод <code class="language-php">execute()</code>
                    </li>
                    <li>
                        В контроллере конструктора прописать этот миддлвейр:
                        <pre>
                            <code class="language-php">
                                public function __construct()
                                {
                                    parent::__construct();
                                    $this->middleware(\Vasqo\Rest\Api\Middlewares\*NAME*Middleware::class);
                                }
                            </code>
                        </pre>
                    </li>
                </ol>
            </li>
        </ol>
        <div class="font-bold mt-2">
            CHANGELOG:
        </div>
        <ol class="list list-inside">
            <li>
                Add middlewares
            </li>
            <li>
                Writing new RETURN algorithm in Controllers
            </li>
        </ol>
        <div class="font-bold mt-2">
            TODO LIST:
        </div>
        <ol class="list list-inside">
            <li>
                <label for="">
                    <input type="checkbox" checked disabled>
                    Перенести всё в отдельный битриксовый модуль, который можно будет использовать в любом проекте
                </label>
            </li>
            <li>
                <label for="">
                    <input type="checkbox" disabled>
                    Добавить поддержку Swagger Open API
                </label>
            </li>
            <li>
                <label for="">
                    <input type="checkbox" disabled>
                    Переписать роутер
                </label>
            </li>
            <li>
                <label for="">
                    <input type="checkbox" disabled>
                    Написать нормальную доку
                </label>
            </li>
        </ol>
        <div class="font-bold mt-2">
            Так же в качестве примера реализован ендпоинт /ping, в качестве примера можно разобрать его!
        </div>
    </div>
</div>

<?php
$this->addExternalJs($this->GetFolder()."/build/main.js");
?>