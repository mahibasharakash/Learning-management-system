<template>

    <div class="block text-[21px] px-5 py-3 bg-white rounded-lg mb-3 text-gray-600">
        Courses
    </div>

    <div class="p-3 bg-white w-full block rounded-lg">

        <div class="w-full flex justify-between items-center mb-3">
            <div class="w-full max-w-[450px]">
                <div class="relative">
                    <div class="absolute top-0 bottom-0 start-0 ps-2.5 flex items-center text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input type="text" name="search" v-model="search" @input="searchData" placeholder="Search Here ..." class="ps-10 pe-4 w-full min-h-[45px] max-h-[45px] block px-4 outline-0 border border-gray-200 ring-0 ring-transparent focus-within:ring-2 focus-within:ring-blue-400 rounded-lg duration-500" />
                </div>
            </div>
            <router-link :to="{name:'manageCourse',state:{id:null}}" class="!text-[14px] cursor-pointer min-w-[90px] max-w-[90px] min-h-[45px] max-h-[45px] duration-500 bg-blue-500 hover:bg-blue-700 text-white inline-flex justify-center items-center rounded-lg">
                Add
            </router-link>
        </div>
        <div class="min-h-[calc(100vh-320px)] max-h-[calc(100vh-320px)] overflow-y-auto" v-if="!loading & tableData.length > 0">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-5">

                <template v-for="(each, index) in tableData" :key="index">
                    <div class="w-full block bg-gray-100 rounded-lg overflow-hidden group shadow-xl border border-gray-100">
                        <div class="relative">
                            <div class="overflow-hidden w-full min-h-[250px] max-h-[250px]">
                                <img :src="`/storage/${each.image}`" class="object-cover scale-100 duration-500 group-hover:scale-125 bg-cover w-full max-h-[250px] min-h-[250px]" alt="course" />
                            </div>
                            <div class="absolute top-0 end-0 p-3">
                                <button type="button" class="min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] inline-flex justify-center items-center text-white bg-black/45 rounded-lg cursor-pointer" @click.stop="toggleDropdown(index, $event)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                    </svg>
                                </button>
                                <div class="max-w-[130px] min-w-[130px] shadow-2xl mt-1 me-3 absolute top-auto end-0 bg-gray-100 rounded-lg duration-500 overflow-hidden" :class="{ 'max-h-[300px]' : dropdownIndex === index, 'max-h-[0px]' : !dropdownIndex !== index }" @click.stop>
                                    <div class="p-1 w-full block">
                                        <router-link :to="{name:'manageCourse',state:{id:each.id}}" class="w-full cursor-pointer flex justify-start items-center py-3 px-4 w-full rounded-lg !text-[14px]" @click="toggleDropdown(index, $event)">
                                            <span class="me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </span>
                                            Edit
                                        </router-link>
                                        <button type="button" class="cursor-pointer flex justify-start items-center py-3 px-4 w-full rounded-lg !text-[14px] text-red-500" @click="toggleDropdown(index, $event)">
                                            <span class="me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </span>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full block px-4 pt-3 font-medium"> {{each.name}} </div>
                        <div class="px-4 py-2 flex justify-between items-center flex-wrap">
                            <span> {{each.from_start_formatted}} </span>
                            <span class="text-gray-700 inline-flex justify-end items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                            <span class="ms-2"> {{each.maximum_students}} </span>
                        </span>
                        </div>
                        <div class="px-4 py-2 flex justify-between items-center flex-wrap">
                            <span> Duration </span>
                            <span> {{each.course_duration}} </span>
                        </div>
                        <div class="px-4 py-2 flex justify-between items-center flex-wrap">
                            <span> Instructor </span>
                            <span> {{each.tutor?.name}} </span>
                        </div>
                        <div class="px-4 pt-2 pb-5 flex justify-between items-center flex-wrap">
                            <span> Student </span>
                            <span> {{each.maximum_students}} </span>
                        </div>
                        <div class="flex justify-end px-4 pb-5">
                            <a href="javascript:void(0)" class="cursor-pointer rounded-lg text-white text-[13px] bg-blue-500 hover:bg-blue-700 duration-500 inline-flex justify-center items-center max-w-[120px] min-w-[120px] min-h-[45px] max-h-[45px]">
                                Read More
                            </a>
                        </div>
                    </div>
                </template>

            </div>

        </div>

        <div v-if="!loading & tableData.length === 0">

            <!-- no records found -->
            <div class="w-full min-h-[calc(100vh-280px)] max-h-[calc(100vh-280px)] text-[17px] font-medium bg-gray-100 rounded-xl text-gray-900 flex justify-center items-center flex-col gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
                No records found.
            </div>

        </div>

        <template v-if="loading">

            <!-- loading -->
            <div class="w-full min-h-[calc(100vh-280px)] max-h-[calc(100vh-280px)] bg-gray-100 rounded-xl flex justify-center items-center">
                <span class="inline-block rounded-full min-w-[45px] max-w-[45px] min-h-[45px] max-h-[45px] border-4 border-gray-900 border-t-transparent animate-spin"></span>
            </div>

        </template>

        <template v-if="!loading & tableData.length > 0">

            <div class="w-full flex justify-between items-center gap-3 mt-3">

                <!-- pagination -->
                <div class="flex justify-center items-center gap-2">
                    <button type="button" class="cursor-pointer min-w-[45px] min-h-[45px] max-w-[45px] max-h-[45px] inline-flex justify-center items-center rounded-full bg-gray-200 outline-0" :class="{ 'pointer-events-none' : currentPage <= 1 }" @click="goPrevious()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="min-w-[15px] min-h-[15px] max-w-[15px] max-h-[15px]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                        </svg>
                    </button>
                    <template v-if="pageCount <= 4">
                        <button v-for="page in pageCount" :key="page" type="button" class="cursor-pointer min-w-[45px] min-h-[45px] max-w-[45px] max-h-[45px] inline-flex justify-center items-center rounded-full outline-0" :class="page === currentPage ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black'" @click="changePage(page)">
                            {{ page }}
                        </button>
                    </template>
                    <template v-else>
                        <button type="button" :key="1" class="cursor-pointer min-w-[45px] min-h-[45px] max-w-[45px] max-h-[45px] inline-flex justify-center items-center rounded-full outline-0" :class="1 === currentPage ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black'" @click="changePage(1)">
                            1
                        </button>
                        <template v-if="currentPage <= 3">
                            <button v-for="page in [2,3]" :key="page" type="button" class="cursor-pointer min-w-[45px] min-h-[45px] max-w-[45px] max-h-[45px] inline-flex justify-center items-center rounded-full outline-0" :class="page === currentPage ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black'" @click="changePage(page)">
                                {{ page }}
                            </button>
                            <span class="px-2">…</span>
                        </template>
                        <template v-else-if="currentPage >= pageCount - 2">
                            <span class="px-2">…</span>
                            <button v-for="page in [pageCount - 2, pageCount - 1]" :key="page" type="button" class="cursor-pointer min-w-[45px] min-h-[45px] max-w-[45px] max-h-[45px] inline-flex justify-center items-center rounded-full outline-0" :class="page === currentPage ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black'" @click="changePage(page)">
                                {{ page }}
                            </button>
                        </template>
                        <template v-else>
                            <span class="px-2">…</span>
                            <button :key="currentPage - 1" type="button" class="cursor-pointer min-w-[45px] min-h-[45px] max-w-[45px] max-h-[45px] inline-flex justify-center items-center rounded-full outline-0" :class="(currentPage - 1) === currentPage ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black'" @click="changePage(currentPage - 1)">
                                {{ currentPage - 1 }}
                            </button>
                            <button :key="currentPage" type="button" class="cursor-pointer min-w-[45px] min-h-[45px] max-w-[45px] max-h-[45px] inline-flex justify-center items-center rounded-full outline-0" :class="currentPage === currentPage ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black'" @click="changePage(currentPage)">
                                {{ currentPage }}
                            </button>
                            <span class="px-2">…</span>
                        </template>
                        <button :key="pageCount" type="button" class="cursor-pointer min-w-[45px] min-h-[45px] max-w-[45px] max-h-[45px] inline-flex justify-center items-center rounded-full outline-0" :class="pageCount === currentPage ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black'" @click="changePage(pageCount)">
                            {{ pageCount }}
                        </button>
                    </template>
                    <button type="button" class="cursor-pointer min-w-[45px] min-h-[45px] max-w-[45px] max-h-[45px] inline-flex justify-center items-center rounded-full bg-gray-200 outline-0" :class="{ 'pointer-events-none' : currentPage >= pageCount }" @click="goNext()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                             stroke="currentColor" class="min-w-[15px] min-h-[15px] max-w-[15px] max-h-[15px]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                        </svg>
                    </button>
                </div>

                <!-- count page -->
                <div> Showing {{ from }} to {{ to }} of {{ total }} entries </div>

            </div>

        </template>

    </div>

</template>

<script>

import axios from "axios";
import apiRoute from "../../../apiController/apiRoute.js";
import apiService from "../../../apiController/apiService.js";

export default {
    data() {
        return {
            dropdownIndex: null,
            deleteLoading: false,
            listLoading: false,
            tableData: [],
            allData: [],
            activeDropdownIndex: null,
            loading: false,
            currentPage: 1,
            perPage: 10,
            limits: Array.from({ length: 10 }, (_, i) => (i + 1) * 20),
            total: 0,
            pageCount: 0,
            from: 0,
            to: 0,
            archived: 0,
            sort_order: 'asc',
            sort_by: '',
            search: null,
            searchTimeout: null,
            selectUserId: [],
            id: null,
        }
    },
    async mounted() {
        await this.readApi(1);
        window.addEventListener('click', () => this.dropdownOutsideClick(event));
    },
    beforeUnmount() {
        window.removeEventListener('click', () => this.dropdownOutsideClick(event));
    },
    methods: {

        toggleDropdown(index, event) {
            event.stopPropagation();
            this.dropdownIndex = this.dropdownIndex === index ? null : index;
        },

        dropdownOutsideClick() {
            this.dropdownIndex = null;
        },

        openDeleteModal(id) {
            this.id = id;
            this.isActiveDeleteModal = true;
        },

        /*** read api ***/
        async readApi(page = 1) {
            try {
                this.loading = true;
                const response = await axios.get(`${apiRoute.admin.course}`, {
                    params: {
                        page,
                        per_page: this.perPage,
                        search: this.search || '',
                        paginate: 0
                    },
                    headers: apiService.headerContent
                });
                const res = response.data;
                this.tableData = res.data;
                this.currentPage = Number(res.current_page);
                this.perPage = Number(res.per_page);
                this.total = Number(res.total);
                this.from = Number(res.from) || 0;
                this.to = Number(res.to) || 0;
                this.pageCount = Math.max(1, Number(res.last_page));
            } catch (error) {
                this.error = error?.response?.data?.errors;
            } finally {
                this.loading = false;
            }
        },

        /*** take me previous page if apply read api ***/
        goPrevious() {
            this.changePage(this.currentPage - 1);
        },

        /*** take me next page if apply read api ***/
        goNext() {
            this.changePage(this.currentPage + 1);
        },

        /*** change page if apply read api ***/
        changePage(page) {
            page = Number(page);
            if (isNaN(page)) page = 1;
            if (page < 1) page = 1;
            if (page > this.pageCount) page = this.pageCount;
            if (page === this.currentPage) return;
            this.readApi(page);
        },

        /*** search data if apply read api ***/
        searchData() {
            if (this.searchTimeout) {
                clearTimeout(this.searchTimeout);
            }
            this.searchTimeout = setTimeout(() => {
                this.readApi(1);
            }, 500);
        },

        async deleteApi() {
            try {
                this.deleteLoading = true;
                await axios.delete(apiRoute.admin.course+`/delete/${this.id}`, {headers: apiService.authHeaderContent()});
                this.isActiveDeleteModal = false;
                await this.readApi(1);
            } catch (e) {
                console.log(e)
            } finally {
                this.deleteLoading = false;
            }
        },

    }
}

</script>
