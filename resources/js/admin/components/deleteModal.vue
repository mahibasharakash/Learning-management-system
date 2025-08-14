<template>
    <section class="fixed inset-0 size-full grid sm:justify-center items-center duration-500 z-50 p-5 overflow-y-auto" :class="{ 'invisible bg-black/35': !open, 'visible bg-black/65': open }" @click="emitClose">
        <aside class="bg-white rounded-3xl w-full sm:max-w-[450px] sm:min-w-[450px] p-10 duration-500 origin-top" :class="{ 'translate-y-0 opacity-100': open, '-translate-y-1/2 opacity-0': !open }" @click.stop>
            <form @submit.prevent="form" class="w-full">
                <div class="flex justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" class="size-[55px] stroke-rose-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </div>

                <div class="text-red-600 text-center text-[25px] mb-3">
                    Are Your Sure?
                </div>

                <div class="w-full mt-5 flex justify-center items-center gap-2 font-medium">
                    <button type="button" class="cursor-pointer px-10 h-[45px] text-[14px] font-medium max-w-[120px] min-w-[120px] bg-gray-100 duration-500 hover:bg-gray-300 inline-flex justify-center items-center text-gray-900 rounded-[0.625rem]" @click="emitClose">
                        Cancel
                    </button>

                    <button v-if="!deleteLoading" type="submit" class="cursor-pointer px-10 h-[45px] text-[14px] font-medium max-w-[120px] min-w-[120px] bg-rose-600 duration-500 hover:bg-rose-800 inline-flex justify-center items-center text-white rounded-[0.625rem]">
                        Confirm
                    </button>

                    <button v-if="deleteLoading" type="button" class="cursor-pointer px-10 h-[45px] text-[14px] font-medium max-w-[120px] min-w-[120px] bg-rose-600 duration-500 hover:bg-rose-800 inline-flex justify-center items-center text-white rounded-[0.625rem]">
                        <span class="size-[18px] inline-block border-2 border-white border-t-transparent animate-spin rounded-full"></span>
                    </button>
                </div>
            </form>
        </aside>
    </section>
</template>

<script>
export default {
    name: 'DeleteModal',
    props: {
        open: {
            type: Boolean,
            required: true,
        },
        form: {
            type: Function,
            required: true,
        },
        deleteLoading: {
            type: Boolean,
            default: false,
        },
    },
    methods: {
        emitClose() {
            this.$emit('close');
        },
    },
};
</script>
