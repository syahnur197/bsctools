<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Records</div>

                <div class="card-body">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" @click="addRecord">
                        New Record
                    </button>

                    <ul class="my-2 list-group">
                        <li class="list-group-item" v-for="(record, index) in records" :key="index">
                            <a :href="viewRecord(record.id)"><button class="btn btn-success">View</button></a>
                            {{record.created_at}} by {{record.owner.name}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                records: []
            }
        },
        mounted() {
            this.getRecords();
        },
        methods: {
            addRecord() {
                axios.post('/record')
                    .then(res => {
                        this.getRecords()
                    })
            },
            getRecords() {
                axios.get('/record')
                    .then(res => {
                        this.records = res.data;
                    })
            },
            viewRecord(id) {
                return "/record/"+id;
            }
        },
        computed: {

        }
    }
</script>
