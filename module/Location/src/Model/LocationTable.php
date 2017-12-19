<?php

namespace Location\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

/**
 * Class LocationTable
 * @package Location\Model
 * @author Frank Clark
 */
class LocationTable
{
    /** @var TableGatewayInterface  */
    private $tableGateway;


    /**
     * LocationTable constructor.
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(
        TableGatewayInterface $tableGateway
    ) {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @return mixed
     */
    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    /**
     * Get as an array for when we want to return as JSON
     * @param $imageManager \Location\Service\ImageManager
     * @return array
     */
    public function fetchAllToArray($imageManager)
    {
        $return = array();
        $aData = $this->fetchAll()->toArray();

        foreach ($aData as $data) {
            $fileData = json_decode($data['file']);
            if ($fileData->name && !is_null($fileData->name)) {
                unset($data['file']);
                $data['file'] = $fileData->name;
            }
            $return[] = $data;
        }

        return $return;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getLocation($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find location with identifier %d',
                $id
            ));
        }

        return $row;
    }

    /**
     * @param Location $location
     */
    public function saveLocation(Location $location)
    {
        $data = [
            'title'  => $location->title,
            'long' => $location->long,
            'lat' => $location->lat,
            'type' => $location->type,
            'file' => json_encode($location->file)
        ];

        $id = (int) $location->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getLocation($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update location with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    /**
     * @param int $id
     */
    public function deleteLocation($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}
