<?php

namespace Location;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\LocationTable::class => function ($container) {
                    $tableGateway = $container->get(Model\LocationTableGateway::class);
                    return new Model\LocationTable($tableGateway);
                },
                Model\LocationTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Location());
                    return new TableGateway('location', $dbAdapter, null, $resultSetPrototype);
                }
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\LocationController::class => function ($container) {
                    return new Controller\LocationController(
                        $container->get(Model\LocationTable::class)
                    );
                },
            ],
        ];
    }
}