<template>

    <form @submit.prevent="forgotApi" class="w-full block">
        <div class="w-full block">
            <div class="text-center text-[19px]"> Reset Account </div>
            <div class="mb-5 text-center !text-[13px] font-medium text-gray-500"> Take reset code from your email </div>
        </div>
        <div class="mb-3 w-full block">
            <label for="user-email" class="mb-1 w-full block !text-[13px] font-medium">
                Email
            </label>
            <input id="user-email" type="email" name="email" v-model="formData.email" placeholder="example@gmail.com" class="!text-[12px] font-medium w-full block px-4 min-h-[45px] max-h-[45px] rounded-lg outline-0 border border-gray-200 ring-0 ring-transparent duration-500 focus-within:ring-2 focus-within:ring-blue-400" autocomplete="off" />
            <div class="text-red-500 mt-1 block w-full !text-[12px] font-medium" v-if="errors.email"> {{errors.email[0]}} </div>
        </div>
        <div class="mb-3 w-full block">
            <label for="user-reset-code" class="mb-1 w-full block !text-[13px] font-medium">
                Reset Code
            </label>
            <input id="user-reset-code" type="text" name="reset_code" v-model="formData.reset_code" class="!text-[12px] font-medium w-full block px-4 min-h-[45px] max-h-[45px] rounded-lg outline-0 border border-gray-200 ring-0 ring-transparent duration-500 focus-within:ring-2 focus-within:ring-blue-400" autocomplete="off" />
            <div class="text-red-500 mt-1 block w-full !text-[12px] font-medium" v-if="errors.reset_code"> {{errors.reset_code[0]}} </div>
        </div>
        <div class="mb-3 w-full block">
            <label for="user-password" class="mb-1 w-full block !text-[13px] font-medium">
                Password
            </label>
            <input id="user-password" type="password" name="password" v-model="formData.password" class="!text-[12px] font-medium w-full block px-4 min-h-[45px] max-h-[45px] rounded-lg outline-0 border border-gray-200 ring-0 ring-transparent duration-500 focus-within:ring-2 focus-within:ring-blue-400" autocomplete="off" />
            <div class="text-red-500 mt-1 block w-full !text-[12px] font-medium" v-if="errors.password"> {{errors.password[0]}} </div>
        </div>
        <div class="mb-3 w-full block">
            <label for="user-confirm-password" class="mb-1 w-full block !text-[13px] font-medium">
                Confirm Password
            </label>
            <input id="user-confirm-password" type="password" name="password_confirmation" v-model="formData.password_confirmation" placeholder="example@gmail.com" class="!text-[12px] font-medium w-full block px-4 min-h-[45px] max-h-[45px] rounded-lg outline-0 border border-gray-200 ring-0 ring-transparent duration-500 focus-within:ring-2 focus-within:ring-blue-400" autocomplete="off" />
            <div class="text-red-500 mt-1 block w-full !text-[12px] font-medium" v-if="errors.password_confirmation"> {{errors.password_confirmation[0]}} </div>
        </div>
        <div class="mb-3 w-full flex justify-center">
            <button type="submit" v-if="!loading" class="w-full !text-[14px] max-w-[120px] min-w-[120px] inline-flex justify-center items-center min-h-[45px] max-h-[45px] rounded-lg bg-blue-500 duration-500 hover:bg-blue-600 text-white cursor-pointer">
                Reset
            </button>
            <button type="button" v-if="loading" class="w-full !text-[14px] max-w-[120px] min-w-[120px] inline-flex justify-center items-center min-h-[45px] max-h-[45px] rounded-lg bg-blue-500 duration-500 hover:bg-blue-600 text-white cursor-pointer">
                <span class="w-4 h-4 inline-block border-2 border-white border-t-transparent animate-spin rounded-full"></span>
            </button>
        </div>
        <div class="text-center !text-[14px]">
            Remember Password!
            <router-link :to="{name:'login'}" class="decoration-0 text-gray-800 duration-500 hover:text-blue-600">
                Login
            </router-link>
        </div>
    </form>

</template>

<script>

import axios from "axios";
import apiRoute from "../../apiController/apiRoute.js";
import apiService from "../../apiController/apiService.js";

export default {
    data() {
        return {
            formData: {
                email: window.history.state.email,
                reset_code: '',
                password: '',
                password_confirmation: '',
            },
            loading: false,
            errors: {},
        }
    },
    mounted() {

    },
    methods: {

        async forgotApi() {
            try {
                this.errors = {};
                this.loading = true;
                await axios.post(apiRoute.admin.reset, this.formData, {headers: apiService.authHeaderContent()});
                this.$router.push({name:'login'});
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
