<?php
namespace Location\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Location\Service\ImageManager;
use Location\Controller\LocationController;
use Location\Model\LocationTable;

/**
 * This is the factory for ImageController. Its purpose is to instantiate the Controller
 * Class LocationControllerFactory
 * @package Location\Controller\Factory
 */
class LocationControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $imageManager = $container->get(ImageManager::class);
        $locationTable = $container->get(LocationTable::class);

        // Instantiate the controller and inject dependencies
        return new LocationController($locationTable, $imageManager);
    }
}