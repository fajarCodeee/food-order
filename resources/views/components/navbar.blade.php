<nav class="navbar bg-body-tertiary border-bottom border-secondary mb-3">
    <div class="container py-1" x-data>
        <a class="navbar-brand mb-0 h1 fw-bold">{{ config('app.name') }}</a>
        <div class="d-flex">
            <button class="btn btn-light btn-md position-relative" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#canvasCheckout" aria-controls="canvasCheckout">
                <i class="fa-solid fa-cart-shopping"></i>
                <!-- <template> -->
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    x-text="$store.cart.getItemCount()"></span>
                <!-- </template> -->
            </button>

                    </div>
    </div>
</nav>
<div class="offcanvas offcanvas-end" tabindex="-1" id="canvasCheckout" aria-labelledby="canvasCheckoutLabel" x-data>
    <div class="offcanvas-header">
        <h5 class="offcanvas-title d-flex align-items-center gap-3" id="canvasCheckoutLabel">
            <i class="fa-solid fa-list"></i>Your Cart
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
        <div class="flex-grow-1">
            <template x-if="$store.cart.items.length === 0">
                <div class="text-center text-muted">
                    <i class="fa-solid fa-cart-shopping fs-1 mb-3"></i>
                    <p>Your cart is empty</p>
                </div>
            </template>
            <template x-if="$store.cart.items.length > 0">
                <!-- <p x-text="$store.cart.items.length"></p> -->
                <div>
                    <div class="list-group list-group-flush">
                        <template x-for="item in $store.cart.items" :key="item.id">
                            <div class="list-group-item">
                                <div class="d-flex gap-3">
                                    <img :src="item.image" class="rounded"
                                        style="width: 64px; height: 64px; object-fit: cover;">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0" x-text="item.name"></h6>
                                        <p class="text-primary mb-0" x-text="`Rp. ${item.price}`"></p>
                                        <div class="d-flex align-items-center gap-2 mt-2">
                                            <button @click="$store.cart.decrementQuantity(item)"
                                                class="btn btn-sm btn-outline-secondary">-</button>
                                            <span x-text="item.quantity"></span>
                                            <button @click="$store.cart.incrementQuantity(item)"
                                                class="btn btn-sm btn-outline-secondary">+</button>
                                            <button @click="$store.cart.removeItem(item)"
                                                class="btn btn-sm btn-outline-danger ms-auto">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>

        <div class="mt-3 p-3 bg-light rounded">
            <div class="d-flex justify-content-between mb-2">
                <span>Total:</span>
                <span class="fw-bold" x-text="`Rp. ${$store.cart.calculateTotal()}`"></span>
            </div>
            <button class="btn btn-primary w-100" @click="$store.cart.bayar()"
                :disabled=$store.cart.items.length===0>Checkout</button>
        </div>
    </div>
</div>
