<?php 
	namespace ecommarg\cart;
	use ecommarg\cart\SaveAdapterInterface as SaveAdapter;
	use ecommarg\cart\ProductoInterface as Product;

	class Cart implements CartInterface
	{
		Private $adapter;

		public function __construct(SaveAdapter $adapter)
		{
			$this->adapter = $adapter;	
		}


		public function add(Product $product, $quantity=1)
		{
			$quantity=(int) $quantity;
			if($quantity <=0){
				throw new \Exception("Cantidad Invalida");
				
			}
			$this->adapter->set($product->getId(), 
			json_encode(
				[
					'quantity'=>$quantity,
					'Product'=>$product 
				]
					)
			);

		}

		public function get($id)
		{
			return $this->get($id);
		}

		public function getAll()
		{
			$data= $this->adapter->getAll();
			foreach ($data as &$item) {
				$item = json_decode($item);
			}
			return $data;
			//return $this->adapter->getAll();
		}

		public function replace($array)
		{
			return $this->adapter->replace($array);
		}
		
	}



 