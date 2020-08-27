<template>
  <transition name="modal-fade">
    <div class="modal-backdrop">
      <div class="modal " role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
        <header class="modal-header" id="modalTitle">
          <slot name="header">
            Details for Order Ref: {{ order ? order.ref : '' }}
            <button type="button" class="btn-close" @click="close" aria-label="Close modal">x</button>
          </slot>
        </header>

        <section class="modal-body" id="modalDescription">
          <slot name="body">
            <table class="table ">
                <thead class="thead-light">
                    <tr>
                        <th>Product</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products" :key="product.id">
                        <td>{{product.name}}</td>
                        <td>{{product.price }}</td>
                        <td>{{product.pivot.ordered_quantity }}</td>
                        <td>{{ totalPriceProduct(product) }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ totalPrice() }}</td>
                    </tr>
                </tfoot>
            </table>

          </slot>
        </section>

        <footer class="modal-footer">
          <slot name="footer">
            <button type="button" class="btn-green" @click="close" aria-label="Close modal" >
              Close me!
            </button>
          </slot>
        </footer>

      </div>
    </div>
  </transition>
</template>

<script>
  export default {
    name: 'modal',
    props:{
        order: {
            type: Object,
            required: true,
            default: ()=>({})
        }
    },
    data() {
        return {
            products: this.order ? this.order.products : []
        }
    },
    watch: {
        order: {
            deep: true,
            handler (val, oldVal) {
                this.products = this.order.products
            }
        }
    },
    methods: {
      close() {
        this.products = []
        this.$emit('close');
      },
       totalPrice(){
            let total = parseFloat(0)
            if(this.products){
                this.products.forEach(element => {
                    console.log(element)
                    total += this.totalPriceProduct(element)
                });
            }
            return  total
        },
      totalPriceProduct(product) {
            return parseFloat(product.price) * parseFloat(product.pivot.ordered_quantity)
        }
    },
  };
</script>s


<style>
  .modal-backdrop {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .modal {
     background: #FFFFFF;
    box-shadow: 2px 2px 20px 1px;
    overflow-x: auto;
    display: flex;
    flex-direction: column;
  }

  .modal-header,
  .modal-footer {
    padding: 15px;
    display: flex;
  }

  .modal-header {
    border-bottom: 1px solid #eeeeee;
    color: #4AAE9B;
    justify-content: space-between;
  }

  .modal-footer {
    border-top: 1px solid #eeeeee;
    justify-content: flex-end;
  }

  .modal-body {
    position: relative;
    padding: 20px 10px;
  }

  .btn-close {
    border: none;
    font-size: 20px;
    padding: 20px;
    cursor: pointer;
    font-weight: bold;
    color: #4AAE9B;
    background: transparent;
  }

  .btn-green {
    color: white;
    background: #4AAE9B;
    border: 1px solid #4AAE9B;
    border-radius: 2px;
  }
</style>
