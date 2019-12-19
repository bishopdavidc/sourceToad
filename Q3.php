<?php
class Customer
{
	    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="integer"
     */
	    private $first_name;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="text", length=65535
     */
    private $last_name;
	/**
	 * A collection of addresses.
	 *
	 * @var array
	 */
	private $address = [];
    /**
     * @var string
     *
     * @ORM\Column(name="address_1", type="text", length=65535
     */
    private $address_1;

    /**
     * @var string
     *
     * @ORM\Column(name="address_2", type="text", length=65535)
     */
    private $address_2;

        /**
     * @var string
     *
     * @ORM\Column(name="city", type="text", length=65535)
     */
        private $city;

        /**
     * @var string
     *
     * @ORM\Column(name="state", type="text", length=65535)
     */
        private $state;

        /**
     * @var string
     *
     * @ORM\Column(name="zip", type="text", length=65535)
     */
        private $zip;  



        //Set the Customer's name
        public function setName($firstName,$lastName){

        	$this->first_name = $firstName;
        	$this->last_name = $lastName;
        }

        //Get the Customer's name
        public function getName(){
        	$first = $this->first_name;
        	$last = $this->last_name;
        	$name = $first." ".$last;
        	return $name; 
        }

        //Set all the addresses for the customer
        public function setAddress($addresses){ 
        	$this->address[0]['address_1'] = $addresses[0]['address_1'];
        	$this->address[0]['address_2'] = $addresses[0]['address_2'];
        	$this->address[0]['city'] = $addresses[0]['city'];
        	$this->address[0]['state'] = $addresses[0]['state'];
        	$this->address[0]['zip'] = $addresses[0]['zip'];
        	$this->address[1]['address_1'] = $addresses[1]['address_1'];
        	$this->address[1]['address_2'] = $addresses[1]['address_2'];
        	$this->address[1]['city'] = $addresses[1]['city'];
        	$this->address[1]['state'] = $addresses[1]['state'];
        	$this->address[1]['zip'] = $addresses[1]['zip'];
        }

        //Get all the addresses for the customer
        public function getAddresses(){
        	return $this->address;
        }

 		//Set the shipping address
        public function setShippingAddress($address){
        	$this->address[1]['address_1'] = $address['address_1'];
        	$this->address[1]['address_2'] = $address['address_2'];
        	$this->address[1]['city'] = $address['city'];
        	$this->address[1]['state'] = $address['state'];
        	$this->address[1]['zip'] = $address['zip'];
        }

        //Get the shipping address
        public function getShippingAddress(){
        	$shipping[] = $this->address[1];
        	$address = $shipping['address_1'].",".$shipping['address_2'].",".$shipping['city'].",".$shipping['state'].",".$shipping['zip'];
        	return $address;
        }
    }

    //Cart Class
    class Cart
    {
	/**
	 * A collection of cart items.
	 *
	 * @var array
	 */
	private $items = [];
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer"
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", length=65535
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer", length=65535
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="text", length=65535)
     */
    private $price;

//Set Items in Cart
    public function setItems($id,$name,$quantity,$price){
    	$this->items['id'] = $id;
    	$this->items['name'] = $name;
    	$this->items['quantity'] = $quantity;
    	$this->items['price'] = $price;
    }

    //Get Items in Car
    public function getItems()
    {
    	return $this->items;
    }

//Cost of item in cart, including shipping and tax
    public function getItemCost($item,$customer,$tax)
    {

    	$shippingVals = $this->shippingAPI();
    	$shippingVals = json_decode($shippingVals, true);
    	$quantity = $item['quantity'];
    	$price = $item['price'];
    	$zip = $customer['address'][1]['zip'];
    	$shipRate = $shippingVals[$zip]['rate'];
    	$itemCost = ($quantity*$price*$tax)*$shipRate;
    	return $itemCost;
    }





//Subtotal and total for all items
    public function getTotalItem()
    {
    	$costVals = array();
    	$totalCost = 0;
    	$subtotalCost = 0;
    	foreach ($items as $item) {
    		$priceVal = str_replace("$", "", $item['price']);
    		$subtotalCost += $item['quantity']*$priceVal;
    	}
    	$totalCost = $subtotalCost * 1.07;
    	$costVals['subtotal'] = '$'.number_format($subtotalCost,2, '.', ',');
    	$costVals['total'] = '$'.number_format($totalCost,2, '.', ',');
    	return $costVals;
    }

    //function to access the shippingAPI
    public function shippingAPI(){
    	$curl = curl_init();

    	curl_setopt_array($curl, array(
    		CURLOPT_URL => "http://sourcetoad.com/v1/shipping",
    		CURLOPT_RETURNTRANSFER => true,
    		CURLOPT_TIMEOUT => 30,
    		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    		CURLOPT_CUSTOMREQUEST => "GET",
    		CURLOPT_HTTPHEADER => array(
    			"cache-control: no-cache"
    		),
    	));

    	$response = curl_exec($curl);
    	$err = curl_error($curl);

    	curl_close($curl);
    	return $response;
    }
}

?>