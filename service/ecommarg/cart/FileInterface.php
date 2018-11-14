<?php 
namespace ecommarg\cart;
use ecommarg\cart\ProductoInterface as Product;

	interface FileInterface
	{
		public function set(Product $p);

		public function get($id);
		
		public function getAll();

	}