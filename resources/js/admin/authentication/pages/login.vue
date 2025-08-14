<template>

    <form @submit.prevent="loginApi" class="w-full block">
        <div class="w-full block">
            <div class="text-center text-[19px]"> Welcome to LMS </div>
            <div class="mb-5 text-center !text-[13px] font-medium text-gray-500"> Sign in to your account </div>
        </div>
        <div class="text-red-600 text-center p-3 bg-red-100 block text-[13px] mb-3 rounded-lg" v-if="credential"> {{credential}} </div>
        <div class="mb-3 w-full block">
            <label for="user-email" class="mb-1 w-full block !text-[13px] font-medium">
                Email
            </label>
            <input id="user-email" type="email" name="email" v-model="formData.email" placeholder="example@gmail.com" class="!text-[12px] font-medium w-full block px-4 min-h-[45px] max-h-[45px] rounded-lg outline-0 border border-gray-200 ring-0 ring-transparent duration-500 focus-within:ring-2 focus-within:ring-blue-400" autocomplete="off" />
            <div class="text-red-500 mt-1 block w-full !text-[12px] font-medium" v-if="errors.email"> {{errors.email[0]}} </div>
        </div>
        <div class="w-full block mb-3">
            <label for="user-password" class="mb-1 w-full flex justify-between items-center !text-[13px] font-medium">
                <span> Password </span>
                <router-link :to="{name:'forgot'}" class="decoration-0 text-red-600 text-[11px]"> Forgot Password? </router-link>
            </label>
            <div class="relative">
                <input id="user-password" :type="passwordFieldType" name="password" v-model="formData.password" class="!text-[12px] font-medium w-full block px-4 min-h-[45px] max-h-[45px] rounded-lg outline-0 border border-gray-200 ring-0 ring-transparent duration-500 focus-within:ring-2 focus-within:ring-blue-400" autocomplete="off" />
                <div class="absolute end-0 top-0 bottom-0 pe-3 flex items-center">
                    <button type="button" class="outline-0 border-0 p-0 m-0 cursor-pointer" @click="changePasswordType()">
                        <template v-if="passwordFieldType === 'text'">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </template>
                        <template v-else>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </template>
                    </button>
                </div>
            </div>
            <div class="text-red-500 mt-1 block w-full !text-[12px] font-medium" v-if="errors.password"> {{errors.password[0]}} </div>
        </div>
        <div class="w-full flex justify-center">
            <button type="submit" v-if="!loading" class="w-full !text-[14px] max-w-[120px] min-w-[120px] inline-flex justify-center items-center min-h-[45px] max-h-[45px] rounded-lg bg-blue-500 duration-500 hover:bg-blue-600 text-white cursor-pointer">
                Login
            </button>
            <button type="button" v-if="loading" class="w-full !text-[14px] max-w-[120px] min-w-[120px] inline-flex justify-center items-center min-h-[45px] max-h-[45px] rounded-lg bg-blue-500 duration-500 hover:bg-blue-600 text-white cursor-pointer">
                <span class="w-4 h-4 inline-block border-2 border-white border-t-transparent animate-spin rounded-full"></span>
            </button>
        </div>
    </form>

</template>

<script>

import axios from 'axios';
import apiRoute from '../../apiController/apiRoute.js';
import apiService from '../../apiController/apiService.js';
import cookiesServices from "../../apiController/cookiesServices.js";

export default {
    data() {
        return {
            formData: {
                email: '',
                password: '',
            },
            passwordFieldType: 'password',
            loading: false,
            errors: {},
            credential: null,
        }
    },
    mounted() {

    },
    methods: {

        changePasswordType() {
            this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password';
        },

        async loginApi() {
            try {
                this.errors = {};
                this.loading = true;
                const response = await axios.post(apiRoute.admin.login, this.formData, {headers: apiService.authHeaderContent()});
                const token = response?.data?.admin_token;
                cookiesServices.set('admin_token',token)
                this.$router.push({name:'dashboard'});
            } catch (e) {
                if(e.response.data.errors) {
                    this.errors = e.response.data.errors;
                } else if (e.response.data.message) {
                    this.credential = e.response.data.message;
                }
            } finally {
                this.loading = false;
            }
        }

    }
}

</script>
