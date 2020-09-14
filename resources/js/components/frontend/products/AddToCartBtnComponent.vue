<template>
    <div class="row">
        <button v-if="product.copy_number>0"
                    @click="addProductToCart(product)"
                    class="btn btn-primary fa fa-shopping-cart mx-auto ajouter-panier">
                    Add To Cart
                </button>
        <button  v-else  disabled="disabled"  class="btn-block btn-secondary btn-twittermx-auto" style="cursor:default;">
            Not available
        </button>
    </div>
</template>

<script>
export default {
      props:{
        product: {
            type: Object,
            required: true,
            default: ()=>({})
        },
    },
    methods: {
        addProductToCart(product){
            this.$store.commit('addProduct', product)
        }
    },
}
</script>
