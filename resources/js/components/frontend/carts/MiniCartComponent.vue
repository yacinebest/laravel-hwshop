<template>
    <div class="container">
        <div class="shopping-cart" style="display: none; width:300px;  ">
            <ul class="dropdown-cart shopping-cart-items" role="menu" >

                <li class="header-shopping-cart" >
                    <span class="text-uppercase">
                        <span class="fa fa-shopping-cart style-icon-short" style="font-size: 27px;margin-left: 5px;margin-top: 1px;" aria-hidden="true"></span>
                        <span class="cercel-number" ></span>
                        <span class="font-weight-bolder total-price">Total :
                            <span class="price-all-article">0</span>
                            DZD
                        </span>
                    </span>
                </li>

                <div v-if="!this.products.length">
                    <li class="panier-vide" style="height:35px;text-align-last: center;position: relative;top: 6px;" >
                        <span class="text-uppercase font-weight-bolder text-center">
                            Your Cart Is Empty
                        </span>
                    </li>
                </div>
                <div v-else>
                    <li class="dropdown-divider "></li>
                    <div class="list-article-panier">

                        <div v-for="product in products" :key="product.id">
                            <li>
                                <span class="item">
                                    <img class="img-cart" :src=" product.image ? product.image.imagePath  : 'https://via.placeholder.com/50'" :alt="product.name">
                                    <span class="d-block" >
                                        <a href="#" class="title font-weight-bolder text-capitalize text-dark" >
                                            {{ product.name }}
                                        </a>
                                    </span>
                                    <span class="price" style="font-weight: 900 !important;" >
                                        <span class="text-muted qte">{{ product.pivot.ordered_quantity }} X </span>
                                        {{ product.price }} DZD
                                    </span>
                                    <button class="btn fa fa-trash-o d-block float-right delete-article" style="font-size: 25px;"></button>
                                </span>
                            </li>
                            <li class="dropdown-divider "></li>
                        </div>

                    </div>
                </div>

                <li>
                    <a :href=" this.url_cart " class="btn btn-out btn-primary btn-square btn-main btn-panier text-uppercase font-weight-bolder w-100" >
                        View Cart
                    </a>
                </li>

            </ul>
        </div>
    </div>
</template>

<script>
export default {
     props:{
        url_cart: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            products: this.$store.state.product_in_cart
        }
    },
}
</script>
