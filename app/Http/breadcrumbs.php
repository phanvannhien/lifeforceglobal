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

	// Home > Feedback
	Breadcrumbs::register('feedback', function($breadcrumbs)
	{
	    $breadcrumbs->parent('home');
	    $breadcrumbs->push('Feedback Us', route('front.feedback'));
	});

	// Home > Products
	Breadcrumbs::register('products', function($breadcrumbs)
	{
	    $breadcrumbs->parent('home');
	    $breadcrumbs->push('Products', route('front.products'));
	});

	// Home > Category
	Breadcrumbs::register('category', function($breadcrumbs,$category)
	{
	    $breadcrumbs->parent('home');
	    $breadcrumbs->push($category->category_name, route('front.category',[ $category->id, Str::slug($category->category_name)]) );
	});

	// Home > Category > Product
	Breadcrumbs::register('product', function($breadcrumbs,$product)
	{
		$category = App\Models\Categories::find($product->category_id);
        if( !is_null($category)){
            $breadcrumbs->parent('category',$category);
        }
	   
	    $breadcrumbs->push($product->product_name, route('front.product',[$product->id,Str::slug($product->product_name) ]));
	});

	

	

