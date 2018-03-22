<?php 
class OrderDetails_OrderDetailUpdate_Model_Observer {
    public function newFunction($observer) {


//  Retrieve the order being placed from the event observer
//  $order = $observer->getEvent()->getOrder();
// Write a new line to var/log/product-updates.log
// $orderId     = $order->getId();
// $orderPrice  = $order->getGrandTotal();
//  Mage::log(" OrderId-{$orderId} OrderGrandTotal-{$orderPrice }  OrderCreated", null, 'myOrderDetailsfile.log');    
//     } 

$order = $observer->getEvent()->getOrder();

  try {  
// Retrieve the order details  being placed 
     $orderId     = $order->getId();
     $orderPrice  = $order->getGrandTotal();
//parameters can be change according to requirment
  	$data = array("orderId" => "$orderId ","orderTotal" => "$orderPrice");
  	
    $adminUrl='http://localhost:8080/EmployeDetailsRestFullServices/addEmpDeatils';
    $ch = curl_init();
//$data = array("orderId" => "19", "orderTotal" => "890000");


//encoding php dta supportated to json suporated data
$data_string = json_encode($data);                       
$ch = curl_init($adminUrl); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); //post method                                                                    
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))); 
          
$token = curl_exec($ch);
        Mage::log("Order has been sent to OwnServer",  null,  'myOrderDetailsfile.log');
 
        } catch (Exception $e) {
               Mage::logException($e);}
     }
        
    }?>