<x-layout-app>
    <x-navbar />
    <div class="container mb-5">
        <h3 class="fw-bold">Daftar Menu</h3>
        <div class="input-group">
            <input type="text" class="form-control" aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-lg" placeholder="Cari Produk Disini">
            <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fa-solid fa-magnifying-glass"></i></span>
        </div>
        <div class="my-3">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link text-bg-secondary" aria-current="page" href="#">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="#">Makanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="#">Minuman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="#">Gorengan</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col">
                <div class="card" style="width: 22rem;">
                    <img src="{{ asset('dist/img/placeholder.svg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title fw-bold d-flex justify-content-between">Spicy Beef Burger <span>Rp.
                                1000</span>
                        </h5>
                        <div class="my-2">
                            <span class="badge rounded-pill text-bg-primary">Primary</span>
                            <span class="badge rounded-pill text-bg-secondary">Secondary</span>
                        </div>
                        <p class="card-text">Juicy beef patty with spicy sauce, lettuce, tomato, and cheese</p>
                        <a href="#"
                            class="btn btn-secondary w-100 btn-sm py-2 d-flex gap-3 align-items-center justify-content-center"><i
                                class="fa-solid fa-plus"></i>Tambahkan ke
                            keranjang </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 22rem;">
                    <img src="{{ asset('dist/img/placeholder.svg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title fw-bold d-flex justify-content-between">Spicy Beef Burger <span>Rp.
                                1000</span>
                        </h5>
                        <div class="my-2">
                            <span class="badge rounded-pill text-bg-primary">Primary</span>
                            <span class="badge rounded-pill text-bg-secondary">Secondary</span>
                        </div>
                        <p class="card-text">Juicy beef patty with spicy sauce, lettuce, tomato, and cheese</p>
                        <a href="#"
                            class="btn btn-secondary w-100 btn-sm py-2 d-flex gap-3 align-items-center justify-content-center"><i
                                class="fa-solid fa-plus"></i>Tambahkan ke
                            keranjang </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 22rem;">
                    <img src="{{ asset('dist/img/placeholder.svg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title fw-bold d-flex justify-content-between">Spicy Beef Burger <span>Rp.
                                1000</span>
                        </h5>
                        <div class="my-2">
                            <span class="badge rounded-pill text-bg-primary">Primary</span>
                            <span class="badge rounded-pill text-bg-secondary">Secondary</span>
                        </div>
                        <p class="card-text">Juicy beef patty with spicy sauce, lettuce, tomato, and cheese</p>
                        <a href="#"
                            class="btn btn-secondary w-100 btn-sm py-2 d-flex gap-3 align-items-center justify-content-center"><i
                                class="fa-solid fa-plus"></i>Tambahkan ke
                            keranjang </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layout-app>
