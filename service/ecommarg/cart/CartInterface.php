<?php 
	namespace ecommarg\cart;

	use ecommarg\cart\ProductInterface as Product;

	Interface CartInterface
	{

		Public function add(Product $P);

		Public function get($id);

	}