<template>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-4">
        <div class="w-full grid grid-cols-1 xl:grid-cols-2 gap-5">
            <div class="p-5 bg-[#6a73fa] text-white w-full block rounded-lg shadow-lg">
                <div class="!text-[14px] mb-1 font-medium"> Students </div>
                <div class="!text-[30px] font-medium"> 3280 </div>
            </div>
            <div class="p-5 bg-[rgb(255,170,22)] text-white w-full block rounded-lg shadow-lg">
                <div class="!text-[14px] mb-1 font-medium"> Instructors </div>
                <div class="!text-[30px] font-medium"> 250 </div>
            </div>
            <div class="p-5 bg-[rgb(103,59,183)] text-white w-full block rounded-lg shadow-lg">
                <div class="!text-[14px] mb-1 font-medium"> Staffs </div>
                <div class="!text-[30px] font-medium"> 300 </div>
            </div>
            <div class="p-5 bg-[rgb(255,22,22)] text-white w-full block rounded-lg shadow-lg">
                <div class="!text-[14px] mb-1 font-medium"> Departments </div>
                <div class="!text-[30px] font-medium"> 10 </div>
            </div>
        </div>
        <div class="w-full grid grid-cols-1 xl:grid-cols-2 gap-5">
            <div class="p-5 bg-[#3D365C] text-white w-full block rounded-lg shadow-lg">
                <div class="!text-[14px] mb-1 font-medium"> Courses </div>
                <div class="!text-[30px] font-medium"> 40 </div>
            </div>
            <div class="p-5 bg-[#BB3E00] text-white w-full block rounded-lg shadow-lg">
                <div class="!text-[14px] mb-1 font-medium"> Library Assets </div>
                <div class="!text-[30px] font-medium"> 120 </div>
            </div>
            <div class="p-5 bg-[#C95792] text-white w-full block rounded-lg shadow-lg">
                <div class="!text-[14px] mb-1 font-medium"> Holidays </div>
                <div class="!text-[30px] font-medium"> 50 </div>
            </div>
            <div class="p-5 bg-[#5F8B4C] text-white w-full block rounded-lg shadow-lg">
                <div class="!text-[14px] mb-1 font-medium"> Fees </div>
                <div class="!text-[30px] font-medium"> $120000 </div>
            </div>
        </div>
    </div>
    <div class="w-full">
        <div class="w-full flex flex justify-start gap-3 items-end bg-white p-5 mb-5 rounded-lg">
            <canvas ref="chartCanvas" class="min-h-[450px] max-h-[450px]"></canvas>
        </div>
        <div class="w-full block p-5 bg-white mb-5 rounded-lg">
            <div class="mb-3 !text-[25px] font-medium"> Instructor List </div>
            <div class="overflow-x-auto w-full min-h-[calc(100vh-600px)] max-h-[calc(100vh-600px)]">
                <table class="w-full table block">
                    <thead class="w-full font-normal border border-gray-200">
                        <tr class="w-full">
                            <th class="min-w-[290px] max-w-[290px] font-semibold text-start truncate px-4 py-3 !text-[14px]"> Name </th>
                            <th class="min-w-[290px] max-w-[290px] font-semibold text-start truncate px-4 py-3 !text-[14px]"> Email </th>
                            <th class="min-w-[200px] max-w-[200px] font-semibold text-start truncate px-4 py-3 !text-[14px]"> Phone </th>
                            <th class="min-w-[200px] max-w-[200px] font-semibold text-start truncate px-4 py-3 !text-[14px]"> Department </th>
                            <th class="min-w-[200px] max-w-[200px] font-semibold text-start truncate px-4 py-3 !text-[14px]"> Major </th>
                            <th class="min-w-[170px] max-w-[170px] font-semibold text-start truncate px-4 py-3 !text-[14px]"> Joining Date </th>
                            <th class="min-w-[170px] max-w-[170px] font-semibold text-start truncate px-4 py-3 !text-[14px]"> Status </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="w-full border border-gray-200" v-for="(each, index) in 5" :key="index">
                            <td class="min-w-[290px] max-w-[290px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-800"> Mahi Bashar Akash </td>
                            <td class="min-w-[290px] max-w-[290px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-800"> mahibashar2000002@gmail.com </td>
                            <td class="min-w-[200px] max-w-[200px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-800"> 01400125289 </td>
                            <td class="min-w-[200px] max-w-[200px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-800"> Accounting </td>
                            <td class="min-w-[200px] max-w-[200px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-800"> Accounting </td>
                            <td class="min-w-[170px] max-w-[170px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-800"> 05 Aug 2025 </td>
                            <td class="min-w-[170px] max-w-[170px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-800"> Online </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-center items-center">
                <router-link :to="{name:'instructors'}" class="max-w-[150px] w-full inline-flex justify-center items-center min-h-[45px] max-h-[45px] !text-[14px] font-medium bg-blue-400 duration-500 hover:bg-blue-700 text-white rounded-lg">
                    View More
                </router-link>
            </div>
        </div>
        <div class="w-full block p-5 bg-white mb-5 rounded-lg">
            <div class="mb-3 !text-[25px] font-medium"> Student List </div>
            <div class="overflow-x-auto w-full min-h-[calc(100vh-600px)] max-h-[calc(100vh-600px)]">
                <table class="w-full table block">
                    <thead class="w-full font-normal border border-gray-200">
                        <tr class="w-full">
                            <th class="min-w-[290px] max-w-[290px] font-semibold text-start truncate px-4 py-3 !text-[14px]"> Name </th>
                            <th class="min-w-[290px] max-w-[290px] font-semibold text-start truncate px-4 py-3 !text-[14px]"> Email </th>
                            <th class="min-w-[200px] max-w-[200px] font-semibold text-start truncate px-4 py-3 !text-[14px]"> Phone </th>
                            <th class="min-w-[200px] max-w-[200px] font-semibold text-start truncate px-4 py-3 !text-[14px]"> Enrolled Course </th>
                            <th class="min-w-[200px] max-w-[200px] font-semibold text-start truncate px-4 py-3 !text-[14px]"> Payment </th>
                            <th class="min-w-[170px] max-w-[170px] font-semibold text-start truncate px-4 py-3 !text-[14px]"> Due </th>
                            <th class="min-w-[170px] max-w-[170px] font-semibold text-start truncate px-4 py-3 !text-[14px]"> Status </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="w-full border border-gray-200" v-for="(each, index) in 5" :key="index">
                            <td class="min-w-[290px] max-w-[290px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-800"> Mahi Bashar Akash </td>
                            <td class="min-w-[290px] max-w-[290px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-800"> mahibashar2000002@gmail.com </td>
                            <td class="min-w-[200px] max-w-[200px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-800"> 01400125289 </td>
                            <td class="min-w-[200px] max-w-[200px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-800"> Accounting </td>
                            <td class="min-w-[200px] max-w-[200px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-800"> 40000 </td>
                            <td class="min-w-[170px] max-w-[170px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-800"> 20000 </td>
                            <td class="min-w-[170px] max-w-[170px] font-normal text-start truncate px-4 py-3 !text-[14px] text-gray-800"> Online </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-center items-center">
                <router-link :to="{name:'students'}" class="max-w-[150px] w-full inline-flex justify-center items-center min-h-[45px] max-h-[45px] !text-[14px] font-medium bg-blue-400 duration-500 hover:bg-blue-700 text-white rounded-lg">
                    View More
                </router-link>
            </div>
        </div>
    </div>

</template>

<script>

import {
    Chart,
    BarController,
    BarElement,
    CategoryScale,
    LinearScale,
    Title,
    Tooltip,
    Legend
} from 'chart.js'

Chart.register(
    BarController,
    BarElement,
    CategoryScale,
    LinearScale,
    Title,
    Tooltip,
    Legend
)

export default {
    data() {
        return {
            chart: null
        }
    },
    mounted() {
        this.renderChart()
    },
    methods: {
        renderChart() {
            const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Aug','Sep','Oct','Nov','Dec']
            const data = {
                labels: labels,
                datasets: [{
                    label: '',
                    data: [10, 40, 20, 30, 80, 50, 60, 70, 90, 120, 100, 110],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                    ],
                    borderWidth: 1
                }]
            }

            const ctx = this.$refs.chartCanvas.getContext('2d')
            this.chart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                title: () => ''
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            })
        }
    }
}

</script>
