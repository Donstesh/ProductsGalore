<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductManagement extends Component
{
    public $products;
    public $name;
    public $image_url;
    public $price;

    public function render()
    {
        $this->products = Product::all();
        $products = Product::paginate(10); 
        return view('livewire.product-management');
    }

    public function createProduct()
    {
        $this->validate([
            'name' => 'required|string',
            'image_url' => 'required|url',
            'price' => 'required|numeric',
        ]);

        Product::create([
            'name' => $this->name,
            'image_url' => $this->image_url,
            'price' => $this->price,
        ]);

        $this->resetFields();
    }

    private function resetFields()
    {
        $this->name = '';
        $this->image_url = '';
        $this->price = '';
    }
}
