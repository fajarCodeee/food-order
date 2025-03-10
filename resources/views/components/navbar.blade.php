<nav class="navbar bg-body-tertiary border-bottom border-secondary mb-3">
    <div class="container py-1">
        <a class="navbar-brand mb-0 h1 fw-bold">{{ config('app.name') }}</a>
        <div class="d-flex">
            <button class="btn btn-light btn-md position-relative" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#canvasCheckout" aria-controls="canvasCheckout">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">
                    0
                </span>
            </button>
        </div>
    </div>
</nav>
<div class="offcanvas offcanvas-end" tabindex="-1" id="canvasCheckout" aria-labelledby="canvasCheckoutLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title d-flex align-items-center gap-3" id="canvasCheckoutLabel"><i
                class="fa-solid fa-list"></i>Your Cart
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        ...
    </div>
</div>
