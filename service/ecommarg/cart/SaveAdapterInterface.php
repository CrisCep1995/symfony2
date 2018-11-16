<?php 
	namespace ecommarg\cart;
	

	interface SaveAdapterInterface
	{	

		public function set($key, $value);
		public function get($key);
		public function getAll();
		
	}
