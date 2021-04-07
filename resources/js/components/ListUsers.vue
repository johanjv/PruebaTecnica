<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Usuarios</div>

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
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Celular</th>
                                        <th scope="col">Cedula</th>
                                        <th scope="col">Fecha Nac</th>
                                        <th scope="col">Edad</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(user, u) in users" :key="u">
                                        <td>{{u + 1}}</td>
                                        <td>{{user.name}}</td>
                                        <td>{{user.phone}}</td>
                                        <td>{{user.cedula}}</td>
                                        <td>{{user.fecha_nac}}</td>
                                        <td>EDAD</td>
                                        <td>{{user.email}}</td>
                                        <td>
                                            <div>
                                                <button class="btn btn-info" v-on:click="editItem(user)">edit</button>
                                                <button class="btn btn-danger" v-on:click="delItem(user, u)">del</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar usuario: {{itemEditing.email}}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <label for="a">Nombre</label><input type="text" v-model="itemEditing.name" ><br>
                                        <label for="a">Cedula</label><input type="text" v-model="itemEditing.cedula" disabled ><br>
                                        <label for="a">Celular</label><input type="text" v-model="itemEditing.phone" ><br>
                                        <label for="a">Correo</label><input type="email" v-model="itemEditing.email" disabled><br>
                                        <label for="a">Fecha Nacimiento</label><input type="date" v-model="itemEditing.fecha_nac" ><br>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
                                    <button type="button" class="btn btn-primary" v-on:click="saveChanges()" >Save changes</button>
                                </div>
                                </div>
                            </div>
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
                users: [],
                searchUser: '',
                limitPag: 5,
                itemEditing: {},
            }
        },
        mounted() {
            this.getUsers();
        },
        watch: {
            'searchUser': function (busq) {
                    this.getUsers();
                },
            'limitPag': function (paginador) {
                this.getUsers();
            } 
            
        },
        methods: {
            getUsers(){
                let params = {
                    busq: this.searchUser,
                    limitPag: this.limitPag
                };
                axios.get("getUsers", {params}).then((rs) => {
                    this.users = rs.data.users;
                });
            },
            editItem(item){
                $('#exampleModal').modal('show')
                this.itemEditing = item;
            },
            saveChanges(){
                let params = this.itemEditing;
                axios.get("saveChanges", {params}).then((rs) => {
                    this.users = rs.data.users;
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
