<?php

namespace src\Transportation;

/**
 * Class AbstractTransportation
 *
 * @package src\Transportation
 */
abstract class AbstractTransportation implements TransportationInterface
{

    /**
     * @var string
     */
    protected $departure;

    /**
     * @var string
     */
    protected $arrival;

    const MESSAGE_FINAL_DESTINATION = 'You have arrived at your final destination.';

    /**
     * @param array $trip
     */
    public function __construct(array $trip)
    {
        foreach ($trip as $key => $value) {
            // Make attribute's first character lowercase
            $property = lcfirst($key);

            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }

}
