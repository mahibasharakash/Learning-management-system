<template>

    <div class="block text-[21px] px-5 py-3 bg-white rounded-lg mb-3 text-gray-600">
        <template v-if="!formData.id"> Create </template>
        <template v-else> Edit </template>
        Fees
    </div>

    <form @submit.prevent="manageApi" class="bg-white px-5 py-3 rounded-lg">
        <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="w-full block">
                <label for="student-information" class="block mb-1 w-full font-medium !text-[14px]"> Student Information </label>
                <div class="relative">
                    <select id="student-information" name="student" v-model="formData.student" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg appearance-none ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" required autocomplete="off">
                        <option :value="null"> Select Student </option>
                        <option v-for="each in studentData" :value="each.id"> {{each.name}} </option>
                    </select>
                    <div class="absolute top-0 end-0 bottom-0 pe-3 pointer-events-none flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="w-full block">
                <label for="department-information" class="block mb-1 w-full font-medium !text-[14px]"> Department Information </label>
                <div class="relative">
                    <select id="department-information" name="department" v-model="formData.department" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg appearance-none ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" required autocomplete="off">
                        <option :value="null"> Select Department </option>
                        <option v-for="each in departmentData" :value="each.id"> {{each.department_name}} </option>
                    </select>
                    <div class="absolute top-0 end-0 bottom-0 pe-3 pointer-events-none flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="w-full block">
                <label for="fees-type" class="block mb-1 w-full font-medium !text-[14px]"> Fees Type </label>
                <div class="relative">
                    <select id="fees-type" name="fees_type" v-model="formData.fees_type" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg appearance-none ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" required autocomplete="off">
                        <option :value="null"> Select Fees Type </option>
                        <option :value="'annual'"> Annual </option>
                        <option :value="'exam'"> Exam </option>
                        <option :value="'other'"> Other </option>
                    </select>
                    <div class="absolute top-0 end-0 bottom-0 pe-3 pointer-events-none flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="w-full block">
                <label for="payment-type" class="block mb-1 w-full font-medium !text-[14px]"> Payment Type </label>
                <div class="relative">
                    <select id="payment-type" name="payment_type" v-model="formData.payment_type" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg appearance-none ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" required autocomplete="off">
                        <option :value="null"> Select Payment Type </option>
                        <option :value="'cash'"> Cash </option>
                        <option :value="'cheque'"> Cheque </option>
                        <option :value="'other'"> Other </option>
                    </select>
                    <div class="absolute top-0 end-0 bottom-0 pe-3 pointer-events-none flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="w-full block">
                <label for="status" class="block mb-1 w-full font-medium !text-[14px]"> Status </label>
                <div class="relative">
                    <select id="status" name="status" v-model="formData.status" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg appearance-none ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" required autocomplete="off">
                        <option :value="null"> Select Status </option>
                        <option :value="'paid'"> Paid </option>
                        <option :value="'unpaid'"> Unpaid </option>
                        <option :value="'pending'"> Pending </option>
                    </select>
                    <div class="absolute top-0 end-0 bottom-0 pe-3 pointer-events-none flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="w-full block">
                <label for="payment-amount" class="block mb-1 w-full font-medium !text-[14px]"> Payment Amount </label>
                <input id="payment-amount" type="text" name="amount" v-model="formData.amount" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
            </div>
            <div class="w-full block md:col-span-2">
                <label for="payment-details" class="block mb-1 w-full font-medium !text-[14px]"> Payment Details </label>
                <textarea id="payment-details" name="payment_details" v-model="formData.payment_details" cols="30" rows="4" class="!text-[14px] w-full block border border-gray-200 py-3 px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" required autocomplete="off"></textarea>
            </div>
            <div class="w-full block md:col-span-2">
                <div class="w-full flex justify-end items-center gap-3">
                    <router-link :to="{name:'fees'}" class="min-w-[120px] max-w-[120px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center bg-gray-100 duration-500 hover:bg-gray-300 text-gray-900 rounded-lg text-xs font-medium">
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

import axios from "axios";
import apiRoute from "../../../apiController/apiRoute.js";
import apiService from "../../../apiController/apiService.js";

export default {
    data() {
        return {
            formData: {
                id: null,
                student: null,
                department: null,
                fees_type: null,
                payment_type: null,
                status: null,
                amount: '',
                payment_details: '',
            },
            manageLoading: false,
            error: {},
            RouteId: null,
            singleLoading: false,
            studentData: [],
            departmentData: [],
        }
    },
    mounted() {
        this.getAllStudent();
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
                await axios.post(apiRoute.admin.fees + '/store', this.buildFormData(), {
                    headers: apiService.authHeaderMediaContent()
                });
                this.$router.push({ name: 'fees' });
            } catch (e) {
                this.error = e.response.data.errors;
            } finally {
                this.manageLoading = false;
            }
        },

        async updateApi(id) {
            try {
                this.manageLoading = true;
                await axios.post(apiRoute.admin.fees + `/update/${id}?_method=PUT`, this.buildFormData(), {
                    headers: apiService.authHeaderMediaContent()
                });
                this.$router.push({ name: 'fees' });
            } catch (e) {
                this.error = e.response.data.errors;
            } finally {
                this.manageLoading = false;
            }
        },

        async singleApi(id) {
            try {
                this.singleLoading = true;
                const { data } = await axios.get(apiRoute.admin.fees+`/show/${id}`, { headers: apiService.authHeaderMediaContent() });

                Object.assign(this.formData, {
                    student: data.student,
                    department: data.department,
                    fees_type: data.fees_type,
                    payment_type: data.payment_type,
                    status: data.status,
                    amount: data.amount,
                    payment_details: data.payment_details,
                });

            } catch (e) {
                console.log(e);
            } finally {
                this.singleLoading = false;
            }
        },

        async getAllStudent() {
            try {
                this.singleLoading = true;
                const response = await axios.get(apiRoute.admin.general+'/student', { headers: apiService.authHeaderMediaContent() });
                this.studentData = response.data
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
