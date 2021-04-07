<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Emails</div>

                <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <select name="paginate" id="paginate" v-model="limitPag">
                                    <option value="all">all</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="search" name="search" id="search" v-model="searchUser"><br><br>
                            </div>
                        </div>
                        <div class="table-responsive">
                                <table id="listUsersTable" class="table table-striped table-bordered" style="width: 100%;" >
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Asunto</th>
                                        <th scope="col">Destino</th>
                                        <th scope="col">Mensaje</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(mail, m) in mails" :key="m">
                                        <td>{{m + 1}}</td>
                                        <td>{{mail.asunto}}</td>
                                        <td>{{mail.destino}}</td>
                                        <td>{{mail.mensaje}}</td>
                                        <td>
                                            <div v-if="mail.status == 'Pendiente'" class="alert alert-info" role="alert">
                                                <p>{{mail.status}}</p>
                                            </div>
                                            <div v-else class="alert alert-danger" role="alert">
                                                <p>{{mail.status}}</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from "axios";
import Vue from 'vue';
import { VuejsDatatableFactory } from 'vuejs-datatable';
Vue.use( VuejsDatatableFactory );
    export default {
        data(){
            return {
                mails: [],
                searchUser: '',
                limitPag: 5,
                itemEditing: {},
            }
        },
        mounted() {
            this.getMails();
        },
        watch: {
            'searchUser': function (busq) {
                    this.getMails();
                },
            'limitPag': function (paginador) {
                this.getMails();
            } 
            
        },
        methods: {
            getMails(){
                let params = {
                    busq: this.searchUser,
                    limitPag: this.limitPag
                };
                axios.get("getMails", {params}).then((rs) => {
                    this.mails = rs.data.mails;
                });
            },
            editItem(item){
                $('#exampleModal').modal('show')
                this.itemEditing = item;
            },
            saveChanges(){
                let params = this.itemEditing;
                axios.get("saveChanges", {params}).then((rs) => {
                    this.mails = rs.data.mails;
                    $('#exampleModal').modal('hide')
                })
            },
            delItem(user, index){
                let params = { id: user.id };
                console.log(params);
                axios.get("delItem", {params}).then((rs) => {
                    this.users.splice(index, 1);
                })
            }
        }
    }
</script>
