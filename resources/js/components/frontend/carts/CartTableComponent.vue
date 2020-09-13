<template>
   <div class="row">

        <aside class="col-lg-9">
            <div class="card" style="min-height: 99px;">
                <div class="justify-content-center row">
                    <h2 v-if="this.products.length" class="font-weight-bold m-4 text-uppercase title-grid title-panier">Your Cart :</h2>
                    <h2 v-else class="font-weight-bold m-4 text-uppercase title-grid title-panier">Your Cart Is Empty...</h2>
                </div>
                <div v-if="!!this.products.length" class="table-responsive" >
                    <table class="table  table-shopping-cart">
                        <thead class="text-muted">
                            <tr class="small text-uppercase">
                                <th class="pl-5" scope="col">Product</th>
                                <th scope="col" width="90">Quantity</th>
                                <th scope="col" width="120">Price</th>
                                <th scope="col" width="120">Sub-Price</th>
                                <th scope="col"  ></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in products" :key="item.id">
                                <td>
                                    <figure class="itemside align-items-center">
                                        <div class="aside">
                                            <img :src=" item.product.image ? item.product.image.imagePath  : 'https://via.placeholder.com/50'" :alt="item.product.name" class="img-sm">
                                        </div>
                                        <figcaption class="info">
                                            <a :href="route_product+item.id" class="title font-weight-bolder text-capitalize text-dark" data-abc="true">
                                                {{ item.product.name }}
                                            </a>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td data-th="Quantity">
                                    <input type="number" class="form-control text-center qte-number" min="0" :max="item.product.copy_number" v-model="item.quantity" @change="updateQte(item)">
                                    <!-- <input type="number" class="form-control text-center qte-number" min="0" :max="item.product.copy_number" :value="item.quantity" v-model="item.quantity"> -->
                                    <small class="text-muted"> Max : {{ item.product.copy_number }}</small>
                                </td>
                                <td>
                                    <div class="price-wrap">
                                        <var class="price">
                                            {{ item.product.price }} DZD
                                        </var>
                                    </div>
                                </td>
                                <td data-th="sous-total" >
                                    <div class="price-wrap">
                                        <var class="price" v-html="subTotal(item.product.price,item.quantity) +' DZD'">
                                        </var>

                                    </div>
                                </td>
                                <td class="text-right">
                                    <button @click="deleteProductFromCart(item.product)" class="btn btn-light delete-article-page-panier" data-abc="true">Delete</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </aside>

        <aside class="col-lg-3">

            <div class="card">
                <div class="card-body">
                        <dl v-if="!!this.products.length" class="dlist-align">
                            <dt>Total Price:</dt>
                            <dd class="text-right ml-3 dd-prix-total font-weight-bolder text-success">
                               {{ this.totalPrice }} DZD
                            </dd>
                        </dl>
                        <hr>

                        <form :action="url_order" method="post"  >
                            <input name="order" class="p-0 m-0 d-none order-input">
                            <button type="submit" class="btn btn-out btn-primary btn-square btn-main commander" data-abc="true">
                                Order
                            </button>
                        </form>

                    <a :href="this.url_back" class="btn btn-out btn-success btn-square btn-main mt-2 continuer-achat w-100" data-abc="true">
                        Continue Shopping
                    </a>
                </div>
            </div>

        </aside>

    </div>
</template>

<script>
export default {
    props:{
        url_order: {
            type: String,
            required: true,
        },
        url_back: {
            type: String,
            required: true,
        }
    },
     data() {
        return {
            products: this.$store.state.product_in_cart,
            route_product: '/product/'
        }
    },
    computed: {
        totalPrice: function () {
            let total = 0
            for(let item of this.products){
                total += Number(item.product.price) * Number(item.quantity) ;
            }
            return total;
        },
         qteTotal: function () {
            let qte = Number(0)
            for (const iterator of this.products) {
                qte += Number(iterator.quantity)
            }
            return qte;
        }
    },
    methods: {
        subTotal(price,quantity) {
            return Number(price) * Number(quantity)
        },
        deleteProductFromCart(product){
            this.$store.commit('deleteProduct', product)
        },
        updateQte(item){
            console.log(item.quantity)
            this.$store.commit('updateProduct', item)
            this.$store.commit('updateStickyQte', Number(this.qteTotal))
        }
    },
}
</script>
