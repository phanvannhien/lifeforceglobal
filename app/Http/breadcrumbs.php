<?php

	// Home
	Breadcrumbs::register('home', function($breadcrumbs)
	{
	    $breadcrumbs->push('Home', route('front.index'));
	});

	// Home > About
	Breadcrumbs::register('about', function($breadcrumbs)
	{
	    $breadcrumbs->parent('home');
	    $breadcrumbs->push('About Us', route('front.aboutus'));
	});

	// Home > Contact Us
	Breadcrumbs::register('contact', function($breadcrumbs)
	{
	    $breadcrumbs->parent('home');
	    $breadcrumbs->push('Contact Us', route('front.contactus'));
	});



	// Home > Category
	Breadcrumbs::register('category', function($breadcrumbs,$category)
	{
	    $breadcrumbs->parent('home');
	    $breadcrumbs->push($category->category_name, route('front.category',$category->id));
	});

	// Home > Category > Product
	Breadcrumbs::register('product', function($breadcrumbs,$product)
	{
		$category = App\Models\Categories::find($product->category_id);
	    $breadcrumbs->parent('category',$category);
	    $breadcrumbs->push($product->product_name, route('front.product',[$product->id,Str::slug($product->product_name) ]));
	});

	

	

