<template>

    <div class="block text-[21px] px-5 py-3 bg-white rounded-lg mb-3 text-gray-600">
        Events
    </div>

    <div class="bg-white p-3 rounded-lg max-h-[calc(100vh-180px)] min-h-[calc(100vh-180px)] overflow-auto">
        <FullCalendar :options="calendarOptions" />
    </div>

    <section class="fixed inset-0 size-full grid sm:justify-center items-center duration-500 z-50 p-5 overflow-y-auto" :class="isActiveManageModal ? 'visible bg-black/65' : 'invisible bg-black/35'" @click="closeModal">
        <aside class="bg-white rounded-3xl w-full sm:max-w-[450px] sm:min-w-[450px] p-10 duration-500 origin-top" :class="isActiveManageModal ? 'translate-y-0 opacity-100' : '-translate-y-1/2 opacity-0'" @click.stop>
            <div class="mb-3 w-full flex justify-between items-center">
                <div class="text-[21px] font-medium"> <template v-if="selectedEvent?.id"> Edit Event </template> <template v-else> Add Event </template> </div>
                <button type="button" class="min-w-[45px] max-w-[45px] cursor-pointer min-h-[45px] max-h-[45px] inline-flex justify-center items-center bg-gray-100 hover:bg-gray-200 rounded-lg" @click="closeModal">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mb-3 w-full block">
                <label for="event_title" class="block mb-1 w-full !text-[14px] font-medium"> Event Title </label>
                <input id="event_title" name="event_title" v-model="selectedEvent.title" class="rounded-lg w-full outline-0 border border-gray-200 bg-white duration-500 min-h-[45px] max-h-[45px] ring-0 ring-transparent focus-within:ring-2 focus-within:ring-green-800 px-4 font-medium !text-[14px]" placeholder="Event Title" />
            </div>
            <div class="mb-3 w-full block">
                <label for="event_date" class="block mb-1 w-full !text-[14px] font-medium"> Event Date </label>
                <Flatpickr id="event_date" v-model="selectedEvent.date" :config="config" class="rounded-lg w-full outline-0 border border-gray-200 bg-white duration-500 min-h-[45px] max-h-[45px] ring-0 ring-transparent focus-within:ring-2 focus-within:ring-green-800 px-4 font-medium !text-[14px]" />
            </div>
            <div class="mb-3 w-full block">
                <label for="event_color" class="block mb-1 w-full !text-[14px] font-medium"> Event Color </label>
                <input type="color" id="event_color" name="event_color" :value="selectedEvent.color || '#3788d8'" @input="selectedEvent.color = $event.target.value" class="rounded-lg w-full outline-0 border border-gray-200 bg-white duration-500 min-h-[45px] max-h-[45px] ring-0 ring-transparent focus-within:ring-2 focus-within:ring-green-800 px-4 font-medium !text-[14px]" />
            </div>
            <div class="flex justify-end items-center gap-3">
                <button type="button" class="min-w-[90px] cursor-pointer max-w-[90px] inline-flex justify-center items-center min-h-[45px] max-h-[45px] rounded-lg bg-gray-100 duration-500 text-sm hover:bg-gray-200" @click="closeModal()">
                    Cancel
                </button>
                <button type="button" class="min-w-[90px] cursor-pointer max-w-[90px] inline-flex justify-center items-center min-h-[45px] max-h-[45px] text-white rounded-lg bg-blue-500 duration-500 text-sm hover:bg-blue-800" @click="saveEvent()">
                    Save
                </button>
            </div>
        </aside>
    </section>

</template>

<script>

import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import listPlugin from '@fullcalendar/list'
import interactionPlugin from '@fullcalendar/interaction'

import Flatpickr from 'vue-flatpickr-component';

import axios from "axios";
import apiRoute from "../../apiController/apiRoute.js";
import apiService from "../../apiController/apiService.js";

export default {
    components: { FullCalendar, Flatpickr },
    data() {
        return {
            events: [],
            isActiveManageModal: false,
            selectedEvent: {
                id: null,
                title: '',
                date: '',
                color: '#3788d8',
            },
            calendarOptions: {
                plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listYear',
                },
                editable: true,
                selectable: true,
                events: [],
                eventClick: this.handleEventClick,
                dateClick: this.handleDateClick,
                eventTimeFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    meridiem: 'short',
                    hour12: true
                }
            },
            config: {
                enableTime: true,
                dateFormat: 'Y-m-d H:i',
                altInput: true,
                altFormat: 'F j, Y h:i K',
                time_24hr: false,
                defaultDate: new Date(),
                minDate: new Date(),
                allowInput: true,
                disableMobile: true,
            }
        }
    },
    mounted() {
        this.listApi()
    },
    methods: {

        handleEventClick(info) {
            this.isActiveManageModal = true;
            this.selectedEvent = {
                id: info.event.id,
                title: info.event.title,
                date: new Date(info.event.start),
                color: info.event.backgroundColor || '#3788d8',
            };
        },

        handleDateClick(info) {
            this.isActiveManageModal = true;
            this.selectedEvent = {
                id: null,
                title: '',
                date: info.dateStr,
                color: '#3788d8',
            };
        },

        closeModal() {
            this.isActiveManageModal = false
            this.selectedEvent = {
                id: null,
                title: '',
                date: '',
                color: '#3788d8',
            }
        },

        async listApi() {
            try {
                const response = await axios.get(`${apiRoute.admin.event}/list`, {
                    headers: apiService.authHeaderContent
                });

                this.events = response.data.map(event => ({
                    id: event.id,
                    title: event.title,
                    start: event.date,
                    color: event.color || '#3788d8',
                    allDay: !event.date.includes('T'),
                }));

                this.calendarOptions.events = [...this.events];
            } catch (err) {
                console.error('Error fetching events:', err);
            }
        },

        async saveEvent() {
            try {

                const eventDate = this.selectedEvent.date instanceof Date
                    ? this.selectedEvent.date
                    : new Date(this.selectedEvent.date);

                const payload = {
                    ...this.selectedEvent,
                    date: eventDate.toISOString(),
                    color: this.selectedEvent.color || '#3788d8'
                };

                if (this.selectedEvent.id) {
                    await axios.put(`${apiRoute.admin.event}/update/${this.selectedEvent.id}`, payload, {
                        headers: apiService.authHeaderContent
                    });
                } else {
                    await axios.post(`${apiRoute.admin.event}/store`, payload, {
                        headers: apiService.authHeaderContent
                    });
                }

                await this.listApi();
                this.closeModal();
            } catch (err) {
                console.error('Error saving event:', err);
            }
        },

    }
}

</script>
