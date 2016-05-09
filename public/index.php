<?php
use Aura\Router\Map;
use Aura\Router\Matcher;
use Macseem\Search\Controllers\ProductController;
use Macseem\Search\Modules\Cache\Cacher;
use Macseem\Search\Modules\Framework\Di;
use Macseem\Search\Modules\ProductSearch\Searcher;
use Macseem\Search\Modules\Serialize\Factory as SerializerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\ServerRequestFactory;

if (!defined('BASE_DIR')) {
    define('BASE_DIR', __DIR__ . '/..');
}
if (!defined('VENDOR_DIR')) {
    define('VENDOR_DIR', BASE_DIR . '/vendor');
}

require_once VENDOR_DIR . '/autoload.php';

$config = include BASE_DIR . '/config/web.php';

$di = Di::getInstance();

$di->setShared('config', function () use ($config) {
    return $config;
});

$di->setShared('cacher', function () use ($config) {
    return new Cacher(
        $config['cacher']['type'],
        $config[$config['cacher']['type']],
        SerializerFactory::getInstance($config['cacher']['serializer'])
    );
});

$di->setShared('searcher', function () use ($config) {
    $type = $config['searcher']['type'];
    return new Searcher($type, $config[$type]);
});

$di->setShared('request', function () {
    return ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
});
$di->setShared('response', function () {
    return new \Zend\Diactoros\Response();
});

$di->setShared('routerContainer', function () {
    return new \Aura\Router\RouterContainer();
});

$di->setShared('routerMap', function () use ($di) {
    return $di->get('routerContainer')->getMap();
});

$di->setShared('routerMatcher', function () use ($di) {
    return $di->get('routerContainer')->getMatcher();
});

/** @var Map $routerMap */
$routerMap = $di->get('routerMap');
$routerMap->get(
    'product.detail.api',
    '/api/product/detail/{id}',
    function (ServerRequestInterface $request, ResponseInterface $response) use ($di) {
        $controller = new ProductController($di->get('config'));
        $product = $controller->detail($request->getAttribute('id'));
        $response->getBody()->write($product);
        return $response;
    }
);
/** @var \Zend\Diactoros\ServerRequest $request */
$request = $di->get('request');
/** @var \Zend\Diactoros\Response $response */
$response = $di->get('response');
/** @var Matcher $routerMatcher */
$routerMatcher = $di->get('routerMatcher');
$route = $routerMatcher->match($request);
if(!$route) {
    echo 'No route'; exit;
}
foreach ($route->attributes as $attribute => $value) {
    $request = $request->withAttribute($attribute, $value);
}
$handler = $route->handler;
try {
    $response = $handler($request, $response);
} catch (\Exception $e) {
    $response->getBody()->write($e->getMessage());
}
echo $response->getBody();
