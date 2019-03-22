<template>
    <div>
        <div class="row justify-content-center my-2">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="" class="label">New Word</label>
                            <div class="row">
                                <div class="col-8">
                                    <input type="text" class="form-control" v-model="newWord"/>
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-success btn-block" @click="addWord">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{speaker.name}}</div>

                    <div class="card-body">
                        <div class="row border my-2 py-2" v-for="(word,index) in words" :key="index">
                            <div class="col-12">
                                <h4 class="h4 text-center">{{word.word}}</h4>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-primary btn-block" @click="minus(index)">-</button>
                            </div>
                            <div class="col-4 text-center">
                                <input type="number" v-model="word.count" class="form-control" disabled/>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-primary btn-block" @click="add(index)">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center my-2">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-success btn-block" @click="save">Save</button>
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
                newWord: '',
                count: 0,
                words: [
                    {
                        word: 'er',
                        count: 0,
                    },
                    {
                        word: 'um',
                        count: 0,
                    },
                    {
                        word: 'ah',
                        count: 0,
                    },
                ]
            }
        },
        props: ['speaker'],
        mounted() {
            this.getWords();
        },
        methods: {
            viewSpeaker(id) {
                return "/speaker/"+id;
            },
            add(index) {
                this.words[index].count++;
            },
            minus(index) {
                if (this.words[index].count > 0) {
                    this.words[index].count--;
                }
            },
            addWord() {
                this.words.push({word: this.newWord, count: 0});
            },
            save() {
                axios.post('/word', {speaker : this.speaker.id, words : this.words})
                    .then(res => {
                        alert('Saved!')
                        this.getWords();
                    })
            },
            getWords() {
                let url = '/word/' + this.speaker.id;
                axios.get(url)
                    .then(res => {
                        if (res.data.length !== 0) {
                            this.words = res.data;
                        }
                    })
            }
        },
        computed: {
        }

    }
</script>
