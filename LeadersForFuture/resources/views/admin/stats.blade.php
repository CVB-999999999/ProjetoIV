@extends('layouts.app')
@section('content')

    <div class="w-full dark:bg-zinc-100 p-3 md:p-5">
        {{-- Year Chart --}}
        <div class="mx-auto mb-5">
            <label id="yearChart"> Ano Letivo: </label>
            <input class="p-2 w-24 md:w-fit rounded-md" type="text" name="yearChart" id="yearChartInput" placeholder="Ex: 2022">
            <button onclick="updateChart()" class="bg-esce px-5 py-2 rounded-md mx-auto">Atualizar</button>
        </div>

        <div class="relative mx-auto dark:text-white">
            <div id="chart" style="height: 300px;"></div>
        </div>
        {{-- Detailed Chart --}}
        <div class="mx-auto mb-5">
            <label id="detailedChartYear"> Ano Letivo: </label>
            <input class="p-2 my-1 rounded-md" type="text" name="detailedChartYear" id="detailedChartYearInput"
                   placeholder="Ex: 2022">
            <label id="detailedChartSemester"> Semestre: </label>
            <select class="p-3 rounded-md" id="detailedChartSemesterSelect" name="detailedChartSemester">
                <option value="0" selected> 1º Semestre</option>
                <option value="1"> 2º Semestre</option>
            </select>
            <button onclick="updateChart1()" class="bg-esce px-5 py-2 rounded-md">Atualizar</button>
        </div>

        <div class="relative mx-auto dark:text-white">
            <div id="chart1" style="height: 300px;"></div>
        </div>
    </div>

    {{-- Chartisan --}}
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <script>
        // Gets current school year
        let date = new Date()
        let year = date.getFullYear()
        if(date.getMonth() < 8) {
            year = year - 1
        }

        // Puts the current year in the input
        document.getElementById("yearChartInput").placeholder = year
        document.getElementById("detailedChartYearInput").placeholder = year

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

        function updateChart() {
            let year = document.getElementById("yearChartInput").value;

            chart.update({url: "@chart('project_status')" + "?year=" + year})
        }

        function updateChart1() {
            let year = document.getElementById("detailedChartYearInput").value;
            let e = document.getElementById("detailedChartSemesterSelect");
            let sem = e.options[e.selectedIndex].value;

            chart1.update({url: "@chart('status_year')" + "?year=" + year + "-" + sem})
        }
    </script>
@endsection
