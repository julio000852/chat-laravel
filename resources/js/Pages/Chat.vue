<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import axios from "axios";
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chat
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex" style="min-height: 400px; max-height: 400px;">
                    
                    <!-- List Users-->
                    <div class="w-3/12 bg-gray-200 bg-opacity-25 border-r border-gray-200 overflow-y-scroll">
                        <ul>
                            <li 
                                v-for="user in users" :key="user.id"
                                @click="() => {loadMessages(user.id)}"
                                :class="(userActive && userActive.id == user.id) ? 'bg-blue-200 bg-opacity-50' : ''"
                                class="p-6 text-lg text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:bg-opacity-50 hover:cursor-pointer hover:bg-gray-300">
                                <p class="flex items-center">
                                    {{ user.name }}
                                    <span class="ml-2 w-2 h-2 bg-blue-500 rounded-full"></span>
                                </p>
                            </li>
                        </ul>
                    </div>

                    <!-- Box message-->
                    <div class="w-9/12 flex flex-col justify-between ">

                        <!-- Messages-->
                        <div class="w-full p-6 flex-col overflow-y-scroll">
                            <div
                            v-for="message in messages" :key="message.id"
                            :class="(message.from == $page.props.auth.user.id) ? 'text-right' : ''"
                             class="w-full mb-3 message">
                                <p 
                                :class="(message.from == $page.props.auth.user.id) ? 'messageFromMe' : 'messageToMe'"
                                class="inline-block p-2 rounded-md " style="max-width: 75%;">
                                    {{ message.content }}
                                </p>
                                <span class="block mt-1 text-xs text-gray-500">
                                    {{ message.data_message }}
                                </span>
                            </div>
                        </div>

                        <!-- Form-->
                        <div v-if="userActive" class="w-full bg-gray-200 bg-opacity-25 p-6 border-gray-200">
                        <form v-on:submit.prevent="sendMenssage">
                            <div class="flex rounded-md overflow-hidden border border-gray-100">
                            <input v-model="message" type="text" class="flex-1 px-4 py-2 text-sm focus:outline-none">
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2">Enviar</button>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style>
.messageFromMe{
    @apply bg-green-500 bg-opacity-25
}
.messageToMe{
    @apply bg-gray-300 bg-opacity-25
}
</style>

<script>
import store from '@/store';
import Echo from "laravel-echo";

    export default {
        components: {
            AppLayout,
        },
        data(){
            return {
                users: [],
                messages: [],
                userActive: null,
                message: ''
            }
        },
        computed: {
            user() {
                return store.state.user
            }
        },
        methods: {
            scrollToBottom: function(){
                if(this.messages.length){
                    document.querySelectorAll('.message:last-child')[0].scrollIntoView()
                }
            },
            loadMessages: async function(userId){

                axios.get(`api/users/${userId}`).then(Response => {
                    this.userActive = Response.data.user
                })

                await axios.get(`api/message/${userId}`).then(Response => {
                    this.messages = Response.data.message
                })

                this.scrollToBottom()
            },
            sendMenssage: async function(){
                await axios.post('api/message/store', {
                    'content': this.message,
                    'to': this.userActive.id
                }).then(Response =>{
                    
                    this.messages.push({
                        'from': this.user.id,
                        'to' : this.userActive.id,
                        'content': this.message,
                        'created_at': Date().toString(),
                        'updated_at': Date().toString()
                    })

                    this.message = ''
                })

                this.scrollToBottom()
            },
        },
        mounted(){
            axios.get('api/users').then(Response =>{
                this.users = Response.data.users
            })

            Echo.private(`user.${this.user.id}`).listen('.SendMessage', (e) => {
                console.log(e)
            })

            // Echo.private(`user.${this.user.id}`).listen('.SendMessage', async (e) => {
            //     if (this.userActive && this.userActive.id == e.message.from){
            //         await this.messages.push(e.message)
            //         this.scrollToBottom()
            //     } else {

            //     }
            //     console.log(e)
            // })
        }
    }
    
</script>
