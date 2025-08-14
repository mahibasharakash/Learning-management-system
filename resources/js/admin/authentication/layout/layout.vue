<template>
    <div class="w-full h-screen grid justify-center items-center p-5 overflow-y-auto bg-gray-200">
        <div class="w-full sm:min-w-[420px] sm:max-w-[420px] bg-white p-7 rounded-xl shadow-2xl">
            <div class="flex justify-center mb-3">
                <div class="min-w-[75px] min-h-[75px] max-w-[75px] max-h-[75px] bg-gray-100 inline-flex justify-center items-center rounded-full">
                    <img :src="'/favicon.svg'" class="min-w-[30px] min-h-[30px] max-w-[30px] max-h-[30px]" alt="logo" />
                </div>
            </div>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {

        }
    },
    mounted() {

    },
    methods: {

    }
}

</script>
