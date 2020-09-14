<template>
    <div class="row pt-4">

        <main>

            <header class="border-bottom mb-4 pb-3">
                <div class="form-inline">
                    <span id="nombre-article" class="mr-md-auto">
                        {{ this.nbr_products }} Products Finds For "{{q}}"
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
                        <option value="9" selected="selected">9</option>
                        <option value="18">18</option>
                        <option value="27">27</option>
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
        }
    },
    data() {
        return {
            products: [],
            nbr_products: 0,
            pagination: {},
            currentPage: 1,
            order: 'created_at-desc',
            order_column: 'created_at',
            direction_order: 'DESC',
            nbr_paginate: '9',
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
