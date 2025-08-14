<template>

    <div class="block text-[21px] px-5 py-3 bg-white rounded-lg mb-3 text-gray-600">
        <template v-if="!formData.id"> Create </template>
        <template v-else> Edit </template>
        Department
    </div>

    <form @submit.prevent="manageApi" class="bg-white px-5 py-3 rounded-lg">
        <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="w-full block">
                <label for="department-name" class="block mb-1 w-full font-medium !text-[14px]"> Department Name </label>
                <input id="department-name" type="text" name="department_name" v-model="formData.department_name" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.department_name"> {{error.department_name[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="head-of-department" class="block mb-1 w-full font-medium !text-[14px]"> Head Of Department </label>
                <input id="head-of-department" type="text" name="head_of_department" v-model="formData.head_of_department" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.head_of_department"> {{error.head_of_department[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="department-start-date" class="block mb-1 w-full font-medium !text-[14px]"> Department Start Date </label>
                <Flatpickr id="department-start-date" :config="config" v-model="formData.start_date" class="rounded-lg w-full outline-0 border border-gray-200 bg-white duration-500 min-h-[45px] max-h-[45px] ring-0 ring-transparent focus-within:ring-2 focus-within:ring-green-800 px-4 font-medium !text-[14px]" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.start_date"> {{error.start_date[0]}} </div>
            </div>
            <div class="w-full block md:col-span-2">
                <label for="department-details" class="block mb-1 w-full font-medium !text-[14px]"> Department Details </label>
                <textarea id="department-details" name="department_details" v-model="formData.department_details" cols="30" rows="4" class="!text-[14px] w-full block border border-gray-200 py-3 px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off"></textarea>
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.department_details"> {{error.department_details[0]}} </div>
            </div>
            <div class="w-full block md:col-span-2">
                <div class="w-full flex justify-end items-center gap-3">
                    <router-link :to="{name:'departments'}" class="min-w-[120px] max-w-[120px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center bg-gray-100 duration-500 hover:bg-gray-300 text-gray-900 rounded-lg text-xs font-medium">
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
                department_name: '',
                head_of_department: '',
                start_date: '',
                department_details: '',
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
                await axios.post(apiRoute.admin.department + '/store', this.buildFormData(), {
                    headers: apiService.authHeaderMediaContent()
                });
                this.$router.push({ name: 'departments' });
            } catch (e) {
                this.error = e.response.data.errors;
            } finally {
                this.manageLoading = false;
            }
        },

        async updateApi(id) {
            try {
                this.manageLoading = true;
                await axios.post(apiRoute.admin.department + `/update/${id}?_method=PUT`, this.buildFormData(), {
                    headers: apiService.authHeaderMediaContent()
                });
                this.$router.push({ name: 'departments' });
            } catch (e) {
                this.error = e.response.data.errors;
            } finally {
                this.manageLoading = false;
            }
        },

        async singleApi(id) {
            try {
                this.singleLoading = true;
                const { data } = await axios.get(apiRoute.admin.department+`/show/${id}`, { headers: apiService.authHeaderMediaContent() });

                Object.assign(this.formData, {
                    department_name: data.department_name,
                    head_of_department: data.head_of_department,
                    start_date: data.start_date,
                    department_details: data.department_details,
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
