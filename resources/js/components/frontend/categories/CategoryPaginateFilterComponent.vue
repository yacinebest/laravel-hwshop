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
                                <input type="checkbox" :value="brand.id " v-model="brands" @change="updateProduct" class="custom-control-input marque-checkbox" />
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
                            <div class="mb-3">
                                <label class="d-block">
                                    <h2 class="text-center">Min</h2>
                                </label>
                                <vue-range-slider ref="slider" :max="this.default_max" :step="Number(100)" v-model="min"></vue-range-slider>
                            </div>

                            <div>
                                <label class="d-block">
                                    <h2 class="text-center">Max</h2>
                                </label>
                                <vue-range-slider ref="slider" :max="this.default_max" :step="Number(100)" v-model="max"></vue-range-slider>
                            </div>

                            <button @click="updateProduct" id="price-filter" class="btn btn-block btn-sm btn-primary w-50 mt-3 mx-auto" >
                                Submit
                            </button>
                            <button @click="changePriceReset" id="price-reset" class="btn btn-block btn-sm btn-primary w-50 mt-3 mx-auto" >
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

                                <li class="switch-list">
                                    <label class="switch">
                                        <input v-model="available" @change="updateProduct" type="checkbox" class="primary more-filter" />
                                        <span class="slider round"></span>
                                    </label>
                                    <p class="pl-2 switch-text">
                                        View Products Available
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
                        {{ this.nbr_products }} Products Finds
                    </span>
                    <select id="order-select" class="mr-2 form-control" @change="changeOrder" v-model="order" >
                        <option value="created_at-desc" selected="selected">Most Recent</option>
                        <option value="created_at-asc">Oldest</option>
                        <option value="view">Most Viewed</option>
                        <option value="quantitySold">Most Sold</option>
                        <option value="price-asc">Ascending price</option>
                        <option value="price-desc">Decreasing price</option>
                    </select>

                    <select id="number-per-page" class="mr-2 form-control"  @change="changePaginateNumber" v-model="nbr_paginate">
                        <option value="3" selected="selected">3</option>
                        <option value="6">6</option>
                        <option value="9">9</option>
                        <option value="15">15</option>
                        <option value="18">18</option>
                        <option value="21">21</option>
                    </select>

                </div>
            </header>

            <product-card  :products_props=" this.pagination.data" page="category"></product-card>

            <pagination :data="this.pagination" @pagination-change-page="this.loadProducts">
                <span slot="prev-nav">&lt; Previous</span>
                <span slot="next-nav">Next &gt;</span>
            </pagination>
        </main>

    </div>
</template>

<script>
import 'vue-range-component/dist/vue-range-slider.css'
import VueRangeSlider from 'vue-range-component'


export default {
    name: 'CategoryPaginateFilter',
    mounted() {
    // created() {
        this.loadProducts()
    },
    components: {
        VueRangeSlider
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
            nbr_products: this.nbr_product,
            products: [],
            pagination: {},
            currentPage: 1,
            order: 'created_at-desc',
            order_column: 'created_at',
            direction_order: 'DESC',
            nbr_paginate: '3',
            brands: [],
            min: Number(0),
            max: Number(100000),
            default_max:Number(100000),
            available: false
        }
    },
    methods:{
        loadProducts(page = 1){
            let form = new FormData()
            form.append('paginate',Number(this.nbr_paginate))
            form.append('orderBy',this.order_column)
            form.append('orderByDirection',this.direction_order)
            form.append('brands',JSON.stringify(this.brands))
            form.append('min',this.min)
            form.append('max',this.max)
            form.append('available',this.available)
            axios.post(`/category/${this.category.id}/productsFilter/page/${page}`,form)
                .then( ({data: pagination}) => {
                    this.pagination = pagination.products
                    this.products = pagination.products.data
                    this.currentPage = pagination.products.current_page
                    this.nbr_products = pagination.nbr
                })
        },
        changeOrder(){
            this.order_column = (this.order.split('-')[0])
            this.direction_order = (this.order.split('-')[1]).toUpperCase()
            this.updateProduct()
        },
        changePriceReset(){
            this.min =0
            this.max = this.default_max
            this.updateProduct()
        },
        changePaginateNumber(){
            this.currentPage = 1
            this.updateProduct()
        },
        updateProduct(){
            this.loadProducts(this.currentPage)
        },
    }
}
</script>
