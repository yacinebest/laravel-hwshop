<template>
    <div>
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col" v-for="name in columns" :key="name">
                        {{ name }}
                    </th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="order in orders" :key="order.id">
                    <td v-for="(name, column) in columns" :key="column">
                        <div v-if="column == 'status'">
                            <select
                                :data-id="order.id"
                                @change="changeStatus"
                                class="selectpicker form-control"
                                data-style="btn-primary"
                                name="status"
                            >
                                <option
                                    v-for="status in order.enumStatus"
                                    :key="status"
                                    :value="status"
                                    :selected="order.status == status"
                                    >{{ status }}</option
                                >
                            </select>
                        </div>
                        <p v-else>{{ order[column] }}</p>
                    </td>
                    <td>
                        <div class="col-4 text-right m-2">
                            <button
                                @click="showModal(order)"
                                class="btn btn-sm btn-secondary"
                            >
                                See Details
                            </button>
                        </div>
                        <div class="col-4 text-right m-2">
                            <button
                                @click="applyChanges(order)"
                                class="btn btn-sm btn-primary"
                            >
                                Apply Changes
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <modal v-if="isModalVisible" :order="sendOrder" @close="closeModal" />
    </div>
</template>

<script>
import Modal from "./ModalComponent.vue";
export default {
    name: "indexpage",
    components: {
        Modal
    },
    props: {
        columns: {
            type: Object,
            required: true,
            default: () => ({})
        },
        paginate: {
            type: Object,
            required: true,
            default: () => ({})
        }
    },
    data() {
        return {
            orders: this.paginate.data,
            isModalVisible: false,
            sendOrder: {},
            products: []
        };
    },
    methods: {
        changeStatus(e) {
            this.orders.forEach(element => {
                if (e.target.dataset.id == element.id) {
                    element.status = e.target.value;
                }
            });
        },
        applyChanges(order) {
            let form = new FormData();
            form.append("status", order.status);
            axios
                .post(`order/${order.id}`, {
                    status: order.status,
                    _method: "patch"
                })
                .then(({ data }) => {
                    alert(`Your have Update Status of Order ${order.ref}`);
                    order.admin_id = data.admin.id;
                    order.adminUsername = data.admin.username;
                });
        },

        showModal(order) {
            this.sendOrder = order;
            this.products = order.products;
            this.isModalVisible = true;
        },
        closeModal() {
            this.sendOrder = {};
            this.products = [];
            this.isModalVisible = false;
        }
    }
};
</script>
