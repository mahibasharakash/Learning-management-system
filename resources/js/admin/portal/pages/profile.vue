<template>

    <div class="block text-[21px] px-5 py-3 bg-white rounded-lg mb-3 text-gray-600">
        Profile
    </div>

    <div class="p-3 bg-white w-full block rounded-lg">
        <div class="flex flex-wrap w-full">
            <div class="w-full lg:w-1/3">
                <div v-if="!loading" class="p-5 w-full block">
                    <div class="flex justify-center items-center mb-3">
                        <img v-if="profileData?.image" :src="`/storage/${profileData?.image}`" class="min-w-[200px] max-w-[200px] min-h-[200px] max-h-[200px] rounded-full object-cover bg-cover" alt="image" />
                        <div v-else class="min-w-[200px] max-w-[200px] min-h-[200px] max-h-[200px] inline-flex justify-center items-center text-5xl bg-gray-100 shadow-xl rounded-full">
                            {{shortName(profileData?.name)}}
                        </div>
                    </div>
                    <div class="block mb-3 w-full">
                        <div class="mb-1 text-gray-900 block w-full font-medium !text-[14px]"> Full Name: </div>
                        <div class="text-gray-600 block w-full !text-[14px]"> {{profileData?.name ?? 'N/A'}} </div>
                    </div>
                    <div class="block mb-3 w-full">
                        <div class="mb-1 text-gray-900 block w-full font-medium !text-[14px]"> Email: </div>
                        <div class="text-gray-600 block w-full !text-[14px]"> {{profileData?.email ?? 'N/A'}} </div>
                    </div>
                    <div class="block mb-3 w-full">
                        <div class="mb-1 text-gray-900 block w-full font-medium !text-[14px]"> Mobile Number: </div>
                        <div class="text-gray-600 block w-full !text-[14px]"> {{profileData?.mobile_number ?? 'N/A'}} </div>
                    </div>
                    <div class="block mb-3 w-full">
                        <div class="mb-1 text-gray-900 block w-full font-medium !text-[14px]"> Date of Birth: </div>
                        <div class="text-gray-600 block w-full !text-[14px]"> {{profileData?.date_of_birth_formatted ?? 'N/A'}} </div>
                    </div>
                    <div class="block mb-3 w-full">
                        <div class="mb-1 text-gray-900 block w-full font-medium !text-[14px]"> Address: </div>
                        <div class="text-gray-600 block w-full !text-[14px]"> {{profileData?.address ?? 'N/A'}} </div>
                    </div>
                </div>
                <div v-if="loading" class="p-5 w-full block">
                    <div class="flex justify-center items-center mb-3">
                        <div class="min-w-[200px] max-w-[200px] min-h-[200px] max-h-[200px] bg-gray-400 animate-pulse rounded-full"></div>
                    </div>
                    <div class="block mb-3 w-full">
                        <div class="w-full font-medium !text-[14px] max-w-[155px] min-h-[19px] max-h-[19px] bg-gray-400 mb-2 rounded-lg">  </div>
                        <div class="w-full font-medium !text-[14px] max-w-[255px] min-h-[19px] max-h-[19px] bg-gray-400 rounded-lg">  </div>
                    </div>
                    <div class="block mb-3 w-full">
                        <div class="w-full font-medium !text-[14px] max-w-[155px] min-h-[19px] max-h-[19px] bg-gray-400 mb-2 rounded-lg">  </div>
                        <div class="w-full font-medium !text-[14px] max-w-[300px] min-h-[19px] max-h-[19px] bg-gray-400 rounded-lg">  </div>
                    </div>
                    <div class="block mb-3 w-full">
                        <div class="w-full font-medium !text-[14px] max-w-[155px] min-h-[19px] max-h-[19px] bg-gray-400 mb-2 rounded-lg">  </div>
                        <div class="w-full font-medium !text-[14px] max-w-[340px] min-h-[19px] max-h-[19px] bg-gray-400 rounded-lg">  </div>
                    </div>
                    <div class="block mb-3 w-full">
                        <div class="w-full font-medium !text-[14px] max-w-[155px] min-h-[19px] max-h-[19px] bg-gray-400 mb-2 rounded-lg">  </div>
                        <div class="w-full font-medium !text-[14px] max-w-[300px] min-h-[19px] max-h-[19px] bg-gray-400 rounded-lg">  </div>
                    </div>
                    <div class="block mb-3 w-full">
                        <div class="w-full font-medium !text-[14px] max-w-[155px] min-h-[19px] max-h-[19px] bg-gray-400 mb-2 rounded-lg">  </div>
                        <div class="w-full font-medium !text-[14px] max-w-[420px] min-h-[19px] max-h-[19px] bg-gray-400 rounded-lg">  </div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-2/3">
                <form @submit.prevent="changeDetails" class="p-5 w-full block">
                    <div class="mb-5 block w-full text-[21px]"> Edit Profile </div>
                    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="w-full md:col-span-2">
                            <div class="flex justify-center">
                                <div v-if="attach_preview" class="relative min-w-[200px] max-w-[200px] min-h-[200px] max-h-[200px] overflow-hidden rounded-full">
                                    <img :src="attach_preview" class="min-w-[200px] max-w-[200px] min-h-[200px] max-h-[200px] object-cover bg-cover overflow-hidden rounded-full" alt="attach_preview" />
                                    <div class="absolute inset-0 w-full h-full rounded-full flex justify-center items-center overflow-hidden">
                                        <button type="button" class="min-w-[45px] max-w-[45px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center bg-red-500 text-white rounded-full cursor-pointer" @click="removeFile()">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <label v-else for="image" class="cursor-pointer min-w-[200px] max-w-[200px] min-h-[200px] max-h-[200px] inline-flex justify-center items-center text-5xl bg-gray-100 shadow-xl rounded-full flex-col">
                                    <input type="file" name="image" id="image" hidden="hidden" @change="attachFile($event)" />
                                    <span class="mb-3 inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                        </svg>
                                    </span>
                                    <span class="text-[14px] font-medium"> Upload Image </span>
                                </label>
                            </div>
                        </div>
                        <div class="w-full block">
                            <label for="user-name" class="block w-full mb-1 !text-[14px] font-medium"> Full Name </label>
                            <input id="user-name" type="text" name="name" v-model="profileParam.name" class="!text-[12px] font-medium w-full block px-4 min-h-[45px] max-h-[45px] rounded-lg outline-0 border border-gray-200 ring-0 ring-transparent duration-500 focus-within:ring-2 focus-within:ring-blue-400" autocomplete="off" />
                            <div class="text-red-500 mt-1 block w-full !text-[12px] font-medium" v-if="profileErrors.name"> {{profileErrors.name[0]}} </div>
                        </div>
                        <div class="w-full block">
                            <label for="user-email" class="block w-full mb-1 !text-[14px] font-medium"> Email </label>
                            <input id="user-email" type="email" name="email" v-model="profileParam.email" class="!text-[12px] font-medium w-full block px-4 min-h-[45px] max-h-[45px] rounded-lg outline-0 border border-gray-200 ring-0 ring-transparent duration-500 focus-within:ring-2 focus-within:ring-blue-400" autocomplete="off" />
                            <div class="text-red-500 mt-1 block w-full !text-[12px] font-medium" v-if="profileErrors.email"> {{profileErrors.email[0]}} </div>
                        </div>
                        <div class="w-full block">
                            <label for="mobile-number" class="block w-full mb-1 !text-[14px] font-medium"> Mobile Number </label>
                            <input id="mobile-number" type="text" name="mobile_number" v-model="profileParam.mobile_number" class="!text-[12px] font-medium w-full block px-4 min-h-[45px] max-h-[45px] rounded-lg outline-0 border border-gray-200 ring-0 ring-transparent duration-500 focus-within:ring-2 focus-within:ring-blue-400" autocomplete="off" />
                            <div class="text-red-500 mt-1 block w-full !text-[12px] font-medium" v-if="profileErrors.mobile_number"> {{profileErrors.mobile_number[0]}} </div>
                        </div>
                        <div class="w-full block">
                            <label for="present-address" class="block w-full mb-1 !text-[14px] font-medium"> Preset Address </label>
                            <input id="present-address" type="text" name="address" v-model="profileParam.address" class="!text-[12px] font-medium w-full block px-4 min-h-[45px] max-h-[45px] rounded-lg outline-0 border border-gray-200 ring-0 ring-transparent duration-500 focus-within:ring-2 focus-within:ring-blue-400" autocomplete="off" />
                            <div class="text-red-500 mt-1 block w-full !text-[12px] font-medium" v-if="profileErrors.address"> {{profileErrors.address[0]}} </div>
                        </div>
                        <div class="w-full block col-span-1 md:col-span-2">
                            <label for="date-of-birth" class="block w-full mb-1 !text-[14px] font-medium"> Date of Birth </label>
                            <Flatpickr id="date-of-birth" :config="config" v-model="profileParam.date_of_birth" class="!text-[12px] font-medium w-full block px-4 min-h-[45px] max-h-[45px] rounded-lg outline-0 border border-gray-200 ring-0 ring-transparent duration-500 focus-within:ring-2 focus-within:ring-blue-400" />
                            <div class="text-red-500 mt-1 block w-full !text-[12px] font-medium" v-if="profileErrors.date_of_birth"> {{profileErrors.date_of_birth[0]}} </div>
                        </div>
                        <div class="w-full block">
                            <button type="submit" v-if="!profileLoading" class="w-full !text-[14px] max-w-[120px] min-w-[120px] inline-flex justify-center items-center min-h-[45px] max-h-[45px] rounded-lg bg-blue-500 duration-500 hover:bg-blue-600 text-white cursor-pointer">
                                Update
                            </button>
                            <button type="button" v-if="profileLoading" class="w-full !text-[14px] max-w-[120px] min-w-[120px] inline-flex justify-center items-center min-h-[45px] max-h-[45px] rounded-lg bg-blue-500 duration-500 hover:bg-blue-600 text-white cursor-pointer">
                                <span class="w-4 h-4 inline-block border-2 border-white border-t-transparent animate-spin rounded-full"></span>
                            </button>
                        </div>
                    </div>
                </form>
                <hr class="w-1/2 border border-gray-200 mx-auto">
                <form @submit.prevent="changePassword" class="p-5 w-full block">
                    <div class="mb-5 block w-full text-[21px]"> Change Password </div>
                    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="w-full block">
                            <label for="current-password" class="block w-full mb-1 !text-[14px] font-medium"> Current Password </label>
                            <input id="current-password" type="password" name="current_password" v-model="passwordParam.current_password" class="!text-[12px] font-medium w-full block px-4 min-h-[45px] max-h-[45px] rounded-lg outline-0 border border-gray-200 ring-0 ring-transparent duration-500 focus-within:ring-2 focus-within:ring-blue-400" autocomplete="off" />
                            <div class="text-red-500 mt-1 block w-full !text-[12px] font-medium" v-if="passwordErrors.current_password"> {{passwordErrors.current_password[0]}} </div>
                        </div>
                        <div class="w-full block">
                            <label for="new-password" class="block w-full mb-1 !text-[14px] font-medium"> Password </label>
                            <input id="new-password" type="password" name="password" v-model="passwordParam.password" class="!text-[12px] font-medium w-full block px-4 min-h-[45px] max-h-[45px] rounded-lg outline-0 border border-gray-200 ring-0 ring-transparent duration-500 focus-within:ring-2 focus-within:ring-blue-400" autocomplete="off" />
                            <div class="text-red-500 mt-1 block w-full !text-[12px] font-medium" v-if="passwordErrors.password"> {{passwordErrors.password[0]}} </div>
                        </div>
                        <div class="w-full block md:col-span-2">
                            <label for="new-confirm-password" class="block w-full mb-1 !text-[14px] font-medium"> Confirm Password </label>
                            <input id="new-confirm-password" type="password" name="password_confirmation" v-model="passwordParam.password_confirmation" class="!text-[12px] font-medium w-full block px-4 min-h-[45px] max-h-[45px] rounded-lg outline-0 border border-gray-200 ring-0 ring-transparent duration-500 focus-within:ring-2 focus-within:ring-blue-400" autocomplete="off" />
                            <div class="text-red-500 mt-1 block w-full !text-[12px] font-medium" v-if="passwordErrors.password_confirmation"> {{passwordErrors.password_confirmation[0]}} </div>
                        </div>
                        <div class="w-full block">
                            <button type="submit" v-if="!passwordLoading" class="w-full !text-[14px] max-w-[120px] min-w-[120px] inline-flex justify-center items-center min-h-[45px] max-h-[45px] rounded-lg bg-blue-500 duration-500 hover:bg-blue-600 text-white cursor-pointer">
                                Update
                            </button>
                            <button type="button" v-if="passwordLoading" class="w-full !text-[14px] max-w-[120px] min-w-[120px] inline-flex justify-center items-center min-h-[45px] max-h-[45px] rounded-lg bg-blue-500 duration-500 hover:bg-blue-600 text-white cursor-pointer">
                                <span class="w-4 h-4 inline-block border-2 border-white border-t-transparent animate-spin rounded-full"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>

<script>

import axios from 'axios';
import apiRoute from '../../apiController/apiRoute.js';
import apiService from '../../apiController/apiService.js';
import cookiesServices from "../../apiController/cookiesServices.js";

import Flatpickr from 'vue-flatpickr-component';

export default {
    components: {
        Flatpickr
    },
    data() {
        return {
            config: {
                enableTime: false,
                dateFormat: 'Y-m-d',
                altInput: true,
                altFormat: 'j F Y',
                time_24hr: false,
                defaultDate: '',
                allowInput: true,
                disableMobile: true,
            },
            loading: false,
            profileLoading: false,
            passwordLoading: false,
            profileData: {},
            profileParam: {
                image: null,
                name: '',
                email: '',
                mobile_number: '',
                address: '',
                date_of_birth: '',
            },
            passwordParam: {
                current_password: '',
                password: '',
                password_confirmation: '',
            },
            profileErrors: {},
            passwordErrors: {},
            attach_preview: null,
        }
    },
    mounted() {
        this.getDetailsApi();
    },
    methods: {

        async getDetailsApi() {
            try {
                this.loading = true;
                axios.defaults.headers.common['Authorization'] = `Bearer ${cookiesServices.get('admin_token')}`;
                const response = await axios.get(apiRoute.admin.details, null, {headers: apiService.authHeaderContent()});
                this.profileData = response.data;
                this.profileParam = JSON.parse(JSON.stringify(response.data));
                if(this.profileParam.image) {
                    console.log(123123)
                    this.attach_preview = `/storage/${this.profileData.image}`
                }
            } catch (e) {
                console.log(e)
            } finally {
                this.loading = false;
            }
        },

        async changeDetails() {
            try {
                this.profileErrors = {};
                this.profileLoading = true;
                await axios.post(apiRoute.admin.changeDetails, this.profileParam, {headers: apiService.authHeaderMediaContent()});
                await this.getDetailsApi();
            } catch (e) {
                this.profileErrors = e.response.data.errors;
            } finally {
                this.profileLoading = false;
            }
        },

        async changePassword() {
            try {
                this.passwordErrors = {};
                this.passwordLoading = true;
                await axios.post(apiRoute.admin.changePassword, this.passwordParam, {headers: apiService.authHeaderContent()});
                await this.getDetailsApi();
            } catch (e) {
                this.passwordErrors = e.response.data.errors;
            } finally {
                this.passwordLoading = false;
            }
        },

        shortName(name) {
            if (!name || typeof name !== 'string') return '';
            let parts = name.trim().split(' ');
            if (parts.length < 2) return parts[0][0] || '';
            return parts[0][0] + parts[1][0];
        },

        attachFile(event) {
            const file = event.target.files[0];
            this.attach_preview = URL.createObjectURL(file);
            this.profileParam.image = file;
        },

        removeFile() {
            this.attach_preview = null;
            this.profileParam.image = null;
        },

    }
}

</script>
