<?php

use App\Controller\Api\ToyCarController;
use PHPUnit\Framework\TestCase;

class ToyCarTest extends TestCase
{

    CONST ALTER_OPT = ['x' => 1, 'y' => 0, 'f' => 'W'];

    CONST OPT_VALIDATE_POSITION = ['x' => 1, 'y' => 100, 'f' => 'S'];

    CONST OPT_TURN_CAR = ['x' => 1, 'y' => 100, 'f' => 'S', 't'=>'R'];
    /**
     * testGetTableCloth function
     * to test the functions returns with array
     * @return void
     */
    public function testGetTableCloth()
    {
        $ToyCarController = new ToyCarController;
        $result = $ToyCarController->getTableCloth();
        $this->assertIsArray($result);
    }

    /**
     * testAlterPosition function
     * will test the output of the alter position 
     * @return void
     */
    public function testAlterPosition()
    {
        $ToyCarController = new ToyCarController;
        $result = $ToyCarController->alterPosition(1,1,'W');

        $this->assertEquals($result, self::ALTER_OPT);
    }

    /**
     * testValidatePosition function
     * will test the ValidatePosition after we get a requuest to change the position of the car
     * @return void
     */
    public function testValidatePosition()
    {
        $ToyCarController = new ToyCarController;
        $result = $ToyCarController->validatePosition(1,100, 'S');
        $this->assertNotEquals($result, self::OPT_VALIDATE_POSITION);
    } 

    /**
     * testTurnCar function
     * will test the TurnCar functionality with un expected output 
     * @return void
     */
    public function testTurnCar()
    {
        $ToyCarController = new ToyCarController;
        $result = $ToyCarController->turnCar(1,100, 'S','L');
        $this->assertNotEquals($result, self::OPT_TURN_CAR);
    } 
}
