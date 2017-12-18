<?php

namespace Location\Form;

use Zend\Form\Form;

/**
 * Class LocationForm
 * @package Location\Form
 * @author Frank Clark
 */
class LocationForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('location');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'title',
            'type' => 'text',
            'options' => [
                'label' => 'Title',
            ],
        ]);
        $this->add([
            'name' => 'long',
            'type' => 'text',
            'options' => [
                'label' => 'Longitude',
            ],
        ]);
        $this->add([
            'name' => 'lat',
            'type' => 'text',
            'options' => [
                'label' => 'latitude',
            ],
        ]);
        $this->add([
            'name' => 'type',
            'type' => 'text',
            'options' => [
                'label' => 'Type',
            ],
        ]);

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'type',
            'options' => array(
                'label' => 'Type',
            ),
            'attributes' => array(
                'options' => array(
                    'home' => 'Home',
                    'destination' => 'Destination',
                    'visited' => 'Visited'
                )
            )
        ));

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}