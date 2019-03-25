<template>
    <div>
        <a href="/home"><i class="fa fa-arrow-left"></i>Back to list of records</a>
        <div class="row justify-content-center my-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4>Add Speaker</h4>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="name" class="form-control" id="name" v-model="name">
                            <button class="btn btn-success btn-block my-1" @click="addSpeaker">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{record.created_at}} by {{record.owner.name}}</div>

                    <div class="card-body">
                        <h4>Speakers</h4>
                        <ul class="list-group">
                            <li class="list-group-item" v-for="(speaker,index) in record.speakers" :key="index">
                                <a :href="viewSpeaker(speaker.id)"><button class="btn btn-primary">View</button></a>
                                <button class="btn btn-danger" @click="deleteSpeaker(speaker.id)"><i class="fa fa-trash"></i></button>
                                {{speaker.name}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                record: {
                    owner : {
                        name : ''
                    }
                }
            }
        },
        props: ['record_id'],
        mounted() {
            this.getRecord();
        },
        methods: {
            viewSpeaker(id) {
                return "/speaker/"+id;
            },
            addSpeaker() {
                let speaker = { name: this.name, record_id : this.record_id };
                axios.post('/speaker', speaker)
                    .then(res => {
                        this.getRecord();
                        this.name = '';
                    })
                    .catch( err => {

                    })
            },
            getRecord() {
                let url = '/record/get/'+this.record_id;
                axios.get(url)
                    .then(res => {
                        this.record = res.data;
                    })
            },
            deleteSpeaker(speaker_id) {
                let url = '/speaker/'+speaker_id;
                let confirmation = confirm("Are you sure?");
                if (confirmation) {
                    axios.delete(url)
                        .then(res => {
                            this.getRecord();
                        })
                }
            }
        },
        computed: {
        }

    }
</script>
