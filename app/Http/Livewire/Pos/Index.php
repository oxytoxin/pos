<?php

namespace App\Http\Livewire\Pos;

use App\Models\Sale;
use App\Models\User;
use App\Models\Cashier;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class Index extends Component
{

    public $cashier;
    public $products;
    public $query = "";
    public $categories;
    public $selected_category = 0;
    public $sale;
    public $customer_id = 1;
    public $customer;
    public $customers;


    // new customer properties
    public $showRegister = false;
    public $customer_name = "";
    public $customer_phone = "";
    public $customer_email = "";

    public function mount()
    {
        $this->products = Product::all();
        $this->customers = Customer::all();
        $this->categories = Category::all();
        $this->customer = Customer::find($this->customer_id);
        $this->cashier = auth()->user()->cashier;
        $pendingSale = $this->cashier->sales->where('status', 'pending')->first();
        if ($pendingSale)
            $this->sale = $pendingSale;
    }

    public function render()
    {
        if ($this->query) {
            if ($this->selected_category)
                $this->products = Product::where('name', 'like', "%$this->query%")->where('category_id', $this->selected_category)->orWhere('barcode', 'like', "%$this->query%")->where('category_id', $this->selected_category)->get();
            else $this->products = Product::where('name', 'like', "%$this->query%")->orWhere('barcode', 'like', "%$this->query%")->get();
        } else {
            if ($this->selected_category)
                $this->products = Product::where('name', 'like', "%$this->query%")->where('category_id', $this->selected_category)->get();
            else $this->products = Product::all();
        }
        return view('livewire.pos.index')
            ->extends('layouts.master');
    }

    public function filterCategory()
    {
        if ($this->selected_category) $this->products = Category::find($this->selected_category)->products;
        else $this->products = Product::all();
    }

    public function addViaBarcode()
    {
        if (strlen($this->query) == 13) {
            $product = Product::where('barcode', $this->query)->first();
            if ($product) {
                if (!$this->sale) {
                    $this->sale = Sale::create([
                        'reference_no' => time() . auth()->user()->phone,
                        'customer_id' => $this->customer_id,
                        'cashier_id' => auth()->user()->cashier->id,
                    ]);
                }
                if ($this->sale->products->contains($product)) {
                    $this->sale->products->find($product)->pivot->update([
                        'quantity' => $this->sale->products->find($product)->pivot->quantity + 1,
                    ]);
                } else $this->sale->products()->attach($product->id);
                $this->sale = Sale::find($this->sale->id);
                $this->query = "";
                $this->dispatchBrowserEvent('success', ['message' => 'Product added!']);
            } else {
                $this->dispatchBrowserEvent('warning', ['message' => 'Product not found.']);
                $this->query = "";
                return false;
            }
        } else {
            $this->dispatchBrowserEvent('error', ['message' => 'Invalid barcode!']);
            $this->query = "";
            return false;
        }
    }
    public function addProduct(Product $product)
    {
        if (!$this->sale) {
            $this->sale = Sale::create([
                'reference_no' => time() . auth()->user()->phone,
                'customer_id' => $this->customer_id,
                'cashier_id' => auth()->user()->cashier->id,
            ]);
        }
        if ($this->sale->products->contains($product)) {
            $this->sale->products->find($product)->pivot->update([
                'quantity' => $this->sale->products->find($product)->pivot->quantity + 1,
            ]);
        } else $this->sale->products()->attach($product->id);
        $this->sale = Sale::find($this->sale->id);
        $this->dispatchBrowserEvent('success', ['message' => 'Product added!']);
    }

    public function updateCustomer()
    {
        if ($this->sale) {
            $this->sale->update([
                'customer_id' => $this->customer_id,
            ]);
        }
    }

    public function newInvoice()
    {
        if ($this->sale) {
            $this->sale->delete();
            $this->sale = null;
            $this->customer_id = 1;
        }
    }

    public function registerCustomer()
    {
        $this->validate([
            'customer_name' => 'required',
            'customer_phone' => 'required|min:11|max:11|unique:users,phone',
            'customer_email' => 'required|email|unique:users,email'
        ]);

        $username = strtolower(explode(" ", trim($this->customer_name))[0]) . substr($this->customer_phone, -4);

        $u = User::create([
            'name' => $this->customer_name,
            'username' => $username,
            'phone' => $this->customer_phone,
            'email' => $this->customer_email,
            'password' => Hash::make('password'),
        ]);
        $c = Customer::create([
            'user_id' => $u->id
        ]);
        $this->showRegister = false;
        $this->dispatchBrowserEvent('success', ['message' => 'Customer registered!']);
        $this->customer_name = "";
        $this->customer_phone = "";
        $this->customer_email = "";
        $this->customers = Customer::all();
        $this->customer_id = $c->id;
        $this->updateCustomer();
    }
}
