<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * ToyCarController controller.
 * @Route("/api", name="api_")
 */
class ToyCarController extends FOSRestController
{

    /**
     * Initiate Place for the car.
     * @Rest\Post("/place")
     *
     * @return Response
     */
    public function postPlaceAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize($data, 'json');
        return new Response($response);
        exit;
    }

    /**
     * Initiate Turning(L,R) for the car.
     * @Rest\Post("/turn")
     *
     * @return Response
     */
    public function postTurnAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $x = $data['x'];
        $y = $data['y'];
        $f = $data['f'];
        $t = $data['t'];
        $new_position = $this->turnCar($x, $y, $f, $t);

        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize($new_position, 'json');
        return new Response($response);
    }

    /**
     * Taking a Turn for the car
     *
     * @param integer $x
     * @param integer $y
     * @param string $f
     * @param string $t
     * @return array
     */
    function turnCar(int $x, int  $y, string $f, string $t): array
    {
        $directions = ['N', 'E', 'S', 'W'];
        if ($t == 'R') {
            $key  = array_search($f, $directions);
            $f = empty($directions[$key + 1]) ? $directions[0] : $directions[$key + 1];
        }
        if ($t == 'L') {
            $key  = array_search($f, $directions);
            $f = empty($directions[$key - 1]) ? $directions[count($directions) - 1] : $directions[$key - 1];
        }

        return  ['x' => $x, 'y' => $y, 'f' => $f];
    }
    /**
     * Initiate Movement for the car.
     * @Rest\Post("/move")
     *
     * @return Response
     */
    public function postMoveAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $x = $data['x'];
        $y = $data['y'];
        $f = $data['f'];
        $new_position = $this->alterPosition($x, $y, $f);

        return self::validatePosition($new_position['x'], $new_position['y'], $new_position['f']);

        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize($new_position, 'json');
        return new Response($response);
    }

    /**
     * Get Elements of table cloths
     *
     * @return array
     */
    public function getTableCloth(): array
    {
        $tableCloth = [];
        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 5; $j++) {
                $tableCloth[] = $i . $j;
            }
        }
        return $tableCloth;
    }
    /**
     * Change the Direction of the car
     *
     * @param integer $x
     * @param integer $y
     * @param string $f
     * @return array
     */
    public function alterPosition(int $x, int $y, string $f): array
    {

        switch ($f) {
            case 'N':
                $xy = (int) ($x . $y) + 10;
                break;
            case 'S':
                $xy = (int) ($x . $y) - 10;

                break;
            case 'E':
                $xy = (int) ($x . $y) + 1;
                break;
            case 'W':
                $xy = (int) ($x . $y) - 1;
                break;
        }
        $xy = str_pad($xy, 2, '0', STR_PAD_LEFT);
        $xy = str_split($xy);
        $x = empty($xy[0]) ? 0 : $xy[0];
        $y = empty($xy[1]) ? 0 : $xy[1];

        return ['x' => $x, 'y' => $y, 'f' => $f];
    }



    /**
     * errorResponse function
     * basic function to give the standard output while there is an error
     * @param integer $status
     * @param string $mesaage
     * @return Response
     */
    private function errorResponse(int $status, string $mesaage): Response
    {
        $resp = ['status' => $status, 'message' => $mesaage];
        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize($resp, 'json');
        return new Response($response);
        exit;
    }

    /**
     * validate the changed position
     *
     * @param [type] $x
     * @param [type] $y
     * @param [type] $f
     * @return void
     */
    public function validatePosition($x, $y, $f)
    {
        $tableCloth = $this->getTableCloth();
        if (!in_array($x . $y, $tableCloth)) {

            return self::errorResponse(0, 'Not a valid Action.');
            exit;
        }
        return ['x' => $x, 'y' => $y, 'f' => $f];
    }
}
