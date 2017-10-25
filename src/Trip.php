<?php

namespace src;

/**
 * Class Trip
 *
 * @package src
 */
class Trip
{
    /**
     * Boardings
     *
     * @var array
     */
    protected $boardings = array();

    /**
     * Sorted boardings
     *
     * @var array
     */
    protected $sortedBoardings = array();

    /**
     * default set of transportation
     *
     * @var array
     */
    protected static $transportations = array(
        'Train' => 'src\Transportation\Train',
        'Bus' => 'src\Transportation\Bus',
        'Plane' => 'src\Transportation\Plane',
    );

    function __construct($boardings)
    {
        $this->boardings = $boardings;
    }

    public function addBoarding($boarding)
    {
        $this->boardings[] = $boarding;
    }

    /**
     * function to sorts the boardings in order
     */
    public function sort()
    {
        // Create BoardingSorter instance to sort data
        $boardingSorter = new BoardingSorter($this->boardings);
        // Sort boardings and assign them to the sorted boardings array
        $boardingSorter->sort();
        $this->sortedBoardings = $boardingSorter->getBoardings();
    }

    /**
     * Get sorted transportations as an array of objects
     *
     * @return array
     */
    public function getTransportations()
    {
        $transportationList = array();

        if (count($this->sortedBoardings) == 0) {
            return $transportationList;
        }

        foreach ($this->sortedBoardings as $boarding) {
            $type = $boarding['Transportation'];

            if (!isset(static::$transportations[$type])){
                throw new Exception\RuntimeException(
                    sprintf(
                        'Error: Unsupported transportation - %s',
                        $type
                    )
                );
            }
            $transportationList[] = new static::$transportations[$type]($boarding);
        }

        return $transportationList;

    }

    /**
     * Function display trip info
     */
    public function tripString()
    {
        foreach ($this->getTransportations() as $idx => $transportaton) {
            echo ($idx + 1) . ". " . $transportaton->getMessage() . PHP_EOL . PHP_EOL;
            // Final destination msg
            if($idx == (count($this->boardings) -1) ){
                echo ($idx + 2) . ". " .  $transportaton::MESSAGE_FINAL_DESTINATION . PHP_EOL;
            }
        }

    }

    /**
     * Get boardings
     *
     * @return array()
     */
    public function getBoardings()
    {
        return $this->boardings;
    }

    /**
     * Get sorted boardings
     *
     * @return array()
     */
    public function getSortedBoardings()
    {
        return $this->sortedBoardings;
    }
}
