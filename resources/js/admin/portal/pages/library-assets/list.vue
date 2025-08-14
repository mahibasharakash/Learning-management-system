<template>

    <div class="block text-[21px] px-5 py-3 bg-white rounded-lg mb-3 text-gray-600">
        Library Assets
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
            <router-link :to="{name:'manageLibrary',state:{id:null}}" class="cursor-pointer min-w-[90px] max-w-[90px] min-h-[45px] max-h-[45px] duration-500 bg-blue-500 hover:bg-blue-700 text-white inline-flex justify-center items-center rounded-lg">
                Add
            </router-link>
        </div>
        <div class="min-h-[calc(100vh-320px)] max-h-[calc(100vh-320px)] overflow-y-auto" v-if="!loading & tableData.length > 0">
            <div class="overflow-x-auto w-full block">
                <table class="w-full table block">
                    <thead class="w-full font-normal border border-gray-200">
                    <tr class="w-full">
                        <th class="min-w-[150px] max-w-[150px] font-medium text-gray-900 text-start truncate px-4 py-3 !text-[14px]">
                            Title
                        </th>
                        <th class="min-w-[150px] max-w-[150px] font-medium text-gray-900 text-start truncate px-4 py-3 !text-[14px]">
                            Subject
                        </th>
                        <th class="min-w-[150px] max-w-[150px] font-medium text-gray-900 text-start truncate px-4 py-3 !text-[14px]">
                            Department
                        </th>
                        <th class="min-w-[150px] max-w-[150px] font-medium text-gray-900 text-start truncate px-4 py-3 !text-[14px]">
                            Publish Date
                        </th>
                        <th class="min-w-[150px] max-w-[150px] font-medium text-gray-900 text-start truncate px-4 py-3 !text-[14px]">
                            Purchase Date
                        </th>
                        <th class="min-w-[150px] max-w-[150px] font-medium text-gray-900 text-start truncate px-4 py-3 !text-[14px]">
                            Asset Type
                        </th>
                        <th class="min-w-[150px] max-w-[150px] font-medium text-gray-900 text-start truncate px-4 py-3 !text-[14px]">
                            Status
                        </th>
                        <th class="min-w-[150px] max-w-[150px] font-medium text-gray-900 text-start truncate px-4 py-3 !text-[14px]">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="w-full border border-gray-200" v-for="(each, index) in tableData" :key="index">
                        <td class="min-w-[150px] max-w-[150px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-600">
                            {{each.title || 'N/A'}}
                        </td>
                        <td class="min-w-[150px] max-w-[150px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-600">
                            {{each.subject || 'N/A'}}
                        </td>
                        <td class="min-w-[150px] max-w-[150px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-600">
                            {{each.department || 'N/A'}}
                        </td>
                        <td class="min-w-[150px] max-w-[150px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-600">
                            {{each.publish_date_formatted || 'N/A'}}
                        </td>
                        <td class="min-w-[150px] max-w-[150px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-600">
                            {{each.purchase_date_formatted || 'N/A'}}
                        </td>
                        <td class="min-w-[150px] max-w-[150px] capitalize font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-600">
                            {{each.asset_type || 'N/A'}}
                        </td>
                        <td class="min-w-[150px] max-w-[150px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-600">
                            <template v-if="each.status === 'in_stocks'"> In Stocks </template>
                            <template v-if="each.status === 'out_of_stocks'"> Out Of Stocks </template>
                        </td>
                        <td class="min-w-[150px] max-w-[150px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-600">
                            <div class="flex justify-start items-center gap-x-2">
                                <router-link :to="{name:'manageLibrary',state:{id:each.id}}" class="cursor-pointer duration-500 inline-flex justify-center items-center max-w-[35px] min-w-[35px] max-h-[35px] min-h-[35px] rounded-lg bg-gray-100 text-gray-900 hover:bg-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </router-link>
                                <button type="button" class="cursor-pointer duration-500 inline-flex justify-center items-center max-w-[35px] min-w-[35px] max-h-[35px] min-h-[35px] rounded-lg bg-red-100 text-red-900 hover:bg-red-500 hover:text-white" @click="openDeleteModal(each.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
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

    <!-- delete modal -->
    <DeleteModal :open="isActiveDeleteModal" :form="deleteApi" :deleteLoading="deleteLoading" @close="isActiveDeleteModal = false" />

</template>

<script>

import DeleteModal from "../../../components/deleteModal.vue";
import axios from "axios";
import apiRoute from "../../../apiController/apiRoute.js";
import apiService from "../../../apiController/apiService.js";

export default {
    components: {
        DeleteModal
    },
    data() {
        return {
            isActiveDeleteModal: false,
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
    },
    methods: {

        openDeleteModal(id) {
            this.id = id;
            this.isActiveDeleteModal = true;
        },

        /*** read api ***/
        async readApi(page = 1) {
            try {
                this.loading = true;
                const response = await axios.get(`${apiRoute.admin.libraryAssets}`, {
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

        /*** short name ***/
        shortName(name) {
            if (name) {
                const words = name.trim().split(/\s+/);
                let initials = '';
                if (words.length >= 2) {
                    initials = words[0][0] + words[1][0];
                } else {
                    initials = words[0].substring(0, 2);
                }
                return initials.toUpperCase();
            }
        },

        async deleteApi() {
            try {
                this.deleteLoading = true;
                await axios.delete(apiRoute.admin.tutor+`/delete/${this.id}`, {headers: apiService.authHeaderContent()});
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
