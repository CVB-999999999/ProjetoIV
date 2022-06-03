<div>
    <div class="w-full dark:bg-zinc-100 p-3 md:p-5">
        {{-- Year Chart --}}
        <div class="relative mx-auto dark:text-white">
            <div id="chart" style="height: 300px;"></div>
        </div>
        {{-- Detailed Chart --}}

        <button x-on:click="updateChart1" class="bg-esce px-5 py-3 rounded-md">Say Hi</button>

        <div class="relative mx-auto dark:text-white">
            <div id="chart1" style="height: 300px;"></div>
        </div>
    </div>

    {{-- Chartisan --}}
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    {{-- Year Chart Script --}}
    <script>
        const chart = new Chartisan({
            el: '#chart',
            url: "@chart('project_status')" + "?year=2021",
            hooks: new ChartisanHooks()
                .colors(['#b40e0e', '#4299E1'])
                .legend({position: 'bottom'})
                .tooltip(true)
                .datasets(['bar', 'bar']),
        });
        {{-- Detailed Chart Script --}}
        const chart1 = new Chartisan({
            el: '#chart1',
            url: "@chart('status_year')" + "?year=2021-1",
            hooks: new ChartisanHooks()
                .colors(['#3ad32f', '#e1b442', '#25278a', '#a41c1c'])
                .legend({position: 'bottom'})
                .tooltip(true)
                .datasets(['bar', 'bar']),
        });

        function updateChart1() {
            chart1.update({url: "@chart('status_year')" + "?year=2021-0"})
        }
    </script>
</div>
