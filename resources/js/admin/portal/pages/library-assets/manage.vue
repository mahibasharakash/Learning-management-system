<template>

    <div class="block text-[21px] px-5 py-3 bg-white rounded-lg mb-3 text-gray-600">
        <template v-if="!formData.id"> Create </template>
        <template v-else> Edit </template>
        Library Asset
    </div>

    <form @submit.prevent="manageApi" class="bg-white px-5 py-3 rounded-lg">
        <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="w-full block">
                <label for="library-asset-title" class="block mb-1 w-full font-medium !text-[14px]"> Title </label>
                <input id="library-asset-title" type="text" name="title" v-model="formData.title" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.title"> {{error.title[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="library-asset-subject" class="block mb-1 w-full font-medium !text-[14px]"> Subject </label>
                <input id="library-asset-subject" type="text" name="subject" v-model="formData.subject" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.subject"> {{error.subject[0]}} </div>
            </div>
            <div class="w-full block md:col-span-2">
                <label for="author-name" class="block mb-1 w-full font-medium !text-[14px]"> Author Name </label>
                <input id="author-name" type="text" name="author_name" v-model="formData.author_name" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.author_name"> {{error.author_name[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="publish-date" class="block mb-1 w-full font-medium !text-[14px]"> Publish Date </label>
                <Flatpickr id="publish-date" :config="config" v-model="formData.publish_date" class="rounded-lg w-full outline-0 border border-gray-200 bg-white duration-500 min-h-[45px] max-h-[45px] ring-0 ring-transparent focus-within:ring-2 focus-within:ring-green-800 px-4 font-medium !text-[14px]" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.publish_date"> {{error.publish_date[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="department" class="block mb-1 w-full font-medium !text-[14px]"> Department </label>
                <div class="relative">
                    <select id="department" name="department" v-model="formData.department" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg appearance-none ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off">
                        <option :value="null"> Select Department </option>
                        <option v-for="each in departmentData" :value="each.id"> {{each.department_name}} </option>
                    </select>
                    <div class="absolute top-0 end-0 bottom-0 pe-3 pointer-events-none flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.department"> {{error.department[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="asset-type" class="block mb-1 w-full font-medium !text-[14px]"> Asset Type </label>
                <div class="relative">
                    <select id="asset-type" name="asset_type" v-model="formData.asset_type" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg appearance-none ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off">
                        <option :value="null"> Select Asset Type </option>
                        <option :value="'books'"> Books </option>
                        <option :value="'newspaper'"> Newspaper </option>
                        <option :value="'comics'"> Comics </option>
                    </select>
                    <div class="absolute top-0 end-0 bottom-0 pe-3 pointer-events-none flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.asset_type"> {{error.asset_type[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="purchase-date" class="block mb-1 w-full font-medium !text-[14px]"> Purchase Date </label>
                <Flatpickr id="purchase-date" :config="config" v-model="formData.purchase_date" class="rounded-lg w-full outline-0 border border-gray-200 bg-white duration-500 min-h-[45px] max-h-[45px] ring-0 ring-transparent focus-within:ring-2 focus-within:ring-green-800 px-4 font-medium !text-[14px]" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.purchase_date"> {{error.purchase_date[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="price" class="block mb-1 w-full font-medium !text-[14px]"> Price </label>
                <input id="price" type="text" name="price" v-model="formData.price" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.price"> {{error.price[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="status" class="block mb-1 w-full font-medium !text-[14px]"> Status </label>
                <div class="relative">
                    <select name="status" id="status" v-model="formData.status" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg appearance-none ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off">
                        <option :value="null"> Select Status </option>
                        <option :value="'in_stocks'"> In Stocks </option>
                        <option :value="'out_of_stocks'"> Out of Stocks </option>
                    </select>
                    <div class="absolute top-0 end-0 bottom-0 pe-3 pointer-events-none flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.status"> {{error.status[0]}} </div>
            </div>
            <div class="w-full block md:col-span-2">
                <label for="asset-details" class="block mb-1 w-full font-medium !text-[14px]"> Asset Details </label>
                <textarea id="asset-details" name="asset_details" v-model="formData.asset_details" cols="30" rows="4" class="!text-[14px] w-full block border border-gray-200 py-3 px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off"></textarea>
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.asset_details"> {{error.asset_details[0]}} </div>
            </div>
            <div class="w-full block md:col-span-2">
                <div class="w-full flex justify-end items-center gap-3">
                    <router-link :to="{name:'libraries'}" class="min-w-[120px] max-w-[120px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center bg-gray-100 duration-500 hover:bg-gray-300 text-gray-900 rounded-lg text-xs font-medium">
                        Cancel
                    </router-link>
                    <button type="submit" v-if="!manageLoading" class="cursor-pointer min-w-[120px] max-w-[120px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center bg-blue-100 duration-500 hover:bg-blue-300 text-blue-900 rounded-lg text-xs font-medium">
                        <template v-if="!formData.id"> Create </template>
                        <template v-else> Update </template>
                    </button>
                    <button type="button" v-if="manageLoading" class="cursor-pointer min-w-[120px] max-w-[120px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center bg-blue-100 duration-500 hover:bg-blue-300 text-blue-900 rounded-lg text-xs font-medium">
                        <span class="inline-block rounded-full min-w-[20px] max-w-[20px] min-h-[20px] max-h-[20px] border-2 border-blue-900 border-t-transparent animate-spin"></span>
                    </button>
                </div>
            </div>
        </div>
    </form>

</template>

<script>

import Flatpickr from "vue-flatpickr-component";
import axios from "axios";
import apiRoute from "../../../apiController/apiRoute.js";
import apiService from "../../../apiController/apiService.js";

export default {
    components: {
        Flatpickr
    },
    data() {
        return {
            config: {
                dateFormat: 'Y-m-d',
                altInput: true,
                altFormat: 'j F, Y',
                time_24hr: false,
                defaultDate: new Date(),
                allowInput: true,
                disableMobile: true,
            },
            formData: {
                id: null,
                title: '',
                subject: '',
                author_name: '',
                publish_date: '',
                department: null,
                asset_type: null,
                purchase_date: '',
                price: '',
                status: null,
                asset_details: '',
            },
            manageLoading: false,
            error: {},
            RouteId: null,
            singleLoading: false,
            departmentData: [],
        }
    },
    mounted() {
        this.getAllDepartment();
        this.RouteId = window.history.state.id
        if(this.RouteId !== null) {
            this.formData.id = this.RouteId
            this.singleApi(this.RouteId);
        }
    },
    methods: {

        manageApi() {
            if(this.RouteId) {
                this.updateApi(this.RouteId);
            } else {
                this.createApi();
            }
        },

        buildFormData() {
            const formDataObj = new FormData();
            for (let key in this.formData) {
                if (this.formData[key] !== null && this.formData[key] !== '') {
                    formDataObj.append(key, this.formData[key]);
                }
            }
            return formDataObj;
        },

        async createApi() {
            try {
                this.manageLoading = true;
                await axios.post(apiRoute.admin.libraryAssets + '/store', this.buildFormData(), {
                    headers: apiService.authHeaderMediaContent()
                });
                this.$router.push({ name: 'libraries' });
            } catch (e) {
                this.error = e.response.data.errors;
            } finally {
                this.manageLoading = false;
            }
        },

        async updateApi(id) {
            try {
                this.manageLoading = true;
                await axios.post(apiRoute.admin.libraryAssets + `/update/${id}?_method=PUT`, this.buildFormData(), {
                    headers: apiService.authHeaderMediaContent()
                });
                this.$router.push({ name: 'libraries' });
            } catch (e) {
                this.error = e.response.data.errors;
            } finally {
                this.manageLoading = false;
            }
        },

        async singleApi(id) {
            try {
                this.singleLoading = true;
                const { data } = await axios.get(apiRoute.admin.libraryAssets+`/show/${id}`, { headers: apiService.authHeaderMediaContent() });

                Object.assign(this.formData, {
                    title: data.title,
                    subject: data.subject,
                    author_name: data.author_name,
                    publish_date: data.publish_date,
                    department: data.department,
                    asset_type: data.asset_type,
                    purchase_date: data.purchase_date,
                    price: data.price,
                    status: data.status,
                    asset_details: data.asset_details,
                });

            } catch (e) {
                console.log(e);
            } finally {
                this.singleLoading = false;
            }
        },

        async getAllDepartment() {
            try {
                this.singleLoading = true;
                const response = await axios.get(apiRoute.admin.general+'/department', { headers: apiService.authHeaderMediaContent() });
                this.departmentData = response.data
            } catch (e) {
                console.log(e);
            } finally {
                this.singleLoading = false;
            }
        },

    }
}

</script>
