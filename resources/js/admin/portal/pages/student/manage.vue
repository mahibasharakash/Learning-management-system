<template>

    <div class="block text-[21px] px-5 py-3 bg-white rounded-lg mb-3 text-gray-600">
        <template v-if="!formData.id"> Create </template>
        <template v-else> Edit </template>
        Student
    </div>

    <form @submit.prevent="manageApi()" class="bg-white px-5 py-3 rounded-lg">
        <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
            <div class="md:col-span-2 xl:col-span-3">
                <div class="flex justify-center">
                    <div v-if="attach_preview" class="relative">
                        <img :src="attach_preview" class="max-w-[200px] min-w-[200px] max-h-[200px] min-h-[200px] object-cover bg-cover rounded-full" alt="picture" />
                        <div class="absolute inset-0 flex justify-center items-center">
                            <button type="button" class="min-w-[45px] max-w-[45px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center bg-red-600 text-white rounded-full cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[25px] h-[25px]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <label v-else for="image" class="max-w-[200px] min-w-[200px] max-h-[200px] min-h-[200px] inline-flex justify-center items-center flex-col border border-gray-100 duration-500 shadow-none hover:shadow-xl bg-gray-100 rounded-full cursor-pointer">
                        <input type="file" name="image" id="image" hidden="hidden" @change="uploadFile($event)" />
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                        </svg>
                        <span class="inline-block mt-3 text-[13px] font-medium"> Upload Image </span>
                    </label>
                </div>
            </div>
            <div class="w-full block">
                <label for="first-name" class="block mb-1 w-full font-medium !text-[14px]"> Name </label>
                <input id="first-name" type="text" name="first_name" v-model="formData.name" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.name"> {{error.name[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="email" class="block mb-1 w-full font-medium !text-[14px]"> Email </label>
                <input id="email" type="email" name="email" v-model="formData.email" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.email"> {{error.email[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="password" class="block mb-1 w-full font-medium !text-[14px]"> Password </label>
                <input id="password" type="password" name="password" v-model="formData.password" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.password"> {{error.password[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="confirm-password" class="block mb-1 w-full font-medium !text-[14px]"> Confirm Password </label>
                <input id="confirm-password" type="password" name="password_confirmation" v-model="formData.password_confirmation" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.password_confirmation"> {{error.password_confirmation[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="registration-date" class="block mb-1 w-full font-medium !text-[14px]"> Registration Date </label>
                <Flatpickr id="registration-date" :config="config" v-model="formData.registration_date" class="rounded-lg w-full outline-0 border border-gray-200 bg-white duration-500 min-h-[45px] max-h-[45px] ring-0 ring-transparent focus-within:ring-2 focus-within:ring-green-800 px-4 font-medium !text-[14px]" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.registration_date"> {{error.registration_date[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="roll-no" class="block mb-1 w-full font-medium !text-[14px]"> Roll Id </label>
                <input id="roll-no" type="text" name="roll-no" v-model="formData.roll_id" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.roll_id"> {{error.roll_id[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="course" class="block mb-1 w-full font-medium !text-[14px]"> Course </label>
                <div class="relative">
                    <select name="course" id="course" v-model="formData.course" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg appearance-none ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off">
                        <option :value="null"> Select Course </option>
                        <option v-for="each in courseData" :value="each.id"> {{each.name}} </option>
                    </select>
                    <div class="absolute top-0 end-0 bottom-0 pe-3 pointer-events-none flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.course"> {{error.course[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="gender" class="block mb-1 w-full font-medium !text-[14px]"> Gender </label>
                <div class="relative">
                    <select name="gender" id="gender" v-model="formData.gender" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg appearance-none ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off">
                        <option :value="null"> Select Gender </option>
                        <option :value="'male'"> Male </option>
                        <option :value="'female'"> Female </option>
                    </select>
                    <div class="absolute top-0 end-0 bottom-0 pe-3 pointer-events-none flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.gender"> {{error.gender[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="mobile-number" class="block mb-1 w-full font-medium !text-[14px]"> Mobile Number </label>
                <input id="mobile-number" type="text" name="mobile-number" v-model="formData.mobile_number" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.mobile_number"> {{error.mobile_number[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="blood_group" class="block mb-1 w-full font-medium !text-[14px]"> Blood Group </label>
                <div class="relative">
                    <select name="blood_group" id="blood_group" v-model="formData.blood_group" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg appearance-none ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off">
                        <option :value="null"> Select Blood Group </option>
                        <option v-for="each in bloodGroupData" :value="each.title"> {{each.title}} </option>
                    </select>
                    <div class="absolute top-0 end-0 bottom-0 pe-3 pointer-events-none flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.blood_group"> {{error.blood_group[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="date-of-birth" class="block mb-1 w-full font-medium !text-[14px]"> Date of Birth </label>
                <Flatpickr id="date-of-birth" :config="config" v-model="formData.date_of_birth" class="rounded-lg w-full outline-0 border border-gray-200 bg-white duration-500 min-h-[45px] max-h-[45px] ring-0 ring-transparent focus-within:ring-2 focus-within:ring-green-800 px-4 font-medium !text-[14px]" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.date_of_birth"> {{error.date_of_birth[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="parent-name" class="block mb-1 w-full font-medium !text-[14px]"> Parent's Name </label>
                <input id="parent-name" type="text" name="parent_name" v-model="formData.parent_name" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.parent_name"> {{error.parent_name[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="parent-mobile-number" class="block mb-1 w-full font-medium !text-[14px]"> Parent's Mobile Number </label>
                <input id="parent-mobile-number" type="text" name="parent_mobile_number" v-model="formData.parent_mobile_number" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.parent_mobile_number"> {{error.parent_mobile_number[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="preset-address" class="block mb-1 w-full font-medium !text-[14px]"> Present Address </label>
                <input id="preset-address" type="text" name="address" v-model="formData.address" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.address"> {{error.address[0]}} </div>
            </div>
            <div class="w-full block md:col-span-2 xl:col-span-3">
                <div class="w-full flex justify-end items-center gap-3">
                    <router-link :to="{name:'students'}" class="min-w-[120px] max-w-[120px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center bg-gray-100 duration-500 hover:bg-gray-300 text-gray-900 rounded-lg text-xs font-medium">
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

import axios from 'axios';
import apiRoute from '../../../apiController/apiRoute.js';
import apiService from '../../../apiController/apiService.js';

import Flatpickr from "vue-flatpickr-component";

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
                image: null,
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                registration_date: '',
                roll_id: '',
                course: null,
                gender: null,
                mobile_number: '',
                blood_group: null,
                date_of_birth: '',
                parent_name: '',
                parent_mobile_number: '',
                address: '',
            },
            courseData: [],
            bloodGroupData: [
                { id: 1, title: 'AB+' },
                { id: 2, title: 'A+' },
                { id: 3, title: 'B+' },
                { id: 4, title: 'AB-' },
                { id: 5, title: 'A-' },
                { id: 6, title: 'B-' },
                { id: 6, title: '0+' },
                { id: 7, title: '0-' },
            ],
            attach_preview: null,
            manageLoading: false,
            error: {},
            RouteId: null,
            singleLoading: false,
        }
    },
    mounted() {
        this.getAllCourse();
        this.RouteId = window.history.state.id
        if(this.RouteId !== null) {
            this.formData.id = this.RouteId
            this.singleApi(this.RouteId);
        }
    },
    methods: {

        uploadFile(event) {
            const file = event.target.files[0];
            this.attach_preview = URL.createObjectURL(file);
            this.formData.image = file;
        },

        removeFile() {
            this.attach_preview = null;
            this.formData.image = null;
        },

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
                await axios.post(apiRoute.admin.student + '/store', this.buildFormData(), {
                    headers: apiService.authHeaderMediaContent()
                });
                this.$router.push({ name: 'students' });
            } catch (e) {
                this.error = e.response.data.errors;
            } finally {
                this.manageLoading = false;
            }
        },

        async updateApi(id) {
            try {
                this.manageLoading = true;
                await axios.post(apiRoute.admin.student + `/update/${id}?_method=PUT`, this.buildFormData(), {
                    headers: apiService.authHeaderMediaContent()
                });
                this.$router.push({ name: 'students' });
            } catch (e) {
                this.error = e.response.data.errors;
            } finally {
                this.manageLoading = false;
            }
        },

        async singleApi(id) {
            try {
                this.singleLoading = true;
                const { data } = await axios.get(apiRoute.admin.student+`/show/${id}`, { headers: apiService.authHeaderMediaContent() });

                Object.assign(this.formData, {
                    name: data.name,
                    email: data.email,
                    registration_date: data.registration_date,
                    roll_id: data.roll_id,
                    course: data.course,
                    gender: data.gender,
                    mobile_number: data.mobile_number,
                    blood_group: data.blood_group,
                    date_of_birth: data.date_of_birth,
                    parent_name: data.parent_name,
                    parent_mobile_number: data.parent_mobile_number,
                    address: data.address,
                });

                if (data.image) {
                    this.attach_preview = `/storage/${data.image}`;
                }

            } catch (e) {
                console.log(e);
            } finally {
                this.singleLoading = false;
            }
        },

        async getAllCourse() {
            try {
                this.singleLoading = true;
                const response = await axios.get(apiRoute.admin.general+'/course', { headers: apiService.authHeaderMediaContent() });
                this.courseData = response.data
            } catch (e) {
                console.log(e);
            } finally {
                this.singleLoading = false;
            }
        },

    }
}

</script>
