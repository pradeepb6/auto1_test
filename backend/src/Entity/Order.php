<?php // src/Entity/Article.php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Order {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;
    /**
     * @ORM\Column(type="datetime")
     */
    public $order_time;

    public function getOrder()
    {
        return $this->order_time;
    }

    public function setOrder($order_time)
    {
        $this->order_time = $order_time;
    }
}