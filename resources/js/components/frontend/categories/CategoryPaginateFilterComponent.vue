<template>
    <div class="row">

        <aside class="col-lg-3 col-md-4">
            <div class="card">

                <article v-show="this.category.directChildCount" class="filter-group">
                    <header class="card-header style-card-header py-2">
                        <a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" class="d-inline-flex">
                            <i class="icon-control fa fa-chevron-down mr-2"></i>
                            <h6 id="sous-categorie-title" data-id="" data_href="" class="title text-capitalize" >
                                {{ category.name }}
                            </h6>
                        </a>
                    </header>

                    <div class="filter-content collapse show" id="collapse_1" >
                        <div class="card-body">
                            <ul class="list-menu">
                                <li v-for="cat in this.category.childs" :key="cat.id">
                                    <a :href="`/category/${cat.id}`" class="text-capitalize text-dark" >
                                        {{ cat.name }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </article>

                <article class="filter-group">
                    <header class="card-header style-card-header py-2">
                        <a href="#" data-toggle="collapse" data-target="#collapse_3" aria-expanded="true" class="d-inline-flex" >
                            <i class="icon-control fa fa-chevron-down mr-2"></i>
                            <h6 class="title">Brands :</h6>
                        </a>
                    </header>
                    <div class="filter-content collapse show" id="collapse_3" >
                        <div class="card-body">
                            <label  v-for="brand in this.category.brands" :key="brand.id"  class="custom-control custom-checkbox">
                                <input type="checkbox" :value="brand.name " class="custom-control-input marque-checkbox" />
                                <div class="custom-control-label">
                                    {{ brand.name }}
                                    <b class="badge badge-pill badge-light float-right">
                                        {{ brand.productsCount }}
                                    </b>
                                </div>
                            </label>
                        </div>
                    </div>
                </article>

                <article class="filter-group">
                    <header class="card-header style-card-header py-2">
                        <a href="#" data-toggle="collapse" data-target="#collapse_4" aria-expanded="true" class="d-inline-flex" >
                            <i class="icon-control fa fa-chevron-down mr-2"></i>
                            <h6 class="title">Price in DZD</h6>
                        </a>
                    </header>
                    <div class="filter-content collapse show" id="collapse_4" >
                        <div class="card-body">
                            <p>
                                <input type="text" id="amount" readonly="" class="text-dark text-center" style=" border: 0; font-weight: bold; width: -webkit-fill-available; " />
                            </p>

                            <div id="slider-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" >
                                <div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 99.6%;" >
                                </div>

                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;" >
                                </span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 99.6%;" >
                                </span>
                            </div>

                            <button id="price-filter" class="btn btn-block btn-sm btn-primary w-50 mt-3 mx-auto" >
                                Submit
                            </button>

                            <button id="price-reset" class="btn btn-block btn-sm btn-primary w-50 mt-3 mx-auto" >
                                Reset
                            </button>
                        </div>
                    </div>
                </article>


                <article class="filter-group">
                    <header class="card-header style-card-header py-2">
                        <a href="#" data-toggle="collapse" data-target="#collapse_5" aria-expanded="true" class="d-inline-flex" >
                            <i class="icon-control fa fa-chevron-down mr-2"></i>
                            <h6 class="title">Other Filters :</h6>
                        </a>
                    </header>
                    <div class="filter-content collapse show" id="collapse_5" >
                        <div class="card-body">
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item switch-list">
                                    <label class="switch">
                                        <input type="checkbox" value="disponible" class="primary more-filter" />
                                        <span class="slider round"></span>
                                    </label>
                                    <p class="pl-2 switch-text">
                                        View Products Available
                                    </p>
                                </li>

                                <li class="list-group-item switch-list">
                                    <label class="switch">
                                        <input type="checkbox" value="indisponible" class="primary more-filter" />
                                        <span class="slider round"></span>
                                    </label>
                                    <p class="pl-2 switch-text">
                                        Show products Unavailable
                                    </p>
                                </li>

                            </ul>
                        </div>
                    </div>
                </article>

            </div>
        </aside>
        <!--  -->
        <main class="col-lg-9 col-md-8">

            <header class="border-bottom mb-4 pb-3">
                <div class="form-inline">
                    <span id="nombre-article" class="mr-md-auto">
                        {{ nbr_product }} Products Finds
                    </span>
                    <select id="order-select" class="mr-2 form-control" >
                        <option value="plus recent" selected="selected">Most Recent</option>
                        <option value="plus ancien">Oldest</option>
                        <option value="plus vues">Most Viewed</option>
                        <option value="plus vendus">Most Sold</option>
                        <option value="prix croissant">Ascending price</option>
                        <option value="prix decroissant">Decreasing price</option>
                    </select>

                    <select id="number-per-page" class="mr-2 form-control" >
                        <option value="9" selected="selected">9</option>
                        <option value="6">6</option>
                        <option value="9">9</option>
                        <option value="15">15</option>
                        <option value="18">18</option>
                        <option value="21">21</option>
                    </select>

                    <div class="btn-group">
                        <a href="#" class="btn btn-outline-secondary" data-toggle="tooltip" title="" data-original-title="List view" >
                            <i class="fa fa-bars"></i>
                        </a>
                        <a href="#" class="btn btn-outline-secondary active" data-toggle="tooltip" title="" data-original-title="Grid view" >
                            <i class="fa fa-th"></i>
                        </a>
                    </div>
                </div>
            </header>

            <product-card  :products_props=" this.pagination.data" page="category"></product-card>
            <!-- <product-card v-if="this.pagination && this.pagination.data"  :products_props=" this.pagination.data" page="category"></product-card> -->

            <pagination :data="this.pagination" @pagination-change-page="this.loadProducts">
                <span slot="prev-nav">&lt; Previous</span>
                <span slot="next-nav">Next &gt;</span>
            </pagination>
        </main>

    </div>
</template>

<script>
export default {
    name: 'CategoryPaginateFilter',
    mounted() {
    // created() {
        this.loadProducts()
    },
    props:{
        category: {
            type: Object,
            required: true,
        },
        nbr_product:{
            type: Number,
            required: true,
            default: 0
        }
    },
    data() {
        return {
            products: [],
            pagination: {},
            next_page: null,
        }
    },
    methods:{
        loadProducts(page = 1){
            axios.get(`/category/${this.category.id}/products?page=${page}`)
                .then( ({data: pagination}) => {
                    this.pagination = pagination
                    this.products = pagination.data
                    this.next_page = pagination.next_page_url
                })
        },
    }
}
</script>
