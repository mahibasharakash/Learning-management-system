<template>

    <div class="block text-[21px] px-5 py-3 bg-white rounded-lg mb-3 text-gray-600">
        <template v-if="!formData.id"> Create </template>
        <template v-else> Edit </template>
        Course
    </div>

    <form @submit.prevent="manageApi" class="bg-white px-5 py-3 rounded-lg">
        <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="md:col-span-2">
                <div class="flex justify-start">

                    <div v-if="attach_preview" class="relative">
                        <img :src="attach_preview" class="max-w-[350px] min-w-[350px] max-h-[200px] min-h-[200px] object-cover bg-cover" alt="picture" />
                        <div class="absolute inset-0 flex justify-center items-center">
                            <button type="button" class="min-w-[45px] max-w-[45px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center bg-red-600 text-white rounded-full cursor-pointer" @click="removeFile()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[25px] h-[25px]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <label v-else for="upload-image" class="max-w-[350px] min-w-[350px] max-h-[200px] min-h-[200px] inline-flex justify-center items-center flex-col border border-gray-100 duration-500 shadow-none hover:shadow-xl bg-gray-100 cursor-pointer">
                        <input type="file" name="upload-image" id="upload-image" hidden="hidden" @change="uploadFile($event)" />
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                        </svg>
                        <span class="inline-block mt-3 text-[13px] font-medium"> Upload Image </span>
                    </label>

                </div>
            </div>
            <div class="w-full block">
                <label for="course-name" class="block mb-1 w-full font-medium !text-[14px]"> Course Name </label>
                <input id="course-name" type="text" name="name" v-model="formData.name" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.name"> {{error.name[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="course-code" class="block mb-1 w-full font-medium !text-[14px]"> Course Code </label>
                <input id="course-code" type="text" name="code" v-model="formData.code" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.code"> {{error.code[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="start-form" class="block mb-1 w-full font-medium !text-[14px]"> Start Form </label>
                <Flatpickr id="start-form" :config="config" v-model="formData.from_start" class="rounded-lg w-full outline-0 border border-gray-200 bg-white duration-500 min-h-[45px] max-h-[45px] ring-0 ring-transparent focus-within:ring-2 focus-within:ring-green-800 px-4 font-medium !text-[14px]" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.from_start"> {{error.from_start[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="course-duration" class="block mb-1 w-full font-medium !text-[14px]"> Course Duration </label>
                <input id="course-duration" type="text" name="course_duration" v-model="formData.course_duration" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.course_duration"> {{error.course_duration[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="course-price" class="block mb-1 w-full font-medium !text-[14px]"> Course Price </label>
                <input id="course-price" type="text" name="price" v-model="formData.price" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.price"> {{error.price[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="tutor-info" class="block mb-1 w-full font-medium !text-[14px]"> Instructor Name </label>
                <div class="relative">
                    <select id="tutor-info" name="tutor" v-model="formData.tutor" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg appearance-none ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off">
                        <option :value="null"> Select Instructor </option>
                        <option v-for="each in tutorData" :value="each.id"> {{each.name}} </option>
                    </select>
                    <div class="absolute top-0 end-0 bottom-0 pe-3 pointer-events-none flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.tutor"> {{error.tutor[0]}} </div>
            </div>
            <div class="w-full block">
                <label for="maximum-students" class="block mb-1 w-full font-medium !text-[14px]"> Maximum Students </label>
                <input id="maximum-students" type="text" name="maximum_students" v-model="formData.maximum_students" class="!text-[14px] w-full block border border-gray-200 min-h-[45px] max-h-[45px] px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off" />
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.maximum_students"> {{error.maximum_students[0]}} </div>
            </div>
            <div class="w-full block md:col-span-2">
                <label for="course-details" class="block mb-1 w-full font-medium !text-[14px]"> Course Details </label>
                <textarea id="course-details" name="course_details" v-model="formData.course_details" cols="30" rows="4" class="!text-[14px] w-full block border border-gray-200 py-3 px-4 outline-0 rounded-lg ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-800 duration-500" autocomplete="off"></textarea>
                <div class="text-red-500 mt-1 w-full block text-[12px] font-medium" v-if="error.course_details"> {{error.course_details[0]}} </div>
            </div>
            <div class="w-full block md:col-span-2">
                <div class="w-full flex justify-end items-center gap-3">
                    <router-link :to="{name:'courses'}" class="min-w-[120px] max-w-[120px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center bg-gray-100 duration-500 hover:bg-gray-300 text-gray-900 rounded-lg text-xs font-medium">
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
                code: '',
                course_details: '',
                from_start: '',
                course_duration: '',
                price: '',
                tutor: null,
                maximum_students: '',
            },
            attach_preview: null,
            manageLoading: false,
            error: {},
            RouteId: null,
            singleLoading: false,
            tutorData: [],
        }
    },
    mounted() {
        this.getAllTutor();
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
                await axios.post(apiRoute.admin.course + '/store', this.buildFormData(), {
                    headers: apiService.authHeaderMediaContent()
                });
                this.$router.push({ name: 'courses' });
            } catch (e) {
                this.error = e.response.data.errors;
            } finally {
                this.manageLoading = false;
            }
        },

        async updateApi(id) {
            try {
                this.manageLoading = true;
                await axios.post(apiRoute.admin.course + `/update/${id}?_method=PUT`, this.buildFormData(), {
                    headers: apiService.authHeaderMediaContent()
                });
                this.$router.push({ name: 'courses' });
            } catch (e) {
                this.error = e.response.data.errors;
            } finally {
                this.manageLoading = false;
            }
        },

        async singleApi(id) {
            try {
                this.singleLoading = true;
                const { data } = await axios.get(apiRoute.admin.course+`/show/${id}`, { headers: apiService.authHeaderMediaContent() });

                Object.assign(this.formData, {
                    name: data.name,
                    code: data.code,
                    course_details: data.course_details,
                    from_start: data.from_start,
                    course_duration: data.course_duration,
                    price: data.price,
                    tutor: data.tutor,
                    maximum_students: data.maximum_students,
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

        async getAllTutor() {
            try {
                this.singleLoading = true;
                const response = await axios.get(apiRoute.admin.general+'/tutor', { headers: apiService.authHeaderMediaContent() });
                this.tutorData = response.data
            } catch (e) {
                console.log(e);
            } finally {
                this.singleLoading = false;
            }
        },

    }
}

</script>
