<div x-data="{showRegister: @entangle('showRegister')}" class="relative flex-1 w-full px-5 py-2 overflow-y-hidden">
    <div class="relative">
        <input wire:model="query" wire:keydown.enter="addViaBarcode" placeholder="Search for product or Scan product barcode.." autofocus type="text" class="w-full mb-2 text-xl text-primary-600 form-input">
        <i class="absolute text-3xl cursor-pointer hover:text-secondary-500 right-2 top-2 material-icons text-primary-600">point_of_sale</i>
    </div>
    <div class="flex h-full">
        <div class="w-2/5 mr-2 left">
            <div class="w-full h-full mb-5 overflow-y-scroll bg-white rounded">
                <div class="sticky top-0 z-10 p-2 bg-white">
                    <div class="p-1 rounded title bg-primary-600">
                        <h1 class="flex items-center"><i class="mr-1 material-icons">dns</i>Products List</h1>
                    </div>
                    <div class="p-1 my-2 text-primary-600">
                        <label for="category">Category</label>
                        <select wire:change="filterCategory" name="category" wire:model="selected_category" class="w-full max-h-32 form-select" size="1" id="category">
                            <option value="0">All Products</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="inline-block px-2 pb-15">
                    <div class="grid w-full grid-cols-2 gap-2 my-2 xl:grid-cols-3">
                        @forelse ($products as $product)
                        <div wire:click="addProduct({{ $product->id }})" class="relative flex flex-col items-center duration-150 transform cursor-pointer hover:scale-105 min-h-40 min-w-32 bg-primary-500">
                            <div class="w-20 h-20 mt-2">
                                <img src="{{ $product->image->url }}" alt="default" class="object-cover w-full">
                            </div>
                            <h1 class="px-2 mt-1 text-xs font-semibold leading-tight text-center uppercase">{{ $product->name }}</h1>
                            <h1 class="px-2 mt-1 text-xs font-semibold leading-tight text-center text-gray-500 uppercase">{{ $product->brand->name }}</h1>
                            <h1 class="mb-10 text-xs leading-tight text-center">&#8369; {{ number_format($product->price,2) }}</h1>
                            <h1 class="absolute bottom-0 left-0 p-1 text-xs leading-tight bg-secondary-500">In stock: {{ $product->stock }}</h1>
                        </div>
                        @empty
                            <h1 class="text-center text-primary-600">No products found.</h1>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="w-3/5 h-full p-2 mb-5 ml-2 bg-white rounded right">
            <div class="p-1 rounded title bg-primary-600">
                <h1 class="flex items-center"><i class="mr-1 material-icons">shopping_cart</i>Products List</h1>
            </div>
            <div class="flex justify-between p-1 mt-2 text-primary-600">
                <h1 class="flex items-center border-2 rounded-lg border-primary-600"><i class="mx-2 border-r-2 border-primary-600 material-icons">person</i>
                        <select wire:model="customer_id" wire:change="updateCustomer" name="customer" id="customer" class="border-0 cursor-pointer form-select">
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->user->name }}</option>
                            @endforeach
                        </select>
                    <i wire:click="$set('showRegister',true)" class="mx-2 border-l-2 cursor-pointer hover:text-green-500 border-primary-600 material-icons">person_add</i></h1>
                <button onclick="confirm('Discard current transaction?')||event.stopImmediatePropagation()" wire:click="newInvoice" class="p-2 font-semibold text-white uppercase bg-primary-600 hover:text-primary-500">New Invoice</button>
            </div>
            <div class="w-full p-1 mt-3">
                <!-- component -->
                <div class="flex flex-col w-full overflow-auto h-halfscreen">
                    <div class="flex-grow">
                    <table class="relative w-full border text-primary-600">
                        <thead>
                        <tr>
                            <th class="sticky top-0 px-6 py-3 text-sm text-red-900 uppercase bg-red-300">Item</th>
                            <th class="sticky top-0 px-6 py-3 text-sm text-red-900 uppercase bg-red-300">In Stock</th>
                            <th class="sticky top-0 px-6 py-3 text-sm text-red-900 uppercase bg-red-300">Quantity</th>
                            <th class="sticky top-0 px-6 py-3 text-sm text-red-900 uppercase bg-red-300">Price</th>
                            <th class="sticky top-0 px-6 py-3 text-sm text-red-900 uppercase bg-red-300">Discount</th>
                            <th class="sticky top-0 px-6 py-3 text-sm text-red-900 uppercase bg-red-300">Tax</th>
                            <th class="sticky top-0 px-6 py-3 text-sm text-red-900 uppercase bg-red-300">Subtotal</th>
                        </tr>
                        </thead>
                        <tbody class="bg-red-100 divide-y">
                        @if(isset($sale))
                        @forelse ($sale->products as $product)
                        <tr>
                            <td class="px-6 py-4 text-sm text-center">{{ $product->name }}</td>
                            <td class="px-6 py-4 text-sm text-center">{{ $product->stock }}</td>
                            <td class="px-6 py-4 text-sm text-center">{{ $product->pivot->quantity }}</td>
                            <td class="px-6 py-4 text-sm text-center whitespace-no-wrap">&#8369; {{ $product->price }}</td>
                            <td class="px-6 py-4 text-sm text-center">{{ $product->pivot->discount }}</td>
                            <td class="px-6 py-4 text-sm text-center">{{ $product->pivot->tax }}</td>
                            <td class="px-6 py-4 text-sm text-center whitespace-no-wrap">&#8369; {{ $product->pivot->total }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center">Add products</td>
                        </tr>
                        @endforelse
                        @else
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center">Add products</td>
                        </tr>
                        @endif

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-show.transition="showRegister" class="absolute inset-0 z-20 flex items-center justify-center bg-opacity-50 bg-primary-500">
        <div @click.away="showRegister=false"  class="bg-white w-halfscreen text-primary-600">
            <div class="p-5">
                <h1 class="font-semibold border-b-2 border-primary-600">Register new customer</h1>
                <div class="grid grid-cols-3 gap-3 my-2">
                    <div class="flex flex-col text-sm">
                        <label for="name">Name</label>
                        <input wire:model.lazy="customer_name" placeholder="John Doe" type="text" class="text-sm form-input">
                        @error('customer_name')
                            <h1 class="text-xs italic text-red-600">{{ $message }}</h1>
                        @enderror
                    </div>
                    <div class="flex flex-col text-sm">
                        <label for="phone">Phone</label>
                        <input wire:model.lazy="customer_phone" placeholder="09123456789" type="text" class="text-sm form-input">
                        @error('customer_phone')
                        <h1 class="text-xs italic text-red-600">{{ $message }}</h1>
                        @enderror
                    </div>
                    <div class="flex flex-col text-sm">
                        <label for="email">Email</label>
                        <input wire:model.lazy="customer_email" placeholder="johndoe@gmail.com" type="text" class="text-sm form-input">
                        @error('customer_email')
                        <h1 class="text-xs italic text-red-600">{{ $message }}</h1>
                        @enderror
                    </div>

                </div>
                <button wire:click="registerCustomer" class="w-full p-2 hover:text-white bg-secondary-500">Register Customer</button>
            </div>
        </div>
    </div>
    <div wire:loading wire:target="newInvoice,registerCustomer,updateCustomer,addProduct,addViaBarcode,filterCategory">
        <div  class="fixed inset-0 z-30 flex items-center justify-center bg-opacity-50 bg-primary-500">
            <i style="font-size: 5rem" class="fa fa-pulse text-primary-600 fa-spinner"></i>
        </div>
    </div>
</div>
