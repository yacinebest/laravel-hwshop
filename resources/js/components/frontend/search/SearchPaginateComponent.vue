<template>
    <div class="row">

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
                        <option value="10" selected="selected">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
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
export default {
    name: 'SearchPaginate',
    mounted() {
    // created() {
        this.loadProducts()
    },
    props:{
        q: {
            type: String,
            required: true,
        },
        products: {
            // type: Array,
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
            pagination: {},
            currentPage: 1,
            order: 'created_at-desc',
            order_column: 'created_at',
            direction_order: 'DESC',
            nbr_paginate: '10',
        }
    },
    methods:{
        loadProducts(page = 1){
            let form = new FormData()
            form.append('paginate',Number(this.nbr_paginate))
            form.append('orderBy',this.order_column)
            form.append('orderByDirection',this.direction_order)
            axios.post(`/search/${this.q}/api/page/${page}`,form)
                .then( ({data: pagination}) => {
                    console.log(pagination.products)
                    console.log(pagination.nbr)
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
