<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use App\Entity\Order;

/**
 * Brand controller.
 *
 * @Route("/")
 */
class OrderController extends Controller
{

    /**
     * Create Order.
     * @FOSRest\Post("/order")
     *
     * @return array
     */

    public function postOrderAction(Request $request)
    {
        $order = new Order();
        $order_time = date('Y-m-d H:i:s', $request->get('orderTime'));
        $date = new \DateTime($order_time);
        $order->setOrder($date);
        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();

        // return View::create($order, Response::HTTP_CREATED , []);
        return new Response("Success", 200);
        
    }

    /**
     * Create Order.
     * @FOSRest\Get("/orders")
     *
     * @return array
     */

    public function getOrderAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Order::class);
        
        // query for a single Product by its primary key (usually "id")
        $orders = $repository->findall();
        $ret = json_encode($orders);
        // return View::create($order, Response::HTTP_CREATED , []);
        return new Response($ret, 200);
        
    }
}