<?php
namespace Location\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Location\Model\LocationTable;
use Location\Form\LocationForm;
use Location\Model\Location;

/**
 * Class LocationController
 * @package Location\Controller
 * @author Frank Clark
 */
class LocationController extends AbstractActionController
{
    /** @var LocationTable  */
    private $table;

    /**
     * LocationController constructor.
     * @param LocationTable $table
     */
    public function __construct(LocationTable $table)
    {
        $this->table = $table;
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $data = $this->table->fetchAllToArray();
        return new ViewModel([
            'locations' => json_encode($data),
        ]);
    }

    /**
     * @return ViewModel
     */
    public function locationsAction()
    {
        return new ViewModel([
            'locations' => $this->table->fetchAll(),
        ]);
    }

    /**
     * @return array|\Zend\Http\Response
     */
    public function addAction()
    {
        $form = new LocationForm();
        $form->get('submit')->setValue('Add');

        /** @var \Zend\Http\PhpEnvironment\Request $request */
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return ['form' => $form];
        }

        $location = new Location();
        $form->setInputFilter($location->getInputFilter());

        /** @var \Zend\Stdlib\Parameters $data */
        $data = $request->getPost();
        $data = $data->toArray();

        // Get the LatLong from the location title
        $address = $request->getPost('title');
        $sanitisedAddress = str_replace(' ', '+', $address);
        $geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $sanitisedAddress . '&sensor=false');
        $output = json_decode($geocode);
        $title = $output->results[0]->formatted_address;
        $latitude = $output->results[0]->geometry->location->lat;
        $longitude = $output->results[0]->geometry->location->lng;

        // Use the name provided from google so that it's tidy
        $data['title'] = $title;
        $data['long'] = $longitude;
        $data['lat'] = $latitude;

        $form->setData($data);

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $location->exchangeArray($form->getData());
        $this->table->saveLocation($location);
        return $this->redirect()->toRoute('location');
    }

    /**
     * @return array|\Zend\Http\Response
     */
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('location', ['action' => 'locations']);
        }

        try {
            $location = $this->table->getLocation($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('location', ['action' => 'index']);
        }

        $form = new LocationForm();
        $form->bind($location);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (!$request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($location->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        $this->table->saveLocation($location);

        // Redirect to location list
        return $this->redirect()->toRoute('location', ['action' => 'index']);
    }

    /**
     * @return array|\Zend\Http\Response
     */
    public function deleteAction()
    {
        // Redirect back to the homepage if this id doesn't exist anymore
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('location');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $this->table->deleteLocation($id);
            }

            // Redirect to list of locations
            return $this->redirect()->toRoute('location', ['action' => 'locations']);
        }

        return [
            'id'    => $id,
            'location' => $this->table->getLocation($id),
        ];
    }
}