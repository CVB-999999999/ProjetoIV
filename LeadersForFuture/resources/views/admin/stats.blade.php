@extends('layouts.app')
@section('content')

    <div class="w-full p-3 md:p-5">
        {{-- Year and semester selector --}}
        <div class="mx-auto mb-5 items-center bg-zinc-100 px-5 py-3 rounded-md">
            <div class="text-center">
                {{-- School Year --}}
                <label id="chartYear"> Ano Letivo: </label>
                <input class="p-2 my-1 rounded-md" type="text" name="ChartYear" id="ChartYearInput"
                       placeholder="Ex: 2022">
                {{-- Semester --}}
                <label id="detailedChartSemester"> Semestre: </label>
                <select class="p-3 rounded-md" id="ChartSemesterSelect" name="ChartSemester">
                    <option value="0" selected> 1º Semestre</option>
                    <option value="1"> 2º Semestre</option>
                </select>
            </div>
            <div class="text-center py-1">
                {{-- Update Btn --}}
                <button onclick="updateCharts()" class="bg-esce px-5 py-2 rounded-md">
                    <span class="material-symbols-outlined align-middle h-7">refresh</span> Atualizar
                </button>
            </div>
        </div>
        {{-- Charts --}}
        <div class="bg-zinc-100 px-5 py-3 rounded-md">
            {{-- Yearly Chart --}}
            <div class="relative mx-auto dark:text-white">
                <h2 class="text-black text-2xl text-center"> Estado dos formulários por ano</h2>
                <div id="chart" style="height: 300px;"></div>
            </div>
            {{-- Detailed Chart --}}
            <div class="relative mx-auto dark:text-white">
                <h2 class="text-black text-2xl text-center"> Estado dos formulários detalhado</h2>
                <div id="chart1" style="height: 300px;"></div>
            </div>
        </div>
    </div>

    {{-- Chartisan --}}
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <script>
        // Gets current school year
        let year = getSchoolYear()

        // Puts the current year in the input
        document.getElementById("ChartYearInput").placeholder = year

        {{-- Year Chart Script --}}
        const chart = new Chartisan({
            el: '#chart',
            url: "@chart('project_status')" + "?year=" + year,
            hooks: new ChartisanHooks()
                .colors(['#b40e0e', '#4299E1'])
                .legend({position: 'bottom'})
                .tooltip(true)
                .datasets(['bar', 'bar']),
        });
        {{-- Detailed Chart Script --}}
        const chart1 = new Chartisan({
            el: '#chart1',
            url: "@chart('status_year')" + "?year=" + year + "-1",
            hooks: new ChartisanHooks()
                .colors(['#3ad32f', '#e1b442', '#25278a', '#a41c1c'])
                .legend({position: 'bottom'})
                .tooltip(true)
                .datasets(['bar', 'bar']),
        });

        // Return the current school year
        function getSchoolYear() {
            let date = new Date()
            let year = date.getFullYear()
            if (date.getMonth() < 8) {
                year = year - 1
            }
            return year
        }

        function updateCharts() {

            // Gets the year and semester from the fields
            let year = document.getElementById("ChartYearInput").value;
            let e = document.getElementById("ChartSemesterSelect");
            let sem = e.options[e.selectedIndex].value;

            // If year field is empty uses current year
            if (year === "") {
                year = getSchoolYear()
            }

            // Updates charts
            updateChart(year)
            updateChart1(year, sem)
        }

        function updateChart(year) {
            chart.update({url: "@chart('project_status')" + "?year=" + year})
        }

        function updateChart1(year, sem) {
            chart1.update({url: "@chart('status_year')" + "?year=" + year + "-" + sem})
        }
    </script>
@endsection
