<template>
    <div class="w-full flex justify-start items-start">
        <aside class="min-w-[270px] bg-gray-50 h-screen fixed top-0 bottom-0 lg:static duration-500 z-50" :class="{ '-start-0' : isActiveSidebar, '-start-[280px]' : !isActiveSidebar }">
            <div class="w-full min-h-[70px] max-h-[70px] flex justify-center items-center">
                <router-link :to="{name:'dashboard'}" class="inline-flex justify-center items-center flex-col">
                    <img :src="'/favicon.svg'" class="max-w-8 min-w-8 max-h-8 min-h-8 object-contain" alt="favicon.svg" />
                    <span class="ps-3 text-[16px]"> School Management </span>
                </router-link>
            </div>
            <div class="w-full block">
                <router-link :to="{name:'dashboard'}" class="decoration-0 flex justify-start items-center w-full py-3 px-4 !text-[12.50px] duration-500 hover:bg-blue-900/15 border-s-4 hover:border-s-blue-900 mb-1 font-medium hover:text-blue-900" :class="{ 'text-gray-500 bg-transparent border-transparent' : $route.name !== 'dashboard', 'text-blue-900 bg-blue-900/15 border-s-blue-900' : $route.name === 'dashboard' }">
                    <span class="me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="max-w-5 min-w-5 max-h-5 min-h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    </span>
                    Dashboard
                </router-link>
                <router-link :to="{name:'events'}" class="decoration-0 flex justify-start items-center w-full py-3 px-4 !text-[12.50px] duration-500 hover:bg-blue-900/15 border-s-4 hover:border-s-blue-900 mb-1 font-medium hover:text-blue-900" :class="{ 'text-gray-500 bg-transparent border-transparent' : $route.name !== 'events', 'text-blue-900 bg-blue-900/15 border-s-blue-900' : $route.name === 'events' }">
                    <span class="me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="max-w-5 min-w-5 max-h-5 min-h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                    </span>
                    Events
                </router-link>
                <router-link :to="{name:'departments'}" class="decoration-0 flex justify-start items-center w-full py-3 px-4 !text-[12.50px] duration-500 hover:bg-blue-900/15 border-s-4 hover:border-s-blue-900 mb-1 font-medium hover:text-blue-900" :class="{ 'text-gray-500 bg-transparent border-transparent' : $route.name !== 'departments', 'text-blue-900 bg-blue-900/15 border-s-blue-900' : $route.name === 'departments' }">
                    <span class="me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="max-w-5 min-w-5 max-h-5 min-h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                        </svg>
                    </span>
                    Departments
                </router-link>
                <router-link :to="{name:'instructors'}" class="decoration-0 flex justify-start items-center w-full py-3 px-4 !text-[12.50px] duration-500 hover:bg-blue-900/15 border-s-4 hover:border-s-blue-900 mb-1 font-medium hover:text-blue-900" :class="{ 'text-gray-500 bg-transparent border-transparent' : $route.name !== 'instructors', 'text-blue-900 bg-blue-900/15 border-s-blue-900' : $route.name === 'instructors' }">
                    <span class="me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="max-w-5 min-w-5 max-h-5 min-h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </span>
                    Instructors
                </router-link>
                <router-link :to="{name:'courses'}" class="decoration-0 flex justify-start items-center w-full py-3 px-4 !text-[12.50px] duration-500 hover:bg-blue-900/15 border-s-4 hover:border-s-blue-900 mb-1 font-medium hover:text-blue-900" :class="{ 'text-gray-500 bg-transparent border-transparent' : $route.name !== 'courses', 'text-blue-900 bg-blue-900/15 border-s-blue-900' : $route.name === 'courses' }">
                    <span class="me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="max-w-5 min-w-5 max-h-5 min-h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                        </svg>
                    </span>
                    Courses
                </router-link>
                <router-link :to="{name:'students'}" class="decoration-0 flex justify-start items-center w-full py-3 px-4 !text-[12.50px] duration-500 hover:bg-blue-900/15 border-s-4 hover:border-s-blue-900 mb-1 font-medium hover:text-blue-900" :class="{ 'text-gray-500 bg-transparent border-transparent' : $route.name !== 'students', 'text-blue-900 bg-blue-900/15 border-s-blue-900' : $route.name === 'students' }">
                    <span class="me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="max-w-5 min-w-5 max-h-5 min-h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </span>
                    Students
                </router-link>
                <router-link :to="{name:'staffs'}" class="decoration-0 flex justify-start items-center w-full py-3 px-4 !text-[12.50px] duration-500 hover:bg-blue-900/15 border-s-4 hover:border-s-blue-900 mb-1 font-medium hover:text-blue-900" :class="{ 'text-gray-500 bg-transparent border-transparent' : $route.name !== 'staffs', 'text-blue-900 bg-blue-900/15 border-s-blue-900' : $route.name === 'staffs' }">
                    <span class="me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="max-w-5 min-w-5 max-h-5 min-h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </span>
                    Staffs
                </router-link>
                <router-link :to="{name:'libraries'}" class="decoration-0 flex justify-start items-center w-full py-3 px-4 !text-[12.50px] duration-500 hover:bg-blue-900/15 border-s-4 hover:border-s-blue-900 mb-1 font-medium hover:text-blue-900" :class="{ 'text-gray-500 bg-transparent border-transparent' : $route.name !== 'libraries', 'text-blue-900 bg-blue-900/15 border-s-blue-900' : $route.name === 'libraries' }">
                    <span class="me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="max-w-5 min-w-5 max-h-5 min-h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                        </svg>
                    </span>
                    Library Assets
                </router-link>
                <router-link :to="{name:'holidays'}" class="decoration-0 flex justify-start items-center w-full py-3 px-4 !text-[12.50px] duration-500 hover:bg-blue-900/15 border-s-4 hover:border-s-blue-900 mb-1 font-medium hover:text-blue-900" :class="{ 'text-gray-500 bg-transparent border-transparent' : $route.name !== 'holidays', 'text-blue-900 bg-blue-900/15 border-s-blue-900' : $route.name === 'holidays' }">
                    <span class="me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="max-w-5 min-w-5 max-h-5 min-h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 1 0 9.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1 1 14.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>
                    </span>
                    Holidays
                </router-link>
                <router-link :to="{name:'fees'}" class="decoration-0 flex justify-start items-center w-full py-3 px-4 !text-[12.50px] duration-500 hover:bg-blue-900/15 border-s-4 hover:border-s-blue-900 mb-1 font-medium hover:text-blue-900" :class="{ 'text-gray-500 bg-transparent border-transparent' : $route.name !== 'fees', 'text-blue-900 bg-blue-900/15 border-s-blue-900' : $route.name === 'fees' }">
                    <span class="me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="max-w-5 min-w-5 max-h-5 min-h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </span>
                    Fees
                </router-link>
            </div>
        </aside>
        <main class="w-full lg:min-w-[calc(100%-270px)] h-screen">
            <div class="w-full flex justify-between items-center min-h-[70px] max-h-[70px] px-5 bg-gray-100">
                <div class="opacity-100 lg:opacity-0 lg:pointer-events-none">
                    <button type="button" class="cursor-pointer min-w-[45px] max-w-[45px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center rounded-full bg-gray-100 hover:bg-gray-200" @click.stop="toggleSidebar()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                        </svg>
                    </button>
                </div>
                <div class="flex justify-center items-start gap-3">
                    <button type="button" class="cursor-pointer min-w-[45px] max-w-[45px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center rounded-full bg-gray-100 duration-500 hover:bg-gray-200" @click="toggleScreenSize()">
                        <template v-if="sizeScreen">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 9V4.5M9 9H4.5M9 9 3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5 5.25 5.25" />
                            </svg>
                        </template>
                        <template v-else>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                            </svg>
                        </template>
                    </button>
                    <div class="relative p-0 m-0">
                        <button type="button" class="cursor-pointer min-w-[45px] max-w-[45px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center rounded-full bg-gray-100 duration-500 hover:bg-gray-200" @click.stop="toggleUserDropdown()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </button>
                        <div class="max-w-[170px] min-w-[170px] mt-1 absolute top-auto end-0 bg-gray-100 rounded-lg duration-500 overflow-hidden" :class="{ 'max-h-[300px]' : isUserActiveDropdown, 'max-h-[0px]' : !isUserActiveDropdown }" @click.stop>
                            <div class="p-1 w-full block border border-gray-300 overflow-hidden rounded-lg">
                                <router-link :to="{name:'profile'}" class="decoration-0 flex justify-start items-center w-full min-h-[45px] max-h-[45px] px-4 !text-[14px] mb-1 rounded-lg duration-500 hover:bg-gray-200 mb-1 text-gray-700 font-medium" :class="{ 'bg-gray-200' : $route.name === 'profile', 'bg-transparent' : $route.name !== 'profile' }" @click="toggleUserDropdown()">
                                    <span class="me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="max-w-5 min-w-5 max-h-5 min-h-5">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                    </span>
                                    Profile
                                </router-link>
                                <button type="button" class="cursor-pointer decoration-0 flex justify-start items-center w-full min-h-[45px] max-h-[45px] px-4 !text-[14px] rounded-lg duration-500 hover:bg-gray-200 text-gray-700 font-medium" v-if="!logoutLoading" @click="logoutApi()">
                                    <span class="me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="max-w-5 min-w-5 max-h-5 min-h-5">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9" />
                                        </svg>
                                    </span>
                                    Logout
                                </button>
                                <button type="button" class="cursor-pointer decoration-0 flex justify-center items-center w-full min-h-[45px] max-h-[45px] px-4 !text-[14px] rounded-lg duration-500 hover:bg-gray-200 text-gray-700 font-medium" v-if="logoutLoading">
                                    <span class="w-4 h-4 inline-block border-2 border-blue-900 border-t-transparent animate-spin rounded-full"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full px-5 min-h-[calc(100vh-70px)] max-h-[calc(100vh-70px)] bg-gray-100 overflow-y-auto">
                <router-view></router-view>
            </div>
        </main>
    </div>
</template>

<script>

import axios from 'axios';
import apiRoute from '../../apiController/apiRoute.js';
import apiService from '../../apiController/apiService.js';
import cookiesServices from "../../apiController/cookiesServices.js";

export default {
    data() {
        return {
            isActiveSidebar: false,
            sizeScreen: false,
            isUserActiveDropdown: false,
            logoutLoading: false,
        }
    },
    mounted() {
        window.addEventListener('click', (event) => this.handleSidebarOutSideClick(event));
        window.addEventListener('click', (event) => this.handleUserDropdownOutSideClick(event));
    },
    beforeUnmount() {
        window.removeEventListener('click', (event) => this.handleSidebarOutSideClick(event));
        window.removeEventListener('click', (event) => this.handleUserDropdownOutSideClick(event));
    },
    methods: {

        toggleSidebar() {
            this.isActiveSidebar = !this.isActiveSidebar;
        },

        handleSidebarOutSideClick() {
            if(this.isActiveSidebar) {
                this.isActiveSidebar = false;
            }
        },

        toggleUserDropdown() {
            this.isUserActiveDropdown = !this.isUserActiveDropdown;
        },

        handleUserDropdownOutSideClick() {
            if(this.isUserActiveDropdown && window.innerWidth >= 991) {
                this.isUserActiveDropdown = false;
            }
        },

        toggleScreenSize() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
                this.sizeScreen = true;
            } else {
                document.exitFullscreen();
                this.sizeScreen = false;
            }
        },

        async logoutApi() {
            try {
                this.logoutLoading = true;
                await axios.post(apiRoute.admin.logout, null, {headers: apiService.authHeaderContent()});
                cookiesServices.remove('admin_token');
                this.$router.push({name:'login'});
            } catch (e) {
                console.log(e)
            } finally {
                this.logoutLoading = false;
            }
        },

    }
}

</script>
