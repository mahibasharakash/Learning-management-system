<template>

    <div class="block text-[21px] px-5 py-3 bg-white rounded-lg mb-3 text-gray-600">
        <template v-if="!formData.id"> Create </template>
        <template v-else> Edit </template>
        Holiday
    </div>

    <form @submit.prevent="manageApi" class="bg-white px-5 py-3 rounded-lg">
        <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="w-full block">
                <label for="holiday-title" class="block mb-1 w-full font-medium !text-[14px]"> Title </label>
                <input id="holiday-title" type="text" name="title" v-model="formData.title" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.title"> {{error.title[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="holiday-type" class="block mb-1 w-full font-medium !text-[14px]"> Holiday Types </label>
                <div class="relative">
                    <select id="holiday-type" name="type" v-model="formData.type" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg appearance-none ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off">
                        <option :value="null"> Select Holiday Type </option>
                        <option :value="'republic_day'"> Republic Day </option>
                        <option :value="'independence_day'"> Independence Day </option>
                        <option :value="'memorial_day'"> Memorial Day </option>
                    </select>
                    <div class="absolute top-0 end-0 bottom-0 pe-3 pointer-events-none flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.type"> {{error.type[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="holiday-start-date" class="block mb-1 w-full font-medium !text-[14px]"> Holiday Start Date </label>
                <Flatpickr id="holiday-start-date" :config="config" v-model="formData.start_date" class="rounded-lg w-full outline-0 border border-gray-200 bg-white duration-500 min-h-[45px] max-h-[45px] ring-0 ring-transparent focus-within:ring-2 focus-within:ring-green-800 px-4 font-medium !text-[14px]" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.start_date"> {{error.start_date[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="holiday-end-date" class="block mb-1 w-full font-medium !text-[14px]"> Holiday End Date </label>
                <Flatpickr id="holiday-end-date" :config="config" v-model="formData.end_date" class="rounded-lg w-full outline-0 border border-gray-200 bg-white duration-500 min-h-[45px] max-h-[45px] ring-0 ring-transparent focus-within:ring-2 focus-within:ring-green-800 px-4 font-medium !text-[14px]" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.end_date"> {{error.end_date[0]}} </div>
            </div>
            <div class="w-full block md:col-span-2">
                <label for="holiday-details" class="block mb-1 w-full font-medium !text-[14px]"> Holiday Details </label>
                <textarea id="holiday-details" name="details" v-model="formData.details" cols="30" rows="4" class="!text-[14px] w-full block border border-gray-200 py-3 px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off"></textarea>
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.details"> {{error.details[0]}} </div>
            </div>
            <div class="w-full block md:col-span-2">
                <div class="w-full flex justify-end items-center gap-3">
                    <router-link :to="{name:'holidays'}" class="min-w-[120px] max-w-[120px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center bg-gray-100 duration-500 hover:bg-gray-300 text-gray-900 rounded-lg text-xs font-medium">
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
                type: null,
                start_date: '',
                end_date: '',
                details: '',
            },
            manageLoading: false,
            error: {},
            RouteId: null,
            singleLoading: false,
        }
    },
    mounted() {
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
                await axios.post(apiRoute.admin.holiday + '/store', this.buildFormData(), {
                    headers: apiService.authHeaderMediaContent()
                });
                this.$router.push({ name: 'holidays' });
            } catch (e) {
                this.error = e.response.data.errors;
            } finally {
                this.manageLoading = false;
            }
        },

        async updateApi(id) {
            try {
                this.manageLoading = true;
                await axios.post(apiRoute.admin.holiday + `/update/${id}?_method=PUT`, this.buildFormData(), {
                    headers: apiService.authHeaderMediaContent()
                });
                this.$router.push({ name: 'holidays' });
            } catch (e) {
                this.error = e.response.data.errors;
            } finally {
                this.manageLoading = false;
            }
        },

        async singleApi(id) {
            try {
                this.singleLoading = true;
                const { data } = await axios.get(apiRoute.admin.holiday+`/show/${id}`, { headers: apiService.authHeaderMediaContent() });

                Object.assign(this.formData, {
                    title: data.title,
                    type: data.type,
                    start_date: data.start_date,
                    end_date: data.end_date,
                    details: data.details,
                });

            } catch (e) {
                console.log(e);
            } finally {
                this.singleLoading = false;
            }
        },

    }
}

</script>
