<x-layout-app>
    <x-navbar />
    <div class="container py-4" x-data="products">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="fw-bold mb-4">Daftar Menu</h3>
                <!-- Improved Search Bar -->
                <div class="input-group input-group-lg shadow-sm">
                    <input type="text" class="form-control border-end-0" placeholder="Cari Produk Disini">
                    <button class="input-group-text bg-white border-start-0" id="inputGroup-sizing-lg">
                        <i class="fa-solid fa-magnifying-glass text-secondary"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Category Pills -->
        <div class="row mb-4">
            <div class="col-12">
                <ul class="nav nav-pills gap-2">
                    <li class="nav-item">
                        <button class="nav-link active px-4" aria-current="page">All</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link px-4">Makanan</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link px-4">Minuman</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link px-4">Gorengan</button>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Product Cards -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <template x-for="product in productList" :key="product.id">
                <div class="col">
                    <div class="card h-100 shadow-sm hover-shadow transition">
                        <img :src="product.image" class="card-img-top" :alt="product.name">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title fw-bold mb-0" x-text="product.name"></h5>
                                <span class="fs-5 fw-semibold text-primary" x-text="`Rp. ${product.price}`"></span>
                            </div>
                            <div class="mb-3">
                                <span class="badge rounded-pill text-bg-primary" x-text="product.category"></span>
                                <template x-for="tag in product.tags" :key="tag">
                                    <span class="badge rounded-pill text-bg-secondary me-1" x-text="tag"></span>
                                </template>
                            </div>
                            <p class="card-text flex-grow-1" x-text="product.description"></p>
                            <button @click="addToCart(product)"
                                class="btn btn-primary w-100 d-flex gap-2 align-items-center justify-content-center">
                                <i class="fa-solid fa-plus"></i>
                                <span>Tambahkan ke keranjang</span>
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="cartToast" class="toast align-items-center text-bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fa-solid fa-check me-2"></i>
                    Item berhasil ditambahkan ke keranjang
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('cart', {
                items: [],

                addItem(product) {
                    const existingItem = this.items.find(item => item.id === product.id);
                    if (existingItem) {
                        existingItem.quantity += 1;
                    } else {
                        this.items.push({
                            ...product,
                            quantity: 1
                        });
                    }
                },

                removeItem(item) {
                    const index = this.items.findIndex(cartItem => cartItem.id === item.id);
                    if (index > -1) {
                        this.items.splice(index, 1);
                    }
                },

                incrementQuantity(item) {
                    item.quantity += 1;
                },

                decrementQuantity(item) {
                    if (item.quantity > 1) {
                        item.quantity -= 1;
                    } else {
                        this.removeItem(item);
                    }
                },

                calculateTotal() {
                    return this.items.reduce((total, item) => {
                        return total + (parseInt(item.price) * item.quantity);
                    }, 0).toLocaleString('id-ID');
                },

                getItemCount() {
                    return this.items.length;
                },
                async bayar() {
                    try {
                        const response = await fetch('/payment/create', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                total: parseInt(this.calculateTotal().replace(/[.,]/g,
                                    '')),
                                items: this.items.map(item => ({
                                    id: item.id,
                                    price: item.price,
                                    quantity: item.quantity,
                                    name: item.name
                                })),
                                name: 'Customer Name', // You might want to get this from a form
                                email: 'customer@email.com',
                                phone: '08123456789'
                            })
                        });

                        const data = await response.json();

                        if (data.snap_token) {
                            window.snap.pay(data.snap_token, {
                                onSuccess: function(result) {
                                    // Handle success
                                    console.log('Payment success:', result);
                                    Alpine.store('cart').items = [];
                                },
                                onPending: function(result) {
                                    // Handle pending
                                    console.log('Payment pending:', result);
                                },
                                onError: function(result) {
                                    // Handle error
                                    console.log('Payment error:', result);
                                },
                                onClose: function() {
                                    // Handle customer closed the popup without finishing the payment
                                    console.log(
                                        'Customer closed the popup without finishing payment'
                                    );
                                }
                            });
                        }
                    } catch (error) {
                        console.error('Payment error:', error);
                        alert('Payment failed. Please try again.');
                    }
                }

            });

            // Products data component
            Alpine.data('products', () => ({
                productList: [{
                        id: 1,
                        name: 'Spicy Beef Burger',
                        price: '35000',
                        category: 'Makanan',
                        tags: ['Spicy', 'Bestseller'],
                        description: 'Juicy beef patty with spicy sauce, lettuce, tomato, and cheese',
                        image: '{{ asset('dist/img/placeholder.svg') }}'
                    },
                    {
                        id: 2,
                        name: 'Chicken Wings',
                        price: '28000',
                        category: 'Makanan',
                        tags: ['Crispy'],
                        description: 'Crispy chicken wings with special sauce',
                        image: '{{ asset('dist/img/placeholder.svg') }}'
                    },
                    {
                        id: 3,
                        name: 'Ice Lemon Tea',
                        price: '12000',
                        category: 'Minuman',
                        tags: ['Fresh'],
                        description: 'Refreshing ice lemon tea with fresh lemon',
                        image: '{{ asset('dist/img/placeholder.svg') }}'
                    },
                    {
                        id: 4,
                        name: 'Pisang Goreng',
                        price: '15000',
                        category: 'Gorengan',
                        tags: ['Sweet'],
                        description: 'Crispy fried banana with cheese and chocolate',
                        image: '{{ asset('dist/img/placeholder.svg') }}'
                    },
                    {
                        id: 5,
                        name: 'Nasi Goreng Special',
                        price: '32000',
                        category: 'Makanan',
                        tags: ['Spicy', 'Popular'],
                        description: 'Special fried rice with chicken, shrimp, and vegetables',
                        image: '{{ asset('dist/img/placeholder.svg') }}'
                    },
                    {
                        id: 6,
                        name: 'Milk Shake',
                        price: '18000',
                        category: 'Minuman',
                        tags: ['Sweet', 'Cold'],
                        description: 'Creamy milkshake with various flavors',
                        image: '{{ asset('dist/img/placeholder.svg') }}'
                    },
                    {
                        id: 7,
                        name: 'Tahu Isi',
                        price: '8000',
                        category: 'Gorengan',
                        tags: ['Vegetarian'],
                        description: 'Stuffed tofu with vegetables and spices',
                        image: '{{ asset('dist/img/placeholder.svg') }}'
                    },
                    {
                        id: 8,
                        name: 'Chicken Katsu',
                        price: '30000',
                        category: 'Makanan',
                        tags: ['Crispy', 'Japanese'],
                        description: 'Crispy chicken katsu with special sauce',
                        image: '{{ asset('dist/img/placeholder.svg') }}'
                    },
                    {
                        id: 9,
                        name: 'Fresh Orange Juice',
                        price: '15000',
                        category: 'Minuman',
                        tags: ['Fresh', 'Healthy'],
                        description: 'Fresh squeezed orange juice',
                        image: '{{ asset('dist/img/placeholder.svg') }}'
                    },
                    {
                        id: 10,
                        name: 'Bakwan Sayur',
                        price: '10000',
                        category: 'Gorengan',
                        tags: ['Vegetarian'],
                        description: 'Vegetable fritters with various vegetables',
                        image: '{{ asset('dist/img/placeholder.svg') }}'
                    }
                ],

                // We'll use the cart store methods via this simple interface
                addToCart(product) {
                    Alpine.store('cart').addItem(product);
                    const toast = new bootstrap.Toast(document.getElementById('cartToast'));
                    toast.show();
                }
            }));


        });
    </script>

    <style>
        .hover-shadow:hover {
            transform: translateY(-3px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        }

        .transition {
            transition: all .2s ease-in-out;
        }

        .nav-pills .nav-link {
            color: #6c757d;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .nav-pills .nav-link.active {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
    </style>
</x-layout-app>
