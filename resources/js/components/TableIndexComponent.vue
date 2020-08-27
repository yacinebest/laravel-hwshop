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
                    <td v-for="(name,column) in columns" :key="column">
                        <div v-if="column=='status'">
                            <!-- <p v-if="order.status==order.enumStatus[2]" class="text-danger">{{ order.status }}</p> -->
                            <select :data-id="order.id" @change="changeStatus" class="selectpicker form-control" data-style="btn-primary" name="status">
                                <option v-for="status in order.enumStatus" :key="status"
                                :value="status" :selected="order.status==status">{{status}}</option>
                            </select>
                        </div>
                        <p v-else>{{   order[column]  }}</p>
                    </td>
                     <td>
                        <div class="col-4 text-right">
                            <button @click="applyChanges(order)" class="btn btn-sm btn-primary" >Apply Changes</button>
                        </div>
                    </td>
                </tr>
            <!-- <tr v->
                <td v-for="(name,column) in columns" :key="column">
                {{   order[column]  }}
                </td> -->
                <!-- @foreach($columns as $key => $value)
                    @if($key==='statusOrder')
                    <td>
                        <select class="selectpicker form-control" data-style="btn-primary" name="status">

                            @foreach($entity->enumStatus() as $status)
                                @if($entity->status==$status)
                                    <option value="{{ $status }}" selected="selected" >{{ $status}}</option>
                                @else
                                    <option value="{{ $status }}"  >{{ $status }}</option>
                                @endif
                            @endforeach

                        </select>
                    </td>
                    @else
                        <td >{{ $entity->$key }}</td>
                    @endif
                @endforeach -->
<!--
                <td>
                    <div class="col-4 text-right">
                        <a href="" class="btn btn-sm btn-primary">Apply Changes</a>
                    </div>
                </td> -->
            <!-- </tr> -->
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props:{
        columns: {
            type: Object,
            required: true,
            default: ()=>({})
        },
        paginate: {
            type: Object,
            required: true,
            default: ()=>({})
        }
    },
    data() {
        return {
            orders:  this.paginate.data
        }
    },
    methods: {
        changeStatus(e){
            this.orders.forEach(element => {
                if(e.target.dataset.id==element.id){
                    element.status = e.target.value
                }
            });
        },
        applyChanges(order){

            let form = new FormData()
            form.append('status',order.status)
            axios.post(`order/${order.id}`,{
                    status: order.status,
                    _method: 'patch'
                })
                .then( ({data}) => {
                    alert(`Your have Update Status of Order ${order.ref}`)
                    order.admin_id = data.admin.id
                    order.adminUsername = data.admin.username
                })
        }
    },
}
</script>
