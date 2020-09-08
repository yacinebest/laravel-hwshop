<template>
    <div class="col-xl-3 col-lg-6 mb-4">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">
                            <a :href="this.entity_route">
                                {{ this.entity_name}}
                            </a>
                        </h5>
                        <span class="h2 font-weight-bold mb-0">{{ this.entity_total }} </span>
                    </div>
                    <div class="col-auto">
                        <!-- bg-warning bg-yellow bg-info // fa-chart-pie fa-users fa-percent -->
                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last hour</span>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'indexpage',
    props: {
        entity_name: {
            type: String,
            required: true,
        },
        entity_total: {
            type: String,
            default: '0'
        },
        entity_route: {
            type: String,
            required: true,
        },
    },
    mounted() {
    }
}
</script>
