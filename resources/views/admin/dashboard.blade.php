<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
        />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>
            Hub do Café
        </title>

        @vite(['resources/css/app.css', 'resources/js/index.js'])
    </head>
    <body
        x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
        x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
        :class="{'dark bg-gray-900': darkMode === true}"
    >
        <!-- ===== Preloader Start ===== -->
        <x-admin.preloader />
        <!-- ===== Preloader End ===== -->

        <!-- ===== Page Wrapper Start ===== -->
        <div class="flex h-screen overflow-hidden">
            <!-- ===== Sidebar Start ===== -->
            <x-admin.sidebar />
            <!-- ===== Sidebar End ===== -->

            <!-- ===== Content Area Start ===== -->
            <div
                class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto"
            >
                <!-- Small Device Overlay Start -->
                <x-admin.overlay />
                <!-- Small Device Overlay End -->

                <!-- ===== Header Start ===== -->
                <x-admin.header />
                <!-- ===== Header End ===== -->

                <!-- ===== Main Content Start ===== -->
                <main>
                    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                        <div class="grid grid-cols-12 gap-4 md:gap-6">
                            <div class="col-span-12 space-y-6 xl:col-span-7">
                                <!-- Metric Group One -->
                                <x-admin.metric-group.metric-group-01 />
                                <!-- Metric Group One -->

                                <!-- ====== Chart One Start -->
                                <x-admin.chart.chart-01 />
                                <!-- ====== Chart One End -->
                            </div>
                            <div class="col-span-12 xl:col-span-5">
                                <!-- ====== Chart Two Start -->
                                <x-admin.chart.chart-02 />
                                <!-- ====== Chart Two End -->
                            </div>

                            <div class="col-span-12">
                                <!-- ====== Chart Three Start -->
                                <x-admin.chart.chart-03 />
                                <!-- ====== Chart Three End -->
                            </div>

                            <div class="col-span-12 xl:col-span-5">
                                <!-- ====== Map One Start -->
                                <x-admin.map-01 />
                                <!-- ====== Map One End -->
                            </div>

                            <div class="col-span-12 xl:col-span-7">
                                <!-- ====== Table One Start -->
                                <x-admin.table.table-01 />
                                <!-- ====== Table One End -->
                            </div>
                        </div>
                    </div>
                </main>
                <!-- ===== Main Content End ===== -->
            </div>
            <!-- ===== Content Area End ===== -->
        </div>
        <!-- ===== Page Wrapper End ===== -->
    </body>
</html>
