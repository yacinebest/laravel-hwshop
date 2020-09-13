<template>
    <div :class="{'row text-center ': page=='home',
                'row ': page=='category',
                'owl-carousel owl-theme align-content-around ': page=='carousel'}">
        <div v-for="product in products_props" :key="product.id"
            :class=" { 'col-lg-4 col-md-6 ': page=='home' || page=='category' ,
                        'item p-2':  page=='carousel'} ">
            <figure :class="{ 'card card-product-grid ': page=='home' || page=='category' ,
                            'shadow ': page=='home' ,
                            'product ': page=='carousel'}">

                <div :class="{ 'img-wrap img-height ': page=='home' || page=='category',
                                'text-center ': page=='category',
                                'container ': page=='carousel'}"
                    :style="{'height: 200px !important; width: 200px !important; ': page=='carousel'}">

                        <img :class="{'img-height ': page=='home' || page=='category',
                                    'mw-100 mh-100 ': page=='carousel' }"
                            :src="product.image ? product.image.imagePath : 'https://picsum.photos/seed/picsum/380/225'"
                            :style="{'-webkit-filter: grayscale(100%); filter: grayscale(100%);': page =='category' ||  product.copy_number==0  }">

                        <a class="btn-overlay" :href="route_product+product.id">
                            <i class="fa fa-search-plus"></i> See Product
                        </a>
                </div>

                <figcaption class="info-wrap">
                    <div :class="{'text-center ': page=='home' || page=='category',
                                'container ': page=='carousel',}"
                        :style="{'min-height: 104px; ': page=='category',
                                'height: 85px !important; ': page=='home',
                                'height: 50px !important; width: 200px  ': page=='carousel' }">

                        <a :href="route_product+product.id"
                            class="title h5 text-capitalize"
                            :class="{'mw-100 mh-100 embed-responsive ': page=='home' || page=='carousel',
                                    'text-secondary ': page=='category' && product.copy_number==0 }">
                            {{ product.name }}
                        </a>

                        <div v-if="page=='carousel'" class="price-group" >
                            <div class="price text-success">
                            <span class="currency">DZD</span>
                            <span>{{ product.price }}</span>
                            </div>
                        </div>
                        <div v-else class="price-wrap mt-2 price-product">
                            <span class="price">{{ product.price }} DZD</span>
                        </div>

                    </div>

                    <button v-if="product.copy_number>0"
                        @click="addProductToCart(product)"
                        :class="{'btn btn-block btn-primary mt-2 ajouter-panier ': page=='home' || page=='category',
                                'btn btn-primary fa fa-shopping-cart ajouter-panier ': page=='carousel' }">
                        Add To Cart
                    </button>
                    <button  v-else  disabled="disabled" class="btn btn-block btn-secondary mt-2 " style="cursor:default;">
                        Not available
                    </button>
                </figcaption>

            </figure>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProductCard',
    props:{
        products_props: {
            type: Array,
            required: true,
            default: ()=>([])
        },
        page: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            route_product: '/product/'
        }
    },
    methods: {
        addProductToCart(product){
            this.$store.commit('addProduct', product)
        }
    },
}
</script>
